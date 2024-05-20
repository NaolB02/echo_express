<?php
declare(strict_types=1);

use Spiral\Goridge;
use Spiral\RoadRunner;
use GRPC\EchoService\EchoServiceInterface;
use GRPC\EchoService\EchoService;

ini_set('display_errors', 'stderr');
require "vendor/autoload.php";
$server = new \Spiral\GRPC\Server();
$server->registerService(EchoServiceInterface::class, new EchoService());
$w = new RoadRunner\Worker(new Goridge\StreamRelay(STDIN, STDOUT));
$server->serve($w);