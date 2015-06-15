#!/bin/bash
NGINX_PID=/var/run/nginx.pid

/usr/sbin/nginx -c /etc/nginx/nginx.conf -t && \
	/usr/sbin/nginx -c /etc/nginx/nginx.conf -g "daemon on;"

/usr/local/bin/consul-template -consul ${CONSUL_PORT_8500_TCP_ADDR:-172.17.42.1}:${CONSUL_PORT_8500_TCP_PORT:-8500} \
    -template "/etc/consul-templates/app.conf.ctmpl:/etc/nginx/conf.d/app.conf:/hup.sh || true"
    -log-level debug

