# Symfony Hello world with assets

# Pre-requests

To start this example, you need a S3 Bucket and a CouldFront distribution. There is nothing Bref specific about these
so feel free to google your best resource or read this [guide from AWS](https://aws.amazon.com/blogs/networking-and-content-delivery/amazon-s3-amazon-cloudfront-a-match-made-in-the-cloud/).
The guide even have links to easily set things up.

Example CloudFront domain: **d3gy0nhvuzeqi8.cloudfront.net**
Example S3 Bucket name: **cf-simple-s3-origin-cloudfrontfors3-403367587399**


# To install

```
composer install
npm install
```

Add your cloudfront domain name at the bottom of `webpack.config.js` to tell Symfony where your assets will be.

# Deploy

Now it is time to deploy.
```
# Create a .env.local.php with dev values
composer dump-env prod
./node_modules/.bin/encore production
aws s3 sync ./public/build s3://cf-simple-s3-origin-cloudfrontfors3-403367587399/bref-demo-assets/build --cache-control max-age=31449600,immutable
composer install --prefer-dist --optimize-autoloader --no-dev
bin/console cache:warm --env=prod --no-debug

# Create an empty .env.local.php to force using environement variables
echo "<?php return ['APP_ENV'=>'prod'];" > .env.local.php
serverless deploy
```

Note that CloudFront may need up to 24 hours to properly get initialized. 