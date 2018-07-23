<?php
require_once 'models/schoolModel.php'; 
    
Class SchoolRender { 

    function ParmsView() {
        $render = new SchoolModel(); 
        echo '<div class="container-fluid">
                <div class="row">
                <div class="col-md-3">
                <h2>Courses:';
                if (empty($_SESSION)) {
                    echo '';
                } elseif (($_SESSION['role'] == 'owner') || ($_SESSION['role'] == 'manager')) {
                    echo ' <a href="'.DIR.'index.php?page=schoolView&action=insertNewCourse"><i class="fa fa-plus-square"></i></a>';
            
                };
                
                echo '</h2><hr>';
            
                    $displayCourses = $render->getCourses();
                    foreach ($displayCourses as $course) {
                        echo '<div><img src="'.DIR.'upload/'.$course['courseImage'].'"/><b><a href="'.DIR.'index.php/?page=schoolView&action=courseDetails&id='.$course['courseId'].'">'.' '.$course['courseName'] .
                         '</a></b><br><br></div>';
                    };
            echo '</div>
            <div class="col-md-3">
            <h2>Students:
            <a href="'.DIR.'index.php?page=schoolView&action=insertNewStudent"><i class="fa fa-plus-square"></a></i>
            </h2><hr>';

     // display list of students           
    $displayStudents = $render->getStudents(); 
            foreach ($displayStudents as $student) {
            echo '<div><img src="'.DIR.'upload/'.$student['studentImage'].'"/><b><a href="'.DIR.'index.php/?page=schoolView&action=studentDetails&id='.$student['studentId'].'">'
            . $student['studentName'] . '</a></b>'.' ' .'<br>'. $student['studentPhone'] .'</div><br/>';
            
        };
           

		echo '</div>
            <div class="col-md-5">';
    }

    // default of school view 
    function mainView() {  
        
        $render = new SchoolModel();
        
        $show = $this->ParmsView();

        $display = $render->getNumOfStudents();
            echo '<h3>Total students: </h3>'.$display['students']. '<br>'; 

        $display = $render->getNumOfCourses();    
            echo '<h3>Total courses: </h3>'.$display['courses'];
    
		echo '</div>
	        </div>
            </div>';
                 
    }
}
Class StudentView extends SchoolRender {
    //show students detalis
    function viewDetails($id) {
        $render = new SchoolModel();
        $show = $this->ParmsView();
    
        $displayStudent = $render->getStudent($id);
        foreach ($displayStudent as $student) {
            echo '<h3>'.$student['studentName']. '<img src="'.DIR.'upload/'.$student['studentImage'].'"/>'.
            ' <a href="'.DIR.'index.php?page=schoolView&action=updateStudent&id='.$student['studentId'].'">
                <i class="glyphicon glyphicon-edit"></i></a></h3><br>'
                .'<h4>Phone: </h4>'.$student['studentPhone'].'<br><br>'
                .'<h4>Email: </h4>'.$student['studentEmail'].'<br><br>'

                .'<h4>Courses:</h4>';
                $render->pre_StudentCourses($id);
             }
                echo '</div>
                </div>
                </div>';
       
    }
        
    // click on + is to insert new student
    function insertView() { 

        $render = new SchoolModel();
        $show = $this->ParmsView();
        
        echo '
        <h3>Insert New Student</h3>
        <hr>
        <form class="form-group" action="" method="post" >
            <label>Name:<br>
            <input class="form-control" type="text" placeholder="name" name="name"><label></br>
            <label>Phone:<br>
            <input class="form-control" type="number" placeholder="phone" name="phone"><label></br>
            <label>Email:<br>
            <input class="form-control" type="email" placeholder="email" name="email"><label></br>
            
            <div>';
            
            $courses = $render->getCourses();
            foreach ($courses as $course) {
            echo '<input type="checkbox" name="course[]" id="'.$course['courseName'].'" value="'.$course['courseName'].'">'.$course['courseName'].'<br>';
            }
            
            echo '<br><input  class="btn btn-default btn-file" id="fileUpload" name="image" multiple="" type="file" /> 
                <br>
            <input type="submit" class="btn btn-primary input-group" name="submit" value="Submit"></div>
                </form>
                ';
                echo '</div>
                 </div>
                </div>';
        
    }
    // clicked on update button
    function updateView($id) { 
        $render = new SchoolModel();
    
        $show = $this->ParmsView();
        $students = $render->getStudent($id);
         
        foreach ($students as $student) {
            echo 
                '<form class="form-group" action="" method="post" >
                <h3>update student '.$student['studentName'].
                '<a href="'.DIR.'index.php?page=schoolView&action=deleteStudent&id='
                .$student['studentId'].'"><i class="glyphicon glyphicon-trash"></i></a></h3>
                <hr>
                <label> Name:<br>
                <input class="form-control" type="text" placeholder="name" name="name" value="';

                if (isset($_POST['name'])) {
                    echo $_POST['name'];
                } else echo $student['studentName'];

                echo '"></label><br>
                <label>Phone:<br> 
                <input class="form-control" type="number" placeholder="phone" name="phone" value="';

                if (isset($_POST['phone'])) {
                    echo $_POST['phone'];
                } else echo $student['studentPhone'];

                echo '"></label><br>
                <label>Email:<br>
                 <input class="form-control" type="email" placeholder="email" name="email" value="';

                if (isset($_POST['email'])) {
                    echo $_POST['email'];
                } else echo $student['studentEmail'];
            
            echo '"></label></br>
                <div>';
            }

            $listOfCourses = $render->getStudent_Courses($id);
            $courses = $render->getCourses();
            foreach ($courses as $course) {
                if (!in_array($course['courseName'], $listOfCourses)) {
                    echo '<input type="checkbox" name="course[]" id="'.$course['courseName'].'" value="'.$course['courseName'].'">'.$course['courseName'].'<br>';
                } else echo '<input type="checkbox" name="course[]" id="'.$course['courseName'].'" checked="checked" value="'.$course['courseName'].'">'.$course['courseName'].'<br>';
            }

            echo '<br><input  class="btn btn-default btn-file" id="fileUpload" name="image" multiple="" type="file" /><br>
            <input type="submit" class="btn btn-success input-group" name="submit" value="Save">
            </form>';

            echo '</div>
            </div>
            </div>';

    }

}

Class CourseView extends SchoolRender {
    
    //show course details
    function viewDetails($id) { 
    
        $render = new SchoolModel();
    
        $show = $this->ParmsView();
    
        $displayCourse = $render->getCourse($id);
        foreach ($displayCourse as $course) {
            echo '<h3>'.$course['courseName']. '<img src="'.DIR.'upload/'.$course['courseImage'].'"/>';
            if (empty($_SESSION)) {
                echo '';
            } elseif (($_SESSION['role'] == 'owner') || ($_SESSION['role'] == 'manager')) {
                echo ' <a href="'.DIR.'index.php?page=schoolView&action=updateCourse&id='.$course['courseId'].'"><i class="glyphicon glyphicon-edit"></i></a>';
            }
            echo '</h3><br>
            <h4>Course Description: </h4></br>'.$course['courseDesc'].
            '<br><br>
            <h4> students:</h4>';
            $render->showCourseStudents($id);
        }
    
            echo '</div>
                </div>
                </div>';
    }

    // click on + is to insert new course
    function insertView() { 
        $render = new SchoolModel();
        $show = $this->ParmsView();
        
        echo '
        <h3>Insert New Course</h3>
        <hr>
        <form class="form-group" action="" method="POST" >
            <label>Name:<br>
            <input class="form-control" type="text" placeholder="name" name="name"></label></br>
            <label>Description:<br>
            <textarea class="form-control" type="text" placeholder=" " name="description"></textarea></label></br></br>
            <br><input  class="btn btn-default btn-file" id="fileUpload" name="image" multiple="" type="file" /><br>
            <input type="submit" class="btn btn-primary input-group" name="submit" value="Submit">
        </form>
        ';
        echo '</div>
        </div>
        </div>';
     
    
    }
   


    // clicked on update button 
    function updateView($id) { 
       
        $render = new SchoolModel();
        $show = $this->ParmsView();             
        $courses = $render->getCourse($id);

        foreach ($courses as $course) {
            $number = $render->courseStudentNumber($id);  
            echo 
            '<div> 
        <h3>Update course '.$course['courseName'];
        if ($number==0) {
            echo '<a href="'.DIR.'index.php?page=schoolView&action=deleteCourse&id='.$course['courseId'].'"><i class="glyphicon glyphicon-trash"></i></a></h3>';
        } else echo '</h3>';
        
        echo '<hr>
            <form class="form-group" action="" method="POST" >
            <label> Name:<br>
            <input class="form-control" type="text" placeholder="name" name="name" value="';
        if (isset($_POST['name'])) {
            echo $_POST['name'];
        } else echo $course['courseName'];
        
        echo '"></label><br> 
            <label>Description: <textarea class="form-control" placeholder=" " type="text" name="description" value=>"';
            if (isset($_POST['desciption'])) {
                echo $_POST['description'];
            } else echo $course['courseDesc'];
        
        echo '"</textarea></label></br></br>
        <br><input  class="btn btn-default btn-file" id="fileUpload" name="image" multiple="" type="file" /><br><br>
        <input type="submit" class="btn btn-success input-group" name="submit" value="Save">
        </form><br>
        </div>
        <div></br>
            <b>Total courses attending: '.$number.'</b>
    </div>
    ';  
    echo '</div>
    </div>
    </div>';

            }
        }
    }

?>