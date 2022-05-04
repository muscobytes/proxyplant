#!make
#SHELL = sh -xv
.PHONY: help
DOCKER=docker run --interactive --tty --rm --workdir "/opt" --env XDEBUG_CONFIG="log_level=0" --volume "$(shell pwd)":"/opt" "proxyplant/php:8.1-dev"

help: ## Shows this help message
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'
init: ## Initialize project
	$(shell test ! -d "$(shell pwd)/.docker" && mkdir -p "$(shell pwd)/.docker")
	$(shell test ! -f "$(shell pwd)/.docker/Dockerfile" && curl -s -o "$(shell pwd)/.docker/Dockerfile" "https://gist.githubusercontent.com/postfriday/e405590799994018c8bef7705436eb4f/raw/79cec77bee56e0232e85332664c355d9f228727d/Dockerfile%2520(php:8.1-cli)")
	docker build --file "$(shell pwd)/.docker/Dockerfile" --tag "proxyplant/php:8.1-dev" .
	${DOCKER} composer install --dev
sh:
	${DOCKER} sh
test:
	${DOCKER} /opt/vendor/bin/phpunit