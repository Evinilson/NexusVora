<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (Schema::hasTable('project_tasks') && ! Schema::hasColumn('project_tasks', 'hour_package_id')) {
            Schema::table('project_tasks', function (Blueprint $table) {
                $table->foreignId('hour_package_id')->nullable()->after('project_id')->constrained()->nullOnDelete();
            });
        }

        if (Schema::hasTable('hour_package_entries') && ! Schema::hasColumn('hour_package_entries', 'project_task_id')) {
            Schema::table('hour_package_entries', function (Blueprint $table) {
                $table->foreignId('project_task_id')->nullable()->after('hour_package_id')->constrained('project_tasks')->nullOnDelete();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('hour_package_entries') && Schema::hasColumn('hour_package_entries', 'project_task_id')) {
            Schema::table('hour_package_entries', function (Blueprint $table) {
                $table->dropConstrainedForeignId('project_task_id');
            });
        }

        if (Schema::hasTable('project_tasks') && Schema::hasColumn('project_tasks', 'hour_package_id')) {
            Schema::table('project_tasks', function (Blueprint $table) {
                $table->dropConstrainedForeignId('hour_package_id');
            });
        }
    }
};
