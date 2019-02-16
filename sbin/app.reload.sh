#!/bin/bash

function refresh(){
    php artisan config:cache || {
        echo -e "configure reload failed";
        exit 1;
    }
    php artisan route:cache || {
        echo -e "route reload failed";
        exit 1;
    }
    php artisan optimize || {
        echo -e "optimize failed";
        exit 1;
    }
}

function supervisor_reload(){
    supervisorctl reload
}

function usage() {
    echo "usage:"
    echo "ssha [-h] [-s]"
    exit 0
}

while getopts chs ARGS
do
case $ARGS in
    s)
        refresh
        supervisor_reload
        ;;
    h)
        usage
        ;;
    c)
        refresh
        ;;
    *)
        usage
        ;;
esac
done
