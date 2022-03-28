<?php

namespace App\Services\Deploy\Laravel\Tasks;

use App\Services\Deploy\DeploymentTasks\Task;
use Exception;

class UpdateCode extends Task
{
    public function run()
    {
        $this->addStatusLog(self::STATUS_RUNNING);

        $bare = "{$this->deployPath}/.dep/repo";
        $currentReleaseName = trim($this->host->runCommand("cat {$this->deployPath}/.dep/release.lock"),"\n");
        $currentReleasePath = "{$this->deployPath}/releases/{$currentReleaseName}";

        /**
         * Check if already a git repo
         */
        $this->host->runCommand("[ -f {$bare}/HEAD ] || git clone --mirror {$this->repository} $bare 2>&1");

        $this->host->runCommand("cd $bare && git remote update");

        $this->host->runCommand("cd $bare && git archive {$this->branch} | tar -x -f - -C {$currentReleasePath} 2>&1");

        $this->host->runCommand("echo {$currentReleaseName} > {$this->deployPath}/.dep/latest_release");
        
        $this->host->runCommand("rm -f {$this->deployPath}/.dep/release.lock");

        $this->addStatusLog(self::STATUS_COMPLETED);
    }

    public function getTaskName(): string
    {
        return 'Update code from git and copy to newly release directory';
    }

    public function getTaskDescription(): string
    {
        return '';
    }
}
