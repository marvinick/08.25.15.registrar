<?php
    class Student
    {
        private $name;
        private $enrollment_date;
        private $id;

        function __construct($name, $enrollment_date, $id=null)
        {
            $this->name = $name;
            $this->enrollment_date = $enrollment_date;
            $this->id = $id;
        }

        function getName()
        {
            return $this->name;
        }

        function getEnrollmentDate()
        {
            return $this->enrollment_date;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO students (name, enrollment_date) VALUES ('{$this->getName()}', '{$this->getEnrollmentDate()}');");
            $this->id=$GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_students = $GLOBALS['DB']->query("SELECT * FROM students ORDER BY name;");
            $students = array();
            foreach($returned_students as $student)
            {
                $name = $student['name'];
                $enrollment_date = $student['enrollment_date'];
                $id = $student['id'];
                $new_student = new Student($name, $enrollment_date, $id);
                array_push($students, $new_student);
            }
            return $students;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM students;");
        }
    }



?>
