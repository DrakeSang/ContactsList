<?php
/**
 * Created by PhpStorm.
 * User: emich
 * Date: 2.1.2019 г.
 * Time: 20:56
 */

namespace Core\Http;


interface RequestInterface
{
    public function getControllerName(): string;

    public function getActionName(): string;

    public function getQueryString(): string;
}