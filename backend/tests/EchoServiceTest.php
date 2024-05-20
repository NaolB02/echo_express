<?php
declare(strict_types=1);
require "vendor/autoload.php";

use PHPUnit\Framework\TestCase;
use Spiral\Goridge\RPC;
use Spiral\Goridge\SocketRelay;
use GRPC\EchoService\EchoRequest;
use GRPC\EchoService\EchoResponse;
use GRPC\Client\Service\EchoServiceClient;
use Spiral\GRPC\Invoker;
use Spiral\GRPC\Context;

class EchoServiceTest extends TestCase
{
    private $client;
    private $serverProcess;

    protected function setUp(): void
    {
        parent::setUp();

        // Start the gRPC server in a separate process
        $this->serverProcess = proc_open(
            ['php', 'EchoServiceWorker.php'],
            [['pipe', 'r'], ['pipe', 'w'], ['pipe', 'w']],
            $pipes
        );

        // Ensure the server has time to start
        sleep(1);

        // Create a client connected to the server
        $relay = new SocketRelay('127.0.0.1', 9001, SocketRelay::SOCK_TCP);
        $rpc = new RPC($relay);
        $this->client = new EchoServiceClient($rpc);
    }

    protected function tearDown(): void
    {
        // Clean up the server process
        proc_terminate($this->serverProcess);
        proc_close($this->serverProcess);

        parent::tearDown();
    }

    public function testEchoBack()
    {
        $request = new EchoRequest();
        $request->setMessage('Hello, World!');

        // The test failed here
        $response = $this->client->EchoBack(new Context([]), $request);

        // Assert the response message
        $this->assertInstanceOf(EchoResponse::class, $response);
        $this->assertEquals('Hello, World!', $response->getMessage());
    }
}
