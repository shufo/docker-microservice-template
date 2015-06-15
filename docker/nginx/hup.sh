#!/bin/sh
echo "DEBUG: restarting nginx"
kill -s HUP $(cat /var/run/nginx.pid)
