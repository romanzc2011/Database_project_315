<html>
<style>
    html { background-color:  #461D7C; }

    h1 { font-family: 'Play'; font-size: 20px; color:orange; padding: 0px 10px 10px 10px;}
    h4 { font-family: 'Play'; color:mediumpurple; padding: 0px 0px 0px 10px;}
    table { font-family: 'Oxygen Mono'; font-size: 12px; color:gold;width: 100%; border-collapse: collapse; }
    table th{ border-bottom: 4px solid gold; text-align: center; padding: 10px 0px 2px 4px;}
    table td { text-align: center; vertical-align: middle; }
    table tr { page-break-inside:avoid; page-break-after:auto;}
    .topborder { border-top: 1px solid black; }
</style>
<head>
    <title>VIEW ALL STUDENTS</title>
</head>
<body style="background-color: #461D7C;">
<p style="color: gold; text-align: center">****************************** UNIVERSITY INFORMATION SYSTEM ******************************</p>


<?php
session_start();
require($_SERVER['DOCUMENT_ROOT'] . '/csc315_final_project/controller/raspberry_mysql_connection.php');

######################################################################################################################################################
// SWITCH TO DETERMINE MODE
switch ($_GET['mode']) {

    case 'select':
        global $MYSQL_CONN;
        $sql = "SELECT * FROM student";

        $stmt = $MYSQL_CONN->prepare($sql);
        $stmt->execute();
        $query_results = $stmt->fetchAll();

        print('<table>');
        print('<thead>');
        print('<th>STUDENT ID</th>');
        print('<th>SSN</th>');
        print('<th>STUDENT FIRSTNAME</th>');
        print('<th>STUDENT LASTNAME</th>');
        print('<th>AGE</th>');
        print('<th>ADDRESS</th>');
        print('<th>BIRTHDATE</th>');
        print('<th>EMAIL</th>');
        print('<th>MAJOR</th>');
        print('</thead>');
        print('<tbody>');

        foreach($query_results as $row) {
            print('<tr>');
            print('<td>' . $row['Student_id'] . '</td>');
            print('<td>' . $row['SSN'] . '</td>');
            print('<td>' . $row['First_name'] . '</td>');
            print('<td>' . $row['Last_name'] . '</td>');
            print('<td>' . $row['Age'] . '</td>');
            print('<td>' . $row['Address'] . '</td>');
            print('<td>' . $row['Birth_date'] . '</td>');
            print('<td>' . $row['Email'] . '</td>');
            print('<td>' . $row['Major'] . '</td>');
            print('</tr>');
        }
        print('</tbody>');


        break;
}
?>
<img src="<?php echo 'data:image/png;base64,' . base64_encode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/csc315_final_project/img/lsus-logo.png')); ?>"
     class="logo-img" height="150">
</body>
</html>
