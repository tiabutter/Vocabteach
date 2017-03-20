<?php 
    $mysqli_select_lv_index = new mysqli(DB_HOST , DB_USER , DB_PASS , DB_NAME) or die(mysqli_connect_error());
    mysqli_set_charset($mysqli_select_lv_index,"utf8");
    
    $query_create_lv_index = "SELECT COUNT(level_index) as levelindex, MAX(level_index) as maxlevelIndex,
    COUNT(order_id) as orderNum FROM sub_state where state_id ='".$_GET['stateId']."' AND level='".$_GET['level']."' ";
    
    $result_lv_index = mysqli_query($mysqli_select_lv_index,$query_create_lv_index);

    $datas_lv_index = array();
    if (!empty($result_lv_index)) {
        while ($data_lv_index = $result_lv_index->fetch_assoc()) {
            $datas_lv_index[] = $data_lv_index;
        }
      }
    mysqli_close($mysqli_select_lv_index);
?>
<?php 
    $mysqli_order = new mysqli(DB_HOST , DB_USER , DB_PASS , DB_NAME) or die(mysqli_connect_error());
    mysqli_set_charset($mysqli_order,"utf8");
    
    $query_order = "SELECT COUNT(order_id) as orderNum FROM sub_state";
    
    $result_order = mysqli_query($mysqli_order,$query_order);

    $datas_order = array();
    if (!empty($result_order)) {
        while ($data_order = $result_order->fetch_assoc()) {
            $datas_order[] = $data_order;
        }
      }
    mysqli_close($mysqli_order);
?>
<?php 
	for ($i=0; $i <count($datas_order) ; $i++) { 
		$order_num_learn = $datas_order[$i]['orderNum']+isset($_POST['learncode']);
		$orderNameLearn = $order_num_learn."-Learning";
		$order_num_question = $datas_order[$i]['orderNum']+isset($_POST['questioncode']);
		$orderNameQuestion = $order_num_question."-Question";
	}
	for ($i=0; $i<count($datas_lv_index); $i++){
    $mysqli_insert_learn = new mysqli(DB_HOST , DB_USER , DB_PASS , DB_NAME) or die(mysqli_connect_error());
    mysqli_set_charset($mysqli_insert_learn,"utf8");
    if (isset($_POST['learncode']) && $datas_lv_index[$i]['levelindex'] == 0) {

      $sql_insert_learn = "INSERT INTO sub_state(state_id,order_id,level,level_index) 
      VALUES ('".$_GET['stateId']."','$orderNameLearn','".$_GET['level']."',1)";
      mysqli_query($mysqli_insert_learn,$sql_insert_learn);
      // $_POST = array();
    }
    else if (isset($_POST['learncode']) && $datas_lv_index[$i]['levelindex'] != 0) {
      $getLevelIndexTop = $datas_lv_index[$i]['maxlevelIndex']+1;
      $sql_insert_learn = "INSERT INTO sub_state(state_id,order_id,level,level_index) 
      VALUES ('".$_GET['stateId']."','$orderNameLearn','".$_GET['level']."','$getLevelIndexTop')";
      mysqli_query($mysqli_insert_learn,$sql_insert_learn);
      // $_POST = array();
    }
    if (isset($_POST['questioncode']) && $datas_lv_index[$i]['levelindex'] == 0) {

      $sql_insert_learn = "INSERT INTO sub_state(state_id,order_id,level,level_index) 
      VALUES ('".$_GET['stateId']."','$orderNameQuestion','".$_GET['level']."',1)";
      mysqli_query($mysqli_insert_learn,$sql_insert_learn);
      // $_POST = array();
    }
    else if (isset($_POST['questioncode']) && $datas_lv_index[$i]['levelindex'] != 0) {
      $getLevelIndexTopQ = $datas_lv_index[$i]['maxlevelIndex']+1;
      $sql_insert_question = "INSERT INTO sub_state(state_id,order_id,level,level_index) 
      VALUES ('".$_GET['stateId']."','$orderNameQuestion','".$_GET['level']."','$getLevelIndexTopQ')";
      mysqli_query($mysqli_insert_learn,$sql_insert_question);
      // $_POST = array();
    }
    mysqli_close($mysqli_insert_learn);
} ?>

<?php 
	$mysqli_swap_order = new mysqli(DB_HOST , DB_USER , DB_PASS , DB_NAME) or die(mysqli_connect_error());
    	mysqli_set_charset($mysqli_swap_order,"utf8");

	    if(isset($_POST['index']))
	    {
		    $query_swap_order = "UPDATE sub_state SET level_index = 
		    (case level_index when '".$_POST['index']."' then '".$_POST['index']."'+1 
		    				  when '".$_POST['index']."'+1 then '".$_POST['index']."' 
		    				  else level_index 
		    				  end) where level = '".$_GET['level']."'";
		    $level_index = mysqli_query($mysqli_swap_order,$query_swap_order);
		}
	    mysqli_close($mysqli_swap_order);
?>
<?php 
    $mysqli_select_order = new mysqli(DB_HOST , DB_USER , DB_PASS , DB_NAME) or die(mysqli_connect_error());
    mysqli_set_charset($mysqli_select_order,"utf8");
    $query_create_order = "SELECT * FROM sub_state where state_id ='".$_GET['stateId']."' 
    						AND level = '".$_GET['level']."' ORDER BY level_index ASC";
    
    $result_order = mysqli_query($mysqli_select_order,$query_create_order);
    $datas_order = array();
    if (!empty($result_order)) {
        while ($data_order = $result_order->fetch_assoc()) {
            $datas_order[] = $data_order;
        }
      }
    mysqli_close($mysqli_select_order);
?>

<div class="container" style="width: 100%">
	<div class="col-md-12">
		<form action="" method="POST">
			<div class="form-group">
				<h1 class="text-center"><?php echo 'Level '.$_GET["level"]; ?></h1>
	            <div class="row">
	                <div class="col-md-3">
	                    <label for="">Learn Code :</label>
	                </div>
                    <input type="hidden" class="form-control" name="learncode" value="1" placeholder="Ex. 1-T" required />
	                <div class="col-md-5">
						<center class="float-right">	
			                <button type="submit" 
									class="btn btn-success" 
									onClick='location.href="?level=<?php echo $_GET['level'];?>&&stateId=<?php echo $_GET['stateId'];?>"'>Create Learn
							</button>
						</center>
		            </div>
	            </div>
	        </div>
		</form>
	</div>
	<div class="col-md-12">
		<form action="" method="POST">
			<div class="form-group">
	            <div class="row">
	                <div class="col-md-4">
	                    <label for="">Question Code :</label>
	                </div>
	                <input type="hidden" class="form-control" name="questioncode" value="1" placeholder="Ex. 1-Q" required />
	                <div class="col-md-5">
						<center>	
			                <button type="submit" 
									class="btn btn-success" 
									style=""
									onClick='location.href="?level=<?php echo $_GET['level'];?>&&stateId=<?php echo $_GET['stateId'];?>"'>Create Question
							</button>
						</center>
		            </div>
	            </div>
	        </div>
		</form>
	</div>
	</div>
	<div class="clearfix"></div>
	</div> <!-- Close form createLevelSubject.php -->
	<div class="col-md-6">
		<div class="container" style="width: 100%;">
			<div class="row">
				<div class="col-md-12">
					<?php if (!empty($datas_order)) { ?>
						<h1 class="text-center">List Level <?= $_GET["level"]; ?></h1>
						<div class="container" style="width: 100%;">
							<div class="row" style="margin-top: 27px;">
							<?php for ($i=0; $i<count($datas_order); $i++) { ?>
								<div class="col-md-10">
									<button type="button" 
										class="btn btn-info" 
										style="width: 100%;margin:10px 0 0 0;"
										onClick='location.href="?level=<?php echo $_GET['level'];?>&&stateId=<?php echo $_GET['stateId'];?>&&orderId=<?php echo $datas_order[$i]['order_id'];?>"'>
										<?php echo $datas_order[$i]['order_id']; ?>
									</button>
								</div>
								<?php if ($i!=0){ ?>
									<div class="col-md-2" style="margin-top: 10px;">
										<form action="" method="post">
											<input type="hidden" name="test" value="<?=$i;?>">
											<button class="btn btn-primary"
													name="index"
													value="<?=$i;?>">
													<i class="fa fa-angle-up" aria-hidden="true"></i>
											</button>
										</form>
									</div>
								<?php } ?>
							<?php } ?>
							</div>
						</div>
					<?php } ?>
				</div>
				<div class="col-md-12">
					<?php 
						if (isset($_GET['orderId'])) {
							$typeName = $_GET['orderId'];
							$typeOrder = explode("-",$typeName);
							$typeOrder = end($typeOrder);

							if ($typeOrder == "Learning") {
								include 'createLearnInfo.php';
							}
							if ($typeOrder == "Question") {
								include 'createQuestionInfo.php';
							}
						}    
					?>
				</div>
			</div>
		</div>
	</div>
<!-- </div> -->
