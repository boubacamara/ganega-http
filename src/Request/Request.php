<?php
namespace Ganega\Http\Request;

use Ganega\Http\Message\RequestInterface;

class Request implements RequestInterface
{
    public function __construct(
        private readonly array $params,
        private readonly array $body,
        private readonly array $session,
        private readonly array $cookie,
        private readonly array $server,
        private readonly array $files,
    ){}


    public static function fromGlobals()
    {
        return new static(
            $_GET, 
            $_POST,
            $_SESSION,
            $_COOKIE,
            $_SERVER,
            $_FILES,
        );
    }

    public function hasBody()
    {
        return isset($this->body);
    }

    public function getBody()
    {
        return $this->body;
    }

    public function notEmptyBody()
    {
        return !empty($this->body);
    }

    public function hasInput(string $name)
    {
        return isset($this->body[$name]);
    }

    public function getInput(string $name)
    {
        return $this->body[$name];
    }

    public function NotEmptyInput(string $name)
    {
        return !empty($this->body[$name]);
    }

    public function hasSession(string $name)
    {
        return isset($this->session[$name]);
    }

    public function getSession(string $name)
    {
        return $this->session[$name];
    }

    public function addSession(string $name, $value)
    {
        $_SESSION[$name] = $value;
    }

    public function deleteSession(string $name)
    {
        if($this->hasSession($name)) unset($_SESSION[$name]);
    }

    public function destroySession()
    {
        unset($_SESSION);
    }

    public function hasCookie(string $name)
    {
        return isset($this->cookie[$name]);
    }

    public function getCookie(string $name)
    {
        return $this->cookie[$name];
    }

    public function addCookie(string $name, $value, array $options)
    {
        if(setcookie($name, $value, $options))
        {
            return true;
        }

        return false;
    }

    public function destroyCookie(string $name)
    {
        $this->addCookie($name, "", ['expires' => time() + -1]);
    }

    public function getUrlPath()
    {
        return strtok($this->server['REQUEST_URI'], '?');
    }

    public function getUrl()
    {
        return parse_url($this->server['REQUEST_URI'], PHP_URL_PATH);
    }

    public function hasMethod(string $method)
    {
        return $this->server['REQUEST_METHOD'] === $method;
    }

    public function getMethod()
    {
        return $this->server['REQUEST_METHOD'] ?? '';
    }

    public function getScriptName()
    {
        return $this->server['SCRIPT_NAME'];
    }

    public function getServerScheme()
    {
        return $this->server['REQUEST_SCHEME'];
    }

    public function getHost()
    {
        return $this->server['HTTP_HOST'];
    }

    public function getPort()
    {
        return $this->server['SERVER_PORT'];
    }

    public function hasServerReferer()
    {
        return isset($this->server['HTTP_REFERER']);
    }

    public function getServerReferer()
    {
        return $this->server['HTTP_REFERER'];
    }

    public function hasInServer(string $key)
    {
        return isset($this->server[$key]);
    }

    public function getInServer(string $key)
    {
        return $this->server[$key];
    }

    public function bodyParser()
    {
        $contentType = $this->server['CONTENT_TYPE'] ?? '';

        switch ($contentType) {
            case 'application/json':
                return json_decode(file_get_contents('php://input'), true);
            case 'application/x-www-form-urlencoded':
                parse_str(file_get_contents('php://input'), $parsedBody);
                return $parsedBody;
            case 'multipart/form-data':
                return $this->body;
            default:
                return null;
        }
    }

}