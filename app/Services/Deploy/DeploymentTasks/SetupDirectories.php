<?php
namespace App\Services\Deploy\DeploymentTasks;

use App\Services\Deploy\DeploymentTasks\Task;

class SetupDirectories extends Task
{
    public function run()
    {
        $this->addStatusLog(self::STATUS_RUNNING);
        
        if ( !$this->host->test("[ -d {$this->deployPath} ]") ){
            $this->host->runCommand("mkdir {$this->deployPath} ");
            $this->addStatusLog(self::STATUS_LOG,"Deploy Directory created");
        }

        if ( !$this->host->test("[ -d {$this->deployPath}/.dep ]") ){
            $this->host->runCommand("mkdir {$this->deployPath}/.dep ");
            $this->addStatusLog(self::STATUS_LOG,".dep directory created");
        }

        if ( !$this->host->test("[ -f {$this->deployPath}/.dep/latest_release ]") ){
            $this->host->runCommand("touch {$this->deployPath}/.dep/latest_release ");
            $this->addStatusLog(self::STATUS_LOG,"Latest releases file created");
        }

        if ( !$this->host->test("[ -d {$this->deployPath}/releases ]") ){
            $this->host->runCommand("mkdir {$this->deployPath}/releases ");
            $this->addStatusLog(self::STATUS_LOG,"Releases directory created");
        }

        if ( !$this->host->test("[ -d {$this->deployPath}/shared ]") ){
            $this->host->runCommand("mkdir {$this->deployPath}/shared ");
            $this->addStatusLog(self::STATUS_LOG,"Shared directory created");
        }

        $this->addStatusLog(self::STATUS_COMPLETED);
    }

    public function getTaskName(): string
    {
        return "Check & Setup Directories";
    }

    public function getTaskDescription(): string
    {
        return '';
    }
}
