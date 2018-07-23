<?php
require_once 'dal.php';

class SchoolModel extends DAL{
 
    function getStudents(){
        $sql = "SELECT * FROM `student`";
        $studentTable = $this->fetch($sql);
        $resultArray = $studentTable->fetchAll(PDO::FETCH_ASSOC);
        return $resultArray;
    }
    function getStudent($id) {
        $sql = "SELECT * FROM student WHERE studentId='".$id."'";
        $studentTable = $this->fetch($sql);
        $resultArray = $studentTable->fetchAll(PDO::FETCH_ASSOC);
        return $resultArray;
    }
    function insertStudent($name, $phone, $email, $image ) {
        $sql = 'INSERT INTO `student`( `studentName`, `studentPhone`, `studentEmail`, `studentImage`) 
          VALUES 
          ("'.$name.'","'.$phone.'","'.$email.'","'.$image.'")';
          $insert = $this->set($sql);
          return $insert;
    }
    function updateStudent($id, $name, $phone, $email, $image) { 
        $sql = "UPDATE `student` SET `studentName`='".$name."',`studentPhone`='".$phone."',`studentEmail`='".$email."',`studentImage`='".$image."' WHERE studentId='".$id."'";
        $update = $this->set($sql);
       
    }
    function deleteStudent($var,$id ) {
        $sql = "DELETE FROM `student` WHERE studentId='".$id."'";
        $delete = $this->set($sql);

        $query = "DELETE FROM `courses_students` WHERE ".$var."='".$id."'";
        $del = $this->set($query);
    }

    function getNumOfStudents() {
        $sql = "SELECT count(*) as `total` FROM `student`";
        $studentTable = $this->fetch($sql);
        $resultArray = array ('students' => $studentTable->fetch(PDO::FETCH_ASSOC)['total']);
        return $resultArray;
    }
    
    function getStudent_Courses($id) {
        $courseList = array ();
        
        $sql = "SELECT * FROM courses_students WHERE student_id='".$id."'";
        $studCourses = $this->fetch($sql);
        $courses = $studCourses->fetchAll(PDO::FETCH_ASSOC);

        foreach ($courses as $course) {
            array_push($courseList, $course['course_id']);
        };

        $allCourses = array ();

        for ($i=0; $i<count($courseList); $i++) {        
            $query = "SELECT * FROM course WHERE courseId='".$courseList[$i]."'";
            $showStudCourses = $this->fetch($query);
            $resultArray = $showStudCourses->fetchAll(PDO::FETCH_ASSOC);
            foreach ($resultArray as $course) {
                array_push($allCourses, $course['courseName']);
            }
        };
        
        return $allCourses;
        
    }
    function pre_StudentCourses($id) {
        $courseList = array ();
        
        $sql = "SELECT * FROM courses_students WHERE student_id='".$id."'";
        $studCourses = $this->fetch($sql);
        $courses = $studCourses->fetchAll(PDO::FETCH_ASSOC);

        foreach ($courses as $course) {
            array_push($courseList, $course['course_id']);
        };

        for ($i=0; $i<count($courseList); $i++) {        
            $sql1 = "SELECT * FROM course WHERE courseId='".$courseList[$i]."'";
            $showStudCourses = $this->fetch($sql1);
            $resultArray = $showStudCourses->fetchAll(PDO::FETCH_ASSOC); 
            foreach ($resultArray as $course) {
                echo $course['courseName'] .'<br>';
            }
        };
    }    

    function clearStudent($id) {
        $sql = "DELETE FROM `courses_students` WHERE `student_id`='".$id."'";
        $delete = $this->set($sql);
    } 
   
    function updateStudentCourses($student_id, $course) {
        $sql = "SELECT * FROM `course` WHERE `courseName`='".$course."'";
        $update = $this->fetch($sql);

        $courses = $update->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($courses as $course) {
            $query = "INSERT INTO `courses_students`(`course_id`, `student_id`) VALUES ('".$course['courseId']."','".$student_id."')";
            $do = $this->set($query);
            print_r($do);
        }
    }
    function getCourses(){
        $sql = "SELECT * FROM `course`";
        $courseTable = $this->fetch($sql);
        $resultArray = $courseTable->fetchAll(PDO::FETCH_ASSOC);
        return $resultArray;
    }
    function getCourse($id) {
        $sql = "SELECT * FROM course WHERE courseId='".$id."'";
        $courseTable = $this->fetch($sql);
        $resultArray = $courseTable->fetchAll(PDO::FETCH_ASSOC);
        return $resultArray;
        
    }
    function insertCourse($name, $description, $image) {
       
        $sql = 'INSERT INTO course (`courseName`, `courseDesc`,`courseImage`) 
          VALUES 
          ("'.$name.'","'.$description.'","'.$image.'")';
          $insert = $this->set($sql);
          print_r($insert);
          return $insert;

    }
 
    function updateCourse($id, $name, $description, $image) {
        $sql = "UPDATE `course` SET `courseName`='".$name."',`courseDesc`='".$description."',`courseImage`='".$image."' WHERE courseId='".$id."'";
        $update = $this->set($sql);
      
        
    }
    function deleteCourse($var,$id) {
        $sql = "DELETE FROM `course` WHERE courseId='".$id."'";
        $delete = $this->set($sql);
        
        $query = "DELETE FROM `courses_students` WHERE ".$var."='".$id."'";
        $del = $this->set($query);
    }


    function courseStudentNumber($id) {
        $sql = "SELECT count(*) as total FROM `courses_students` WHERE `course_id`='".$id."'";
        $students = $this->fetch($sql);
        $total = $students->fetch(PDO::FETCH_ASSOC)['total'];
        return $total;
    }
    function getNumOfCourses() {
        $sql = "SELECT count(*) as `total` FROM `course`";
        $courseTable = $this->fetch($sql);
        $resultArray = array ('courses' => $courseTable->fetch(PDO::FETCH_ASSOC)['total']);
        return $resultArray;
    }
    function showCourseStudents($id) {
        $studList = array ();
        
        $sql = "SELECT * FROM courses_students WHERE course_id='".$id."'";
        $c = $this->fetch($sql);
        $students = $c->fetchAll(PDO::FETCH_ASSOC);

        foreach ($students as $student) {
            array_push($studList, $student['student_id']);
        };

        for ($i=0; $i<count($studList); $i++) {        
            $sql1 = "SELECT * FROM student WHERE studentId='".$studList[$i]."'";
            $showStuds = $this->fetch($sql1);
            $resultArray = $showStuds->fetchAll(PDO::FETCH_ASSOC);
            foreach ($resultArray as $student) {
                echo $student['studentName'] .'<br>';
            }
        };
    }


}




?>