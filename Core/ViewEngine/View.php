<?php

namespace Core\ViewEngine;

use Core\Http\RequestInterface;

class View implements ViewInterface
{
    private $request;

    const DEFAULT_TEMPLATE_FOLDER = 'views';
    const DEFAULT_TEMPLATE_EXTENSION = '.php';

    /**
     * View constructor.
     * @param $request
     */
    public function __construct(RequestInterface $request)
    {
        $this->request = $request;
    }

    /**
     * @param null $templateName
     * @param null $data
     */
    public function render($templateName = null, $data = null)
    {
        if(is_object($templateName)){
            $model = $templateName;
            $templateName = null;
        }

        if(null == $templateName){
            include self::DEFAULT_TEMPLATE_FOLDER .
                    DIRECTORY_SEPARATOR .
                    $this->request->getControllerName().
                    DIRECTORY_SEPARATOR.
                    $this->request->getActionName() .
                    self::DEFAULT_TEMPLATE_EXTENSION;
        }else {
            include self::DEFAULT_TEMPLATE_FOLDER .
                DIRECTORY_SEPARATOR .
                $templateName .
                self::DEFAULT_TEMPLATE_EXTENSION;
        }
    }
}