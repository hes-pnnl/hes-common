#!/usr/bin/env bash

# Get the directory in which this script file resides
DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" >/dev/null 2>&1 && pwd )"

_sync(){
    mkdir -p /${DIR}/../src $1/vendor/pnnl/hes-common/src # in case the directory is missing for any reason
    rsync -rtv --exclude=".git" /${DIR}/../src $1/vendor/pnnl/hes-common
}

sync_all(){
    ROOT_DIR=${DIR}/../..
    _sync ${ROOT_DIR}/hes-gui
    _sync ${ROOT_DIR}/hes-api
    _sync ${ROOT_DIR}/hes-tests
}

# Start a daemon that will synchronize the hes-common project to projects that depend on it every two seconds
while :; do clear; sync_all; sleep 2; done