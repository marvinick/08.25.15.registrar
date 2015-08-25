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

        function setName($new_name)
        {
            $this->name = $new_name;
        }

        function getEnrollmentDate()
        {
            return $this->enrollment_date;
        }

        function setEnrollmentDate($new_enrollment_date)
        {
            $this->enrollment_date = $new_enrollment_date;
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

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM students WHERE id = {$this->getId()};");
        }

        //Will update both name and enrollment date at the same time.  If just updating name, send the current enrollment date to the function as $new_enrollment_date
        function update($new_name, $new_enrollment_date)
        {
            $GLOBALS['DB']->exec("UPDATE students SET name = '{$new_name}', enrollment_date = '{$new_enrollment_date}' WHERE id = {$this->getId()};");
            $this->setName($new_name);
            $this->setEnrollmentDate($new_enrollment_date);
        }

        //NOT TESTED YET
        function addCourse($course)
        {
            $GLOBALS['DB']->exec("INSERT INTO students_courses (student_id, course_id) VALUES ({$this->getId()}, {$course->getId()});");
        }

        //INCOMPLETE, UNTESTED
        function getCourses($student_id)
        {
            $courses = $GLOBALS['DB']->query("SELECT courses.* FROM
                    students JOIN students_courses ON (students.id = students_courses.student_id)
                            JOIN courses ON (students_courses.course_id = courses.id)
                            WHERE students.id = {$student_id}");

        }

        static function find($search_id)
        {
            $found_student = null;
            $students = Student::getAll();
            foreach($students as $student) {
                $student_id = $student->getId();
                if ($student_id == $search_id) {
                    $found_student = $student;
                }
            }
            return $found_student;
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
