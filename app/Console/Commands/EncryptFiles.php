<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Console\Input\InputOption;

class EncryptFiles extends Command
{
    protected $signature = 'files:encrypt {directories*}';
    protected $description = 'Encrypt all files in the specified directories';

    public function __construct()
    {
        parent::__construct();
        $this->addOption('password', null, InputOption::VALUE_REQUIRED, 'Password for encryption');
    }

    public function handle()
    {
        $password = $this->option('password');

        if (!$password) {
            $password = $this->secret('Enter the encryption password');
        }

        if (!$this->checkPassword($password)) {
            $this->error('Invalid password. Operation aborted.');
            return;
        }

        $directories = $this->argument('directories');

        foreach ($directories as $directory) {
            $path = base_path($directory);

            if (!File::isDirectory($path)) {
                $this->error('The specified directory ' . $directory . ' does not exist.');
                continue;
            }

            $files = File::allFiles($path);

            foreach ($files as $file) {
                if (!File::isReadable($file) || !File::isWritable($file)) {
                    $this->warn('Skipping file (not readable or writable): ' . $file->getRealPath());
                    continue;
                }

                if (!$this->isTextFile($file->getRealPath())) {
                    $this->warn('Skipping non-text file: ' . $file->getRealPath());
                    continue;
                }

                try {
                    $contents = File::get($file->getRealPath());

                    if ($this->isEncrypted($contents)) {
                        $this->info($file->getFilename() . ' is already encrypted.');
                        continue;
                    }

                    $encrypted = 'ENCRYPTED::' . Crypt::encryptString($contents);
                    File::put($file->getRealPath(), $encrypted);
                } catch (\Exception $e) {
                    Log::error('Error encrypting file: ' . $file->getRealPath(), ['error' => $e->getMessage()]);
                    $this->error('Error encrypting file: ' . $file->getRealPath());
                }
            }

            $this->info('All files in directory ' . $directory . ' have been encrypted.');
        }
    }

    private function isEncrypted($contents)
    {
        return strpos($contents, 'ENCRYPTED::') === 0;
    }

    private function isTextFile($path)
    {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $path);
        finfo_close($finfo);

        return preg_match('/^text\/|\/json|\/xml|\/javascript|\/css/', $mimeType);
    }

    private function checkPassword($password)
    {
        // Define a constant or fetch from config/env
        $correctPassword = env('ENCRYPTION_PASSWORD', 'encrypt_password777');
        return $password === $correctPassword;
    }
}
