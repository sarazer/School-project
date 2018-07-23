<?php
    class DAL {
        private $servername = "localhost";
        private $username = "root";
        private $password = "";
        private $dbname = "school";

        function fetch($sql) {
            try {
                $conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                 
                $resultsArray = $conn->query($sql);
                return $resultsArray;
                
            }
            catch(PDOException $e)
            {
                return $e->getMessage();
            }
        }
        function set($sql) {
            try {
                $conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                 
                $do = $conn->query($sql);
        
            }
            catch(PDOException $e)
            {
                return $e->getMessage();
            }
        }
    }
    

?>