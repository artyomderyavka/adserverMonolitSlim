<?php
/**
 * Created by PhpStorm.
 * Date: 27.07.2017
 * Time: 14:56
 */

namespace Controller;


class HelloController {
    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function index(Request $request, Response $response) {
        $name = $request->getAttribute('name');
        $response->getBody()->write("Hello, $name");

        return $response;
    }
}