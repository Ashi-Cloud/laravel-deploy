<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class ProjectSetup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setup:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup Project initialy';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->createAdminIfNotExists();
    }


    private function createAdminIfNotExists()
    {
        if ( $user = User::find(1) ){
            return $user;
        }

        return User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('12345678')
        ]);
    }
}
