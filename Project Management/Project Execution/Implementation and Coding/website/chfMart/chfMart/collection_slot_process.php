<?php include 'includes/connection.php';
session_start();


if(isset($_POST['time'])&& isset($_POST['day'])){
    if(isset($_SESSION['user'])){
        $member_id = $_SESSION['user']['USER_ID'];
    }
    $time = $_POST['time'];

    $arr = explode('-', $time);
    $start_time = $arr[0];
    $end_time = $arr[1];
    
      $date = date('m/d/Y');

      $slot_start_time = ($date." ".$start_time); 
      $slot_end_time = ($date." ".$end_time); 
    
 
    $day = $_POST['day'];
 
    $select = "select USER_ID from users where USER_ID = $member_id";
    $parse = oci_parse($conn, $select);
    $execute = oci_execute($parse);
    $results = array();
        $num_rows = oci_fetch_all($parse, $results, null, null, OCI_FETCHSTATEMENT_BY_ROW);
        if($num_rows>0){
            foreach($results as $row){   
               
                $current_user_id = $row['USER_ID'];
                
                $query = "insert into COLLECTION_SLOT (ADDED_BY, DAYOF_WEEK, START_TIME, END_TIME) VALUES($current_user_id, '".$day."', TO_DATE('".$slot_start_time."', 'MM/DD/YYYY HH24:MI:SS'), TO_DATE('".$slot_end_time."', 'MM/DD/YYYY HH24:MI:SS'))";
            
                $parse = oci_parse($conn, $query);
                $execute = oci_execute($parse);
                    if(!$parse){
                        $m = oci_error();
                        echo $m['message'], "\n";
                    }
            }
        }

        
}

    