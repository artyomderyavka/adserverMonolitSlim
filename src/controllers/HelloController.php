<?php
/**
 * Created by PhpStorm.
 * Date: 27.07.2017
 * Time: 14:56
 */

namespace Controller;


use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


class HelloController {
    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function hello(Request $request, Response $response, $arguments) {
        $name = $request->getAttribute('name');
        $response->getBody()->write("Hello, $name");

        return $response;
    }

    public function goodbye(Request $request, Response $response, $arguments) {
        $name = $request->getAttribute('name');
        $response->getBody()->write("Goodbye, $name");

        return $response;
    }
}