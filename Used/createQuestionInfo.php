<?php 
    $mysqli_select_ques = new mysqli(DB_HOST , DB_USER , DB_PASS , DB_NAME) or die(mysqli_connect_error());
    mysqli_set_charset($mysqli_select_ques,"utf8");
    
    $query_select_ques = "SELECT COUNT(answer_id) as questionCount FROM question";
    
    $result_ques = mysqli_query($mysqli_select_ques,$query_select_ques);

    $datas_ques = array();
    if (!empty($result_ques)) {
        while ($data_ques = $result_ques->fetch_assoc()) {
            $datas_ques[] = $data_ques;
        }
      }
    mysqli_close($mysqli_select_ques);
?>
<?php 
    for ($i=0; $i<count($datas_ques); $i++) { 
        $ansGroup_num = $datas_ques[$i]['questionCount']+isset($_POST['answercode']);
        $ansGroupName = "Question-Group-".$ansGroup_num;
    }
    $mysqli_insert_ques = new mysqli(DB_HOST , DB_USER , DB_PASS , DB_NAME) or die(mysqli_connect_error());
    mysqli_set_charset($mysqli_insert_ques,"utf8");
    
    if (isset($_POST['qname']) && isset($_POST['answercode'])) {
        $sql_insert_info_question = "
            INSERT question(state_id,question_id,question_name,answer_id) 
            values('".$_GET['stateId']."',
                    '".$_GET['orderId']."',
                    '".$_POST['qname']."','$ansGroupName')";
        mysqli_query($mysqli_insert_ques,$sql_insert_info_question);
    }
    mysqli_close($mysqli_insert_ques);
?>
<?php 
    $mysqli_ans = new mysqli(DB_HOST , DB_USER , DB_PASS , DB_NAME) or die(mysqli_connect_error());
    mysqli_set_charset($mysqli_ans,"utf8");
            
    $sql_ans = "SELECT answer_id FROM question WHERE question_id = '".$_GET['orderId']."'";
    $result_ans = mysqli_query($mysqli_ans,$sql_ans);
    $anses = array();
    
    if (!empty($result_ans)) {
        while ($ans = $result_ans->fetch_assoc()) {
            $anses[] = $ans;
        }
    }
    mysqli_close($mysqli_ans);
?>
<?php 
    $mysqli_hasGroup_ques = new mysqli(DB_HOST , DB_USER , DB_PASS , DB_NAME) or die(mysqli_connect_error());
    mysqli_set_charset($mysqli_hasGroup_ques,"utf8");
            
    $sql_hasGroup_ques = "SELECT COUNT(answer_id) as hasAnsGroup FROM question WHERE question_id = '".$_GET['orderId']."'";
    $result_hasGroup_ques = mysqli_query($mysqli_hasGroup_ques,$sql_hasGroup_ques);
    $datas_has_group_ques = array();
    
    if (!empty($result_hasGroup_ques)) {
        while ($data_has_group_ques = $result_hasGroup_ques->fetch_assoc()) {
            $datas_has_group_ques[] = $data_has_group_ques;
        }
    }
    mysqli_close($mysqli_hasGroup_ques);
?>
 <div class="container" style="width: 100%;margin-top: 10px">
    <h1 class="text-center"><?=$_GET["orderId"];?></h1>
    <?php for ($i=0; $i<count($datas_has_group_ques) ; $i++) { ?>
        <?php if ($datas_has_group_ques[$i]['hasAnsGroup'] == 0 ){ ?>
        <form action="" method="post" enctype="multipart/form-data" id="myFrom">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <label for="">Question :</label>
                    </div>
                    <div class="col-md-12">
                        <input type="text" name="qname" class="form-control" placeholder="Question Name :" />
                    </div>
                </div>
            </div>
            <input type="hidden" name="answercode" value="1" class="form-control"/>

            <div class="col-md-12 text-center">
                <button type="submit" value="Upload" class="btn btn-success">Save</button>
            </div>
        </form>
        <?php } ?>
    <?php } ?>
    <div class="clearfix"></div>
    <?php for ($i=0; $i<count($anses); $i++) { 
            $_SESSION["val_ansId"] = $anses[$i]['answer_id'];
              include 'createQuestionAnswer.php';
    } ?>
</div>