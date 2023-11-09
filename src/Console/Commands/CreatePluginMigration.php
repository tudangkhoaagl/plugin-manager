<?php

namespace Dangkhoa\PluginManager\Console\Commands;

use Illuminate\Console\Command;

class CreatePluginMigration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:plugins-migration {name} {--plugin=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migration command for plugins';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->call('make:migration', [
            'name' => ucfirst(trim($this->argument('name'))),
            '--path' => ('packages/plugin-manager/Plugins/' . (ucfirst(trim($this->option('plugin')))) . '/database/migrations'),
        ]);

        return Command::SUCCESS;
    }
}
