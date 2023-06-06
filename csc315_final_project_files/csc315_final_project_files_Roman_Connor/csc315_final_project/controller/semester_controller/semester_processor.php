    <?php

    session_start();
    require($_SERVER['DOCUMENT_ROOT'].'/csc315_final_project/controller/raspberry_mysql_connection.php');

    if(isset($_GET['semester_id'])){ $semester_id = $_GET['semester_id']; }
    // #########################################################################################
    // POST Variables
    $start_date = null;
    $end_date = null;

    if($date = strtotime($_POST['start_date'])) { $start_date = date("Y-m-d", $date); }
    if($date = strtotime($_POST['end_date'])) { $end_date = date("Y-m-d", $date); }
    if($_POST['semester_time']){ $semester_time = $_POST['semester_time']; }

    // ADD YEAR TO SEMESTER TIME
    $semester_time = strtoupper($semester_time);
    $semester_time .= ' '.date('Y', strtotime($_POST['start_date']));
    switch($_GET['mode']){

        case 'update':
            $updates = array();
            global $MYSQL_CONN;

            if(!empty($start_date)){$updates[] = 'Semester_startdate = '."'".$start_date."'";}
            if(!empty($end_date)){$updates[] = 'Semester_enddate = '."'".$end_date."'";}

            if(!empty($semester_time))
            {
                $updates[] = 'Time_of_year = '."'".$semester_time."'";
            }

            if(!empty($updates)){
                $sql = 'UPDATE semester SET '.implode(', ', $updates).' WHERE Semester_id = '.$semester_id;
            }
            $stmt = $MYSQL_CONN->prepare($sql);
            $stmt->execute();
            break;

        case 'insert':
            global $MYSQL_CONN;

            // Build INSERT statement
            $sql = "INSERT INTO semester (Semester_startdate, Semester_enddate, Time_of_year)";
            $sql .=" VALUES (";
            $sql .= "'".$start_date."', ";
            $sql .= "'".$end_date."', ";
            $sql .= "'".$semester_time."')";
            $stmt = $MYSQL_CONN->prepare($sql);
            $stmt->execute();
            break;

        case 'delete':
            $sql = "DELETE FROM semester 
                    WHERE Semester_id = ".$_GET['semester_id'];
            deleteMySQL($sql);
            break;



    }

    ?>