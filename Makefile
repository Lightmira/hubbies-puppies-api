# Date : 04.03.20
# Author Etienne Crespi
CONSOLE=bin/console
PWD=$(shell pwd)
DC=docker-compose
DB=docker build
DR=docker run
HAS_DOCKER:=$(shell command -v $(DC) 2> /dev/null)
ifdef HAS_DOCKER
	EXEC_PHP=$(DC) exec php
else
	EXEC_PHP=
endif
.DEFAULT_GOAL := help
.PHONY: help ## Generate list of targets with descriptions
help:
		@grep '##' Makefile \
		| grep -v 'grep\|sed' \
		| sed 's/^\.PHONY: \(.*\) ##[\s|\S]*\(.*\)/\1:\t\2/' \
		| sed 's/\(^##\)//' \
		| sed 's/\(##\)/\t/' \
		| expand -t14

##---------------------------------------------------------------------------
## Project setup & day to day shortcuts
##---------------------------------------------------------------------------

.PHONY: start ## Start the project (Install in first place)
start: docker-compose.override.yml
	$(DC) pull || true
	$(DC) build
	$(DC) up -d
	$(EXEC_PHP) composer install
	$(EXEC_PHP) $(CONSOLE) doctrine:database:create --if-not-exists
	$(EXEC_PHP) $(CONSOLE) doctrine:schema:update --force
	$(EXEC_PHP) $(CONSOLE) make:migration
.PHONY: stop ## stop the project
stop:
	$(DC) down
.PHONY: exec ## Run bash in the php container
exec:
	$(EXEC_PHP) /bin/bash
.PHONY: build ## Rebuild
build:
	$(DC) pull || true
	$(DC) build
	$(DC) up -d
.PHONY: dbDrop ## Drop the database
dbDrop:
	$(EXEC_PHP) $(CONSOLE) doctrine:database:drop --force
.PHONY: dbCreate ## Create the database
dbCreate:
	$(EXEC_PHP) $(CONSOLE) doctrine:database:create --if-not-exists
	$(EXEC_PHP) $(CONSOLE) doctrine:schema:update --force
	$(EXEC_PHP) $(CONSOLE) make:migration
.PHONY: dbUpdate ## Update database structure
dbUpdate:
	$(EXEC_PHP) $(CONSOLE) doctrine:schema:update --force
	$(EXEC_PHP) $(CONSOLE) make:migration
.PHONY: dbMigration ## Make migration
dbMigration:
	$(EXEC_PHP) $(CONSOLE) doctrine:migrations:migrate
.PHONY: dummy ## Load dummy data
dummy:
	$(EXEC_PHP) $(CONSOLE) doctrine:database:drop --force
	$(EXEC_PHP) $(CONSOLE) doctrine:database:create --if-not-exists
	$(EXEC_PHP) $(CONSOLE) doctrine:schema:update --force
	$(EXEC_PHP) $(CONSOLE) make:migration
	$(EXEC_PHP) $(CONSOLE) doctrine:fixtures:load -q
.PHONY: cachedev ## Clear dev cache
cachedev:
	$(EXEC_PHP) $(CONSOLE) cache:clear
.PHONY: cacheprod ## Clear prod cache
cacheprod:
	$(EXEC_PHP) $(CONSOLE) cache:clear --prod

##---------------------------------------------------------------------------
## Shortcuts outside container
##---------------------------------------------------------------------------

.PHONY: entity ## Call make:entity
entity:
	$(EXEC_PHP) $(CONSOLE) make:entity
.PHONY: controller ## Call make:controller
controller:
	$(EXEC_PHP) $(CONSOLE) make:controller
.PHONY: form ## Call make:form
form:
	$(EXEC_PHP) $(CONSOLE) make:form
.PHONY: command ## Call make:command
command:
	$(EXEC_PHP) $(CONSOLE) make:command

##---------------------------------------------------------------------------
## Shortcuts commands
##---------------------------------------------------------------------------

.PHONY: admin ## Call create:admin
admin:
	$(EXEC_PHP) $(CONSOLE) create:admin


##---------------------------------------------------------------------------
## Dependencies & environment Files
##---------------------------------------------------------------------------

docker-compose.override.yml: docker-compose.override.yml.dist
	$(RUN) cp docker-compose.override.yml.dist docker-compose.override.yml
.env.local: .env
	$(RUN) cp .env .env.local
