<?php 
    include 'connect.php';

    $mysqli_select_sub = new mysqli(DB_HOST , DB_USER , DB_PASS , DB_NAME) or die(mysqli_connect_error());
    mysqli_set_charset($mysqli_select_sub,"utf8");
    
    $query_create_sub = "SELECT * FROM state where state_id = '".$_GET['stateId']."' ";
    
    $result_sub = mysqli_query($mysqli_select_sub,$query_create_sub);
    $datas_sub = array();
    if (!empty($result_sub)) {
        while ($data_sub = $result_sub->fetch_assoc()) {
            $datas_sub[] = $data_sub;
        }
      }
    mysqli_close($mysqli_select_sub);
?>
<?php 
    $mysqli_select_lv_test = new mysqli(DB_HOST , DB_USER , DB_PASS , DB_NAME) or die(mysqli_connect_error());
    mysqli_set_charset($mysqli_select_lv_test,"utf8");
    
    $query_create_lv_test = "SELECT COUNT(level_num) as levelstate , MAX(level_num) as maxlevel FROM level where state_id ='".$_GET['stateId']."' ";
    
    $result_lv_test = mysqli_query($mysqli_select_lv_test,$query_create_lv_test);

    $datas_lv_test = array();
    if (!empty($result_lv_test)) {
        while ($data_lv_test = $result_lv_test->fetch_assoc()) {
            $datas_lv_test[] = $data_lv_test;
        }
      }
    mysqli_close($mysqli_select_lv_test);
?>
<?php for ($i=0; $i<count($datas_lv_test) ; $i++) { 

    $mysqli_insert_sub = new mysqli(DB_HOST , DB_USER , DB_PASS , DB_NAME) or die(mysqli_connect_error());
    mysqli_set_charset($mysqli_insert_sub,"utf8");

    if (isset($_POST['addlevel']) && $datas_lv_test[$i]['levelstate'] == 0) {
        $sql_create_sub = "INSERT INTO level(state_id,level_num) VALUES ('".$_GET['stateId']."','".$_POST['addlevel']."')";
        mysqli_query($mysqli_insert_sub,$sql_create_sub);

    }else if(isset($_POST['addlevel']) && $datas_lv_test[$i]['levelstate'] != 0){
        $getLevelTop = $datas_lv_test[$i]['maxlevel']+$_POST['addlevel'];
        $sql_create_sub = "INSERT INTO level(state_id,level_num) VALUES ('".$_GET['stateId']."','$getLevelTop')";
        mysqli_query($mysqli_insert_sub,$sql_create_sub);
    }
    mysqli_close($mysqli_insert_sub);
} ?>
<?php 
    $mysqli_select_lv = new mysqli(DB_HOST , DB_USER , DB_PASS , DB_NAME) or die(mysqli_connect_error());
    mysqli_set_charset($mysqli_select_lv,"utf8");
    
    $query_create_lv = "SELECT * FROM level where state_id ='".$_GET['stateId']."' ";
    
    $result_lv = mysqli_query($mysqli_select_lv,$query_create_lv);
    $datas_lv = array();
    if (!empty($result_lv)) {
        while ($data_lv = $result_lv->fetch_assoc()) {
            $datas_lv[] = $data_lv;
        }
      }
    mysqli_close($mysqli_select_lv);
?>
<div class="panel panel-default">
  <div class="panel-heading">Create Level Subject</div>
  <div class="panel-body">
  <div class="container" style="width: 100%;">
    <legend>Level Form</legend>

    <div class="col-md-6">
      <div class="container" style="width: 100%">
        <form action="" method="POST" role="form">
            <div class="container" style="width: 100%">
            <?php if (count($datas_sub) != null) { for ($i=0; $i<count($datas_sub); $i++) { ?>
                     <h3>Subject Name : <?php echo $datas_sub[$i]['state_name'] ?></h3>
                <?php }  ?>
            <?php } ?>
            </div>
            <div class="form-group">
                <div class="container" style="width: 100%;">
                  <div class="row text-center">
                        <button type="submit" name="addlevel" value="1" class="btn btn-success">
                          Add Level
                        </button>
                  </div>
                </div>
            </div>
        </form>
    <?php if (count($datas_lv) != null) { for ($i=0; $i<count($datas_lv); $i++) { ?>
                 <div class="col-md-12">
                    <center style="margin-bottom: 10px;">
                      <button type="button"
                              class="btn btn-warning" 
                              style="width: 100%"
                              onClick='location.href="?level=<?php echo $datas_lv[$i]['level_num'];?>&&stateId=<?php echo $_GET['stateId'];?>"'
                              >
                              <?php echo "level".' '.$datas_lv[$i]['level_num'];?>
                      </button>
                    <center>
                  </div>

            <?php $_SESSION["val_level"] = isset($_GET['level']); }  ?>
        <?php } ?>
      </div>
        
        <?php if (isset($_GET['level'])) {
              include 'createChoice.php';
        } ?>

    <div class="clearfix"></div>
    </div>
  </div>
</div>
