<?php 
	include 'connect.php';
	$mysqli_delete_learn = new mysqli(DB_HOST , DB_USER , DB_PASS , DB_NAME) or die(mysqli_connect_error());
    mysqli_set_charset($mysqli_delete_learn,"utf8");
    
    if (isset($_GET['DeleteLearnId'])) {
        $query_delete_learn = "DELETE FROM teach WHERE teach_id = '".$_GET['DeleteLearnId']."'";
    
        $result_delete_learn = mysqli_query($mysqli_delete_learn,$query_delete_learn);  
        header('Location: http://www.realtime-dev.com/?learnlog');

    }
    mysqli_close($mysqli_delete_learn);
?>