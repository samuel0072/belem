<?php

namespace routes;

class Router
{
    private $request;
    private $supportedHttpMethods = array(
        "GET",
        "POST"
    );
    function __construct(IRequest $request)
    {
        $this->request = $request;
    }
    function __call($name, $args)
    {
        list($route, $method) = $args;
        if(!in_array(strtoupper($name), $this->supportedHttpMethods))
        {
            $this->invalidMethodHandler();
        }
        $this->{strtolower($name)}[$this->formatRoute($route)] = $method;
    }

    private function formatRoute($route)
    {
        $result = rtrim($route, '/');
        if ($result === '')
        {
            return '/';
        }
        return $result;
    }
    private function invalidMethodHandler()
    {
        header("{$this->request->serverProtocol} 405 Method Not Allowed");
    }
    private function defaultRequestHandler()
    {
        header("{$this->request->serverProtocol} 404 Not Found");
    }
    private function cleanRoute($route){
        $input = explode("?", $route);
        return $input[0];
    }

    function resolve()
    {
        $routeClean = $this->cleanRoute($this->request->requestUri);
        $methodDictionary = $this->{strtolower($this->request->requestMethod)};
        $formatedRoute = $this->formatRoute($routeClean);
        $method = $methodDictionary[$formatedRoute];
        if(is_null($method))
        {
            $this->defaultRequestHandler();
            return;
        }
        echo call_user_func_array($method, array($this->request));
    }
    function __destruct()
    {
        $this->resolve();
    }
}