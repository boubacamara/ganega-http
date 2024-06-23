<?php
namespace Ganega\Http\Message;

interface RequestInterface
{
    # BODY METHODS

    public function hasBody();

    public function getBody();

    public function notEmptyBody();

    public function hasInput(string $name);

    public function getInput(string $name);

    public function notEmptyInput(string $name);

    # SESSION METHODS

    public function hasSession(string $name);

    public function getSession(string $name);

    public function addSession(string $name, $value);

    public function deleteSession(string $name);

    public function destroySession();


    # COOKIES METHODS

    public function hasCookie(string $name);

    public function getCookie(string $name);

    public function addCookie(string $name, $value, array $options);

    public function destroyCookie(string $name);

    # SERVER METHODS

    public function getUrlPath();

    public function getUrl();

    public function hasMethod(string $method);

    public function getMethod();

    public function getScriptName();

    public function getServerScheme();

    public function getHost();

    public function getPort();

    public function hasServerReferer();

    public function getServerReferer();

    public function hasInServer(string $key);

    public function getInServer(string $key);
}