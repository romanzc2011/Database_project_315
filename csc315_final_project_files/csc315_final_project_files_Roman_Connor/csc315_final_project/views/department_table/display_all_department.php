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
    <title>DEPARTMENT LISTING</title>
</head>
<body style="background-color: #461D7C;">
<p style="color: gold; text-align: center">****************************** UNIVERSITY INFORMATION SYSTEM ******************************</p>


<?php
session_start();
require($_SERVER['DOCUMENT_ROOT'] . '/csc315_final_project/controller/raspberry_mysql_connection.php');
######################################################################################################################################################
// VARIABLES
if(isset($_GET['faculty_id'])) { $facultyID = trim($_GET['faculty_id']); }

######################################################################################################################################################
// SANITIZE VARIABLES
$facultyID = preg_replace('/\D/', '', $facultyID); // REPLACE ANYTHING IN THIS VARIABLE THAT IS NOT A DIGIT

######################################################################################################################################################
// SWITCH TO DETERMINE MODE
switch ($_GET['mode']) {

    case 'select':
        global $MYSQL_CONN;
        $sql = "SELECT d.Faculty_id, d.Department_id, d.Department_name, d.Instructor_id, i.Last_name
                FROM department d
                INNER JOIN instructor i ON i.Instructor_id = d.Instructor_id";

        $stmt = $MYSQL_CONN->prepare($sql);
        $stmt->execute();
        $query_results = $stmt->fetchAll();

        print('<table>');
        print('<thead>');
        print('<th>FACULTY ID</th>');
        print('<th>DEPARTMENT ID</th>');
        print('<th>DEPARTMENT NAME</th>');
        print('<th>INSTRUCTOR ID</th>');
        print('<th>INSTRUCTOR LASTNAME</th>');
        print('</thead>');
        print('<tbody>');

        foreach($query_results as $row) {
            print('<tr>');
            print('<td>' . $row['Faculty_id'] . '</td>');
            print('<td>' . $row['Department_id'] . '</td>');
            print('<td>' . $row['Department_name'] . '</td>');
            print('<td>' . $row['Instructor_id'] . '</td>');
            print('<td>' . $row['Last_name'] . '</td>');
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
