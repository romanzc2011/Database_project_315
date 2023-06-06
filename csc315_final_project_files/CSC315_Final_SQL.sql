
CREATE DATABASE university;
use university;
use HW4;
desc add_student_to_course;
desc course;
desc department;

desc financial_aid;
ALTER TABLE financial_aid DROP COLUMN Student_id;
DROP TABLE financial_aid;

desc instructor;
desc semester;
desc semester_has_course;
desc student;
desc student_course_grades;
desc student_has_financial_aid;
desc student_has_semester;

SELECT * FROM student;
SELECT * FROM course;
SELECT * FROM financial_aid;
desc financial_aid;
CREATE TABLE student (
Student_id INT NOT NULL,
SSN VARCHAR(100) NOT NULL,
First_name VARCHAR(50),
Last_name VARCHAR(50),
Age INT,
Address VARCHAR(50),
Email VARCHAR(50),
Major VARCHAR(50),
GPA REAL,
PRIMARY KEY(Student_id),
UNIQUE (SSN)
);
ALTER TABLE student ADD UNIQUE(SSN);
ALTER TABLE student ADD GPA REAL;
SELECT * FROM student;
use university;
desc student;

SELECT s.Student_id, s.SSN, shfa.Finaid_id, f.Aid_Amount, s.First_name, s.Last_name, s.Age, s.Address, s.Birth_date, s.Email, s.Major, s.GPA
                FROM financial_aid f
                INNER JOIN student_has_financial_aid shfa ON shfa.Finaid_id = f.Finaid_id
                INNER JOIN student s ON shfa.Student_id = s.Student_id
                WHERE 1=1
                AND s.Student_id = 100;

SELECT s.Student_id, s.SSN, s.First_name, s.Last_name, s.Age, s.Address, s.Birth_date, s.Email, s.Major, s.GPA,
       fa.Aid_Amount
FROM student s
INNER JOIN financial_aid fa on s.Student_id = fa.Student_id
WHERE fa.Student_id = 100;

SELECT Birth_date FROM student;
desc student_has_financial_aid;
select * from student_has_financial_aid;
##################################### STUDENT

CREATE TABLE financial_aid (
Finaid_id INT NOT NULL AUTO_INCREMENT,
Aid_Amount VARCHAR(50),
Aid_Source VARCHAR(100),
Student_id INT,
SSN VARCHAR(100),
PRIMARY KEY(Finaid_id),
FOREIGN KEY(Student_id) REFERENCES student(Student_id) ON DELETE CASCADE ON UPDATE CASCADE,
FOREIGN KEY(SSN) REFERENCES student(SSN) ON DELETE CASCADE ON UPDATE CASCADE
);

ALTER TABLE financial_aid AUTO_INCREMENT = 100;
SET FOREIGN_KEY_CHECKS = 1;
DROP TABLE financial_aid;
select * from financial_aid;
##################################### COURSE DDL 
CREATE TABLE course (
Course_id INT NOT NULL AUTO_INCREMENT,
Title VARCHAR(50),
Credits INT,
Instructor_id INT,
Instructor_Lastname VARCHAR(100),
PRIMARY KEY(Course_id)
);

ALTER TABLE course
ADD FOREIGN KEY(Instructor_id) REFERENCES instructor(Instructor_id) ON DELETE CASCADE ON UPDATE CASCADE;

DROP TABLE course;
##################################### INSTRUCTOR 
SET FOREIGN_KEY_CHECKS = 1;

CREATE TABLE instructor (
Instructor_id INT NOT NULL AUTO_INCREMENT,
First_name VARCHAR(50),
Last_name VARCHAR(50),
Instructor_rank VARCHAR(50),
Office VARCHAR(50),
Department_name VARCHAR(100),
Faculty_id INT,
PRIMARY KEY(Instructor_id)
);

ALTER TABLE instructor AUTO_INCREMENT = 100;

ALTER TABLE instructor
ADD FOREIGN KEY(Faculty_id) REFERENCES department(Faculty_id) ON UPDATE CASCADE;

INSERT INTO instructor (
First_name, Last_name, Instructor_rank, Office)
VALUES
( 'RICHARD', 'WATSON', 'DEAN OF COMPUTER SCIENCE', 'ROOM 200');
## INSERT instructor then Add instructor to appropriate department, update the instructor's faculty_id and department name'

UPDATE instructor SET Faculty_id = 1
WHERE Instructor_id = 100;

SELECT * FROM instructor;

DELETE FROM instructor WHERE Instructor_id = 1;

SELECT i.Instructor_id, i.First_name, i.Last_name, i.Instructor_rank, i.Office, d.Department_name
FROM instructor i
INNER JOIN department d ON d.Faculty_id = i.Faculty_id
WHERE 1=1
AND d.Instructor_id = 100;

DROP TABLE instructor;
##################################### DEPARTMENT 
desc department;
SET FOREIGN_KEY_CHECKS = 1;

CREATE TABLE department (
Faculty_id INT NOT NULL AUTO_INCREMENT,
Department_id INT,
Department_name VARCHAR(50),
Instructor_id INT,
Instructor_Lastname VARCHAR(100),
PRIMARY KEY(Faculty_id),
FOREIGN KEY(Instructor_id) REFERENCES instructor(Instructor_id) ON DELETE CASCADE ON UPDATE CASCADE
);

INSERT INTO department 
(Department_id, Department_name, Instructor_id, Instructor_Lastname)
VALUES
(10, 'COMPUTER SCIENCE', 101, (SELECT Last_name FROM instructor WHERE Instructor_id = 101));

ALTER TABLE department DROP INDEX Department_id;

SELECT d.Faculty_id, d.Department_id, d.Department_name, d.Instructor_id, i.Last_name
FROM department d
INNER JOIN instructor i ON i.Instructor_id = d.Instructor_id
WHERE d.Faculty_id = 1;

SELECT * FROM department;

SELECT * FROM department WHERE Faculty_id = 1;

DELETE FROM department WHERE Faculty_id IN (37,38);
desc department;

DROP TABLE department;
##################################### SEMESTER 
CREATE TABLE semester (
Semester_id INT,
Semester_startdate DATE,
Semester_enddate DATE,
PRIMARY KEY(Semester_id)
);

ALTER TABLE student
ADD COLUMN Finaid_id INT,
ADD FOREIGN KEY(Finaid_id) REFERENCES financial_aid(Finaid_id);

ALTER TABLE course
ADD COLUMN Instructor_id INT,
ADD FOREIGN KEY(Instructor_id) REFERENCES instructor(Instructor_id);

ALTER TABLE instructor
ADD COLUMN Department_id INT,
ADD FOREIGN KEY(Department_id) REFERENCES department(Department_id);

CREATE TABLE student_has_course (
Student_id INT,
Course_id INT,
Grade VARCHAR(10),
PRIMARY KEY(Student_id, Course_id),
FOREIGN KEY(Student_id) REFERENCES student(Student_id),
FOREIGN KEY(Course_id) REFERENCES course(Course_id)
);

CREATE TABLE student_has_semester (
Student_id INT,
Semester_id INT,
PRIMARY KEY(Student_id, Semester_id),
FOREIGN KEY(Student_id) REFERENCES student(Student_id),
FOREIGN KEY(Semester_id) REFERENCES semester(Semester_id)
);

CREATE TABLE semester_has_course (
Semester_id INT,
Course_id INT,
PRIMARY KEY(Semester_id, Course_id),
FOREIGN KEY(Semester_id) REFERENCES semester(Semester_id),
FOREIGN KEY(Course_id) REFERENCES course(Course_id)
);

CREATE TABLE financial_aid (
Finaid_id INT NOT NULL auto_increment,
Award_name VARCHAR(150),
Award_amount Decimal(19,4),
Student_id INT,
PRIMARY KEY(Finaid_id),
FOREIGN KEY(Student_id) REFERENCES student(Student_id));

################# COURSE TABLE #########################################
ALTER TABLE course RENAME COLUMN Title TO Course_name;
ALTER TABLE course CHANGE Course_id Course_id VARCHAR(20);
INSERT INTO course (
Course_id, Course_name, Credits)
VALUES
(315, 'INTRO TO DATABASE', 3);

SELECT * FROM course;

SELECT Course_name, Credits
FROM course
INNER JOIN instructor ON course.Instructor_id = instructor.Instructor_id;

SELECT * FROM course
WHERE 1=1
AND Course_id = 315;

SELECT * FROM course WHERE Course_id = 315;
UPDATE course SET Instructor_id = 100 WHERE Course_id = 315;

UPDATE course SET Instructor_Lastname = (SELECT Last_name FROM instructor WHERE Instructor_id = 100)
WHERE 1=1
AND Course_id = 315;

ALTER TABLE course ADD COLUMN Instructor_Lastname varchar(50);

SELECT * fROm student;
SELECT * FROM course;
SELECT * FROM course WHERE Course_id = 382;
DELETE FROM course WHERE Course_id =382;

UPDATE course SET Instructor_Lastname = (SELECT Last_name FROM instructor WHERE Instructor_id = 101) 
WHERE 1=1
AND Course_id = 345;

SELECT Last_name
FROM instructor i
INNER JOIN course c ON i.Instructor_id = c.Instructor_id
WHERE 1=1
AND c.Course_id = 315;

INSERT INTO course (Course_id, Course_name, Credits, Instructor_id, Instructor_Lastname)
VALUES (345, 'DATA STRUCTURES', 3,
	(SELECT Instructor_id FROM instructor WHERE Instructor_id = 101),
    (SELECT Last_name FROM instructor WHERE Instructor_id = 101));

################# INSTRUCTOR TABLE #########################################
SET FOREIGN_KEY_CHECKS = 0;
desc instructor;
DROP TABLE instructor;

DELETE FROM instructor WHERE Instructor_id = 198;
INSERT INTO instructor (
Instructor_id, First_name, Last_name, Instructor_rank, Office)
VALUES
(103, 'MARJAN', 'TRUTSCHL', 'PROFESSOR', 'ROOM 210');

ALTER TABLE instructor
ADD COLUMN Office VARCHAR(100);

DELETE FROM instructor WHERE Instructor_id BETWEEN 171 AND 196;

SELECT * FROM instructor;

DELETE FROM instructor WHERE Instructor_id = 100;
UPDATE instructor SET First_name = 'MARJAN', Last_name = 'TRUTSCHL', Instructor_rank = 'PROFESSOR' WHERE Instructor_id = 102;

SELECT i.Instructor_id, i.First_name, i.Last_name, i.Instructor_rank, d.Department_name
FROM instructor i
INNER JOIN department d ON d.Instructor_Lastname = i.Last_name
WHERE 1=1
AND i.Instructor_id = 100;

ALTER TABLE instructor
DROP INDEX Last_name;

################# STUDENT_COURSE_GRADE TABLE #########################################
SELECT * FROM student_course_grades;
SELECT * FROM student_course_grades WHERE Student_id = 100;
INSERT INTO student_course_grades (Student_id, Course_id, Grade, Course_name, Student_Lastname)
VALUES (
(SELECT Student_id FROM student WHERE Student_id = 101),
(SELECT Course_id FROM course WHERE Course_id = 345),
'A', (SELECT Course_name FROM course WHERE Course_id = 345),
(SELECT Last_name FROM student WHERE Student_id = 101)
);

ALTER TABLE student_course_grades MODIFY Course_name VARCHAR(60);

ALTER TABLE student_course_grades
ADD FOREIGN KEY(Student_id) REFERENCES student(Student_id),
ADD FOREIGN KEY(Course_id) REFERENCES course(Course_id);

desc student_course_grades;

SELECT scg.Student_id, c.Course_id, Grade, c.Course_name, s.Last_name
FROM student_course_grades scg
INNER JOIN course c ON c.Course_id = scg.Course_id
INNER JOIN student s ON s.Student_id = scg.Student_id
WHERE 1=1
AND scg.Student_id = 100;

################# DEPARTMENT TABLE #########################################
desc department;
DROP TABLE department;
SET FOREIGN_KEY_CHECKS = 0;
DELETE FROM department WHERE Faculty_id = 2;

SELECT * FROM department;
SELECT * FROM instructor;
UPDATE instructor SET Last_name = 'CAMP' WHERE Instructor_id = 180;
select * from instructor;
ALTER TABLE department
ADD FOREIGN KEY(Instructor_Lastname) REFERENCES instructor(Last_name);

ALTER TABLE department MODIFY Faculty_id INT AUTO_INCREMENT;

################# STUDENT TABLE #########################################
desc student;
ALTER TABLE student
ADD COLUMN Aid_amount Decimal(19,4);

ALTER TABLE student
DROP COLUMN Zip;

ALTER TABLE student
ADD COLUMN Zip INT;

SELECT s.Student_id, s.Firstn_name, s.Last_name, s.Age, s.Address, s.Email, s.Major, s.Birth_date, f.Award_amount
FROM student s
INNER JOIN financial_id f ON ;
################# FINANCIAL AID TABLE #########################################
desc financial_aid;

SET FOREIGN_KEY_CHECKS = 1;

ALTER TABLE financial_aid
ADD Finaid_id INT NOT NULL AUTO_INCREMENT;

ALTER TABLE financial_aid
RENAME COLUMN Award_amount TO Aid_amount;

##################################### GRADES
SELECT * FROM student_course_grades;

CREATE TABLE add_student_to_course (
    Student_id INT,
    Course_id INT,
    PRIMARY KEY (Student_id, Course_id),
    FOREIGN KEY (Student_id) REFERENCES student(Student_id) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (Course_id) REFERENCES course(Course_id) ON UPDATE CASCADE ON DELETE CASCADE
);

desc course;
ALTER TABLE student_course_grades ADD COLUMN GPA REAL;

INSERT INTO add_student_to_course (Student_id, Course_id) VALUES (100, 392);

select * from add_student_to_course;
SELECT * FROM student;
SELECT * FROM course;
set foreign_key_checks = 1;
drop table add_student_to_course;