<?php

namespace FredBradley\Feedback\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class Migrate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'feedback:migrate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Runs the migration for Feedback app';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $path = dirname(dirname(__DIR__)).'/database/migrations/2021_12_21_000001_feedback_package_migration.php';
        $this->line('Migrating...');
        Artisan::call('migrate --database=laravel-feedback --path='.$path);
        $this->line('Done!');
    }
}
