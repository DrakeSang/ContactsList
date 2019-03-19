<?php
/**
 * Created by PhpStorm.
 * User: emich
 * Date: 2.1.2019 г.
 * Time: 20:58
 */

namespace Core\Http;


class Request implements RequestInterface
{
    private $controllerName;

    private $actionName;

    private $queryString;

    /**
     * Request constructor.
     * @param $controllerName
     * @param $actionName
     * @param $queryString
     */
    public function __construct(string $controllerName, string $actionName, string $queryString)
    {
        $this->controllerName = $controllerName;
        $this->actionName = $actionName;
        $this->queryString = $queryString;
    }

    /**
     * @return string
     */
    public function getControllerName(): string
    {
        return $this->controllerName;
    }

    /**
     * @return string
     */
    public function getActionName(): string
    {
        return $this->actionName;
    }

    /**
     * @return string
     */
    public function getQueryString(): string
    {
        return $this->queryString;
    }
}