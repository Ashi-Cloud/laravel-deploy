<?php

namespace App\Services\Deploy\Helpers;

use App\Services\Deploy\Host\DeployHost;

class BaseHelper
{
    static public function getHost($project)
    {
        return DeployHost::createFromProject($project, fn() => null);
    }
}
