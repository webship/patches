# Webship Patches

[![Test patches (11.0.x)](https://github.com/webship/patches/actions/workflows/test-patches.yml/badge.svg?branch=11.0.x)](https://github.com/webship/patches/actions/workflows/test-patches.yml?query=branch%3A11.0.x)
[![Total Downloads](https://img.shields.io/packagist/dt/webship/patches.svg)](https://packagist.org/packages/webship/patches)
[![License](https://img.shields.io/packagist/l/webship/patches.svg)](LICENSE)

List of needed patches for Webship used packages with Composer Patches.

The `11.0.x` branch tests itself: it installs Drupal plus the modules it patches, asserts that Composer Patches applies all of them, and checks that every patch file still exists ([`tests/`](tests/)).

Composer plugin and curated patch list for [Webship](https://www.drupal.org/project/webship). Built on top of [`cweagans/composer-patches`](https://github.com/cweagans/composer-patches) v2 with three additions that v2 dropped or never had:

- **Wildcard** `ignore-dependency-patches` (e.g. `drupal/*`).
- **Allowlist** `allowed-dependency-patches` — only listed packages contribute dependency-declared patches. Defaults to `["webship/patches"]`.
- **`patches-ignore`** restored from cweagans v1 — drop a specific URL declared by a given dependency.

Plus two Composer commands to convert remote merge-request URLs into local timestamped patch files (`./patches/<package>--YYYY-MM-DD--<issue>--mr-<n>.patch`).

## Quick start

```bash
composer require webship/patches:~11.0.0
```

```json
{
  "config": {
    "allow-plugins": {
      "cweagans/composer-patches": true,
      "webship/patches": true
    }
  },
  "extra": {
    "enable-patching": true,
    "composer-exit-on-patch-failure": true,
    "composer-patches": {
      "allowed-dependency-patches": [
        "webship/patches",
        "webship/drupal-patches"
      ]
    },
    "patches": {}
  }
}
```

```bash
composer install
```

Result: only patches declared by `webship/patches` (and your project's own `extra.patches`) apply. Patches declared by other dependencies are skipped — no more aborted installs from stale third-party `.patch` URLs.

## Versions

| Branch       | Drupal core | Use with                     |
|--------------|-------------|------------------------------|
| `11.0.x`     | `~11.3.0`   | Webship `~11.0.0`, Drupal 11 |
| `10.1.x`     | `~11.3.0`   | Webship `~10.1.0`            |
| `10.0.x`     | `~10.6.0`   | Webship `~10.0.0`            |
| `9.2.x`      | `~10.6.0`   | Webship `~9.2.0`             |
| `9.1.x`      | `~10.6.0`   | Webship `~9.1.0`             |
| `no-patches` | n/a         | Plugin only, manage your own list |

The `patches` branch carries patch files only — do not require it.

## Drupal Core Patches

Drupal **core** patches are managed in a dedicated package, [`webship/drupal-patches`](https://github.com/webship/drupal-patches), so Webship can always track the latest Drupal core release while keeping core patches separate from contrib patches.

`webship/patches` **requires** `webship/drupal-patches`. The core-patches package stores the curated Drupal core patches with **one git branch per Drupal core `major.minor`** — `10.4.x`, `10.5.x`, `10.6.x`, `11.1.x`, `11.2.x`, `11.3.x`, `11.4.x`, `12.0.x` — plus a flat `patches` branch that holds the actual `.patch` files. Each `drupal-patches` release `require`s `drupal/core ~<minor>.0`, so Composer automatically selects the patch set that matches the Drupal core version installed in your project.

On this branch `webship/patches` requires:

```json
{
  "require": {
    "webship/drupal-patches": "~11 || ~12"
  }
}
```

> **Note:** `webship/drupal-patches` is a **metapackage** — a storage for Drupal core patches — **not** a Composer plugin. The only Webship patch *plugin* is `webship/patches`. List `webship/drupal-patches` only under `extra.composer-patches.allowed-dependency-patches`, and **never** under `config.allow-plugins`.

## Handling Webship Patches Ignoring

To exclude a specific patch declared by `webship/patches` (e.g. when you want to replace it with an improved version, or skip it entirely), add a `patches-ignore` block to your root `composer.json`:

```json
{
  "extra": {
    "patches-ignore": {
      "webship/patches": {
        "drupal/recaptcha": {
          "fix: #3588269 Make Drupal8Post::submit() compatible with parent":
          "https://git.drupalcode.org/project/recaptcha/-/commit/68b0f86d1e930ed78f795a97a2fc207be35b3260.diff"
        }
      }
    }
  }
}
```

Schema: `{ "<source-pkg>": { "<target-pkg>": { "<description>": "<url>" } } }`. Matching is done by URL — the description string is informational. A flat array of URLs (`{ "<source-pkg>": { "<target-pkg>": ["<url>", ...] } }`) is also accepted.

This is the v1-style `patches-ignore` from `cweagans/composer-patches`, restored by this plugin on top of v2.

### Ignoring Drupal Core Patches

`webship/drupal-patches` is an ordinary dependency that contributes patches through the dependency resolver, so the same `patches-ignore` block controls it — use `webship/drupal-patches` as the **source** package and `drupal/core` as the **target**:

```json
{
  "extra": {
    "patches-ignore": {
      "webship/drupal-patches": {
        "drupal/core": {
          "Issue #3606822: ContainerBuilder synthetic kernel on install": "https://git.drupalcode.org/project/drupal/-/merge_requests/16159.patch"
        }
      }
    }
  }
}
```

Matching is by URL string, the same as for `webship/patches`.

### Filename convention

```
[package name]--[Date]--[issue number]--[MR number].patch
```

Examples:

- `drupal-core--2026-05-10--3539178--mr-12890.patch`
- `ctools--2026-05-10--3572317--mr-85.patch`
- `redirect--2026-05-10--2879648--mr-109.patch`

## Fresh builds: commit `patches.lock.json`

On a fresh, lock-less build (`composer create-project`, or the first
`composer require`/`composer update` of a project with no `vendor/`),
Composer installs plugins one at a time inside the same run.
`cweagans/composer-patches` activates first — it is a dependency of this
plugin — and resolves the patch collection at the first package event after
its own activation, **before Webship Patches has been installed**. The
allow-list cannot run inside that one-shot bootstrap window:

- Normally this is harmless: the collection is momentarily unfiltered, and
  Webship Patches re-resolves and rewrites `patches.lock.json` through the
  allow-list the moment its own package lands, later in the same run.
- It turns fatal when any third-party dependency in the tree declares a
  patch Composer cannot download — for example a repository-relative path
  like `patches/foo.patch`, which only resolves inside that package's own
  repository. `composer-patches` then aborts the whole install while
  creating `patches.lock.json`, before the filter exists:

  ```
  The "patches/foo.patch" file could not be downloaded: Failed to open stream:
  No such file or directory
  ```

The fix is to **commit `patches.lock.json` to the project template or site
repository** — it is a lock file and belongs in version control next to
`composer.lock`. When it is present, `composer-patches` loads it instead of
resolving, nothing is downloaded during the window, and Webship Patches
re-resolves and rewrites it through the allow-list once active. For a CI job
that cannot ship a committed lock, seed a stub before the first Composer
command:

```bash
[ -f patches.lock.json ] || echo '{"patches": {}}' > patches.lock.json
```

or install the plugin globally first (`composer global require
webship/patches`) so it is active from process start. Once the plugin
is loaded, the allow-list is enforced on every resolve and the lock file
self-heals — patches from packages outside `allowed-dependency-patches`
(default: `webship/patches` and `webship/drupal-patches`) never
reach `patches.lock.json`.

## Documentation

- [Overview](docs/README.md)
- [Installation](docs/installation.md)
- [Configuration](docs/configuration.md)
- [Architecture](docs/architecture.md)
- [Troubleshooting](docs/troubleshooting.md)

External: <https://github.com/webship/patches/blob/11.0.x/docs/README.md>

## AI assistant context

The AI-assistant context for this package lives in [`webship/ai-agents`](https://github.com/webship/ai-agents), shared across every Webship repository rather than duplicated in each one. Merge its `.claude/` folder into your `~/.claude/` to make the agents and skills available:

- `webship-patches` — installing, configuring, and troubleshooting `webship/patches`.
- `webship-patches-release-manager` — cutting and publishing releases.
- `composer-patches` — `cweagans/composer-patches` v2 + this plugin's allowlist, wildcard ignore, and `patches-ignore` extensions.
- `patch-management` — authoring, re-rolling and the patch filename convention.

## Requirements

- PHP `>=8.1`
- `composer-plugin-api ^2.0`
- `cweagans/composer-patches ~2.0`

## License

GPL-2.0-or-later. See [LICENSE](LICENSE).

## Maintainer

[Webship](https://webship.org) — <https://github.com/webship>
