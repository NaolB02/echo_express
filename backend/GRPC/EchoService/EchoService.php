<?php

namespace GRPC\EchoService;

use GRPC\EchoService\EchoRequest;
use GRPC\EchoService\EchoResponse;
use GRPC\EchoService\EchoServiceInterface;
use Spiral\GRPC;

class EchoService implements EchoServiceInterface
{
   
    /**
    * @param GRPC\ContextInterface $ctx
    * @param EchoRequest $in
    * @return EchoResponse
    *
    * @throws GRPC\Exception\InvokeException
    */
    public function EchoBack(GRPC\ContextInterface $ctx, EchoRequest $in): EchoResponse {
        $message = $in->getMessage();
        $response = new EchoResponse();
        $response->setMessage($message);
        return $response;
    }
}
