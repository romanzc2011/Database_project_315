use HW4;
##################################### STUDENT
CREATE TABLE student (
StudentID INT NOT NULL ,
StudentName VARCHAR(100),
PRIMARY KEY(StudentID)
);
desc student;

##################################### 


INSERT INTO student(StudentName)
VALUES
('jameson');
##################################### FACULTY
CREATE TABLE faculty (
	FacultyID INT NOT NULL,
    FacultyName VARCHAR(100),
    primary key(FacultyID)
);

INSERT INTO faculty
(FacultyID, FacultyName)
VALUES
(2143, 'Birkin');

##################################### QUALIFIED
CREATE TABLE qualified (
	FacultyID INT,
    CourseID INT,
    DateQualified DATE,
    PRIMARY KEY (FacultyID, CourseID),
    FOREIGN KEY (CourseID) REFERENCES course(CourseID),
    FOREIGN KEY (FacultyID) REFERENCES faculty(FacultyID));
drop table qualified;
    ##################################### COURSE
CREATE TABLE course (
	CourseID INT NOT NULL,
    CourseName VARCHAR(100),
    PRIMARY KEY(CourseID));
drop table course;

INSERT INTO course (CourseID, CourseName)
VALUES
(1, 'Syst Analysis');
##################################### SECTION
CREATE TABLE section (
	SectionNo  INT NOT NULL,
    Semester VARCHAR(100),
    CourseID INT,
    PRIMARY KEY (SectionNo,Semester,CourseID),
    FOREIGN KEY(CourseID) REFERENCES course(CourseID));
##################################### REGISTRATION
CREATE TABLE registration (
	StudentID INT,
	SectionNo INT,
	Semester VARCHAR(100),
	PRIMARY KEY(StudentID, SectionNo, Semester),
    FOREIGN KEY(SectionNo) REFERENCES section(SectionNo)
	);
    ALTER TABLE registration ADD FOREIGN KEY(Semester) REFERENCES section(Semester);
    ALTER TABLE registration ADD FOREIGN KEY(SectionNo) REFERENCES section(SectionNo);

desc student;
desc
    