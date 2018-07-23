<?php
include './models/dal.php';
include './models/loginModel.php';
require_once './view/loginView.php';


$render = new LoginView;
$render->login();

if (isset($_POST['submit'])) {
    
    if ((!isset($_POST['email'])) || ($_POST['email'] == null)) {
        echo '<div class="alert alert-warning">
        <strong>Warning!</strong> Incorrect username value.</div>';
    } elseif ((!isset($_POST['password'])) || ($_POST['password'] == null)) {
        echo '<div class="alert alert-warning">
        <strong>Warning!</strong> Incorrect password value.</div>';
    } else {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $dal = new LoginModel();
        $results = $dal->setQuery($email, $password);
        
        if (empty($results)) {
            echo '<div class="alert alert-warning">
            <strong>Warning!</strong> This admin does not exist.</div>';
        } else {
            $_SESSION['name'] = $results['adminName'];
            $_SESSION['role'] = $results['adminRole'];
            $_SESSION['image'] = $results['adminImage'];
            header("location: /theschool/index.php?page=schoolView");
        };
    };
};

?>