<?php

namespace App\Services\Deploy\SSH;

use App\Services\Deploy\Host\DeployHost;

class SshKey
{
    static public function getHost($project)
    {
        return DeployHost::createFromProject($project, fn() => null);
    }

    static public function generate($project, $overwrite = false)
    {
        $host = self::getHost($project);

        $key_name = "~/.ssh/project_{$project->id}";

        if(!$overwrite && $host->test("[ -f {$key_name} ]")){
            return;
        }
        
        $output = $host->runCommand("echo y | ssh-keygen -f {$key_name} -N \"\"");

        if($host->test("[ -f {$key_name} ]")){
            return $key_name;
        }
    }

    static public function publicKey($project)
    {
        $host = self::getHost($project);

        $key_name = $project->git_ssh_key;
        $pub_key_name = "{$project->git_ssh_key}.pub";

        if(empty($key_name) || !$host->test("[ -f {$pub_key_name} ]")){
            return null;
        }

        return $host->runCommand("cat {$pub_key_name}");
    }
}
