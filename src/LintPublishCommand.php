<?php

namespace LaravelLint;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class LintPublishCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lint:publish {--overwrite : overwrite existing linting config files}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish Lint config files';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $basePath = $this->laravel->basePath();
        $overwrite = $this->option('overwrite');

        if ($overwrite || !$this->_fileExists('phpcs.xml')) {
            File::copy(__DIR__ . '/stubs/phpcs.xml', $basePath . '/phpcs.xml');
        }
        if ($overwrite || !$this->_fileExists('phpmd.xml')) {
            File::copy(__DIR__ . '/stubs/phpmd.xml', $basePath . '/phpmd.xml');
        }
        if (File::exists($basePath . '/.git/hooks')) {
            if ($overwrite || !$this->_fileExists('/.git/hooks/pre-commit')) {
                File::copy(__DIR__ . '/stubs/git-pre-commit', $basePath . '/.git/hooks/pre-commit');
                File::chmod($basePath . '/.git/hooks/pre-commit', 0755);    
            }
        }

        $this->info('published successfully.');
    }

    /**
     * Check if the file exists in the project base path.
     *
     * @param string $relativePath
     * @return bool
     */
    private function _fileExists($relativePath)
    {
        return File::exists($this->laravel->basePath() . $relativePath);
    }
}
