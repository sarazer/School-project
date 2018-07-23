<?php 

require_once 'dal.php';

Class LoginModel extends DAL {

    function setQuery($email, $password) {
        $sql = "SELECT * FROM administrator WHERE adminEmail = '".$email."' AND adminPassword = '".$password."'";
        $result = $this->fetch($sql);
        $resultArray = $result->fetch(PDO::FETCH_ASSOC);
        return $resultArray;
    }
}
?>