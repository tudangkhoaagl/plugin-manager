<?php

namespace Dangkhoa\PluginManager\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class UpdateAssetPlugin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'asset:publish {--tag=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish asset command for plugin-manager package';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->call('vendor:publish', [
            '--tag' => $this->option('tag'),
            '--force' => true
        ]);

        return Command::SUCCESS;
    }
}
