<?php
    class Course
    {
        private $name;
        private $course_number;
        private $id;

        function __construct($name, $course_number, $id = null)
        {
            $this->name = $name;
            $this->course_number = $course_number;
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

        function getCourseNumber()
        {
            return $this->course_number;
        }

        function setCourseNumber($new_course_number)
        {
            $this->course_number = $new_course_number;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO courses (name, course_number) VALUES ('{$this->getName()}', '{$this->getCourseNumber()}');");
            $this->id=$GLOBALS['DB']->lastInsertId();

        }

        function update($new_name, $new_course_number)
        {
            $GLOBALS['DB']->exec("UPDATE courses SET name = '{$new_name}', course_number = '{$new_course_number}' WHERE id = {$this->getId()};");
            $this->setName($new_name);
            $this->setCourseNumber($new_course_number);

        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM courses WHERE id = {$this->getId()};");
            $GLOBALS['DB']->exec("DELETE FROM student_courses WHERE course_id = {$this->getId()};");
        }

        static function find($search_id)
        {
            $found_course = null;
            $courses=Course::getAll();
            foreach($courses as $course) {
                $course_id = $course->getId();
                if ($course_id == $search_id) {
                    $found_course = $course;
                }
            }

            return $found_course;
        }

        static function getAll()
        {
            $returned_courses = $GLOBALS['DB']->query("SELECT * FROM courses ORDER BY name;");
            $courses = array();
            foreach($returned_courses as $course)
            {
                $name = $course['name'];
                $course_number = $course['course_number'];
                $id = $course['id'];
                $new_course = new Course($name, $course_number, $id);
                array_push($courses, $new_course);
            }
            return $courses;

        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM courses;");
        }



        function addStudent($student)
        {
            $GLOBALS['DB']->exec("INSERT INTO students_courses (student_id, course_id) VALUES ({$this->getId()}, {$student->getId()});");
        }


        function getStudents()
        {
            $course_id = $this->getId();
            $returned_students = $GLOBALS['DB']->query("SELECT students.* FROM courses JOIN  students_courses ON (courses.id = students_courses.course_id) JOIN students ON(students_courses.student_id = students.id) WHERE courses.id = {$course_id}");

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


    }

 ?>
