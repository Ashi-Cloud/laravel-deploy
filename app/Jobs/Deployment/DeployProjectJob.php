<?php

namespace App\Jobs\Deployment;

use App\Models\Project;
use App\Services\Deploy\Laravel\DeployLaravelApplication;
use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;


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
        (new DeployLaravelApplication($this->project, function($type, $line){
            $this->project->appendLog( Str::of($type)->title()." : ".$line );
        }))->deploy();
    }
}
