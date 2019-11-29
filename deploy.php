<?php
namespace Deployer;

require 'recipe/zend_framework.php';

// Project name
set('application', 'cross-cms');

// Shared files/dirs between deploys 
add('shared_files', [
    '.env'
]);

// Project repository
set('repository', 'https://github.com/cross-solution/cms.git');

set('default_stage', 'prod');

// deploy to Hosts
host('quasar.cross-solution.de')
    ->user('nuxt')
    ->stage('prod')
    ->multiplexing(false) 
    ->set('deploy_path', '/srv/cms')
    ->set('writableusesudo', true);
    
// if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// run npm 
after('deploy:symlink', 'yarn');

// restart nodeserver
after('cleanup', 'restart');

task('yarn', '
    ~/.yarn/bin/yarn;
    node_modules/.bin/quasar build -m ssr;
');

task('restart', '
    sudo systemctl restart nodeserver-quasar.service;
');