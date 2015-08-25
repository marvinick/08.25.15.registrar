<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Student.php";
    require_once "src/Courses.php";

    $server = 'mysql:host=localhost; dbname=registrar_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StudentTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Student::deleteAll();
        }

        function testGetName()
        {
            $name = "Bob";
            $enrollment_date = "2015-01-01";
            $test_student = new Student($name, $enrollment_date);

            $result = $test_student->getName();

            $this->assertEquals($name, $result);
        }

        function testGetEnrollmentDate()
        {
            $name = "Bob";
            $enrollment_date = "2015-01-01";
            $test_student = new Student($name, $enrollment_date);

            $result = $test_student->getEnrollmentDate();

            $this->assertEquals($enrollment_date, $result);
        }

        function testGetId()
        {
            $name = "Bob";
            $enrollment_date = "2015-01-01";
            $id = 1;
            $test_student = new Student($name, $enrollment_date, $id);

            $result = $test_student->getId();

            $this->assertEquals($id, $result);
        }

        function testSave()
        {
            $name = "Bob";
            $enrollment_date = "2015-01-01";
            $test_student = new Student($name, $enrollment_date);
            $test_student->save();

            $result = Student::getAll();

            $this->assertEquals($test_student, $result[0]);
        }

        function testGetAll()
        {
            $name = "Bob";
            $enrollment_date = "2015-01-01";
            $test_student = new Student($name, $enrollment_date);
            $test_student->save();

            $name2 = "Kevin";
            $enrollment_date2 = "2015-02-01";
            $test_student2 = new Student($name, $enrollment_date);
            $test_student2->save();

            $result = Student::getAll();

            $this->assertEquals([$test_student, $test_student2], $result);
        }

        function testFind()
        {
            $name = "Bob";
            $enrollment_date = "2015-01-01";
            $test_student = new Student($name, $enrollment_date);
            $test_student->save();

            $name2 = "Kevin";
            $enrollment_date2 = "2015-02-01";
            $test_student2 = new Student($name, $enrollment_date);
            $test_student2->save();

            $result = Student::find($test_student->getId());

            $this->assertEquals($test_student, $result);
        }

        function testUpdate()
        {
            $name = "Bob";
            $enrollment_date = "2015-01-01";
            $test_student = new Student($name, $enrollment_date);
            $test_student->save();

            $new_name = "Kevin";

            $test_student->update($new_name, $enrollment_date);

            $this->assertEquals("Kevin", $test_student->getName());
        }

        function testDelete()
        {
            $name = "Bob";
            $enrollment_date = "2015-01-01";
            $test_student = new Student($name, $enrollment_date);
            $test_student->save();

            $name2 = "Kevin";
            $enrollment_date2 = "2015-02-01";
            $test_student2 = new Student($name, $enrollment_date);
            $test_student2->save();

            $test_student->delete();

            $this->assertEquals([$test_student2], Student::getAll());

        }

        //UNTESTED
        function testAddCourse()
        {
            $name = "Bob";
            $enrollment_date = "2015-01-01";
            $test_student = new Student($name, $enrollment_date);
            $test_student->save();

            $course_name = "History";
            $course_number = "HIST100";
            $test_course = new Course($course_name, $course_number);
            $test_course->save();

            $test_student->addCourse($test_course);

            $this->assertEquals($test_student->getCourses(), [$test_course]);
        }
    }























?>
