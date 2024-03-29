check: composer-install phplint phpcs phpinsight psalm phpstan phpmd test infection phpmetrics fix-permission

app: exec

up:
	docker-compose up -d
down:
	docker-compose down
exec:
	docker-compose run --rm app bash
fix-permission:
	docker-compose run --rm app chown -R 1000:1000 .

composer-install:
	docker-compose run --rm app composer i --dev --no-interaction
composer-update:
	docker-compose run --rm app composer u --dev --no-interaction

test:
	docker-compose run --rm app ./vendor/bin/phpunit -v --no-interaction

phplint:
	docker-compose run --rm app ./vendor/bin/phplint -v --no-interaction

phpcs:
	docker-compose run --rm app ./vendor/bin/phpcs -v
phpcbf:
	docker-compose run --rm app ./vendor/bin/phpcbf -v

phpinsight:
	docker-compose run --rm app ./vendor/bin/phpinsights -v --no-interaction

psalm:
	docker-compose run --rm app ./vendor/bin/psalm

phpstan:
	docker-compose run --rm app ./vendor/bin/phpstan analyse

phpmd:
	docker-compose run --rm app ./vendor/bin/phpmd src/ ansi phpmd.xml

phpmetrics:
	docker-compose run --rm app ./vendor/bin/phpmetrics --report-html=var/phpmetrics ./src/

infection:
	docker-compose run --rm app ./vendor/bin/infection --threads=4 --show-mutations --only-covered