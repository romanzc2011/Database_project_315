<html>
<style>
    html { background-color:  #461D7C; }

    h1 { font-family: 'Play'; font-size: 20px; color:orange; padding: 0px 10px 10px 10px;}
    h4 { font-family: 'Play'; color:mediumpurple; padding: 0px 0px 0px 10px;}
    table { font-family: 'Play'; font-size: 14px; color:gold;width: 100%; border-collapse: collapse; }
    table th{ border-bottom: 4px solid gold; text-align: center; padding: 10px 0px 2px 4px;}
    table td { text-align: center; vertical-align: middle; }
    table tr { page-break-inside:avoid; page-break-after:auto;}
    html * {
        font-family: Play;
    }
    p {font-family: 'Play'; font-size: 18px; color:gold; font-weight: bolder;width: 100%; border-collapse: collapse; }
    .topborder { border-top: 1px solid black; }
</style>
<head>
    <title>FINANCIAL AID</title>
</head>
<body style="background-color: #461D7C;">
<p style="color: gold; text-align: center">****************************** UNIVERSITY INFORMATION SYSTEM ******************************</p>


<?php
session_start();
require($_SERVER['DOCUMENT_ROOT'] . '/csc315_final_project/controller/raspberry_mysql_connection.php');

######################################################################################################################################################
// VARIABLES
if(isset($_GET['student_id'])){ $student_id = $_GET['student_id']; }
$money_fmt = new NumberFormatter('en_US', NumberFormatter::CURRENCY);

######################################################################################################################################################
// SWITCH TO DETERMINE MODE
$total_aid = 0;
switch ($_GET['mode']) {

    case 'select':
        global $MYSQL_CONN;
        $sql = "SELECT f.Finaid_id, f.Student_id, f.Aid_Amount, s.Last_name, s.SSN, f.Aid_Source, s.First_name
                FROM financial_aid f
                INNER JOIN student s ON f.Student_id = s.Student_id
                WHERE f.Student_id = ".$student_id;

        $stmt = $MYSQL_CONN->prepare($sql);
        $stmt->execute();
        $query_results = $stmt->fetchAll();

        print('<table>');
        print('<tr><td><br><br></td></tr>');
        print('<tr><td><br><br></td></tr>');
        print('<tr>');
        print('<th>FINANCIAL AID ID</th>');
        print('<th>AID SOURCE</th>');
        print('<th>AID AMOUNT</th>');
        print('<th>STUDENT ID</th>');
        print('<th>STUDENT FIRSTNAME</th>');
        print('<th>STUDENT LASTNAME</th>');
        print('</tr>');

        foreach($query_results as $row) {
            print('<tr>');
            print('<td>' . $row['Finaid_id'] . '</td>');
            print('<td>'. $row['Aid_Source']. '</td>');
            print('<td>' . $money_fmt->formatCurrency($row['Aid_Amount'], 'USD') . '</td>');
            print('<td>' . $row['Student_id'] . '</td>');
            print('<td>' . $row['First_name'] . '</td>');
            print('<td>' . $row['Last_name'] . '</td>');
            print('</tr>');

            $total_aid += $row['Aid_Amount'];

        }
        print('</table>');


        break;
}
print('<p>TOTAL: '.$money_fmt->formatCurrency($total_aid, 'USD').'</p>');

?>
<img src="<?php echo 'data:image/png;base64,' . base64_encode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/csc315_final_project/img/lsus-logo.png')); ?>"
     class="logo-img" height="150">
</body>
</html>
