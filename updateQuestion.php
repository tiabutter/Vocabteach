<?php 
    include 'connect.php';
        $mysqli_update_ques = new mysqli(DB_HOST , DB_USER , DB_PASS , DB_NAME) or die(mysqli_connect_error());
        mysqli_set_charset($mysqli_update_ques,"utf8");
        
        if(isset($_POST['qnameupdate'])) {
            $query_update_ques = "UPDATE question SET question_name='".$_POST['qnameupdate']."' WHERE question_id = '".$_GET["UpdateQuestionId"]."'";
            $result_log_update = mysqli_query($mysqli_update_ques,$query_update_ques);
            header('Location: http://www.realtime-dev.com/?questionlog');
        }
         mysqli_close($mysqli_update_ques);
?>
<div class="panel panel-default">
  <div class="panel-heading">Update Question Log</div>
  <div class="panel-body">
    <form action="" method="POST" role="form">
        <legend>Update Question Form</legend>
        <div class="form-group">
            <div class="row">
                <div class="col-md-5">
                    <label for="" class="float-right">Question :</label>
                </div>
                <div class="col-md-5">
                    <input type="text" name="qnameupdate" class="form-control" placeholder="Question Name :" />
                </div>
            </div>
        </div>
        <div class="col-md-12 text-center">
            <button type="submit" class="btn btn-success">Save</button>
            <button type="reset" class="btn btn-warning">Clear</button>
        </div>
    </form>
    <div class="clearfix"></div>
  </div>
</div>