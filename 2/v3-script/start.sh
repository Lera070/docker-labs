#!/bin/sh
if [ ! -f /usr/src/app/index.html ]; then
    git clone https://github.com/gabrielecirulli/2048.git /usr/src/app
fi
npx http-server /usr/src/app -p 8080