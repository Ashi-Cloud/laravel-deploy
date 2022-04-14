<?php

use App\Models\Project;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->foreignId('server_id')->nullable()->change();
            
            $table->string('git_repository')->nullable()->change();
            $table->string('server_path')->nullable()->change();

            $table->string('git_ssh_key')->nullable()->after('git_branch');

            $table->text('shared_files')->nullable()->after('server_path');
            $table->text('shared_directories')->nullable()->after('server_path');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->bigInteger('server_id')->nullable(false)->change();
            
            $table->string('git_repository')->nullable(false)->change();
            $table->string('server_path')->nullable(false)->change();

            $table->dropColumn('git_ssh_key', 'shared_files', 'shared_directories');
        });
    }
};
