<?php

namespace App\Jobs\Deployment;

use App\Models\Deployment;
use Exception;
use App\Models\Project;
use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Services\Deploy\Laravel\DeployLaravelApplication;


class DeployProjectJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $project;

    public $timeout = 8000;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Project $project)
    {
        $this->project = $project;
        $this->queue = 'deploy-projects';
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            (new DeployLaravelApplication($this->project, function ($type, $line) {
                $this->project->appendLog(Str::of($type)->title() . " : " . $line);
            }))->deploy();
        } catch (Exception $ex) {
            $this->project->appendLog("Error: {$ex->getMessage()}");
        } finally {
            $this->project->closeActiveDeployment(Deployment::STATUS_FAILED);
        }
    }
}
