install:
	composer install
lint:
	composer run-script phpcs -- --standard=PSR12 public routes bootstrap app/Http/Controllers  tests
run:
	php -S localhost:8000 -t public
logs:
	tail -f storage/logs/lumen.log
test:
	composer run-script phpunit tests