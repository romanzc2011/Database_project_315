<style>
    <?php require($_SERVER['DOCUMENT_ROOT'].'/csc315_final_project/css/stylesheet.css'); ?>
</style>

<?php
session_start();
require($_SERVER['DOCUMENT_ROOT'] . '/csc315_final_project/controller/raspberry_mysql_connection.php');

###############################################################################################
if(isset($_GET['faculty_id'])){ $faculty_id = $_GET['faculty_id']; }

switch ($_GET['mode']) {
    case 'select':

        $sql = "SELECT d.Faculty_id, d.Department_id, d.Department_name, d.Instructor_id, i.Last_name
                FROM department d
                INNER JOIN instructor i ON i.Instructor_id = d.Instructor_id
                WHERE d.Faculty_id = ".$faculty_id;

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
                <span class="input-rt">FACULTY ID:<input style="border-radius: 0.5em;" type="text"
                                                        name="facultyID"
                                                        id="facultyID" class="input-rt">
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
        <!-- FACULTY ID ############################################################################## -->
        <div class="row gap-4 mt-4">
            <div class="col-sm-4 fw-bold">FACULTY ID:</div>
            <div class="col-sm-6"><input id="faculty_id" name="faculty_id" class="resp-text" type="text" disabled="disabled"
                value="<?php echo $data['Faculty_id']; ?>"></div>
        </div>

        <!-- DEPARTMENT ID ############################################################################## -->
        <div class="row gap-4 mt-4">
            <div class="col-sm-4 fw-bold">DEPARTMENT ID:</div>
            <div class="col-sm-6"><input id="department_id" name="department_id" class="resp-text" type="text"
                                         value="<?php echo $data['Department_id']; ?>"></div>
        </div>

        <!-- DEPARTMENT NAME ############################################################################## -->
        <div class="row gap-4 mt-4">
            <div class="col-sm-4 fw-bolder">DEPARTMENT NAME:</div>
            <div class="col-sm-6"><input id="department_name" name="department_name" class="resp-text" type="text"
                                         value="<?php echo $data['Department_name']; ?>"></div>
        </div>

        <!-- INSTRUCTOR ID ############################################################################## -->
        <div class="row gap-4 mt-4">
            <div class="col-sm-4 fw-bolder">INSTRUCTOR ID:</div>
            <div class="col-sm-6"><input id="instructor_id" name="instructor_id" class="resp-text" type="text"
                                         value="<?php echo $data['Instructor_id']; ?>"></div>
        </div>

        <!-- INSTRUCTOR LASTNAME ############################################################################## -->
        <div class="row gap-4 mt-4">
            <div class="col-sm-4 fw-bolder">INSTRUCTOR LASTNAME:</div>
            <div class="col-sm-6"><input id="instructor_lastname" name="instructor_lastname" class="resp-text" type="text" disabled="disabled"
                                         value="<?php echo $data['Last_name']; ?>"></div>
        </div>

    </div>
    </div>
        <div id="background-img" class="logo-img" ><img src="../../img/lsus-logo.png"></div>

</body>
</html>