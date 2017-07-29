<?php
/**
 * Created by PhpStorm.
 * Date: 27.07.2017
 * Time: 14:56
 */

namespace Controller;


use \Psr\Http\Message\ServerRequestInterface as RequestInterface;
use \Psr\Http\Message\ResponseInterface as ResponseInterface;
use \AdServer\Controller as Controller;


class HelloController extends Controller
{
    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param $arguments
     * @return ResponseInterface
     */
    public function hello(RequestInterface $request, ResponseInterface $response, $arguments) {
        $name = $request->getAttribute('name');

        $targetServiceClient = $this->getContainer()->get("targetServiceClient");
        $serviceResponseJson = $targetServiceClient->callService('GET', '/target/goodbye/' . $name,  '', [], [], "");
        $serviceResponse = json_decode($serviceResponseJson->getBody());

        $response->getBody()->write("Hello, $name" . PHP_EOL);
        $response->getBody()->write("Target Service Respond with message " . $serviceResponse->message);

        return $response;
    }

    public function goodbye(Request $request, Response $response, $arguments) {
        $name = $request->getAttribute('name');
        $response->getBody()->write("Goodbye, $name");

        return $response;
    }
}