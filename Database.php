<?php

declare(strict_types=1);

class Database
{
    public $connection;

    public function __construct ()
    {
        $host = 'mysql';
        $port = 3306;
        $dbname = 'study';
        $username = 'root';
        $password = 'root';
        $this->connection = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
    }
    public function getAllEmails() {
        $statement = $this->connection->query('select email from ajax_form_users');
        return $statement->fetchAll();
    }

    public function saveUsers($name, $email) {
        $executeUsers = $this->connection->prepare('INSERT INTO ajax_form_users (name, email) values (:name, :email);');
        return $executeUsers->execute([':name' => $name, ':email' => $email]);

    }
    public function getAll() {
        $statement = $this->connection->query('select * from ajax_form_users');
        return$statement->fetchAll();
    }
}
