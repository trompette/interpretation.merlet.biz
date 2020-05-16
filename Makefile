.DEFAULT_GOAL := help

.PHONY: help
help:
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) |sort |awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-10s\033[0m %s\n", $$1, $$2}'

.PHONY: up
up: ## Start development environment
	@docker-compose up --detach

.PHONY: ps
ps: ## Show development environment
	@docker-compose ps --all

.PHONY: log
log: ## Follow development environment logs
	@docker-compose logs --follow

.PHONY: test
test: ## Run test suite
	@docker-compose exec web php composer.phar dump-autoload
	@docker-compose exec web bin/phpunit

.PHONY: sh
sh: ## Open shell in development environment
	@docker-compose exec web bash

.PHONY: down
down: ## Stop development environment
	@docker-compose down
