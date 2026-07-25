# Architecture

## Layout

```
src/
├── Plugin/
│   └── PatchesPlugin.php       # PluginInterface + EventSubscriber + Capable
├── Capability/
│   └── ResolverProvider.php    # cweagans ResolverProvider capability
└── Resolver/
    └── FilteredDependencies.php       # Replacement for cweagans Dependencies resolver
```

## Plugin activation

`composer.json` declares `type: composer-plugin` and:

```json
"extra": {
  "class": "Webship\\Patches\\Plugin\\PatchesPlugin",
  "plugin-modifies-downloads": true,
  "plugin-modifies-install-path": true
}
```

The `plugin-modifies-*` flags promote the plugin into the same early-load phase as `cweagans/composer-patches`, so its event subscribers are registered before the first `PRE_PACKAGE_INSTALL` fires.

## Resolver replacement

`cweagans/composer-patches` v2 dispatches `cweagans\Composer\Event\PluginEvents::POST_DISCOVER_RESOLVERS` after collecting resolvers from all plugins. The plugin subscribes at priority `100` and removes the default `cweagans\Composer\Resolver\Dependencies` instance from the array, leaving only `RootComposer`, `PatchesFile`, and our `FilteredDependencies`.

`FilteredDependencies` (provided via `ResolverProvider` → cweagans `ResolverProvider` capability) reads the lock file, applies the allowlist + ignore wildcards via `fnmatch`, then strips any URLs listed in `extra.patches-ignore`, and emits a `PatchCollection` with `provenance = "dependency:<package>"`.

## Lock rewrite

cweagans writes `patches.lock.json` early (during the first `PRE_PACKAGE_INSTALL`, which fires for `webship/patches` itself on a clean install). On a fresh project this happens *before* our plugin code is loaded, so the first lock is unfiltered.

The plugin compensates: on `POST_PACKAGE_INSTALL` of itself (and as a `PRE_PACKAGE_INSTALL` fallback for the case where the package is already installed) it calls `cweagans` `resolvePatches()` again — this time `FilteredDependencies` is in the resolver list — then via reflection writes the new `PatchCollection` into the cweagans `Locker` (`setLockData()`) and into its in-memory `patchCollection` property. Subsequent `loadLockedPatches()` calls observe the filtered list, so all package-specific patch applications use it.

You will see this line in `composer install -vvv` output:

```
patches: re-resolving patches with filter (allowed: webship/patches).
```

## Drupal Core Patches

`webship/patches` **requires** [`webship/drupal-patches`](https://github.com/webship/drupal-patches), a dedicated package that stores Webship's curated Drupal **core** patches separately from contrib patches so Webship can track the latest Drupal core release. It is a **metapackage** (patch storage), **not** a Composer plugin — the only patch plugin is `webship/patches` — so it belongs only under `extra.composer-patches.allowed-dependency-patches`, never under `config.allow-plugins`.

`webship/drupal-patches` has **one git branch per Drupal core `major.minor`** (`10.4.x`, `10.5.x`, `10.6.x`, `11.1.x`, `11.2.x`, `11.3.x`, `11.4.x`, `12.0.x`) plus a flat `patches` branch that holds the `.patch` files. Each release `require`s `drupal/core ~<minor>.0`, so Composer selects the patch set that matches the installed Drupal core. Its dependency-declared core patches flow through `FilteredDependencies` like any other dependency, gated by `allowed-dependency-patches`.

On this branch `webship/patches` requires:

```json
{
  "require": {
    "webship/drupal-patches": "~11 || ~12"
  }
}
```

