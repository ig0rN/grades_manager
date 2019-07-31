<?php
namespace App\Models;
use App\Core\Database;

class Student extends Database {


        public static function getStudentsAndGrades($id){

            $instance = self::getInstance();
            
            $statement = $instance->prepare("SELECT students.id,students.full_name, GROUP_CONCAT(student_grades.grade SEPARATOR ',') AS grades, AVG(student_grades.grade) AS grade_avg
            FROM students 
            LEFT JOIN student_grades ON students.id = student_grades.student_id
            WHERE students.id = ? GROUP BY students.id LIMIT 1
            ");
            $statement->execute([$id]);
            $data = $statement->fetchAll(\PDO::FETCH_OBJ);
            dd($data);
            if (!count($data)) {
                die('User with choosen id doen\'t exits in database');
            }
        }
}
?>