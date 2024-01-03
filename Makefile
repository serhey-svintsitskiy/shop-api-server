##################
# Variables
##################

DOCKER_COMPOSE = docker-compose -f ./docker-compose.yml
DOCKER_COMPOSE_PHP_FPM_EXEC = ${DOCKER_COMPOSE} exec -u www-data php

##################
# Docker compose
##################

build:
	${DOCKER_COMPOSE} build

start:
	${DOCKER_COMPOSE} start

stop:
	${DOCKER_COMPOSE} stop

up:
	${DOCKER_COMPOSE} up -d --remove-orphans

down:
	${DOCKER_COMPOSE} down

restart: stop start

dc_ps:
	${DOCKER_COMPOSE} ps

dc_logs:
	${DOCKER_COMPOSE} logs -f

dc_down:
	${DOCKER_COMPOSE} down -v --rmi=all --remove-orphans

dc_restart:
	make dc_stop dc_start


##################
# App
##################

app_bash:
	${DOCKER_COMPOSE_PHP_FPM_EXEC} bash
php: app_bash

test:
	${DOCKER_COMPOSE_PHP_FPM_EXEC} bin/phpunit
cache:
	${DOCKER_COMPOSE_PHP_FPM_EXEC} bin/console cache:clear
	${DOCKER_COMPOSE_PHP_FPM_EXEC} bin/console cache:clear --env=test

##################
# Database
##################

db_migrate:
	${DOCKER_COMPOSE_PHP_FPM_EXEC} bin/console doctrine:migrations:migrate --no-interaction -vv
migrate: db_migrate

generate_migration:
	${DOCKER_COMPOSE_PHP_FPM_EXEC} bin/console doctrine:migrations:generate
generate: generate_migration

db_diff:
	${DOCKER_COMPOSE_PHP_FPM_EXEC} bin/console doctrine:migrations:diff --no-interaction
diff: db_diff

db_drop:
	${DOCKER_COMPOSE_PHP_FPM_EXEC} bin/console doctrine:schema:drop --force

new_migration:
	${DOCKER_COMPOSE_PHP_FPM_EXEC} bin/console doctrine:migrations:diff


##################
# Static code analysis
##################

phpstan:
	docker compose exec php bash -c "vendor/bin/phpstan analyze -c phpstan.neon --memory-limit=3G" \
 	docker compose exec php bash -c "vendor/bin/phpstan clear-result-cache"

cs_fix:
	${DOCKER_COMPOSE_PHP_FPM_EXEC} bash -c "vendor/bin/php-cs-fixer fix"
linter: cs_fix

cs_fix_diff:
	${DOCKER_COMPOSE_PHP_FPM_EXEC} bash -c "vendor/bin/php-cs-fixer fix --dry-run --diff"

composer_validate:
	${DOCKER_COMPOSE_PHP_FPM_EXEC} composer validate
