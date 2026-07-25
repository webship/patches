# Installation

## Require the package

```bash
composer require webship/patches:~11.0.0
```

For Webship `~10.1.0` use `~10.1.0`, etc. See the version table in [index.md](index.md).

## Allow the plugin

`webship/patches` is a Composer plugin. Composer 2.2+ requires every plugin to be allowlisted in your root `composer.json`:

```json
{
  "config": {
    "allow-plugins": {
      "cweagans/composer-patches": true,
      "webship/patches": true,
      "composer/installers": true,
      "drupal/core-composer-scaffold": true,
      "drupal/core-project-message": true,
      "drupal/core-recipe-unpack": true,
      "drupal/core-vendor-hardening": true,
      "oomphinc/composer-installers-extender": true,
      "php-http/discovery": true
    }
  }
}
```

## Minimal recommended config

```json
{
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

With this config:

- Patches declared by `webship/patches` apply.
- Patches declared by other dependencies (e.g. random `drupal/*` modules with their own `extra.patches`) are silently skipped.
- Your project-level `extra.patches` block applies as usual.

## Requirements

- PHP `>=8.1`
- `composer-plugin-api ^2.0`
- `cweagans/composer-patches ~2.0`

`cweagans/composer-patches ~1` is not supported. The plugin requires `~2.0`.
