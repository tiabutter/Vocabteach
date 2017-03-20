<?php 
    include 'connect.php';
        $mysqli_update_ans = new mysqli(DB_HOST , DB_USER , DB_PASS , DB_NAME) or die(mysqli_connect_error());
        mysqli_set_charset($mysqli_update_ans,"utf8");

        if( isset($_GET['UpdateAnswerId']) && 
            isset($_POST['ansupdate1']) &&
            isset($_POST['ansupdate2']) &&
            isset($_POST['ansupdate3']) &&
            isset($_POST['ansupdate4']) &&
            isset($_POST['checkAnsupdate']) &&
            isset($_POST['backtoquestion']))
             {

            $query_update_ans = "UPDATE answer SET answer1='".$_POST['ansupdate1']."',answer2='".$_POST['ansupdate2']."',answer3='".$_POST['ansupdate3']."',answer4='".$_POST['ansupdate4']."',correct='".$_POST['checkAnsupdate']."', wrong='".$_POST['backtoquestion']."' WHERE answer_id = '".$_GET['UpdateAnswerId']."'";

            mysqli_query($mysqli_update_ans,$query_update_ans) or die("error");
            header('Location: http://www.realtime-dev.com/?questionlog');
        }
         mysqli_close($mysqli_update_ans);
?>
<?php 
    $mysqli_select_ques = new mysqli(DB_HOST , DB_USER , DB_PASS , DB_NAME) or die(mysqli_connect_error());
    mysqli_set_charset($mysqli_select_ques,"utf8");
    $query_select = "SELECT level FROM sub_state WHERE order_id='".$_GET['questionUpdate']."' ";
    $result_select = mysqli_query($mysqli_select_ques,$query_select);
    $datas_select = array();
    if (!empty($result_select)) 
    {
        while ($data_select = $result_select->fetch_assoc()) {
            $datas_select[] = $data_select;
        }
    }
    mysqli_close($mysqli_select_ques);
    
?>

<?php 
    for ($i=0; $i <count($data_select) ; $i++) { }
    $mysqli_select = new mysqli(DB_HOST , DB_USER , DB_PASS , DB_NAME) or die(mysqli_connect_error());
    mysqli_set_charset($mysqli_select,"utf8");
    $query_select_lv = "SELECT order_id FROM sub_state WHERE state_id='".$_GET['stateUpdate']."' AND level='".$datas_select[$i]['level']."' ";
    $result_select_lv = mysqli_query($mysqli_select,$query_select_lv);
    $datas_select_lv = array();
    if (!empty($result_select_lv)) 
    {
        while ($data_select_lv = $result_select_lv->fetch_assoc()) {
            $datas_select_lv[] = $data_select_lv;
        }
    }
    mysqli_close($mysqli_select);
?>

<div class="panel panel-default">
  <div class="panel-heading">Update Answer Log</div>
  <div class="panel-body">
    <form action="" method="POST" role="form">
        <legend>Update Answer Form</legend>
        <div class="form-group">
            <div class="row">
                <?php for ($i=1; $i<= 4 ; $i++) { ?>
                <div class="col-md-3">
                <label for="" class="float-right">Answer <?= $i;?> : </label>
                </div>
                <div class="col-md-5">
                    <input type="text" name="ansupdate<?= $i;?>" class="form-control" placeholder="Ex. Answer<?=$i; ?>" required/>
                </div>
                <div class="col-md-4">
                    <input type="radio" name="checkAnsupdate" value="<?= $i; ?>" /><span>&nbsp;&nbsp;Correct</span>
                </div>
                <div class="clearfix" style="margin-bottom: 15px;"></div>
            <?php } ?>
                <div class="col-md-3">
                    <label for="" class="float-right">Back To : </label>
                </div>
                <div class="col-md-5">
                    <select name="backtoquestion" class="form-control">
                        <?php for ($k=0; $k<count($datas_select_lv); $k++) { ?> 
                        <option value="<?= $datas_select_lv[$k]['order_id'];?>">    <?= $datas_select_lv[$k]['order_id'];?>
                        </option>
                        <?php  } ?>
                    </select>
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
