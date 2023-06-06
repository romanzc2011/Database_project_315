<style>
    <?php require($_SERVER['DOCUMENT_ROOT'].'/csc315_final_project/css/stylesheet.css'); ?>
</style>

<?php
session_start();
require($_SERVER['DOCUMENT_ROOT'] . '/csc315_final_project/controller/raspberry_mysql_connection.php');

###############################################################################################
if(isset($_GET['semester_id'])){ $semester_id = $_GET['semester_id']; }

switch ($_GET['mode']) {
    case 'select':

        $sql = "SELECT Semester_id, Semester_startdate, Semester_enddate, Time_of_year
                FROM semester WHERE Semester_id = ".$semester_id;
        $data = SelectMySQL($sql);
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
                <span class="input-rt">SEMESTER ID:<input style="border-radius: 0.5em;" type="text"
                                                        name="courseID"
                                                        id="courseID" class="input-rt">
                </span>
            </div>
        </div>
    </div>

    <div class="row between-xs">
        <!-- COL -  ##################################################################### -->
        <div class="col-sm-3 d-grid gap-3 p-4 height">
            <!-- VIEW STUDENT ############################################################################## -->


        </div>
        <div class="col-sm-7 rcorner" id="index_div">
            <!-- COURSE ID ############################################################################## -->
            <div class="row gap-4 mt-4">
                <div class="col-sm-3 fw-bold">SEMESTER ID:</div>
                <div class="col-sm-6"><input id="semester_id" name="semester_id" class="resp-text" type="text"
                                             value="<?php echo $data['Semester_id']; ?>"></div>
            </div>

            <!-- COURSE NAME ############################################################################## -->
            <div class="row gap-4 mt-4">
                <div class="col-sm-3 fw-bold">SEMESTER START DATE:</div>
                <div class="col-sm-6"><input id="semester_startdate" class="resp-text" type="text"
                                             value="<?php echo $data['Semester_startdate']; ?>"></div>
            </div>

            <!-- CREDIT HOURS ############################################################################## -->
            <div class="row gap-4 mt-4">
                <div class="col-sm-3 fw-bold">SEMESTER END DATE:</div>
                <div class="col-sm-6"><input id="semester_enddate" class="resp-text" type="text"
                                             value="<?php echo $data['Semester_enddate']; ?>"></div>
            </div>

            <!-- TIME OF YEAR ############################################################################## -->
            <div class="row gap-4 mt-4">
                <div class="col-sm-3 fw-bold">TIME OF YEAR:</div>
                <div class="col-sm-6"><input id="semester_time" class="resp-text" type="text"
                                             value="<?php echo $data['Time_of_year']; ?>"></div>
            </div>

        </div>
        <div id="background-img" class="logo-img" ><img src="../../img/lsus-logo.png"></div>

</body>
</html>
