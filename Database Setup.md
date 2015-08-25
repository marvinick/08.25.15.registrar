How to set up database from scratch

Start MySQL with:
> mysql.server start
> mysql -uroot -proot

Inside MySQL:
> CREATE DATABASE registrar;
> USE registrar;
> CREATE TABLE students (name VARCHAR(255), enrollment_date date, id serial PRIMARY KEY);
> CREATE TABLE courses (name VARCHAR(255), course_number VARCHAR(255), id serial PRIMARY KEY);
> CREATE TABLE students_courses (student_id int, course_id int, id serial PRIMARY KEY);
