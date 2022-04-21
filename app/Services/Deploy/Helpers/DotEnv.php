<?php

namespace App\Services\Deploy\Helpers;

use Illuminate\Support\Str;

class DotEnv extends BaseHelper
{

    static public function save($project, $content)
    {
        $host = self::getHost($project);

        $shared_path = "$project->deploy_path/shared/";
        $file_path = "{$shared_path}.env";

        if(!$host->test("[ -d {$shared_path} ]")){
            return false;
        }
        
        $output = $host->runCommand("echo '{$content}' > {$file_path}");
        
        return rtrim($content, "\n") === rtrim($host->runCommand("cat {$file_path}"), "\n");
    }

    static public function get($project)
    {
        $host = self::getHost($project);

        $file_path = "$project->deploy_path/shared/.env";

        if(!$host->test("[ -f {$file_path} ]")){
            return null;
        }

        return $host->runCommand("cat {$file_path}");
    }
}
