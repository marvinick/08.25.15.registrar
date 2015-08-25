<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Course.php";
    require_once "src/Student.php";

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

        function testSave()
        {
            $name = "History";
            $course_number = "HIST100";
            $test_course = new Course($name, $course_number);
            $test_course->save();

            $result = Course::getAll();

            $this->assertEquals($test_course, $result[0]);

        }

        function testGetAll()
        {
            $name = "History";
            $course_number = "HIST100";
            $test_course = new Course($name, $course_number);
            $test_course->save();

            $name2 = "Math";
            $course_number2 = "MATH100";
            $test_course2 = new Course($name, $course_number);
            $test_course2->save();

            $result = Course::getAll();

            $this->assertEquals([$test_course, $test_course2], $result);


        }

        function testFind()
        {
            $name = "History";
            $course_number = "HIST100";
            $test_course = new Course($name, $course_number);
            $test_course->save();

            $name2 = "Math";
            $course_number2 = "MATH100";
            $test_course2 = new Course($name, $course_number);
            $test_course2->save();

            $result = Course::find($test_course->getId());

            $this->assertEquals($test_course, $result);

        }

        function testUpdate()
        {
            $name = "History";
            $course_number = "HIST100";
            $test_course = new Course($name, $course_number);
            $test_course->save();

            $new_name = "Home Economics";

            $test_course->update($new_name, $course_number);

            $this->assertEquals($new_name, $test_course->getName());

        }

        function testDelete()
        {
            $name = "History";
            $course_number = "HIST100";
            $test_course = new Course($name, $course_number);
            $test_course->save();

            $name2 = "Math";
            $course_number2 = "MATH100";
            $test_course2 = new Course($name, $course_number);
            $test_course2->save();

            $test_course->delete();

            $this->assertEquals([$test_course2], Course::getAll());

        }


    }
