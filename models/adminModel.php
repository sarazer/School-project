<?php 

require_once 'dal.php';

Class AdminModel extends DAL {

    function getNumOfAdmin() {
        $sql = "SELECT count(*) as total FROM administrator";
        $admin = $this->fetch($sql);
        $resultArray = $admin->fetch(PDO::FETCH_ASSOC);
        return $resultArray;
    }

    function getAdmins() {
        $sql = "SELECT * FROM administrator";
        $admin = $this->fetch($sql);
        $resultArray = $admin->fetchAll(PDO::FETCH_ASSOC);
        return $resultArray;
    }

    function getAdmin($id) {
        $sql = "SELECT * FROM administrator WHERE adminId='".$id."'";
        $admin = $this->fetch($sql);
        $resultArray = $admin->fetchAll(PDO::FETCH_ASSOC);
        return $resultArray;
    }
    function insertAdmin($name, $phone, $email, $role, $image) {
        $sql = "INSERT INTO `administrator`(`adminName`,`adminPhone`, `adminEmail`,`adminRole`, `adminImage`) VALUES ('".$name."','".$phone."','".$email."','".$role."','".$image."')";
        $insert = $this->set($sql);
    }

    function updateAdmin($id, $name, $phone, $email, $role, $image) {
        $sql = "UPDATE `administrator` SET `adminName`='".$name."',`adminPhone`='".$phone."',`adminEmail`='".$email."',`adminRole`='".$role."',`adminImage`='".$image."' WHERE adminId='".$id."'";
        $update = $this->set($sql);
    }

    function deleteAdmin($id) {
        $sql = "DELETE FROM `administrator` WHERE `adminId`='".$id."'";
        $delete = $this->set($sql);
    }


}
?>