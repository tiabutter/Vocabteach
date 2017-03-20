<?php 
    $mysqli_order = new mysqli(DB_HOST , DB_USER , DB_PASS , DB_NAME) or die(mysqli_connect_error());
    mysqli_set_charset($mysqli_order,"utf8");
            
    $sql_order = "SELECT order_id FROM sub_state WHERE state_id = '".$_GET['stateId']."'
                                                 AND   level = '".$_GET['level']."'   ";
    $result_order = mysqli_query($mysqli_order,$sql_order);
    $datas_order = array();
    
    if (!empty($result_order)) {
        while ($data_order = $result_order->fetch_assoc()) {
            $datas_order[] = $data_order;
        }
    }
    mysqli_close($mysqli_order);
?>
<?php 
    $mysqli_insert_ans = new mysqli(DB_HOST , DB_USER , DB_PASS , DB_NAME) or die(mysqli_connect_error());
    mysqli_set_charset($mysqli_insert_ans,"utf8");
    
    if (isset($_POST['ans1']) && 
        isset($_POST['ans2']) &&
        isset($_POST['ans3']) &&
        isset($_POST['ans4']) &&
        isset($_POST['checkAns']) &&
        isset($_POST['backtoquestion'])) {
        $sql_insert_ans = "
            INSERT answer(answer_id,correct,answer1,answer2,answer3,answer4,wrong) 
            values('".$_SESSION["val_ansId"]."',
                    '".$_POST['checkAns']."',
                    '".$_POST['ans1']."',
                    '".$_POST['ans2']."',
                    '".$_POST['ans3']."',
                    '".$_POST['ans4']."',
                    '".$_POST['backtoquestion']."')";
        mysqli_query($mysqli_insert_ans,$sql_insert_ans);
    }
    mysqli_close($mysqli_insert_ans);
?>

<form action="" method="post" style="margin-top: 10px;">
    <div class="form-group">
        <div class="row">
            <?php for ($i=1; $i<= 4 ; $i++) { ?>
                <div class="col-md-12">
                <label for="">Answer <?= $i;?> :</label>
                </div>
                <div class="col-md-9">
                    <input type="text" name="ans<?= $i;?>" class="form-control" placeholder="Ex. Answer<?=$i; ?>" required/>
                </div>
                <div class="col-md-3">
                    <input type="radio" name="checkAns" value="<?= $i; ?>" /><span>&nbsp;&nbsp;Correct</span>
                </div>
                <div class="clearfix" style="margin-bottom: 15px;"></div>
            <?php } ?>
            <div class="col-md-12">
                <label for="">Back To :</label>
            </div>
            <div class="col-md-12">
                <select name="backtoquestion" class="form-control">
                    <?php for ($i=0; $i<count($datas_order); $i++) { ?> 
                        <option value="<?= $datas_order[$i]['order_id'];?>"><?= $datas_order[$i]['order_id'];?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-12 text-center" style="margin-top: 15px;">
                <button type="submit" value="Upload" class="btn btn-success">Add Answer</button>
            </div>
        </div>

    </div>
</form>