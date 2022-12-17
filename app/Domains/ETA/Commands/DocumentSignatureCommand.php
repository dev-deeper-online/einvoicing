<?php

namespace App\Domains\ETA\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Exception\CommandNotFoundException;
use Symfony\Component\Process\Process;

class DocumentSignatureCommand extends Command
{
    protected $signature = 'document:sign';

    protected $description = 'Sign the given document.';

    public function handle(): int
    {
        $cmd = [
            app_path('Domains/ETA/Signer/EInvoicingSigner.exe'),
            storage_path('app/temp'),
            '13NQ9Z1',
        ];

        $process = Process::fromShellCommandline(implode(' ', $cmd));

        $processOutput = '';

        $captureOutput = function ($type, $line) use (&$processOutput) {
            $processOutput .= $line;
        };

        $process->setTimeout(null)
            ->run($captureOutput);

        if ($process->getExitCode()) {
            throw new CommandNotFoundException($cmd[0].' - '.$processOutput);
        }

        $this->output->write($processOutput);

        return Command::SUCCESS;
    }
}
