<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (Schema::hasTable('project_tasks') && ! Schema::hasColumn('project_tasks', 'completed_at')) {
            Schema::table('project_tasks', function (Blueprint $table) {
                $table->timestamp('completed_at')->nullable()->after('due_date');
            });

            // Tarefas já concluídas: usa a data da tarefa quando é anterior à última
            // atualização (edições posteriores não alteram a data real de conclusão).
            DB::table('project_tasks')
                ->where('status', 'concluido')
                ->update(['completed_at' => DB::raw(
                    'case when due_date is not null and due_date < date(updated_at) then due_date else updated_at end'
                )]);
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('project_tasks') && Schema::hasColumn('project_tasks', 'completed_at')) {
            Schema::table('project_tasks', function (Blueprint $table) {
                $table->dropColumn('completed_at');
            });
        }
    }
};
