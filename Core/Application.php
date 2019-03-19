<?php

namespace Core;

use Core\Http\Request;
use Core\Http\RequestInterface;
use Core\Util\Binder;

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

    /**
     * @throws \ReflectionException
     */
    public function start()
    {
        $request = $this->initiateRequest(); // keeping the request(controller,action and
        // query string)
        echo '<pre>';
        print_r($request);
        echo '</pre>';
        $binder = new Binder(); // making new instance of binder to use it later
        $this->instances[RequestInterface::class] = $request; // putting the created request
        // in instances array
        echo '<pre>';
        print_r($this->instances);
        echo '</pre>';
        $controllerFullQualifiedName =
            'Controllers\\' .
            ucfirst($this->controllerName) .
            'Controller';
        // Creating the controller path and making the first letter of the controller capital.
        // If i have controller contact from the url it will search in
        // Controllers/ContactController

        $controller = new $controllerFullQualifiedName($request); // Making new instance.
        echo '<pre>';
        print_r($controller);
        echo '</pre>';

        $methodInfo = new \ReflectionMethod($controllerFullQualifiedName, $this->actionName);
        // I get the method info(the arguments of the function) for teh specific action in
        // that controller.
        echo '<pre>';
        print_r($methodInfo);
        echo '</pre>';

        for ($i = count($this->params); $i < count($methodInfo->getParameters()); $i++) {
            $parameter = $methodInfo->getParameters()[$i]; // getting the first argument of the function
            $paramType = $parameter->getType(); // getting the param type of the argument.

            if(null === $paramType) {
                continue;
            }

            $interfaceName = $paramType->getName(); // getting the name.
            if (!key_exists($interfaceName, $this->mappings) && !key_exists($interfaceName, $this->instances)){
                // if this interface name does not exist in mappings or instances i have
                // received form and i need to go through the post data. I bind that form
                // to model so i can go through the setters of that model and use the post
                // data.
                $bindingModelName = $interfaceName;
                $instance = new $bindingModelName();
                $binder->bindData($_POST, $instance);
            } else {
                // if not i need to resolve that dependency.
                $instance = $this->resolveDependencies($interfaceName);
            }

            $this->params[] = $instance;
        }

        call_user_func_array(
            [$controller, $this->actionName],
            $this->params
        );
    }

    /**
     * @param string $interfaceName
     * @return mixed|object
     * @throws \ReflectionException
     */
    private function resolveDependencies(string $interfaceName)
    {
        if(key_exists($interfaceName, $this->instances)) {
            return $this->instances[$interfaceName];
        } // first checking if that interface name is already added in the instance array

        $className = $this->mappings[$interfaceName]; // getting the class name
        $classInfo = new \ReflectionClass($className);
        $constructorInfo = $classInfo->getConstructor(); // getting the constructor info

        if(null === $constructorInfo || count($constructorInfo->getParameters()) === 0) {
            $instance = new $className;
            $this->instances[$interfaceName] = $instance;
            return $instance;
        } // if there is no constructor we directly create the instance

        $instanceArguments = [];

        foreach ($constructorInfo->getParameters() as $parameter) {
            $paramType = $parameter->getType();
            if(null === $paramType) {
                continue;
            }

            $dependentInterface = $paramType->getName();
            $instance = $this->resolveDependencies($dependentInterface); // we create recursion
            $instanceArguments[] = $instance;

        } // if the constructor exist we need to loop through his arguments

        $instance = $classInfo->newInstanceArgs($instanceArguments);
        $this->instances[$interfaceName] = $instance;

        echo '<pre>';
        print_r($instance);
        echo '</pre>';

        return $instance;
    }

    private function initiateRequest(): RequestInterface
    {
        return new Request(
            $this->controllerName,
            $this->actionName,
            $_SERVER['QUERY_STRING']
        );
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