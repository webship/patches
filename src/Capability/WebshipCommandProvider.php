<?php

namespace Webship\WebshipPatches\Capability;

use Composer\Plugin\Capability\CommandProvider;
use Webship\WebshipPatches\Command\CleanupPatchesCommand;
use Webship\WebshipPatches\Command\CleanupPatchesFileCommand;

class WebshipCommandProvider implements CommandProvider
{
    public function getCommands(): array
    {
        return [
            new CleanupPatchesCommand(),
            new CleanupPatchesFileCommand(),
        ];
    }
}
