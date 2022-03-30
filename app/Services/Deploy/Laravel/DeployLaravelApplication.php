<?php

namespace App\Services\Deploy\Laravel;

use Exception;
use App\Models\Deployment;
use App\Services\Deploy\DeployApplication;
use App\Services\Deploy\Laravel\Tasks\UpdateCode;
use App\Services\Deploy\Laravel\Tasks\PrepareDeployment;
use App\Services\Deploy\DeploymentTasks\SetupDirectories;
use App\Services\Deploy\Laravel\Tasks\FinalizeDeployment;
use App\Services\Deploy\DeploymentTasks\VerifyDeployDirectory;
use App\Services\Deploy\Laravel\Tasks\UpdateSharedFilesAndDirectories;

class DeployLaravelApplication extends DeployApplication
{
   protected $tasks = [
      VerifyDeployDirectory::class,
      SetupDirectories::class,
      PrepareDeployment::class,
      UpdateCode::class,
      UpdateSharedFilesAndDirectories::class,
      FinalizeDeployment::class
   ];

   public function deploy()
   {
      try {
         $this->project->createOrFindActiveDeployment();
         parent::deploy();
         $this->project->appendLog('Deployment Completed.');
         $this->project->closeActiveDeployment(Deployment::STATUS_SUCCESS);
      } catch (Exception $ex) {
         $this->project->appendLog('Error while Deploying: ' . $ex->getMessage());
      } finally {
         $this->project->closeActiveDeployment(Deployment::STATUS_FAILED);
      }
   }

   public function __destruct()
   {
      try {
         $this->project->closeActiveDeployment(Deployment::STATUS_FAILED);
      } catch (\Exception $th) {
         //throw $th;
      }
   }
}
