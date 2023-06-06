<style>
    <?php require($_SERVER['DOCUMENT_ROOT'].'/csc315_final_project/css/stylesheet.css'); ?>
</style>

<?php
session_start();
require($_SERVER['DOCUMENT_ROOT'] . '/csc315_final_project/controller/raspberry_mysql_connection.php');
$money_fmt = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
###############################################################################################
if(isset($_GET['student_id'])){ $student_id = $_GET['student_id']; }

switch ($_GET['mode']) {
    case 'select':

        $sql = "SELECT s.Student_id, s.SSN, s.First_name, s.Last_name, s.Age, s.Address, s.Birth_date, s.Email, s.Major, s.GPA,
                       fa.Aid_Amount
                FROM student s
                INNER JOIN financial_aid fa on s.Student_id = fa.Student_id
                WHERE fa.Student_id = ".$student_id;
        $data = SelectMySQL($sql);

        $sql = "SELECT SUM(Aid_Amount) FROM financial_aid WHERE Student_id = ".$student_id;
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
                <span class="input-rt">STUDENT ID:<input style="border-radius: 0.5em;" type="text"
                                                            name="studentID"
                                                            id="studentID" class="input-rt">
                </span>

            </div>
        </div>
    </div>

    <div class="row between-xs">
        <!-- COL -  ##################################################################### -->
        <div class="col-sm-3 d-grid gap-1 p-1 height">
            <!-- VIEW STUDENT ############################################################################## -->


        </div>
        <div class="col-sm-7 rcorner" id="index_div">
            <!-- STUDENT ID ############################################################################## -->
            <div class="row gap-2 mt-2">
                <div class="col-sm-2 fw-bold">STUDENT ID:</div>
                <div class="col-sm-6"><input id="id" name="id" class="resp-text" type="text" disabled="disabled"
                    value="<?php echo $data['Student_id']; ?>">
                </div>
            </div>

            <!-- SSN ############################################################################## -->

            <div class="row gap-2 mt-2">
                <div class="col-sm-2 fw-bold">SSN:</div>
                <div class="col-sm-6"><input id="ssn" class="resp-text" type="text" value="<?php echo $data['SSN']; ?>">
                </div>
            </div>
            <!-- FIRST NAME ############################################################################## -->

            <div class="row gap-2 mt-2">
                <div class="col-sm-2 fw-bold">FIRST NAME:</div>
                <div class="col-sm-6"><input id="firstName" class="resp-text" type="text" value="<?php echo $data['First_name']; ?>">
                </div>
            </div>

            <!-- LAST NAME ############################################################################## -->
            <div class="row gap-2 mt-2">
                <div class="col-sm-2 fw-bolder">LAST NAME:</div>
                <div class="col-sm-6"><input id="lastName" name="lastName" class="resp-text" type="text"
                                             value="<?php echo $data['Last_name']; ?>"></div>
            </div>

            <!-- AGE ############################################################################## -->
            <div class="row gap-2 mt-2">
                <div class="col-sm-2 fw-bold">AGE:</div>
                <div class="col-sm-6"><input id="age" name="age" class="resp-text" type="text"
                                             value="<?php echo $data['Age']; ?>"></div>
            </div>

            <!-- ADDRESS ############################################################################## -->
            <div class="row gap-2 mt-2">
                <div class="col-sm-2 fw-bold">ADDRESS:</div>
                <div class="col-sm-6"><input id="address" name="address" class="resp-text" type="text"
                                             value="<?php echo $data['Address']; ?>"></div>
            </div>

            <!-- EMAIL ############################################################################## -->
            <div class="row gap-2 mt-2">
                <div class="col-sm-2 fw-bold">EMAIL:</div>
                <div class="col-sm-6"><input id="email" name="email" class="resp-text" type="text"
                                             value="<?php echo $data['Email']; ?>"></div>
            </div>

            <!-- BIRTHDAY ############################################################################## -->
            <div class="row gap-2 mt-2">
                <div class="col-sm-2 fw-bold">BIRTHDATE:</div>
                <div class="col-sm-6"><input id="birth_date" class="resp-text" type="text"
                                             value="<?php echo $data['Birth_date']; ?>"></div>
            </div>

            <!-- MAJOR ############################################################################## -->
            <div class="row gap-2 mt-2">
                <div class="col-sm-2 fw-bold">MAJOR:</div>
                <div class="col-sm-6"><input id="major" name="major" class="resp-text" type="text"
                                             value="<?php echo $data['Major']; ?>"></div>
            </div>

            <!-- FINANCIAL AID AMOUNT ############################################################################## -->
            <div class="row gap-2 mt-2">
                <div class="col-sm-2 fw-bold">AID AMOUNT:</div>
                <div class="col-sm-6"><input id="finaid_amount" name="finaid_amount" class="resp-text" type="text"
                                             value="<?php echo $money_fmt->formatCurrency($total['SUM(Aid_Amount)'], 'USD'); ?>"></div>
            </div>
            <!-- GPA ############################################################################## -->

            <div class="row gap-2 mt-2">
                <div class="col-sm-2 fw-bold">GPA:</div>
                <div class="col-sm-6"><input id="gpa" class="resp-text" type="text"
                                             value="<?php echo $data['GPA']; ?>"></div>
            </div>
        </div>


        <div id="background-img" class="logo-img" ><img src="../../img/lsus-logo.png"></div>

</body>
</html>