init-config:
	bash ./scripts/config/init_docker_conf.sh

build-docker:
	bash ./scripts/config/init_docker_conf.sh
	docker-compose up --build