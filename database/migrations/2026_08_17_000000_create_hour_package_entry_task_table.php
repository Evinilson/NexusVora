<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (! Schema::hasTable('hour_package_entry_task')) {
            Schema::create('hour_package_entry_task', function (Blueprint $table) {
                $table->foreignId('hour_package_entry_id')
                    ->constrained('hour_package_entries')
                    ->cascadeOnDelete();
                $table->foreignId('project_task_id')
                    ->constrained('project_tasks')
                    ->cascadeOnDelete();

                $table->primary(['hour_package_entry_id', 'project_task_id']);
            });
        }

        // Conserva as associações criadas antes de ser possível selecionar várias tarefas.
        if (Schema::hasColumn('hour_package_entries', 'project_task_id')) {
            DB::table('hour_package_entries')
                ->whereNotNull('project_task_id')
                ->orderBy('id')
                ->each(function ($entry) {
                    DB::table('hour_package_entry_task')->updateOrInsert([
                        'hour_package_entry_id' => $entry->id,
                        'project_task_id' => $entry->project_task_id,
                    ]);
                });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('hour_package_entry_task');
    }
};
