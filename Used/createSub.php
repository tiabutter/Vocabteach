<?php 
    include './connect.php';
    $mysqli_insert_sub = new mysqli(DB_HOST , DB_USER , DB_PASS , DB_NAME) or die(mysqli_connect_error());
    mysqli_set_charset($mysqli_insert_sub,"utf8");
    if (isset($_POST['subjectName'])) {
         $sql_create_sub = "INSERT INTO state(state_name) VALUES ('".$_POST['subjectName']."')";
         mysqli_query($mysqli_insert_sub,$sql_create_sub);
    }
    mysqli_close($mysqli_insert_sub );
?>
<?php 
    $mysqli_select_sub = new mysqli(DB_HOST , DB_USER , DB_PASS , DB_NAME) or die(mysqli_connect_error());
    mysqli_set_charset($mysqli_select_sub,"utf8");
    
    $query_create_sub = "SELECT * FROM state";
    
    $result_sub = mysqli_query($mysqli_select_sub,$query_create_sub);
    $datas_sub = array();
    if (!empty($result_sub)) {
        while ($data_sub = $result_sub->fetch_assoc()) {
            $datas_sub[] = $data_sub;
        }
    }
    mysqli_close($mysqli_select_sub );
    
?>
<div class="panel panel-default">
  <div class="panel-heading">Create Subject</div>
  <div class="panel-body">
    <form action="" method="POST" role="form">
        <legend>Input Subject Form</legend>
        <div class="form-group">
            <div class="row">
                <div class="col-md-3">
                    <label for="subjectName" class="float-right">Subject Name :</label>
                </div>
                <div class="col-md-5">
                    <input type="text" class="form-control" name="subjectName" placeholder="Ex. MDT101" required />
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-success" style="float:left;">Add Subject</button>
                </div>
            </div>
        </div>
        <?php if (count($datas_sub) != null) { ?>
          <h1 class="text-center">Click To Create Info Subject</h1>
          <?php for ($i=0; $i<count($datas_sub); $i++) { ?>
                 <div class="col-md-11">
                    <center style="margin-bottom: 10px;">
                      <button class="btn btn-primary" 
                              style="width: 100%"
                              onClick='location.href="?stateId=<?= $datas_sub[$i]['state_id'];?>"'>
                              <?php echo $datas_sub[$i]['state_name'];?>
                      </button>
                    <center>
                 </div>
                <div class="col-md-1"> 
                    <a href="./deleteState.php?DeleteStateId=<?=$datas_sub[$i]['state_id'];?>" class="btn btn-danger" onClick="return confirm('Are you sure?')">Delete</a>
                </div>
            <?php }  ?>
        <?php } ?>
    </form>
    <div class="clearfix"></div>
  </div>
</div>