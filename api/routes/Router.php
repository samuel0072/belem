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
    private function getURLParams($routeUrl) {

        $request["params"] = [];

        $url = $this->request->requestUri;
        $size = mb_strlen($routeUrl);

        for ($i = 0, $j = 0; $i < $size; $i++, $j++) {
            //achou um parametro
            if($routeUrl[$i] == ':') {
                $name = '';
                $value = '';
                //atribui seu nome
                while($routeUrl[$i] != '/') {
                    $name += $routeUrl[$i];
                    $i++;
                }
                //avanca ate seu valor
                while($url[$j] != ':') {
                    $j++;
                }
                //atribui seu valor como uma string
                for($j++ ; $url[$j] != '/'; $j++) {
                    $value += $url[$j];
                }
                $request["params"][$name] = $value;
            }
        }
    }

    function resolve()
    {
        $methodDictionary = $this->{strtolower($this->request->requestMethod)};
        $formatedRoute = $this->formatRoute($this->request->requestUri);
        $method = $methodDictionary[$formatedRoute];
        if(is_null($method))
        {
            $this->defaultRequestHandler();
            return;
        }
        $this->getURLParams($formatedRoute);
        echo call_user_func_array($method, array($this->request));
    }
    function __destruct()
    {
        echo var_dump($this);
        $this->resolve();
    }
}