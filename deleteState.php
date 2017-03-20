<?php 
	include 'connect.php';
	$mysqli_delete_state = new mysqli(DB_HOST , DB_USER , DB_PASS , DB_NAME) or die(mysqli_connect_error());
    mysqli_set_charset($mysqli_delete_state,"utf8");
    
    if (isset($_GET['DeleteStateId'])) {
        $query_delete_state = "DELETE FROM state WHERE state_id = '".$_GET['DeleteStateId']."'";
    
        mysqli_query($mysqli_delete_state,$query_delete_state);  
        header('Location: http://www.realtime-dev.com/?createSubject');

    }
    mysqli_close($mysqli_delete_state);
?>