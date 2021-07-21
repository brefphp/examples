deploy:
	composer install --optimize-autoloader --no-dev
	php artisan config:clear
	serverless deploy
