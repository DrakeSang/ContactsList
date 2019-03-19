<?php

namespace Core;

class Application
{
    private  $controllerName;

    private $actionName;

    private $params = [];

    private $mappings = [];

    private $instances = [];

    /**
     * Application constructor.
     * @param $controllerName
     * @param $actionName
     * @param array $params
     */
    public function __construct($controllerName, $actionName, array $params)
    {
        $this->controllerName = $controllerName;
        $this->actionName = $actionName;
        $this->params = $params;
    }

    public function addMapping(string $interface, string $className)
    {
        $this->mappings[$interface] = $className;
    }

    public function addInstance(string $interface, $instance)
    {
        $this->instances[$interface] = $instance;
    }
}