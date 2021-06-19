.DEFAULT_GOAL := help
TAG := trompette/interpretation:buster

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
	@docker-compose run --rm composer install --ignore-platform-reqs
	@docker-compose run --rm node yarn install --force
	@docker-compose run --rm node yarn encore dev
	@docker-compose exec web php vendor/bin/phpunit --testdox

.PHONY: assets
assets: ## Build assets for production
	@docker-compose run --rm node yarn encore prod

.PHONY: sh
sh: ## Open shell in development environment
	@docker-compose exec web bash

.PHONY: down
down: ## Stop development environment
	@docker-compose down
