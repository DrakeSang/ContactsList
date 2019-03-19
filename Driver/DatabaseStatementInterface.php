<?php

namespace Driver;

interface DatabaseStatementInterface
{
    public function fetch(): array;

    public function fetchRow();

    public function execute(array $args = []): bool;
}