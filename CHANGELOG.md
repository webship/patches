# Changelog — webship/patches (`11.0.x`)

All notable changes on the `11.0.x` branch of [`webship/patches`](https://github.com/webship/patches), newest first.
`12.0.x` targets Webship `12.0.x` and the website project; `11.0.x` targets Webship `11.0.x`. Both run on Drupal core `~11.4.0` for now.
Each release lists the commits — merged pull requests and the drupal.org issues they reference — since the previous release.
`#N` links to the pull request; 7-digit `#NNNNNNN` refs are drupal.org issues.

## [Unreleased]

## [12.0.17] - 2026-11-22

- Remove the AI Validations Drupal 12 patch (`RequirementSeverity`): ai_validations 1.4.1 carries the change, and the file no longer applied, which stopped `composer create-project drupal/webship_project:12.0.x-dev` ([#84](https://github.com/webship/patches/pull/84))
- Remove the three AI Content Suggestions Drupal 12 patches ([#3594629](https://www.drupal.org/i/3594629) info file, the plugin Attribute file, the config schema file): ai_content_suggestions 1.5.3 declares `^12` and carries its own Drupal 12 changes ([#86](https://github.com/webship/patches/pull/86))
- Remove the Display Builder AI Drupal 12 patch (method signatures): display_builder_ai 1.0.0-alpha4 declares `^12` and no longer has the files it changed ([#87](https://github.com/webship/patches/pull/87))
- Change the two Entity Embed feature patches ([#3070343](https://www.drupal.org/i/3070343), [#2679875](https://www.drupal.org/i/2679875)) to the files re-rolled for Entity Embed 1.8.0, which moved its hooks into a class, and remove the three files 1.8.0 now carries ([#3531672](https://www.drupal.org/i/3531672), the [#3610147](https://www.drupal.org/i/3610147) info file, the plugin Attribute file) ([#88](https://github.com/webship/patches/pull/88), patch files in [#85](https://github.com/webship/patches/pull/85))
  - The removed files stay on the `patches` branch, as the earlier removals keep theirs

## [12.0.16] - 2026-11-18

- Remove the AI Translate Drupal 12 compatibility patch ([#3585522](https://www.drupal.org/i/3585522), its info file): ai_translate 1.4.5 declares `^12` in both of its info files, and the file no longer applied, which stopped `composer create-project drupal/webship_project:12.0.x-dev` and turned the `Test patches` run of 12.0.x red ([#78](https://github.com/webship/patches/pull/78))
- Remove the four Embed patches ([#3517882](https://www.drupal.org/i/3517882) MR !26, [#3597602](https://www.drupal.org/i/3597602) MR !27 and its info file, the plugin Attribute file): Embed 1.11 carries the #3517882 fix and Embed 1.12 declares `^11.3 || ^12` with its own Drupal 12 support, so none of the four files applied to 1.12 ([#79](https://github.com/webship/patches/pull/79))
- Remove the External Links Drupal 12 compatibility patch ([#3604276](https://www.drupal.org/i/3604276), library discovery): extlink 3.0.1 declares `^11.3 || ^12` and carries its own Drupal 12 changes, and the file no longer applied ([#80](https://github.com/webship/patches/pull/80))
  - The removed files stay on the `patches` branch, as the earlier removals keep theirs

## [12.0.15] - 2026-11-18

- Remove the three Inline Entity Form Drupal 12 patches ([#3599178](https://www.drupal.org/i/3599178) MR !172, its info file, the method signatures file): inline_entity_form 3.1.0 declares `^12` and carries the signatures, and the files no longer applied, which stopped `composer create-project drupal/webship_project:12.0.x-dev` and turned the `Test patches` run of 12.0.x red ([#76](https://github.com/webship/patches/pull/76))
  - The two feature patches ([#2913571](https://www.drupal.org/i/2913571), [#3136514](https://www.drupal.org/i/3136514)) still apply to 3.1.0 and stay; the three files stay on the `patches` branch, as the earlier removals keep theirs

## [12.0.14] - 2026-11-18

- Change the Display Builder Drupal 12 compatibility patch for [#3620792](https://www.drupal.org/i/3620792) to the file that also gives the nested `display_builder_entity_view_lb` module `^12`: without it a Drupal 12 site install stopped at "module 'display_builder_entity_view_lb' is incompatible with this version of Drupal core" ([#74](https://github.com/webship/patches/pull/74), patch file in [#73](https://github.com/webship/patches/pull/73))

## [12.0.13] - 2026-11-18

- Remove the AI Logging Drupal 12 compatibility patch: ai_logging 1.3.4 carries `^12` in its info file, and the file no longer applies, which stopped `composer create-project drupal/webship_project:12.0.x-dev` ([#71](https://github.com/webship/patches/pull/71))
  - The file stays on the `patches` branch, as the earlier removals keep theirs
- Change the test project to install Google Tag `~2.0.0`, the range Web SEO declares, instead of `^2.0`: CI installed google_tag 2.1.0, which Webship does not install and to which none of the six Google Tag patches applies, so the `Test patches` run of 12.0.x turned red ([#71](https://github.com/webship/patches/pull/71))
  - The six Google Tag patches stay: webship_project and website lock google_tag 2.0.9, where all six apply and the info patch still adds `^12`

## [12.0.12] - 2026-11-12

- Remove the three Devel Drupal 12 patches (`RequirementSeverity`, the Attribute classes of the plugin managers, `interact(): void` of the Drush commands): devel 5.6.0-rc1 carries them ([devel #565](https://gitlab.com/drupalspoons/devel/-/work_items/565), commit [`42b1a3a`](https://git.drupalcode.org/project/devel/-/commit/42b1a3a048d08f2c45b20c2f832617b8d2acaa0b)), and none of the three files applied to it, which broke `composer install` of webship_project 12.0.x ([#68](https://github.com/webship/patches/pull/68))
  - The three files stay on the `patches` branch, because other refs still point at them; they still apply to devel 5.5.0, which devel #565 reports as not Drupal 12 compatible
- Remove the Autocomplete Deluxe Drupal 12 compatibility patch for [#3591908](https://www.drupal.org/i/3591908): autocomplete_deluxe 2.2.0 carries `^12` in its info file, and the file no longer applied, which turned the `Test patches` run of 12.0.x red ([#67](https://github.com/webship/patches/pull/67))

## [12.0.11] - 2026-11-10

- Change the AI Playwright Drupal 12 compatibility patch for [#3609765](https://www.drupal.org/i/3609765) to the file re-rolled for ai_playwright 1.0.0-beta2: the 1.0.0-beta1 file no longer applies, which broke `composer install` of webship_project 12.0.x ([#54](https://github.com/webship/patches/pull/54), patch file in [#53](https://github.com/webship/patches/pull/53))
  - The new file keeps `^12` in the info file and in the `drupal/core` constraint of `composer.json`; beta2 already carries the PHPUnit attributes, so those hunks are gone, and the file still applies to 1.0.0-beta1
- Change the Display Builder `core_version_requirement` patch for [#3620792](https://www.drupal.org/i/3620792) to the file re-rolled for display_builder 1.0.0-beta10: the 2026-10-04 file no longer applies, which broke `composer install` of webship_project 12.0.x ([#57](https://github.com/webship/patches/pull/57), patch file in [#55](https://github.com/webship/patches/pull/55))
  - The new file keeps the hunks that still applied and re-rolls those of the entity view and UI submodules, whose `dependencies` changed in 1.0.0-beta10; it still applies to 1.0.0-beta9
- Remove the Display Builder patch that reads the view displays through `get()` ([#3620792](https://www.drupal.org/i/3620792)): display_builder 1.0.0-beta10 no longer reads the protected `View::$display` ([#3629063](https://www.drupal.org/i/3629063)), and the file no longer applies, which broke `composer install` of webship_project 12.0.x ([#58](https://github.com/webship/patches/pull/58))
- Remove the Pathauto Drupal 12 compatibility patch for [#3601975](https://www.drupal.org/i/3601975): Pathauto 1.16.0 carries it, and the file no longer applies, which broke `composer install` of webship_project 12.0.x ([#56](https://github.com/webship/patches/pull/56))

## [12.0.10] - 2026-11-07

- Drop or re-roll the patches that stopped applying to the current releases, which broke `composer install` of webship_project, webships_project and website ([#51](https://github.com/webship/patches/pull/51), patch files in [#50](https://github.com/webship/patches/pull/50))
  - Dropped, now in the release: Key 1.23.0 ([#3632542](https://www.drupal.org/i/3632542)), Token 1.18.0 ([#3586686](https://www.drupal.org/i/3586686)), Captcha 2.0.12 ([#3596096](https://www.drupal.org/i/3596096)), Shield 1.11.0 ([#3602958](https://www.drupal.org/i/3602958)), Entityqueue 1.13.0 ([#3597890](https://www.drupal.org/i/3597890)), Metatag 2.2.5 ([#3600244](https://www.drupal.org/i/3600244), [#3398796](https://www.drupal.org/i/3398796)), Better Exposed Filters 7.2.0, UI Patterns 2.0.23 ([#3625036](https://www.drupal.org/i/3625036), [#3589825](https://www.drupal.org/i/3589825)), and the ai_translate 1.4.4 and ai_playwright 1.0.0-beta1 signature and requirements patches
  - Re-rolled: ai 1.5.2 and ai_translate 1.4.4 info files ([#3586520](https://www.drupal.org/i/3586520), [#3585522](https://www.drupal.org/i/3585522)), easy_breadcrumb 2.0.11 ([#3597449](https://www.drupal.org/i/3597449)), ai_playwright 1.0.0-beta1 ([#3609765](https://www.drupal.org/i/3609765)), ui_patterns 2.0.23 RequiredArrayValues constructor ([#3588936](https://www.drupal.org/i/3588936))

## [12.0.9] - 2026-10-04

- Remove the Dashboards patches: Cucumber moved to Web Dashboard ([#48](https://github.com/webship/patches/pull/48))
- Remove our ai_penpot signatures patch, which ai_penpot 1.0.0-beta1 carries and which stopped applying to it; builds that resolve ai_penpot 1.0.0-beta1 failed on it

## [12.0.8] - 2026-10-04

- Fixes from the by-role round on Drupal 12 ([#45](https://github.com/webship/patches/pull/45), [#46](https://github.com/webship/patches/pull/46))
  - RequirementSeverity for ai_validations, config_inspector, devel, security_review and automatic_updates: the status report and `/admin/config` returned 500
  - `display_builder_views` no longer reads the protected `View::$display` ([#3620792](https://www.drupal.org/i/3620792))
  - The XML sitemap PHP 8.5 fix is part of the [#3607528](https://www.drupal.org/i/3607528) patch, so it no longer depends on patch order
  - metatag_views drops a no-op `setAccessible()` call

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

[12.0.17]: https://github.com/webship/patches/compare/12.0.16...12.0.17
[12.0.16]: https://github.com/webship/patches/compare/12.0.15...12.0.16
[12.0.15]: https://github.com/webship/patches/compare/12.0.14...12.0.15
[12.0.14]: https://github.com/webship/patches/compare/12.0.13...12.0.14
[12.0.13]: https://github.com/webship/patches/compare/12.0.12...12.0.13
[12.0.12]: https://github.com/webship/patches/compare/12.0.11...12.0.12
[12.0.11]: https://github.com/webship/patches/compare/12.0.10...12.0.11
[12.0.10]: https://github.com/webship/patches/compare/12.0.9...12.0.10
[12.0.9]: https://github.com/webship/patches/compare/12.0.8...12.0.9
[12.0.8]: https://github.com/webship/patches/compare/12.0.7...12.0.8
[12.0.7]: https://github.com/webship/patches/compare/12.0.6...12.0.7
[12.0.6]: https://github.com/webship/patches/compare/12.0.5...12.0.6
[12.0.5]: https://github.com/webship/patches/compare/12.0.4...12.0.5
[12.0.4]: https://github.com/webship/patches/compare/12.0.3...12.0.4
[12.0.3]: https://github.com/webship/patches/compare/12.0.2...12.0.3
[11.0.1]: https://github.com/webship/patches/compare/11.0.0...11.0.1
[12.0.2]: https://github.com/webship/patches/compare/12.0.1...12.0.2
