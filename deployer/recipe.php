<?php

declare(strict_types = 1);

namespace Deployer;

require 'recipe/laravel.php';

// Normal options
set('branch', 'master');

add('shared_dirs', ['bootstrap/cache']);
add('shared_files', ['docker/.env']);

// Tasks
desc('Docker build');
task('docker:build', function () {
    $output = run('cd {{deploy_path}}/current/docker && ./ctl build');
    writeln('<info>' . $output . '</info>');
});

desc('Docker restart');
task('docker:restart', function () {
    $output = run('cd {{deploy_path}}/current/docker && ./ctl restart');
    writeln('<info>' . $output . '</info>');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

/**
 * Main task
 */
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

    // Artisan commands
    'artisan:storage:link',
    'artisan:optimize',
    'artisan:optimize:clear',
    'artisan:migrate',

    'deploy:symlink',

    // Docker
    'docker:build',
    'docker:restart',

    'deploy:unlock',
    'cleanup',
]);

after('deploy', 'success');
