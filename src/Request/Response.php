<?php
namespace Ganega\Http\Request;

use Ganega\Http\Message\ResponseInterface;

class Response implements ResponseInterface
{
    public function __construct(private string $content = '', private int $statusCode = 200, private array $headers = [])
    {
  
    }

    public function setContent(string $content)
    {
        $this->content = $content;
    }

    public function addContent(string $content)
    {
        $this->content .= $content;
    }

    public function setHeader(string $name, string $value)
    {
        $this->headers[$name] = $value;
    }

    public function setStatusCode(int $code)
    {
        $this->statusCode = $code;
    }

    public function send()
    {
    
        http_response_code($this->statusCode);

        foreach($this->headers as $name => $value)
        {
            header(sprintf("%s: %s", $name, $value));
        }

        return $this->content;
    }
}