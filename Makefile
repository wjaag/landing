SHELL := /bin/sh

.PHONY: up down restart logs status cli shell db-shell export-db import-db reset help

help: ## Display available commands
	@awk 'BEGIN {FS = ":.*##"}; /^[a-zA-Z_-]+:.*##/ {printf "\033[36m%-12s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

up: ## Start WordPress at http://localhost:8070
	docker compose up -d

down: ## Stop containers (keeps database and WordPress files)
	docker compose down

restart: ## Restart the stack
	docker compose restart

logs: ## Follow WordPress logs
	docker compose logs -f wordpress

status: ## Show services and health state
	docker compose ps

cli: ## Run WP-CLI: make cli CMD="plugin list"
	docker compose run --rm wp $(CMD)

shell: ## Open a shell inside the WordPress container
	docker compose exec wordpress bash

db-shell: ## Open a MariaDB shell
	docker compose exec db sh -c 'mariadb -u"$$MARIADB_USER" -p"$$MARIADB_PASSWORD" "$$MARIADB_DATABASE"'

export-db: ## Export database to backups/wordpress-YYYYmmdd-HHMMSS.sql
	@mkdir -p backups
	docker compose exec -T db sh -c 'mariadb-dump -u"$$MARIADB_USER" -p"$$MARIADB_PASSWORD" "$$MARIADB_DATABASE"' > backups/wordpress-$$(date +%Y%m%d-%H%M%S).sql

import-db: ## Import SQL: make import-db FILE=backups/example.sql
	@test -n "$(FILE)" || (echo "Usage: make import-db FILE=path/to/file.sql"; exit 1)
	docker compose exec -T db sh -c 'mariadb -u"$$MARIADB_USER" -p"$$MARIADB_PASSWORD" "$$MARIADB_DATABASE"' < "$(FILE)"

reset: ## Delete ALL local containers and persistent data
	docker compose down -v --remove-orphans
