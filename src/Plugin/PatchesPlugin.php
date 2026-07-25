<?php

namespace Webship\Patches\Plugin;

use Composer\Composer;
use Composer\DependencyResolver\Operation\InstallOperation;
use Composer\EventDispatcher\EventSubscriberInterface;
use Composer\Installer\PackageEvent;
use Composer\Installer\PackageEvents;
use Composer\IO\IOInterface;
use Composer\Plugin\Capable;
use Composer\Plugin\PluginInterface;

/**
 * Adds wildcard ignore-dependency-patches, an allowed-dependency-patches
 * allowlist, and v1-style patches-ignore on top of cweagans/composer-patches.
 *
 * Requires cweagans/composer-patches "~2.0". The default Dependencies resolver
 * is replaced with FilteredDependencies (via Capability +
 * POST_DISCOVER_RESOLVERS), and patches.lock.json is force-rewritten once our
 * own package is installed.
 */
class PatchesPlugin implements PluginInterface, EventSubscriberInterface, Capable
{
    /**
     * Packages whose extra.patches are applied by default (no config needed).
     */
    public const DEFAULT_ALLOWED_DEPENDENCY_PATCHES = ['webship/patches', 'webship/drupal-patches'];

    private Composer $composer;
    private IOInterface $io;
    private bool $reresolved = false;

    public function activate(Composer $composer, IOInterface $io): void
    {
        $this->composer = $composer;
        $this->io = $io;
    }

    public function deactivate(Composer $composer, IOInterface $io): void
    {
    }

    public function uninstall(Composer $composer, IOInterface $io): void
    {
    }

    public function getCapabilities(): array
    {
        if (!$this->cweagansAvailable()) {
            return [];
        }
        return [
            \cweagans\Composer\Capability\Resolver\ResolverProvider::class
                => \Webship\Patches\Capability\ResolverProvider::class,
        ];
    }

    public static function getSubscribedEvents(): array
    {
        return [
            PackageEvents::PRE_PACKAGE_INSTALL => [['onPrePackage', 9999]],
            PackageEvents::PRE_PACKAGE_UPDATE => [['onPrePackage', 9999]],
            PackageEvents::POST_PACKAGE_INSTALL => [['onPostPackage', 9999]],
            'post-discover-resolvers' => [['filterResolvers', 100]],
        ];
    }

    /**
     * Whether the cweagans/composer-patches v2 plugin class is autoloadable.
     *
     * Deliberately not cached: within a single Composer process the cweagans
     * classes can become autoloadable mid-run (for example when
     * cweagans/composer-patches is installed by the same `composer require`
     * that installs this plugin), so a cached "not found" would short-circuit
     * the resolver filter and the capability wiring for the rest of the run.
     */
    private function cweagansAvailable(): bool
    {
        return class_exists(\cweagans\Composer\Plugin\Patches::class);
    }

    public function filterResolvers($event): void
    {
        if (!$this->cweagansAvailable()) {
            return;
        }
        $resolvers = $event->getCapabilities();
        $kept = [];
        foreach ($resolvers as $resolver) {
            if ($resolver instanceof \cweagans\Composer\Resolver\Dependencies) {
                continue;
            }
            $kept[] = $resolver;
        }
        $event->setCapabilities($kept);
    }

    public function onPrePackage(PackageEvent $event): void
    {
        if (!$this->reresolved) {
            $this->reresolveAndRewriteLock();
        }
    }

    public function onPostPackage(PackageEvent $event): void
    {
        $op = $event->getOperation();
        if (!$op instanceof InstallOperation) {
            return;
        }
        if ($op->getPackage()->getName() === 'webship/patches') {
            $this->reresolveAndRewriteLock();
        }
    }

    private function reresolveAndRewriteLock(): void
    {
        if ($this->reresolved) {
            return;
        }
        $cweagans = $this->findCweagansPlugin();
        if ($cweagans === null) {
            return;
        }
        $this->reresolved = true;

        $this->io->write('<info>webship/patches: re-resolving patches with filter (allowed dependency patches).</info>');
        $newCollection = $cweagans->resolvePatches();

        $r = new \ReflectionClass($cweagans);
        $lockerProp = $r->getProperty('locker');
        $lockerProp->setAccessible(true);
        $locker = $lockerProp->getValue($cweagans);
        $locker->setLockData($newCollection, true);

        if ($r->hasProperty('patchCollection')) {
            $pcProp = $r->getProperty('patchCollection');
            $pcProp->setAccessible(true);
            $pcProp->setValue($cweagans, $newCollection);
        }
    }

    private function findCweagansPlugin()
    {
        if (!$this->cweagansAvailable()) {
            return null;
        }
        foreach ($this->composer->getPluginManager()->getPlugins() as $plugin) {
            if ($plugin instanceof \cweagans\Composer\Plugin\Patches) {
                return $plugin;
            }
        }
        return null;
    }
}
