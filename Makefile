SHELL := /bin/bash

tests:
	symfony console doctrine:fixtures:load -n
	symfony run bin/phpunit
.PHONY: tests

start:
	symfony server:start -d
	symfony run -d --watch=config,src,templates,vendor symfony console messenger:consume async
.PHONY: start

restart:
	symfony server:stop
	symfony server:start -d
	symfony run -d --watch=config,src,templates,vendor symfony console messenger:consume async
	symfony server:log
.PHONY: restart
