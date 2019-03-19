<?php

namespace Driver;

interface DatabaseInterface
{
    public function prepare($query): DatabaseStatementInterface;
}