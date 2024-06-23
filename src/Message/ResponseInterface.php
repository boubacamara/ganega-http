<?php
namespace Ganega\Http\Message;

interface ResponseInterface
{
    public function setContent(string $content);

    public function addContent(string $content);

    public function setHeader(string $name, string $value);

    public function setStatusCode(int $code);

    public function send();

}