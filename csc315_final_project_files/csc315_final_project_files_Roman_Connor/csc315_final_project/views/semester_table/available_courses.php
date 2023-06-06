<html>
<style>
    html { background-color:  #461D7C; }

    h1 { font-family: 'Play'; font-size: 20px; color:gold; padding: 0px 10px 10px 10px;}
    h4 { font-family: 'Play'; color:mediumpurple; padding: 0px 0px 0px 10px;}
    table { font-family: 'Oxygen Mono'; font-size: 12px; color:gold;width: 100%; border-collapse: collapse; }
    table th{ border-bottom: 4px solid gold; text-align: center; padding: 10px 0px 2px 4px;}
    table td { text-align: center; vertical-align: middle; }
    table tr { page-break-inside:avoid; page-break-after:auto;}
</style>
<head>
    <title>AVAILABLE COURSES</title>
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
        $sql = "SELECT s.Semester_id, s.Semester_startdate, s.Semester_enddate, c.Course_id, c.Course_name
                FROM semester_has_course shc
                INNER JOIN semester s ON shc.Semester_id = s.Semester_id
                INNER JOIN course c ON c.Course_id = shc.Course_id";

        $stmt = $MYSQL_CONN->prepare($sql);
        $stmt->execute();
        $query_results = $stmt->fetchAll();

        print('<table>');
        print('<thead>');
        print('<th>SEMESTER ID</th>');
        print('<th>SEMESTER START DATE</th>');
        print('<th>SEMESTER END DATE</th>');
        print('<th>COURSE ID</th>');
        print('<th>COURSE NAME</th>');
        print('</thead>');
        print('<tbody>');

        foreach($query_results as $row) {
            print('<tr>');
            print('<td>' . $row['Semester_id'] . '</td>');
            print('<td>' . $row['Semester_startdate'] . '</td>');
            print('<td>' . $row['Semester_enddate'] . '</td>');
            print('<td>' . $row['Course_id'] . '</td>');
            print('<td>' . $row['Course_name'] . '</td>');
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
