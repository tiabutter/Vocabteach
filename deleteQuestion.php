<?php 
	include 'connect.php';
	$mysqli_delete_ques = new mysqli(DB_HOST , DB_USER , DB_PASS , DB_NAME) or die(mysqli_connect_error());
    mysqli_set_charset($mysqli_delete_ques,"utf8");
    
    if (isset($_GET['DeleteQuestionId'])) {
        $query_delete_ques = "DELETE FROM question WHERE question_id = '".$_GET['DeleteQuestionId']."'";
    
        $result_delete_learn = mysqli_query($mysqli_delete_ques,$query_delete_ques);  
        header('Location: http://www.realtime-dev.com/?questionlog');

    }
    mysqli_close($mysqli_delete_ques);
?>