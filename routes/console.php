<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('serve_me_daddy',function () {
    $this->comment('you want it , you got it');
    artisan::call('serve');
});

Artisan::command('stop_serve',function () {
    $this->comment('Stopping server...');
    if (PHP_OS_FAMILY === 'Windows') {
        exec('taskkill /F /IM php.exe');
    } elseif (PHP_OS_FAMILY === 'Linux' || PHP_OS_FAMILY === 'Darwin') {
        exec('pkill -f "php artisan serve"');
    } elseif (PHP_OS_FAMILY === 'Android') {
        exec('ps | grep "php artisan serve" | awk \'{print $2}\' | xargs kill');
    } else {
        $this->error('Unsupported operating system');
        return;
    }
    $this->info('Server stopped successfully!');
});





