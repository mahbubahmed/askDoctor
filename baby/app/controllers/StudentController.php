<?php

class StudentController extends BaseController {
    
    public function getStudent(){
        
        $students = Student::all();
        
        foreach ($students as $student) {
            echo $student->student_name ."<br>"; 
        }
    }
    
}
