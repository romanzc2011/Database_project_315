<?php session_start(); ?>
<?php require($_SERVER['DOCUMENT_ROOT'] . '/csc315_final_project/controller/student_controller/student_processor.php'); ?>

<style>
    <?php require($_SERVER['DOCUMENT_ROOT'].'/csc315_final_project/css/stylesheet.css'); ?>
</style>

<!doctype html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href='http://fonts.googleapis.com/css?family=Play:400,700' rel='stylesheet' type='text/css'>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.js"
            integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <title>CSC 315 FINAL PROJECT ROMAN-CONNOR</title>
</head>
<body style="background-color:  #461D7C" ;>
<form id="student_form">
    <div class="container-fluid" id="cover_page">
        <!-- SEARCH BAR ROW ################################################################## -->
        <div class="row between-xs" id="index_header">
            <!-- HEADER ################################################################## -->
            <div class="col-sm-11 m-4 d-grid gap-4 rcorner-sm border-success lt-purple">
                <div class="col-sm-12">
                        <span class="lg-font bf-left">
                            University Registration System
                        </span>
                    <span class="input-rt">STUDENT ID:<input style="border-radius: 0.5em;" type="text" name="studentID"
                                                               id="studentID" class="input-rt">
                    </span>
                </div>
            </div>
        </div>
        <!-- ROW ############################################################################## -->
        <div class="row between-xs">
            <!-- COL -  ##################################################################### -->
            <div class="col-sm-3 d-grid gap-3 p-4 height">
                <div class="col-sm-3" style="line-height:0;padding:0;font-weight:bolder;color: gold;">CONTROLS</div>

                <!-- SHOW ALL STUDENTS ############################################################################## -->
                <button class="button btn-warning height" type="submit" id="view_all_students">
                    <span style="font-size: 15px; font-weight: bold">VIEW ALL STUDENTS</span>
                </button>
                <!-- FIND STUDENT ############################################################################## -->
                <button class="button btn-warning height" type="submit" id="find_student" name="find_student">
                    <span style="font-size: 15px; font-weight: bold">FIND STUDENT</span>
                </button>

                <!-- ADD STUDENT TABLE ############################################################################## -->
                <button class="button btn-warning height" type="submit" id="insert_request" name="insert_request">
                    <span style="font-size: 15px; font-weight: bold">ADD STUDENT</span>
                </button>

                <!-- UPDATE STUDENT TABLE ############################################################################## -->
                <button class="button btn-warning btn-primary-spacing height" type="submit" id="student_update">
                    <span style="font-size: 15px; font-weight: bold">UPDATE STUDENT</span>
                </button>

                <!-- DELETE STUDENT TABLE ############################################################################## -->
                <button class="button btn-warning btn-primary-spacing height" id="delete_request"
                        name="delete_request">
                    <span style="font-size: 15px; font-weight: bold">DELETE STUDENT</span>
                </button>

                <br><div class="col-sm-3" style="line-height:0;padding:0;font-weight:bolder;color: gold;">NAVIGATION</div>
                <!-- VIEW GRADES BUTTON ############################################################ -->
                <button class="button btn-warning btn-primary-spacing height" type="submit" id="view_grades"
                        name="view_grades">
                    <span style="font-size: 15px; font-weight: bold">GRADES</span>
                </button>
                <!-- ############################################################################################################-->

                <!-- VIEW COURSE BUTTONS ############################################################ -->
                <button class="button btn-warning btn-primary-spacing height" type="submit" id="view_course"
                        name="view_course">
                    <span style="font-size: 15px; font-weight: bold">COURSES</span>
                </button>

                <!-- DEPARTMENT BUTTON ############################################################ -->
                <button class="button btn-warning btn-primary-spacing height" type="submit" id="view_department"
                        name="view_department">
                    <span style="font-size: 15px; font-weight: bold">DEPARTMENTS</span>
                </button>

                <!-- VIEW INSTRUCTORS PAGE ############################################################################## -->
                <button class="button btn-warning height" type="submit" id="instructors_page" name="instructors_page">
                    <span style="font-size: 15px; font-weight: bold">INSTRUCTORS</span>
                </button>

                <!-- VIEW FINANCIAL AID ############################################################ -->
                <button class="button btn-warning btn-primary-spacing height" type="submit" id="view_financial_aid"
                        name="view_financial_aid">
                    <span style="font-size: 15px; font-weight: bold">FINANCIAL AID</span>
                </button>

                <!-- VIEW FINANCIAL AID ############################################################ -->
                <button class="button btn-warning btn-primary-spacing height" type="submit" id="view_semester"
                        name="view_semester">
                    <span style="font-size: 15px; font-weight: bold">SEMESTERS</span>
                </button>
            </div>
            <!-- INPUT BOX COL ############################################################################## -->

            <div class="col-sm-7 rcorner" id="index_div">
                <!-- STUDENT ID ############################################################################## -->
                <div class="row gap-4 mt-4">
                    <div class="col-sm-2 fw-bold">STUDENT ID:</div>
                    <div class="col-sm-6"><input id="student_id" class="resp-text" type="text" disabled="disabled">
                    </div>
                </div>

                <!-- SSN ############################################################################## -->
                <div class="row gap-4 mt-4">
                    <div class="col-sm-2 fw-bold">SSN:</div>
                    <div class="col-sm-6"><input id="ssn" class="resp-text" type="text">
                    </div>
                </div>
                <!-- FIRST NAME ############################################################################## -->

                <div class="row gap-4 mt-4">
                    <div class="col-sm-2 fw-bold">FIRST NAME:</div>
                    <div class="col-sm-6"><input id="firstName" name="firstName" value="" class="resp-text" type="text">
                    </div>
                </div>

                <!-- LAST NAME ############################################################################## -->
                <div class="row gap-4 mt-4">
                    <div class="col-sm-2 fw-bolder">LAST NAME:</div>
                    <div class="col-sm-6"><input id="lastName" name="lastName" class="resp-text" type="text"></div>
                </div>

                <!-- AGE ############################################################################## -->
                <div class="row gap-4 mt-4">
                    <div class="col-sm-2 fw-bold">AGE:</div>
                    <div class="col-sm-6"><input id="age" name="age" class="resp-text" type="text"></div>
                </div>

                <!-- ADDRESS ############################################################################## -->
                <div class="row gap-4 mt-4">
                    <div class="col-sm-2 fw-bold">ADDRESS:</div>
                    <div class="col-sm-6"><input id="address" name="address" class="resp-text" type="text"></div>
                </div>

                <!-- BIRTH_DATE ############################################################################## -->
                <div class="row gap-4 mt-4">
                    <div class="col-sm-2 fw-bold">BIRTHDATE:</div>
                    <div class="col-sm-6"><input id="birth_date" class="resp-text" type="text"></div>
                </div>

                <!-- EMAIL ############################################################################## -->
                <div class="row gap-4 mt-4">
                    <div class="col-sm-2 fw-bold">EMAIL:</div>
                    <div class="col-sm-6"><input id="email" name="email" class="resp-text" type="text"></div>
                </div>

                <!-- MAJOR ############################################################################## -->
                <div class="row gap-4 mt-4">
                    <div class="col-sm-2 fw-bold">MAJOR:</div>
                    <div class="col-sm-6"><input id="major" name="major" class="resp-text" type="text"></div>
                </div>

            </div>
        </div>
        <!-- ROW ############################################################################## -->
    </div>
    <img src="../../img/lsus-logo.png" style="position:absolute;bottom:-125px;left:100px;z-index:1" height="120" />
    <script><?php require($_SERVER['DOCUMENT_ROOT'] . '/csc315_final_project/js/student_page.js'); ?></script>
</form>
</body>
</html>

