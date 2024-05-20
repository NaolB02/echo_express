<?php
declare(strict_types=1);
// require_once '../GRPC/EchoService/EchoService.php';

use PHPUnit\Framework\TestCase;
use GRPC\EchoService\EchoService;

final class EchoServiceTest extends TestCase
{
    public function testEcho(): void
    {
        $echoService = new EchoService();
        $input = 'Hello, world!';
        $expectedOutput = 'Hello, world!'; // Replace with the expected output

        $this->assertSame(
            $expectedOutput,
            $echoService->echo($input)
        );
    }
}