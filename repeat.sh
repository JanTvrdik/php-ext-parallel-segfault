#!/bin/sh

if [ $# -eq 0 ]; then
    echo "Usage: $0 command"
    exit 1
fi

command="$@"

i=1
while [ $i -le 1000 ]; do
    if ! $command; then
        echo "Command failed on iteration $i"
        exit 1
    fi
    i=$((i+1))
done

echo "Command succeeded 1000 times"
