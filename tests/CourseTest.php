<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Course.php";

    $server = 'mysql:host=localhost; dbname=registrar_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class CourseTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Course::deleteAll();
        }

        function testGetName()
        {
            $name = "History";
            $course_number = "HIST100";
            $test_course = new Course($name, $course_number);

            $result = $test_course->getName();
            $this->assertEquals($name, $result);
        }

        function testGetCourseNumber()
        {
            $name = "History";
            $course_number = "HIST100";
            $test_course = new Course($name, $course_number);

            $result = $test_course->getCourseNumber();
            $this->assertEquals($course_number, $result);
        }

        function testGetId()
        {
            $name = "History";
            $course_number = "HIST100";
            $test_course = new Course($name, $course_number);

            $result = $test_course->getId();
            $this->assertEquals(null, $result);
        }


    }
