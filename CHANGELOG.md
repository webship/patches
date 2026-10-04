# Changelog — webship/patches (`11.0.x`)

All notable changes on the `11.0.x` branch of [`webship/patches`](https://github.com/webship/patches), newest first.
`12.0.x` targets Webship `12.0.x` and the website project; `11.0.x` targets Webship `11.0.x`. Both run on Drupal core `~11.4.0` for now.
Each release lists the commits — merged pull requests and the drupal.org issues they reference — since the previous release.
`#N` links to the pull request; 7-digit `#NNNNNNN` refs are drupal.org issues.

## [Unreleased]

## [12.0.7] - 2026-10-04

- Drupal 12 install of all five site templates: Composer resolves and `drupal/website` installs Website Starter, Webship Starter, Webship Portal, Webapi Starter and Webships Starter on Drupal 12.0.0-beta1 with PHP 8.5 ([#32](https://github.com/webship/patches/pull/32), [#33](https://github.com/webship/patches/pull/33), [#35](https://github.com/webship/patches/pull/35), [#39](https://github.com/webship/patches/pull/39), [#41](https://github.com/webship/patches/pull/41), [#43](https://github.com/webship/patches/pull/43))
  - `^12` in the info files of ai_logging, autocomplete_deluxe, automatic_updates, better_exposed_filters, coffee, config_update, drupical, easy_encryption, focal_point, flood_control, login_emailusername, project_browser, schemata, security_review, tagify, views_bulk_operations and webform ([#3603992](https://www.drupal.org/i/3603992))
  - Webform: `massageFormValues(): array`, and RequirementSeverity folded into the [#3617732](https://www.drupal.org/i/3617732) patch
  - An Attribute class next to the Annotation of the plugin managers of crop, config_filter, ctools, dashboards, devel, embed, entity_embed, field_validation, google_tag, metatag, openapi, openapi_ui, schemata, schema_metatag, simple_oauth and ai_content_suggestions (Drupal 12 refuses annotation-only managers)
  - Method signatures (getOperations and getDefaultOperations with CacheableMetadata, validate(mixed): void, interact(): void, execute(?object), RenderElementBase) in 19 modules; config schema constraints as keyed options in 8 modules; the ai ComplexToolItems constraint; ui_patterns RequiredArrayValues ([#3588936](https://www.drupal.org/i/3588936)); book constraints ([#3595865](https://www.drupal.org/i/3595865)); extlink library discovery ([#3604276](https://www.drupal.org/i/3604276))
  - jsonapi_extras resource type repository constructor; better_exposed_filters MR !282; config_ignore Drush 14 listener
  - PHP 8.5: ui_patterns ignored `merge()` results, google_tag `SplObjectStorage::contains()`

## [12.0.6] - 2026-10-04

- Add the Display Builder `core_version_requirement` and Key list builder patches ([#30](https://github.com/webship/patches/pull/30), patch files in [#29](https://github.com/webship/patches/pull/29))
  - `drupal/display_builder`: [#3620792](https://www.drupal.org/i/3620792) `^12` in the info files (Drupal 12 installs it; the builder UI still needs upstream htmx 4 work)
  - `drupal/key`: [#3627461](https://www.drupal.org/i/3627461) Add the `CacheableMetadata` parameter to `KeyListBuilder::getOperations()`

## [12.0.5] - 2026-10-01

- Add the Drupal 12 requirements, signature and Webform patches ([#27](https://github.com/webship/patches/pull/27), patch files in [#26](https://github.com/webship/patches/pull/26))
  - `RequirementSeverity` parts of the Project Update Bot MRs (Drupal 12 removes the `REQUIREMENT_*` constants): ai, ai_translate, captcha, field_group, google_tag, metatag; re-rolled for friendlycaptcha 1.1.4 and token 1.17
  - `drupal/ai`: [#3586667](https://git.drupalcode.org/project/ai/-/work_items/3586667) Add the `$object` parameter to `ExecutableInterface::execute()` implementations
  - `drupal/captcha`: [#3576948](https://www.drupal.org/i/3576948) Replace the deprecated `FormElement` base class
  - `drupal/consumers`: [#3592591](https://git.drupalcode.org/project/consumers/-/work_items/3592591) `ConsumerListBuilder::getOperations()` forward-compatible signature
  - `drupal/field_group`: [#3489669](https://www.drupal.org/i/3489669) Replace annotations with PHP attributes (re-rolled for 4.0.0)
  - `drupal/google_tag`: [#3617953](https://www.drupal.org/i/3617953) Add the array return type to `getSubscribedEvents()`
  - `drupal/key`: [#3484086](https://www.drupal.org/i/3484086) Add attributes to plugins in addition to annotations
  - `drupal/views_bulk_operations`: [#3617756](https://www.drupal.org/i/3617756) Add the missing return type to `getSubscribedEvents()`
  - `drupal/webform`: [#3537358](https://www.drupal.org/i/3537358), [#3585813](https://www.drupal.org/i/3585813), [#3590360](https://www.drupal.org/i/3590360), [#3614713](https://www.drupal.org/i/3614713), [#3617732](https://www.drupal.org/i/3617732), [#3618362](https://www.drupal.org/i/3618362), [#3618665](https://www.drupal.org/i/3618665), [#3618674](https://www.drupal.org/i/3618674), [#3618889](https://www.drupal.org/i/3618889)

## [12.0.4] - 2026-10-01

- Change the AI Image Alt Text `core_version_requirement` patch for [#3594672](https://git.drupalcode.org/project/ai_image_alt_text/-/work_items/3594672) to the file re-rolled for ai_image_alt_text 1.0.3: the 1.0.2 file no longer applies, which broke fresh builds

## [12.0.3] - 2026-10-01

- Remove the Redirect patch for [#3602388](https://www.drupal.org/i/3602388) (MR !196): Composer Patches can apply it before the [#2879648](https://www.drupal.org/i/2879648) patch it was re-rolled on, and both append to `redirect.services.yml`, so the install fails where only `git apply` is available. The `core_version_requirement` patch for Redirect stays.

## [12.0.2] - 2026-10-01

- Add the Drupal 12 compatibility patches for 64 contrib modules: the Project Update Bot (or issue) MR where it applies to the installed release, and a `core_version_requirement` patch where it does not
- Remove the Shield patch for [#3562392](https://www.drupal.org/i/3562392): the Drupal 12 MR for [#3602958](https://www.drupal.org/i/3602958) carries the same change
- Remove the `ReflectionProperty::setAccessible()` calls, deprecated in PHP 8.5 and a no-op since PHP 8.1
- Remove the patches for the Display Builder module (`drupal/display_builder`)

## [11.0.1] - 2026-09-15

- Add patches for the Display Builder and reCAPTCHA v3 modules ([#10](https://github.com/webship/patches/pull/10), patch files in [#9](https://github.com/webship/patches/pull/9))
  - `drupal/display_builder`: [#3623215](https://www.drupal.org/i/3623215) Keep the schema types of values saved from the Config panel
  - `drupal/display_builder`: [#3623217](https://www.drupal.org/i/3623217) Render the block label when it is set to show
  - `drupal/recaptcha_v3`: [#3622964](https://www.drupal.org/i/3622964) Add the missing langcode to `recaptcha_v3.settings`

[12.0.7]: https://github.com/webship/patches/compare/12.0.6...12.0.7
[12.0.6]: https://github.com/webship/patches/compare/12.0.5...12.0.6
[12.0.5]: https://github.com/webship/patches/compare/12.0.4...12.0.5
[12.0.4]: https://github.com/webship/patches/compare/12.0.3...12.0.4
[12.0.3]: https://github.com/webship/patches/compare/12.0.2...12.0.3
[11.0.1]: https://github.com/webship/patches/compare/11.0.0...11.0.1
[12.0.2]: https://github.com/webship/patches/compare/12.0.1...12.0.2
