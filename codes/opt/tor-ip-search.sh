#!/bin/dash
#echo "$1"
/usr/bin/wget https://onionoo.torproject.org/details?search=$1 -O /opt/search.json >/opt/logs.txt 2>&1 || echo "wget" >/opt/failure
#cat /opt/search.json
