<?php
# Generated by the protocol buffer compiler (spiral/php-grpc). DO NOT EDIT!
# source: proto/echo.proto

namespace GRPC\EchoService;

use Spiral\GRPC;

interface EchoServiceInterface extends GRPC\ServiceInterface
{
    // GRPC specific service name.
    public const NAME = "service.EchoService";

    /**
    * @param GRPC\ContextInterface $ctx
    * @param EchoRequest $in
    * @return EchoResponse
    *
    * @throws GRPC\Exception\InvokeException
    */
    public function EchoBack(GRPC\ContextInterface $ctx, EchoRequest $in): EchoResponse;
}