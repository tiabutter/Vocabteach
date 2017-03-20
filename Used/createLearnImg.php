<?php 
    $mysqli_learn_img = new mysqli(DB_HOST , DB_USER , DB_PASS , DB_NAME) or die(mysqli_connect_error());
    mysqli_set_charset($mysqli_learn_img,"utf8");
    $imageGroup=array();
    if(!empty($_FILES['image']['name'])){
        foreach ($_FILES['image']['name'] as $position => $name) {
            $ran_name = rand();
            $newFilePath = './images/'.'img'.$ran_name;
            if($_FILES['image']['type'][$position] == "image/jpeg" || 
                $_FILES['image']['type'][$position] == "image/png")
            {
                $typeNameImg = $_FILES['image']['type'][$position];
                $typeImg = explode("/",$typeNameImg);
                $typeImg = end($typeImg);

                $pathImg = $newFilePath.".".$typeImg;
                if(move_uploaded_file($_FILES['image']['tmp_name'][$position],$pathImg))
                {
                    $imageGroup[] = array(
                        'image_name'=>$name,
                        'path_image'=>$pathImg   
                    );
                    
                    $sql_learn_img = "INSERT INTO image(state_id,image_group,path_image,image_name) values('".$_GET['stateId']."','".$_SESSION["val_img"]."','$pathImg','$name')";
                    mysqli_query($mysqli_learn_img,$sql_learn_img);
                }
            }
            else{
                echo 'Error type';
            }
        }
    }   
?>
<?php 
    $mysqli_log_learn = new mysqli(DB_HOST , DB_USER , DB_PASS , DB_NAME) or die(mysqli_connect_error());
    mysqli_set_charset($mysqli_log_learn,"utf8");
    
    $query_log_learn = "SELECT * FROM state JOIN teach ON teach.state_id = state.state_id WHERE state.state_id = teach.state_id";
    
    $result_log_learn = mysqli_query($mysqli_log_learn,$query_log_learn);

    $datas_log_learn = array();
    while ($data_log_learn = $result_log_learn->fetch_assoc()) {
        $datas_log_learn[] = $data_log_learn;
    }
    mysqli_close($mysqli_log_learn);
?>
<form action="" method="post" enctype="multipart/form-data" style="margin-top: 10px;">
	<div class="form-group">
        <div class="row">
            <div class="col-md-12">
                <label for="">Picture :</label>
            </div>
            <div class="col-md-12">
                <input type="file" 
                       name="image[]" 
                       placeholder="Picture" 
                       multiple
                       style="width: 100%;" /><br />
                <!-- <div class="progress progress-striped active">
                    <div class="progress-bar" style="width: 0%;">
                        <p id="msg"></p>
                    </div>
                </div> -->
                <!-- <div class="show-img"></div> -->
            </div>
            <div class="col-md-12">
                <?php for ($i=0; $i <count($datas_log_learn) ; $i++) { 
                    $_SESSION["img"][$i] = $datas_log_learn[$i]['image_group'];
                    $mysqli_log_img = new mysqli(DB_HOST , DB_USER , DB_PASS , DB_NAME) or die(mysqli_connect_error());
                    mysqli_set_charset($mysqli_log_img,"utf8");
                    $query_log_img = "SELECT * FROM image WHERE image_group ='".$_SESSION["img"][$i]."'
                    ";                    
                    $result_log_img = mysqli_query($mysqli_log_img,$query_log_img);
                    $datas_log_img = array();
                    while ($data_log_img = $result_log_img->fetch_assoc()) {
                        $datas_log_img[] = $data_log_img;
                    }
                    mysqli_close($mysqli_log_img);

                    for ($j=0; $j<count($datas_log_img); $j++) {?>
                    <a href="<?= $datas_log_img[$j]['path_image'];?>">
                        <img src="<?= $datas_log_img[$j]['path_image'];?>" 
                             alt="img" 
                             width="50" 
                             height="50"
                             style="object-fit: cover;">&nbsp;
                    </a>
                    <?php } ?>
                <?php } ?>
            </div>
            <div class="col-md-12" style="margin-top:15px;">
                <div class="alert alert-warning">
                  <strong>Warning !</strong> Only use files png / jpg 
                </div>
            </div>
            <div class="col-md-12">
                <center>
                    <button type="submit" value="Upload" class="btn btn-success">
                        Upload
                    </button>
                </center>
            </div>
        </div>
    </div>
</form>

