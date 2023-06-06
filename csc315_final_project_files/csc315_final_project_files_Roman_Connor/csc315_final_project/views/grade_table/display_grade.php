    <?php
    session_start();
    require($_SERVER['DOCUMENT_ROOT'] . '/csc315_final_project/controller/raspberry_mysql_connection.php');
    ?>

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
        <?php
            if(isset($_GET['studentID'])){ $studentID = $_GET['studentID']; }

            $sql = 'SELECT s.First_name, s.Last_name
                    FROM student s
                    WHERE s.Student_id = '.$studentID;
            $data = SelectMySQL($sql);
        ?>
        <title>GRADES FOR <?php echo ' '.$data['First_name'].' '.$data['Last_name'];?></title>
    </head>
    <body style="background-color: #461D7C;">
    <p style="color: gold; text-align: center">****************************** UNIVERSITY INFORMATION SYSTEM ******************************</p>


    <?php
    // #########################################################################################
    // CALCULATE GPA

    $total_points = 0;
    $letter_grade = '';
    $units = 0;
    $gpa = 0;

    global $MYSQL_CONN;
    $sql = 'SELECT scg.Student_id, c.Credits, scg.Grade_id, scg.Grade
            FROM student_course_grades scg
            INNER JOIN student s ON s.Student_id = scg.Student_id
            INNER JOIN course c ON c.Course_id = scg.Course_id
            WHERE scg.Student_id = '.$studentID;

    $stmt = $MYSQL_CONN->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll();

    foreach($results as $grade)
        {
            switch($grade['Grade'])
            {
                case 'A':
                    $total_points += (4 * 3);
                    $units += $grade['Credits'];
                    break;
                case 'B':
                    $total_points += (3 * 3);
                    $units += $grade['Credits'];
                    break;
                case 'C':
                    $total_points += (2 * 3);
                    $units += $grade['Credits'];
                    break;
                case 'D':
                    $total_points += (1 * 3);
                    $units += $grade['Credits'];
                    break;
                case 'F':
                    $total_points += 0;
                    break;
                default:
                    die('Invalid letter grade');
            }
        }
    $gpa = $total_points / $units;
    $sql = 'UPDATE student_course_grades SET GPA = '.$gpa;
    $stmt = $MYSQL_CONN->prepare($sql);
    $stmt->execute();

    ######################################################################################################################################################
    // SWITCH TO DETERMINE MODE

    switch ($_GET['mode']) {
        case 'select':
            global $MYSQL_CONN;
            $sql = "SELECT scg.Grade_id, scg.Student_id, c.Course_id, scg.Grade, c.Course_name, s.Last_name
                    FROM student_course_grades scg
                    INNER JOIN course c ON c.Course_id = scg.Course_id
                    INNER JOIN student s ON s.Student_id = scg.Student_id
                    WHERE 1=1
                    AND s.Student_id = ".$studentID;

            $stmt = $MYSQL_CONN->prepare($sql);
            $stmt->execute();
            $query_results = $stmt->fetchAll();

            print('<table>');
            print('<thead>');
            print('<th>GRADE ID</th>');
            print('<th>STUDENT ID</th>');
            print('<th>STUDENT LASTNAME</th>');
            print('<th>COURSE ID</th>');
            print('<th>COURSE NAME</th>');
            print('<th>GRADE</th>');
            print('</thead>');
            print('<tbody>');

            foreach($query_results as $row) {
                print('<tr>');
                print('<td>' . $row['Grade_id'] . '</td>');
                print('<td>' . $row['Student_id'] . '</td>');
                print('<td>' . $row['Last_name'] . '</td>');
                print('<td>' . $row['Course_id'] . '</td>');
                print('<td>' . $row['Course_name'] . '</td>');
                print('<td>' . $row['Grade'] . '</td>');
                print('</tr>');
            }
            print('<tr><td><br><br></td></tr>');

            print('<tr><td style="color: gold; font-weight: bolder">GPA: '.$gpa.'</td></tr>');

            print('</tbody>');

            $sql = 'UPDATE student SET GPA = '.$gpa;
            $stmt = $MYSQL_CONN->prepare($sql);
            $stmt->execute();

            break;
    }
    ?>
    <img src="<?php echo 'data:image/png;base64,' . base64_encode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/csc315_final_project/img/lsus-logo.png')); ?>"
         class="logo-img" height="150">
    </body>
    </html>
