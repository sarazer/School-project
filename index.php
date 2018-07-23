<?php
session_start();

include 'header.php';

    if(isset($_GET['page'])){
        $page = $_GET['page'];
    } elseif ((isset($_SESSION)) && (!empty($_SESSION))) {
            $page = 'schoolView';
    } else $page = 'loginView';

        switch ($page) {

            case 'loginView':
            include_once 'controller/loginController.php';
            break;

            case 'adminView':
            include_once 'controller/adminController.php';
            break;

            case 'schoolView':
            include_once 'controller/schoolController.php';
            break;
            
           
       
    }
 include 'footer.php';
?>
