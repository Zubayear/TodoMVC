<?php

    class Dbh
    {
        private $servername;
        private $username;
        private $password;
        private $dbname;

        protected function connect()
        {
            try
            {
                $this->servername = "localhost";
                $this->username = "";
                $this->password = "";
                $this->dbname = "todolist";
                
                $dsn = "mysql:host={$this->servername};dbname={$this->dbname}";
                $pdo = new PDO($dsn, $this->username, $this->password);
                $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                return $pdo;
            }
            catch(PDOException $e)
            {
                echo "Error!: " . $e->getMessage() . "</br>";
                die();
            }

        }
    }
?>
