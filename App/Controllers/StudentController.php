<?php
namespace App\Controllers;
use App\Models\Student;

class StudentController {

    public function index($user = null) {

        if(!is_numeric($user)) {
            die('you didnt enter valid number');
        }
        $student = new Student();
        $student = $student->getStudentsAndGrades($user);
\dd($student->makeStatistic());
        return $student->makeStatistic();
    }
}