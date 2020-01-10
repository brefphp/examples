# Symfony Hello world com assets

### Translations
* [Inglês](Readme.md)

# Pré-requisitos

Para iniciar este exemplo, você precisa dos seguintes recursos: um S3 Bucket e CouldFront. 
Não existe nada específico a ser configurado para o Bref nessa parte, sinta-se à vontade para pesquisar no Google e 
encontrar o melhor recurso para o seu caso ou leia este [guia da AWS] (https://aws.amazon.com/blogs/networking-and-content-delivery/amazon-s3-amazon-cloudfront-a-match-made -na nuvem/).
No guia você encontra links para configurar facilmente os recursos.

- Exemplo de um domínio CloudFront: **d3gy0nhvuzeqi8.cloudfront.net**
- Exemplo de nome de bucket S3: **cf-simple-s3-origin-cloudfrontfors3-403367587399**

# Instalação

```
composer install
npm install
```

Adicione o nome do seu domínio cloudfront no final do arquivo `webpack.config.js` para informar ao Symfony onde seus 
recursos estarão.

# Deploy

```
# Crie um arquivo .env.local.php com os valores de dev
composer dump-env prod
./node_modules/.bin/encore production
aws s3 sync ./public/build s3://cf-simple-s3-origin-cloudfrontfors3-403367587399/bref-demo-assets/build --cache-control max-age=31449600,immutable
composer install --prefer-dist --optimize-autoloader --no-dev
bin/console cache:warm --env=prod --no-debug

# Crie um .env.local.php vazio para forçar o uso de variáveis ​​de ambiente
echo "<?php return ['APP_ENV'=>'prod'];" > .env.local.php
serverless deploy
```

Observe que o CloudFront pode levar até 24 horas para ser inicializado corretamente.