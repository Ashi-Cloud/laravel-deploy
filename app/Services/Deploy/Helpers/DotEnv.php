<?php

namespace App\Services\Deploy\Helpers;

use App\Models\Project;
use Illuminate\Support\Str;

class DotEnv extends BaseHelper
{
    static protected function getEnvPath(Project $project)
    {
        return "$project->deploy_path/shared/.env";
    }

    static public function save(Project $project, $content)
    {
        $host = self::getHost($project);

        $file_path = self::getEnvPath($project);
        $shared_path = dirname($file_path);

        if(!$host->test("[ -d {$shared_path} ]")){
            return false;
        }
        
        $output = $host->runCommand("echo '{$content}' > {$file_path}");
        
        return rtrim($content, "\n") === rtrim($host->runCommand("cat {$file_path}"), "\n");
    }

    static public function get(Project $project)
    {
        $host = self::getHost($project);

        $file_path = self::getEnvPath($project);

        if(!$host->test("[ -f {$file_path} ]")){
            return null;
        }

        return $host->runCommand("cat {$file_path}");
    }
}
