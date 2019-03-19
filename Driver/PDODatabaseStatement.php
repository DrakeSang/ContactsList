<?php

namespace Driver;

class PDODatabaseStatement implements  DatabaseStatementInterface
{
    private $statement;

    /**
     * PDODatabaseStatement constructor.
     * @param $statement
     */
    public function __construct(\PDOStatement $statement)
    {
        $this->statement = $statement;
    }


    public function fetch(): array
    {
        return $this->statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function fetchRow()
    {
        return $this->statement->fetch(\PDO::FETCH_ASSOC);
    }

    public function execute(array $args = []): bool
    {
        return $this->statement->execute($args);
    }
}