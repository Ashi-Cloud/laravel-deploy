<?php

use App\Models\Project;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('git_repository');
            $table->string('git_branch')->default('master');
            $table->string('type')->default(Project::TYPE_DEVELOPMENT);
            $table->string('host');
            $table->string('user');
            $table->string('port')->default(22);
            $table->string('server_path');
            $table->string('authentication_type')->default('private_key')->comment('private_key, password');
            $table->string('password')->nullable();
            $table->text('private_key')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
};
