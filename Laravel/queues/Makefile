deploy:
	composer install --optimize-autoloader --no-dev
	npm install
	php artisan config:clear
	serverless deploy
