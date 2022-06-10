<?php

namespace LaravelLint;

use Illuminate\Console\Command;

class LintCodeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lint:code
        {files?*}
        {--fix : automatic fix}
        {--standard=phpcs.xml : coding standards}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Lint code files';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $bin = $this->option('fix') ? 'phpcbf' : 'phpcs';
        $files = empty($this->argument('files')) ? [ '.' ] : $this->argument('files');

        exec(
            "vendor/bin/$bin --standard=" . $this->option('standard')
            . ' -s ' . implode(' ', $files),
            $output,
            $code
        );
        foreach ($output as $line) {
            $this->line($line);
        }
        return $code;
    }
}
