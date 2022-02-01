#!/bin/bash

ip addr show | grep 205.5.3.1/24 >/dev/null \
&& @docker network create --subnet 205.5.3.0/24 php_store_net_dev \
|| echo "network already created"
