<?php

namespace LaravelLint;

use FilesystemIterator;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class LintStagedCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lint:staged';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Lint git staged files';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        exec('.git/hooks/pre-commit', $output, $code);
        foreach ($output as $line) {
            $this->line($line);
        }
        return $code;
    }
}
