#!/bin/bash

# Get the directory in which this script file resides
DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" >/dev/null 2>&1 && pwd )"
ROOT_DIR=${DIR}/../..

composer_update(){
    echo "Updating $1..."
    cd ${ROOT_DIR}/$1 && composer update pnnl/hes-common --no-interaction
}

composer_update hes-api
composer_update laravel-hes-gui
composer_update hes-tests
