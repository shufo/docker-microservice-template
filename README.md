docker-microservice-template
============================

A template for create your own microservice with [docker](https://www.docker.com/), [docker-compose](https://docs.docker.com/compose/), [nginx](http://nginx.org/en/), [consul](https://www.consul.io/), [consul-template](https://github.com/hashicorp/consul-template) and [registrator](https://github.com/gliderlabs/registrator).

## Overview

<img src="https://raw.githubusercontent.com/wiki/shufo/docker-microservice-template/images/microservice-template.gif" width="220">

|Container|Description|
|:--|:--|
|Application|Your application|
|registrator|Service registry bridge for Docker|
|Consul|Service discovery and configuration|
|Nginx with consul-template|Load balancing and template rendering with Consul|

 

## Requirements

- Docker (Tested on 1.6.0)
- Ansible (Tested on 1.9.0)
- Vagrant (Tested on 1.7.2)

## Installation

- Boot vagrant virtual machine. This will setup your local environment and VM configuration.

```
vagrant up
```

- Run all containers.

```
docker-compose up -d
```

- Then open below link. This will show you a simple 3-tier application. 

http://172.17.8.101/example/php-mysql/

<img src="https://raw.githubusercontent.com/wiki/shufo/docker-microservice-template/images/example.gif" width="400">

You can see example page, if not kill & rm containers and recreate them.  
Now, you can edit applications by edit local files that Application Containers are mounted on VM mounted on host machine.

- Exit containers

```
docker-compose kill && docker-compose rm
```

- Restart containers

```
docker-compose up -d
```

or 

```
docker-compose restart
```

- You can easily scale your containers by `docker-compose scale`

```
docker-compose scale app=3
```

- Containers knows each host's name via Consul DNS.

```bash
# attach to running container
$ docker exec -it dockermicroservicetemplate_app_1 /bin/bash
# name resolution
root@1be773ff5254:/var/www/html#  ping mysql.service.consul

PING mysql.service.consul (10.1.0.45): 56 data bytes
64 bytes from 10.1.0.45: icmp_seq=0 ttl=64 time=0.068 ms
64 bytes from 10.1.0.45: icmp_seq=1 ttl=64 time=0.090 ms
```

## Contributing

1. Fork it
2. Create your feature branch (`git checkout -b my-new-feature`)
3. Commit your changes (`git commit -am 'Add some feature'`)
4. Push to the branch (`git push origin my-new-feature`)
5. Create new Pull Request