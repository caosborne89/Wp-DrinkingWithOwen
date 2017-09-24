<?php
namespace Deployer;

require 'recipe/common.php';

// Project name
set('application', 'drinking_with_o');

// Project repository
set('repository', 'https://github.com/caosborne89/Wp-DrinkingWithOwen.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true); 

// Shared files/dirs between deploys 
set('shared_files', ['.env']);
set('shared_dirs', ['web/app/uploads']);

// Writable dirs by web server 
set('writable_dirs', ['web/app/uploads']);

// Keep up to three releases
set('keep_releases', 5);

// Hosts

host('138.197.42.218')
    ->stage('production') 
    ->set('deploy_path', '/var/www/html');    
    
// Tasks

desc('Deploy your project');
task('deploy', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:writable',
    'deploy:vendors',
    'deploy:clear_paths',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
    'success'
]);

// [Optional] If deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');
