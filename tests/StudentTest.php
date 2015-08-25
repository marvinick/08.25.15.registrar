<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Student.php";

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
    }

?>
