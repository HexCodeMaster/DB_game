<?php

namespace Mastermind;

interface Database
{
    public function __construct(string $host, string $dbname, string $username, string $password);
    public function select(array $params, array $conditions = []);
    public function insert(string $table, array $params);
    public function update(string $table, array $params, array $conditions);
    public function delete(string $table, array $conditions);
}