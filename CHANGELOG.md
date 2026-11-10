# Changelog — webship/patches (`11.0.x`)

All notable changes on the `11.0.x` branch of [`webship/patches`](https://github.com/webship/patches), newest first.
`11.0.x` is the only supported branch, and it targets Webship `11.0.x` on Drupal core `~11.4.0`.
Each release lists the commits — merged pull requests and the drupal.org issues they reference — since the previous release.
`#N` links to the pull request; 7-digit `#NNNNNNN` refs are drupal.org issues.

## [Unreleased]

- Remove the Shield patch for [#3562392](https://www.drupal.org/i/3562392): Shield 1.9.0 rewrote the settings form, so the file no longer applies to any release Composer now resolves, and Shield 1.11.0 already declares the constructor parameter nullable, which the patch was for; the weekly 11.0.x run had been red on it since 2026-10-26 ([#62](https://github.com/webship/patches/pull/62))
  - The test project no longer installs `drupal/shield`; the patch file stays on the `patches` branch because released tags still point at it
- Remove the patches for the Display Builder module (`drupal/display_builder`)

## [11.0.1] - 2026-09-15

- Add patches for the Display Builder and reCAPTCHA v3 modules ([#10](https://github.com/webship/patches/pull/10), patch files in [#9](https://github.com/webship/patches/pull/9))
  - `drupal/display_builder`: [#3623215](https://www.drupal.org/i/3623215) Keep the schema types of values saved from the Config panel
  - `drupal/display_builder`: [#3623217](https://www.drupal.org/i/3623217) Render the block label when it is set to show
  - `drupal/recaptcha_v3`: [#3622964](https://www.drupal.org/i/3622964) Add the missing langcode to `recaptcha_v3.settings`

[11.0.1]: https://github.com/webship/patches/compare/11.0.0...11.0.1
