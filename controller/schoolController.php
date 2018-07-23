<?php
include 'view/schoolView.php';


$renderStudent = new StudentView();
$renderCourse = new CourseView();

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
        $renderStudent->mainView();      
    break;

    case 'courseDetails':
    $renderCourse->viewDetails($id);
    break;

    case 'deleteCourse':
    $del= new SchoolModel();
    $del->deleteCourse('course_id', $id);
    $renderCourse->mainView();
    echo '<div class="alert alert-success">
    <strong>Success!</strong> Course delete successful.</div>';
    echo '<meta http-equiv="refresh" content="5">';

    break;
    case 'insertNewCourse': 
    $renderCourse->insertView(); 

        if (isset($_POST['submit'])) {
            if ((!isset($_POST['name'])) || ($_POST['name'] == null)) {
                echo '<div class="alert alert-warning">
                <strong>Warning!</strong> Incorrect name value.</div>';
            } elseif ((!isset($_POST['description'])) || ($_POST['description'] == null)) {
                echo '<div class="alert alert-warning">
                <strong>Warning!</strong> Incorrect description value.</div>';
            } elseif ((!isset($_POST['image'])) || ($_POST['image'] == null)) {
                echo '<div class="alert alert-warning">
                <strong>Warning!</strong> Incorrect image value.</div>';
            }else {
                $name = $_POST['name'];
                $description = $_POST['description'];
                $image = $_POST['image'];
            
                
                    $dal = new SchoolModel();
                    $insert= $dal->insertCourse($name, $description, $image);
                    
                    echo '<div class="alert alert-success">
                    <strong>Success!</strong> New course insert successful.</div>';
                    echo '<meta http-equiv="refresh" content="5">';
                    
            
            }
            }
    break;


    case 'updateCourse':
    $renderCourse->updateView($id);

        if(isset($_POST['submit'])) {
            if ((!isset($_POST['name'])) || ($_POST['name'] == null)) {
                echo '<div class="alert alert-warning">
                <strong>Warning!</strong> Incorrect name value.</div>';
            } elseif ((!isset($_POST['description'])) || ($_POST['description'] == null)) {
                echo '<div class="alert alert-warning">
                <strong>Warning!</strong> Incorrect description value.</div>';
            } elseif ((!isset($_POST['image'])) || ($_POST['image'] == null)) {
                echo '<div class="alert alert-warning">
                <strong>Warning!</strong> Incorrect image value.</div>';
            } else {
                $name = $_POST['name'];
                $description = $_POST['description'];
                $image =  $_POST['image'];

                $dal = new SchoolModel();
                $update = $dal->updateCourse($id, $name, $description, $image);
                echo '<div class="alert alert-success">
                <strong>Success!</strong> Course update successful.</div>';
                echo '<meta http-equiv="refresh" content="5">';
    
            }
        }   
    break;

    case 'studentDetails':
    $renderStudent->viewDetails($id);
    break;

    case 'deleteStudent':
    $delete = new SchoolModel();
    $delete->deleteStudent('student_id', $id );
    $renderStudent->mainView();
    echo '<div class="alert alert-success">
    <strong>Success!</strong> Course delete successful.</div>';
    echo '<meta http-equiv="refresh" content="5">';

    break;
    case 'insertNewStudent':
    $renderStudent->insertView();


        if (isset($_POST['submit'])) {
            if ((!isset($_POST['name'])) || ($_POST['name'] == null)) {
                echo '<div class="alert alert-warning">
                <strong>Warning!</strong> Incorrect name value.</div>';
            }elseif ((!isset($_POST['phone'])) || ($_POST['phone'] == null)) {
                echo '<div class="alert alert-warning">
                <strong>Warning!</strong> Incorrect phone value.</div>';
            }elseif ((!isset($_POST['email'])) || ($_POST['email'] == null)) {
                echo '<div class="alert alert-warning">
                <strong>Warning!</strong> Incorrect email value.</div>';
            }elseif ((!isset($_POST['image'])) || ($_POST['image'] == null)) {
                echo '<div class="alert alert-warning">
                <strong>Warning!</strong> Incorrect image value.</div>';
            }else {
                $name = $_POST["name"];
                $email = $_POST["email"];
                $phone = $_POST["phone"];
                $image = $_POST['image'];
            
                    $dal = new SchoolModel();
                    $id = $dal->insertStudent($name, $phone, $email,$image);
                    
                    $checked = array();

                    foreach ($_POST['course'] as $checkbox) {
                        array_push($checked, $checkbox);
                    } 

                    for ($i=0; $i<count($checked); $i++) {
                        $dal->updateStudentCourses($id, $checked[$i]);
                    }

                    echo '<div class="alert alert-success">
                    <strong>Success!</strong>New student insert successful.</div>';
                    echo '<meta http-equiv="refresh" content="5">';
                    
                
                }

        };
    break;

    case 'updateStudent':
    $renderStudent->updateView($id); 
     

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
            } elseif ((!isset($_POST['image'])) || ($_POST['image'] == null)) {
                echo '<div class="alert alert-warning">
                <strong>Warning!</strong> Incorrect image value.</div>';
              
            } else {
                $name = $_POST['name'];
                $phone = $_POST['phone'];
                $email = $_POST['email'];
                $image = $_POST['image'];

                $dal = new SchoolModel();
                $update = $dal->updateStudent($id, $name, $phone, $email, $image);
                $dal->clearStudent($id);

                $checked = array();
                    foreach ($_POST['course'] as $checkbox) {
                        array_push($checked, $checkbox);
                } 

                for ($i=0; $i<count($checked); $i++) {
                    $dal->updateStudentCourses($id, $checked[$i]);
                }    
                echo '<div class="alert alert-success">
                <strong>Success!</strong> Student update successful.</div>';
                echo '<meta http-equiv="refresh" content="5">';
            }   
        }
    break;

}
?>