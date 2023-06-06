<style>
    <?php require($_SERVER['DOCUMENT_ROOT'].'/csc315_final_project/css/stylesheet.css'); ?>
</style>

<?php
session_start();
require($_SERVER['DOCUMENT_ROOT'] . '/csc315_final_project/controller/raspberry_mysql_connection.php');
$money_fmt = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
###############################################################################################
if (isset($_GET['student_id'])) {
    $student_id = $_GET['student_id'];
}

switch ($_GET['mode']) {
    case 'select':

        $sql = "SELECT shfa.Student_id, s.SSN, shfa.Finaid_id, f.Aid_Amount, s.First_name, s.Last_name, s.Age, s.Address, s.Birth_date, s.Email, s.Major
                FROM financial_aid f
                INNER JOIN student_has_financial_aid shfa ON shfa.Finaid_id = f.Finaid_id
                INNER JOIN student s ON shfa.Student_id = s.Student_id
                WHERE 1=1
                AND s.Student_id = " . $student_id;
        $data = SelectMySQL($sql);

        $sql = "SELECT SUM(Aid_Amount) FROM financial_aid WHERE Student_id = " . $student_id;
        $total = SelectMySQL($sql);

        break;
}
?>

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
    <script type="text/javascript" charset="utf8"
            src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <title>CSC 315 Final Project Roman-Connor</title>
</head>
<form id="add_to_course_form">
    <body style="background-color:  #461D7C" ;>
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

        <div class="row between-xs">
            <!-- COL -  ##################################################################### -->
            <div class="col-sm-3 d-grid gap-3 p-4 height">
                <!-- ADD TO COURSE ############################################################ -->
                <div class="col-sm-3" style="line-height:0;padding:0;font-weight:bolder;color: gold;">CONTROLS</div>
                <button class="button btn-warning btn-primary-spacing height" type="submit" id="student_add_to">
                    <span style="font-size: 15px; font-weight: bold">ADD STUDENT TO COURSE</span>
                </button>

                <!-- VIEW SCHEDULE ############################################################ -->
                <button class="button btn-warning btn-primary-spacing height" type="submit" id="view_schedule">
                    <span style="font-size: 15px; font-weight: bold">VIEW SCHEDULE</span>
                </button>

                <!-- DELETE FROM COURSE ############################################################ -->
                <button class="button btn-warning btn-primary-spacing height" type="submit" id="student_delete_from">
                    <span style="font-size: 15px; font-weight: bold">DELETE STUDENT FROM COURSE</span>
                </button>


                <!-- BACK ############################################################ -->
                <br>
                <div class="col-sm-3" style="line-height:0;padding:0;font-weight:bolder;color: gold;">NAVIGATION</div>
                <button class="button btn-warning btn-primary-spacing height" type="submit" id="back_to_course">
                    <span style="font-size: 15px; font-weight: bold">BACK</span>
                </button>

            </div>
            <div class="col-sm-7 rcorner" id="index_div">
                <!-- STUDENT ID ############################################################################## -->
                <div class="row gap-4 mt-4">
                    <div class="col-sm-2 fw-bold">STUDENT ID:</div>
                    <div class="col-sm-6"><input id="student_id" class="resp-text" type="text">
                    </div>
                </div>

                <!-- COURSE ID ############################################################################## -->

                <div class="row gap-4 mt-4">
                    <div class="col-sm-2 fw-bold">COURSE ID:</div>
                    <div class="col-sm-6"><input id="course_id" class="resp-text" type="text">
                    </div>
                </div>


            </div>

</form>
<script><?php require($_SERVER['DOCUMENT_ROOT'] . '/csc315_final_project/js/student_to_course.js'); ?></script>
</body>
</html>