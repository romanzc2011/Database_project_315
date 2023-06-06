<style>
    <?php require($_SERVER['DOCUMENT_ROOT'].'/csc315_final_project/css/stylesheet.css'); ?>
</style>
<?php session_start(); ?>
<?php require($_SERVER['DOCUMENT_ROOT'] . '/csc315_final_project/controller/instructor_controller/instructor_processor.php'); ?>
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

    <title>CSC 315 Final Project Roman-Connor</title>
</head>
<body style="background-color:  #461D7C" ;>

<form id="instructor_form">
<div class="container-fluid" id="cover_page">
    <!-- SEARCH BAR ROW ################################################################## -->
    <div class="row between-xs" id="index_header">
        <div class="col-sm-11 m-4 d-grid gap-4 rcorner-sm border-success lt-purple">
            <?php require($_SERVER['DOCUMENT_ROOT'] . '/csc315_final_project/views/instructor_table/instructor_header.php'); ?>
        </div>

        <div class="col-sm-3 d-grid gap-3 p-4 height">
            <?php require($_SERVER['DOCUMENT_ROOT'] . '/csc315_final_project/views/instructor_table/instructor_buttons/instructor_buttons.php'); ?>
        </div>
        <div class="col-sm-7 rcorner" id="index_div">
            <?php require($_SERVER['DOCUMENT_ROOT'] . '/csc315_final_project/views/instructor_table/instructor_page.php'); ?>
        </div>
    </div>
</form>
<img src="../../img/lsus-logo.png" style="position:absolute;bottom:-125px;left:100px;z-index:1" height="120" />
    <script><?php require($_SERVER['DOCUMENT_ROOT'] . '/csc315_final_project/js/instructor_page.js'); ?></script>