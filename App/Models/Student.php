<?php
namespace App\Models;
use App\Core\Database;
use App\Responder\JsonStringOutput;
use App\Responder\XMLStringOutput;

class Student extends Database {

    private $dataFromDB;

    public function getStudentsAndGrades($id){

        $instance = self::getInstance();
        
        $statement = $instance->prepare("SELECT students.id, students.full_name, students.student_school_board, GROUP_CONCAT(student_grades.grade SEPARATOR ',') AS grades, AVG(student_grades.grade) AS grade_avg
        FROM students 
        LEFT JOIN student_grades ON students.id = student_grades.student_id
        WHERE students.id = ? GROUP BY students.id LIMIT 1
        ");
        $statement->execute([$id]);
        $data = $statement->fetch(\PDO::FETCH_OBJ);
        
        if (empty($data)) {
            die('User with choosen id doen\'t exits in database');
        }

        $this->dataFromDB = $data;

        return $this;
    }

    public function makeStatistic(){
        switch($this->dataFromDB->student_school_board){
            case '1':
                return $this->statisticCSM();
            case '2':
                return $this->statisticCSMB();
        }
    }

    private function statisticCSM(){
        if($this->dataFromDB->grade_avg >= '7.0000'){
            $this->dataFromDB->final_result = 'Pass';
        } else {
            $this->dataFromDB->final_result = 'Fail';
        }

        $arrayForJson = (array)$this->dataFromDB;
        unset($arrayForJson['student_school_board']);

        return (new JsonStringOutput)->load($arrayForJson);

    }

    private function statisticCSMB(){
        $grades = \explode(',',$this->dataFromDB->grades);
        $biggest_grade = max($grades);

        if(count($grades) > 2 && $biggest_grade > 8){
            $this->dataFromDB->final_result = 'Pass';
        } else {
            $this->dataFromDB->final_result = 'Fail';
        }

        $arrayForJson = (array)$this->dataFromDB;
        unset($arrayForJson['student_school_board']);

        return (new XMLStringOutput)->load($arrayForJson);

    }
}
?>