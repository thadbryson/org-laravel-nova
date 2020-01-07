<?php

declare(strict_types = 1);

namespace Deployer;

require 'recipe/laravel.php';

// Normal options
set('branch', 'master');

set('artisan', 'cd {{release_path}} && ./dock artisan');

add('shared_dirs', ['bootstrap/cache']);
add('shared_files', ['docker/.env']);

// Tasks
desc('Docker build');
task('docker:build', function () {
    $output = run('cd {{release_path}} && ./dock build');

    writeln('<info>' . $output . '</info>');
});

desc('Docker restart');
task('docker:restart', function () {
    $output = run('cd {{release_path}} && ./dock restart');

    writeln('<info>' . $output . '</info>');
});

desc('Artisan CLI commands for Laravel');
task('deploy:laravel', function () {
    run('{{artisan}} storage:link');
    run('{{artisan}} view:cache');
    run('{{artisan}} config:cache');
    run('{{artisan}} optimize:clear');
    run('{{artisan}} optimize');
    run('{{artisan}} migrate --force');
});

desc('Deploy your project');
task('deploy', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:vendors',
    'deploy:writable',

    'docker:build',
    'docker:restart',

    'deploy:symlink',

    // All artisan commands
    'deploy:laravel',

    'deploy:unlock',
    'cleanup'
]);

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');
after('deploy', 'success');
