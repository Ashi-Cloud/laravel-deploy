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

        $git_command = "git";
        if(!empty($key = $this->project->git_ssh_key)){
            $git_command = "GIT_SSH_COMMAND='ssh -i {$key} -o IdentitiesOnly=yes' git";
        }

        /**
         * Check if already a git repo
         */
        $this->host->runCommand("[ -f {$bare}/HEAD ] || {$git_command} clone --mirror {$this->repository} $bare 2>&1");
        if(
            !$this->host->test("[ -f {$bare}/HEAD ]")
            || !$this->host->test("cd $bare && {$git_command} remote update")
            || !$this->host->test("cd $bare && {$git_command} archive {$this->branch} | tar -x -f - -C {$currentReleasePath} 2>&1")
        ){
            throw new Exception("Repository not found. Please make sure you have the correct access rights and the repository exists.");
        }

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
