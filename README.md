# Ganega\Http

The `Request` and `Response` classes provide simple and intuitive interfaces for handling HTTP requests and responses in your PHP application. They encapsulate request data and HTTP responses, making their manipulation and management easier.

## Purpose

The `Request` and `Response` classes are designed to simplify interaction with HTTP request and response data. They offer methods to check and retrieve request parameters, request body data, sessions, cookies, and server information, as well as to configure and send HTTP responses. This abstraction allows you to manipulate HTTP requests and responses cleanly and efficiently without directly accessing global variables like `$_GET`, `$_POST`, `$_SESSION`, `$_COOKIE`, `$_SERVER`, and `$_FILES`.

## Ease of Use

The `Request` and `Response` classes provide a clear and concise interface with well-defined methods for common HTTP request and response operations. Using these classes helps reduce repetitive code and makes the code more readable and maintainable.

## Installation

To use these classes in your project, simply include them in your PSR-4 autoloader or directly import them into your PHP file.

```bash 
composer require boubacamara/ganega-http

```

## Usage Examples

### Request Class

#### Create a `Request` instance from global variables

```php
use Ganega\Http\Request\Request;

$request = Request::fromGlobals();

```

##### Check if the request has a body

```php

if ($request->hasBody()) {
    // Process the request body
}

```

##### Get the request body

```php

$body = $request->getBody();

```

##### Check and retrieve a request parameter

```php

if ($request->hasInput('username')) {
    $username = $request->getInput('username');
}

```

##### Manipulate sessions

```php

// Add a session
$request->addSession('user_id', 123);

// Retrieve a session
$user_id = $request->getSession('user_id');

// Delete a session
$request->deleteSession('user_id');

// Destroy all sessions
$request->destroySession();

```

##### Manipulate cookies

```php

// Add a cookie
$request->addCookie('test_cookie', 'value', ['expires' => time() + 3600]);

// Retrieve a cookie
$cookieValue = $request->getCookie('test_cookie');

// Delete a cookie
$request->destroyCookie('test_cookie');

```

##### Retrieve URL and server information

```php

// Get the URL path
$urlPath = $request->getUrlPath();

// Get the full URL
$url = $request->getUrl();

// Check the request method
if ($request->hasMethod('POST')) {
    // Process the POST request
}

// Get the request method
$method = $request->getMethod();

// Get the script name
$scriptName = $request->getScriptName();

// Get the server scheme (HTTP/HTTPS)
$serverScheme = $request->getServerScheme();

// Get the host
$host = $request->getHost();

// Get the server port
$port = $request->getPort();

// Check and get the server referrer
if ($request->hasServerReferer()) {
    $referer = $request->getServerReferer();
}

```

##### Parse the request body

```php

$parsedBody = $request->bodyParser();

```

### Response Class

#### Create a `Response` instance

```php

use Ganega\Http\Request\Response;

$response = new Response();

```

##### Set the response content

```php

$response->setContent('Hello, World!');

```

##### Add content to the existing response

```php

$response->addContent(' More content.');

```

##### Set an HTTP header

```php

$response->setHeader('Content-Type', 'application/json');

```

##### Set the HTTP status code

```php

$response->setStatusCode(404);

```

##### Send the response

```php

echo $response->send();

```