# Webship Patches — Documentation (branch `11.0.x`)

Composer plugin and curated patch list for [Webship](https://www.drupal.org/project/webship). Built on top of [`cweagans/composer-patches`](https://github.com/cweagans/composer-patches) v2.

- **Branch:** `11.0.x`
- **Drupal core:** `~11.3.0`
- **Use with:** Webship `~11.0.0`, Drupal 11
- **Recommended require:** `"webship/patches": "~11.0.0"`
- **External docs:** <https://github.com/webship/patches/blob/11.0.x/docs/README.md>

## What it does

1. Ships a curated `extra.patches` list (issue / MR diffs vetted by Webship) for Drupal core and contrib modules used by Webship 11.
2. Wraps `cweagans/composer-patches` v2 to add three features missing from upstream v2:
   - **Wildcard** `ignore-dependency-patches` (e.g. `drupal/*`).
   - **Allowlist** `allowed-dependency-patches` — only listed packages contribute dependency-declared patches. Default: `["webship/patches"]`.
   - **`patches-ignore`** restored from cweagans v1 — drop a specific URL declared by a given dependency.

## Why

Drupal contrib modules sometimes ship `extra.patches` entries pointing at stale or third-party patch URLs. With `composer-exit-on-patch-failure: true`, one bad URL aborts the whole install. Upstream cweagans v2 only supports exact-match exclusions and dropped v1's `patches-ignore`, so blocking those patches required enumerating every package by name. This plugin restores wildcard control and adds a default-deny allowlist so only Webship-curated patches apply.

## Contents

- [Installation](installation.md)
- [Configuration](configuration.md)
- [Architecture](architecture.md)
- [Troubleshooting](troubleshooting.md)

## AI assistant context

The AI-assistant context for this package lives in [`webship/ai-agents`](https://github.com/webship/ai-agents), shared across every Webship repository rather than duplicated in each one. Merge its `.claude/` folder into your `~/.claude/`:

- `webship-patches` — installing, configuring, and troubleshooting `webship/patches`. Captures the non-obvious constraints (late-activation rule, default-deny allowlist, filename convention).
- `webship-patches-release-manager` — cutting and publishing releases.
- `composer-patches` — `cweagans/composer-patches` v2 + this plugin's allowlist / wildcard ignore / `patches-ignore` extensions.
- `patch-management` — authoring, re-rolling and the patch filename convention.

## Patch filename convention

```
[package name]--[Date]--[issue number]--[MR number].patch
```

Examples:

- `drupal-core--2026-05-10--3539178--mr-12890.patch`
- `ctools--2026-05-10--3572317--mr-85.patch`

Static, timestamped local files give reproducible builds; raw MR URLs change as commits are added and break checksums mid-install.

## All branches at a glance

| Branch       | Drupal core | Use with                          | External docs                                                              |
|--------------|-------------|-----------------------------------|----------------------------------------------------------------------------|
| `11.0.x`     | `~11.3.0`   | Webship `~11.0.0`, Drupal 11      | <https://github.com/webship/patches/blob/11.0.x/docs/README.md>        |
| `10.1.x`     | `~11.3.0`   | Webship `~10.1.0`                 | <https://github.com/webship/patches/blob/11.0.x/docs/README.md>        |
| `10.0.x`     | `~10.6.0`   | Webship `~10.0.0`                 | <https://github.com/webship/patches/blob/11.0.x/docs/README.md>        |
| `9.2.x`      | `~10.6.0`   | Webship `~9.2.0`                  | <https://github.com/webship/patches/blob/11.0.x/docs/README.md>         |
| `9.1.x`      | `~10.6.0`   | Webship `~9.1.0`                  | <https://github.com/webship/patches/blob/11.0.x/docs/README.md>         |
| `no-patches` | n/a         | Plugin only, empty `extra.patches`| —                                                                          |
| `patches`    | n/a         | Patch files only, do not require  | —                                                                          |

To run with no Webship patches and manage your own list, require the `no-patches` branch (`webship/patches: dev-no-patches`) — plugin still active, allowlist still enforced, but the curated list is empty.
