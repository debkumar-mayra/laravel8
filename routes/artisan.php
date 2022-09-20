<?php 

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);

Route::get('migrate', function () {
    Artisan::call('migrate');
    return 'Migrate done.';
});

Route::get('key-generate', function () {
    Artisan::call('key:generate');
    return 'Key generate done.';
});

Route::get('migrate-fresh-seed', function () {
    Artisan::call('migrate:fresh --seed');
    return 'Migrate fresh and seeder done.';
});

Route::get('db-seed', function () {
    Artisan::call('db:seed');
    return 'Seeder done.';
});

Route::get('single-seed/{class_name}', function ($class_name) {
    Artisan::call('db:seed --class=' . $class_name);
    return 'seeder done.';
});

Route::get('migration-rollback/{file_name}', function ($file_name) {
    Artisan::call('migrate:rollback --path=/database/migrations/' . $file_name);
    return 'rollback done.';
});

Route::get('storage-link', function ($file_name) {
    Artisan::call('storage:link');
    return 'storage link done.';
});

Route::get('clear', function () {
    Artisan::call('optimize:clear');
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('clear-compiled');
    return 'Cleared.';
});

Route::get('queue-work', function () {
    Artisan::call('queue:work');
    return 'Working.';
});

Route::get('log-clear', function () {
    exec("truncate -s 0 " . storage_path('/logs/laravel.log'));
    return 'log clear done.';
});

Route::get('queue-listen', function () {
    Artisan::call('queue:listen');
    return 'Working.';
});

Route::get('view-env', function () {
    return file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/../.env", true);
});

Route::get('migrate-seed', function () {
    Artisan::call('migrate:fresh --seed');
    return 'Table migrate and seeder done.';
});

Route::get('role-seed', function () {
    Artisan::call('db:seed --class=RolePermissionSeeder');
    return 'seeder done.';
});