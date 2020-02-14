deploy:
	composer install --prefer-dist --optimize-autoloader --no-dev
	php artisan config:clear
	serverless deploy
