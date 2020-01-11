all: help

## pull: Update docker images
pull:
	docker-compose pull

## shell: Interactive shell to use commands inside docker
shell:
	docker-compose run --rm php bash

## test: Launch PHPUnit test suites
test:
	docker-compose run --rm php vendor/bin/phpunit

## help: Show this screen
help: Makefile
	@sed -n 's/^##//p' $<
