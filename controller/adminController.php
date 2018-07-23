<?php

include 'view/adminView.php';

$render = new AdminView();

if (isset ($_GET['action'])){
    $action = $_GET['action'];
} else {
    $action = '';
}

if (isset ($_GET['id'])){
    $id = $_GET['id'];
}

switch ($action) {

    case '':
        $render->mainView();

    break;

    case 'adminDetails':
        $render->viewDetails($id);

    break;

    case 'deleteAdmin':
    $delete = new AdminModel();
    $delete->deleteAdmin($id);
    $render->mainView();
    echo '<div class="alert alert-success">
    <strong>Success!</strong>Admin delete successful.</div>';
    echo '<meta http-equiv="refresh" content="5">';  
    break;

    case 'insertNewAdmin':
        $render->insertView();

      if (isset($_POST['submit'])) {
           if ((!isset($_POST['name'])) || ($_POST['name'] == null)) {
            echo '<div class="alert alert-warning">
            <strong>Warning!</strong> Incorrect name value.</div>';
            } elseif ((!isset($_POST['phone'])) || ($_POST['phone'] == null)) {
                echo '<div class="alert alert-warning">
                <strong>Warning!</strong> Incorrect phone value #.</div>';
            } elseif ((!isset($_POST['email'])) || ($_POST['email'] == null)) {
                echo '<div class="alert alert-warning">
                <strong>Warning!</strong> Incorrect email value.</div>';
            } elseif (!isset($_POST['role'])) {
                echo '<div class="alert alert-warning">
                <strong>Warning!</strong> Incorrect role value.</div>';
            }elseif ((!isset($_POST['image'])) || ($_POST['image'] == null)) {
                echo '<div class="alert alert-warning">
                <strong>Warning!</strong> Incorrect image value.</div>';
            } else {
                $name = $_POST['name'];
                $phone =$_POST['phone'];
                $email =$_POST['email'];
                $role = $_POST['role'];
                $image =$_POST['image'];
            } 
        
                $dal = new AdminModel();
                $insert = $dal->insertAdmin($name, $phone, $email, $role, $image);
                echo '<div class="alert alert-success">
                <strong>Success!</strong>  New Admin insert successful.</div>';
                echo '<meta http-equiv="refresh" content="5">';
          
        };

    break;  
    
    case 'updateAdmin':
        $render->updateView($id);

        if(isset($_POST['submit'])) {
            if ((!isset($_POST['name'])) || ($_POST['name'] == null)) {
                echo '<div class="alert alert-warning">
                <strong>Warning!</strong> Incorrect name value.</div>';
            } elseif ((!isset($_POST['phone'])) || ($_POST['phone'] == null)) {
                echo '<div class="alert alert-warning">
                <strong>Warning!</strong> Incorrect phone value #.</div>';
            } elseif ((!isset($_POST['email'])) || ($_POST['email'] == null)) {
                echo '<div class="alert alert-warning">
                <strong>Warning!</strong> Incorrect email value.</div>';
            } elseif (!isset($_POST['role'])) {
                echo '<div class="alert alert-warning">
                <strong>Warning!</strong> Incorrect role value.</div>';
            } elseif ((!isset($_POST['image'])) || ($_POST['image'] == null)) {
                echo '<div class="alert alert-warning">
                <strong>Warning!</strong> Incorrect image value.</div>';
            }else {
                $name = $_POST['name'];
                $phone =$_POST['phone'];
                $email =$_POST['email'];
                $role = $_POST['role'];
                $image = $_POST['image'];

                $dal = new AdminModel();
                $update = $dal->updateAdmin($id, $name, $phone, $email, $role, $image);
                echo '<div class="alert alert-success">
                <strong>Success!</strong> Admin update successful.</div>';
                echo '<meta http-equiv="refresh" content="5">';
                
            }
        }   
              
    break;

   

}


?>