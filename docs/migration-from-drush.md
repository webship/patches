# Migration from Drush commands

Earlier Webship releases shipped two Drush commands inside `webship_core` for cleaning up merge-request patches. They have been moved into `webship/webship-patches` as Composer commands.

## Mapping

| Old Drush command                          | Old alias    | New Composer command                       | New alias    |
|--------------------------------------------|--------------|--------------------------------------------|--------------|
| `webship:composer:cleanup:patches`         | `web-ccup`   | `composer webship-patches:cleanup:patches` | `web-ccup`   |
| `webship:composer:cleanup:patches-file`    | `web-ccupf`  | `composer webship-patches:cleanup:patches-file` | `web-ccupf` |

The Composer aliases are the same as the Drush ones, so existing scripts that called e.g. `drush web-ccup` only need to change to `composer web-ccup`.

## Behavior changes

- **No Drupal bootstrap required.** Old commands needed a working site (`drush` had to bootstrap Drupal). New commands run from any directory with a `composer.json`, including in CI before any DB exists.
- **Project root detection.** Old code used `$this->getConfig()->get('runtime.project')` (Drush). New code uses `getcwd()` by default and accepts `--project-dir=<path>` to override.
- **HTTP user-agent.** Old code used a 2008-era Firefox UA which GitLab now answers with HTML instead of the diff. New code uses `webship-patches/1.0` and `Accept: text/plain, text/x-diff, */*`, which returns the raw diff.
- **Output.** Same human-readable lines (`Processed the patch …`, `From: …`, `To: …`, separator), but emitted via Composer's `OutputInterface` instead of Drush's logger.

## Removing the old commands

If you still ship `webship_core` with the old Drush command file, you can remove the `mergeRequestPatchesCleanup()` and `mergeRequestPatchesFileCleanup()` methods from `src/Drush/Commands/WebshipCoreCommands.php` once you have upgraded to a `webship/webship-patches` release that includes the plugin commands. The other commands in that file (`webship:remove-non-existent-permissions`, `webship:entity-update`) are unrelated to patches and should stay.
