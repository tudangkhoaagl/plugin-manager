<?php

namespace Dangkhoa\PluginManager\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class PluginManagerMigration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:plugin-manager-migration {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migration command for plugin-manager package';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->call('make:migration', [
            'name' => $this->argument('name'),
            '--path' => 'packages/plugin-manager/database/migrations'
        ]);

        return Command::SUCCESS;
    }
}
