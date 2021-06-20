.DEFAULT_GOAL := help

TAG := trompette/interpretation:buster

export UID=$(shell id -u)
export GID=$(shell id -g)

.PHONY: help
help:
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) |sort |awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-10s\033[0m %s\n", $$1, $$2}'

.PHONY: image
image: ## Build and push base image
	@docker build --pull --tag $(TAG) .
	@docker login --username trompette
	@docker push $(TAG)
	@docker logout

.PHONY: up
up: ## Start environment
	@docker-compose up --detach --quiet-pull

.PHONY: ps
ps: ## Show environment
	@docker-compose ps --all

.PHONY: log
log: ## Follow environment logs
	@docker-compose logs --follow

.PHONY: install
install: ## Install dependencies
	@docker-compose run --rm composer install --ignore-platform-reqs --no-interaction --no-progress
	@docker-compose run --rm node yarn install --force --non-interactive --no-progress

.PHONY: test
test: ## Run test suite
	@docker-compose run --rm node yarn encore dev
	@docker-compose exec web php vendor/bin/phpunit --do-not-cache-result --testdox

.PHONY: assets
assets: ## Build assets for production
	@docker-compose run --rm node yarn encore prod

.PHONY: outdated
outdated: ## Show outdated dependencies
	@docker-compose run --rm composer outdated --locked
	@docker-compose run --rm composer recipes --outdated || :
	@docker-compose run --rm node yarn outdated || :

.PHONY: sh
sh: ## Open shell in environment
	@docker-compose exec web bash

.PHONY: down
down: ## Stop environment
	@docker-compose down --remove-orphans
