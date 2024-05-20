<?php
declare(strict_types=1);

use Spiral\Goridge;
use Spiral\RoadRunner;
use Spiral\RoadRunner\Worker;
use Spiral\GRPC\Server;
use Spiral\Goridge\StreamRelay;
use GRPC\EchoService\EchoServiceInterface;
use GRPC\EchoService\EchoService;

ini_set('display_errors', 'stderr');
require "vendor/autoload.php";

// Initialize gRPC server
$server = new Server();
$server->registerService(EchoServiceInterface::class, new EchoService());

// Start the worker
$worker = new Worker(new StreamRelay(STDIN, STDOUT));
$server->serve($worker);