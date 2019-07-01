install:
	composer install
lint:
	composer run-script phpcs -- --standard=PSR12 public routes
run:
	php -S localhost:8000 -t public