<?php declare(strict_types=1);

use App\Kernel;
use Bref\Symfony\Messenger\Service\Sqs\SqsConsumer;
use Symfony\Component\Dotenv\Dotenv;

require dirname(__DIR__).'/vendor/autoload.php';

(new Dotenv())->bootEnv(dirname(__DIR__).'/.env');

$kernel = new Kernel($_SERVER['APP_ENV'], (bool)$_SERVER['APP_DEBUG']);
$kernel->boot();

return $kernel->getContainer()->get(SqsConsumer::class);
