<?php

namespace WalkerChiu\Core\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class Cleaner extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var String
     */
    protected $signature = 'command:Cleaner';

    /**
     * The console command description.
     *
     * @var String
     */
    protected $description = 'Truncate tables';



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
     * @param String  $package
     * @param String  $keyword
     * @return Mixed
     */
    public function clean(string $package, $keyword = null)
    {
        $tasks = $keyword ? [] : [$package];
        foreach (config('wk-'. $tasks[0] .'.onoff') as $key => $task) {
            if (
                is_null($keyword)
                || strstr($key, $keyword)
            ) {
                if (config('wk-'. $tasks[0] .'.onoff.'.$key)) {
                    array_push($tasks, $key);
                }
            }
        }

        $this->info('Warning! This operation will truncate all tables of the following packages:');
        foreach ($tasks as $key => $task) {
            $this->info($key+1 .'. '. $task);
        }
        if (!$this->confirm('Are you sure you want to continue working?'))
            exit('Cancel');

        $this->info('Truncating...');

        // Truncate
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
            foreach ($tasks as $key => $task) {
                if (is_array(config('wk-core.table.'.$task))) {
                    foreach (config('wk-core.table.'.$task) as $table) {
                        if (Schema::hasTable($table)) {
                            DB::table($table)->truncate();
                            $this->info($table .' have been truncated.');
                        }
                    }
                } else {
                    if (Schema::hasTable(config('wk-core.table.'.$task))) {
                        DB::table(config('wk-core.table.'.$task))->truncate();
                        $this->info(config('wk-core.table.'.$task) .' have been truncated.');
                    }
                }
            }
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

        $this->info('Done!');
    }
}
