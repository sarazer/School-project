<?php
require ('config.php');
echo' 
<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>The school</title>
            <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
            <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
            <link href=" '.DIR.'style.css" rel="stylesheet">
        </head>
        
        <body>

        <div  class="menu" id="header">
        <div class="container-fluid">
            <div class="navbar-header">
            <a href="'.DIR.'index.php"><img src="'.DIR.'upload/logo.jpeg" height="40px"></a>
            <h6> Professional High-Tech studies </h6> 
            </div>
            <div>
                <ul class="nav navbar-nav navbar-left">';
                if (empty($_SESSION)) {
                    echo '';
                    } elseif (($_SESSION['role'] == 'owner') || ($_SESSION['role'] == 'manager')) {
                        echo '<li><a href="'.DIR.'index.php?page=schoolView">School</a></li>
                        <li><a href="'.DIR.'index.php?page=adminView">Administrator</a></li>';
                    } else echo '<li><a href="'.DIR.'index.php?page=schoolView">School</a></li>';
                    
                
            echo '</ul>   
                <ul class="nav navbar-nav navbar-right">';
                if (empty($_SESSION)) {
                    echo '';
                } else echo '<li>' . $_SESSION['name'] . ', ' . $_SESSION['role'].'</li>'
                .  "<li><img src='".'http://localhost/theschool/upload/'.$_SESSION['image']."'/></li>" .
                 '<li><a href="'.DIR.'controller/logoutController.php">Log out</a></li>'
            ;
                echo '</ul>

            </div>
        </div>
        </div>
        <div id="content">';


?>
      

