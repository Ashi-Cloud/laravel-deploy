<?php
namespace App\Services\Deploy\DeploymentTasks;

use App\Services\Deploy\DeploymentTasks\Task;
use Exception;

class VerifyDeployDirectory extends Task
{
    public function run()
    {
        $this->addStatusLog(self::STATUS_RUNNING);

        $deployRoot = dirname($this->deployPath);

        if (!$deployRoot || !$this->host->test("[ -d {$deployRoot} ]") ){
            $this->addStatusLog(self::STATUS_ERRORED, "Invalid Deploy Directory");
            throw new Exception("Invalid Deploy Directory given: {$deployRoot}");
        }

        $this->addStatusLog(self::STATUS_COMPLETED);
    }

    public function getTaskName(): string
    {
        return "Check Deploy Directory";
    }

    public function getTaskDescription(): string
    {
        return "";
    }
}
