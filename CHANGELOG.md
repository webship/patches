# Changelog — webship/patches (`11.0.x`)

All notable changes on the `11.0.x` branch of [`webship/patches`](https://github.com/webship/patches), newest first.
`12.0.x` targets Webship `12.0.x` and the website project; `11.0.x` targets Webship `11.0.x`. Both run on Drupal core `~11.4.0` for now.
Each release lists the commits — merged pull requests and the drupal.org issues they reference — since the previous release.
`#N` links to the pull request; 7-digit `#NNNNNNN` refs are drupal.org issues.

## [Unreleased]

## [11.0.1] - 2026-09-15

- Add patches for the Display Builder and reCAPTCHA v3 modules ([#10](https://github.com/webship/patches/pull/10), patch files in [#9](https://github.com/webship/patches/pull/9))
  - `drupal/display_builder`: [#3623215](https://www.drupal.org/i/3623215) Keep the schema types of values saved from the Config panel
  - `drupal/display_builder`: [#3623217](https://www.drupal.org/i/3623217) Render the block label when it is set to show
  - `drupal/recaptcha_v3`: [#3622964](https://www.drupal.org/i/3622964) Add the missing langcode to `recaptcha_v3.settings`

[11.0.1]: https://github.com/webship/patches/compare/11.0.0...11.0.1
