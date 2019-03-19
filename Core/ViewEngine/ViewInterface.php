<?php

namespace Core\ViewEngine;

interface ViewInterface
{
    public function render($templateName = null, $model = null);
}