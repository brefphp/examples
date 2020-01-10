# Symfony Hello world with SQS

### Traduções
* [Portuguese - Brazil](Readme-ptBr.md)

# Pre-requests

Before we start we need to setup the QUEUE. Bref works with both FIFO queues and normal queues. Try to create a new normal
SQS queue, name it "foobar" and  click "quick create". 

Example queue ARN: **arn:aws:sqs:us-east-1:403367587399:foobar**
Example queue URL: **https://sqs.us-east-1.amazonaws.com/403367587399/foobar**

# To install

```
composer install
```

Add queue URL to `serverless.yml` in the environment section. Then add queue ARN  `serverless.yml` in the 
"worker" section.  

# Deploy

Now it is time to deploy.
```
# Create a .env.local.php with dev values
composer dump-env prod
composer install --prefer-dist --optimize-autoloader --no-dev
bin/console cache:warm --env=prod --no-debug

# Create an empty .env.local.php to force using environement variables
echo "<?php return ['APP_ENV'=>'prod'];" > .env.local.php
serverless deploy
rm .env.local.php
```

The last thing we need to do is to allow write access to the queue. 

1. Go to IAM in the AWS console
2. Click "Roles" in the left sidebar
3. Find the roles for this Lambda application and click on it. Probably named something like "bref-demo-sqs"
4. Now click "Attach policy" and find "SQSFullAccess" in the list. After you added that policy you are good to go. 

You can obviously be more restrictive with what policy to add. 
