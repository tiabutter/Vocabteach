<?php 
    $mysqli_select_imgCount = new mysqli(DB_HOST , DB_USER , DB_PASS , DB_NAME) or die(mysqli_connect_error());
    mysqli_set_charset($mysqli_select_imgCount,"utf8");
    
    $query_select_img = "SELECT COUNT(image_group) as imageGroupCount FROM teach";
    
    $result_imgCount = mysqli_query($mysqli_select_imgCount,$query_select_img);

    $datas_imgCount = array();
    if (!empty($result_imgCount)) {
        while ($data_imgCount = $result_imgCount->fetch_assoc()) {
            $datas_imgCount[] = $data_imgCount;
        }
      }
    mysqli_close($mysqli_select_imgCount);
?>
<?php 
    $mysqli_insert_info_learn = new mysqli(DB_HOST , DB_USER , DB_PASS , DB_NAME) or die(mysqli_connect_error());
    mysqli_set_charset($mysqli_insert_info_learn,"utf8");
    for ($i=0; $i<count($datas_imgCount); $i++) { 
        $imgGroup_num = $datas_imgCount[$i]['imageGroupCount']+isset($_POST['imagegroup']);
        $imgGroupName = "Learning-img-".$imgGroup_num;
    }
    $ran_voice_name = rand();
    $newVoicePath = './voices/'.'voice'.$ran_voice_name;
    if (isset($_POST['word']) && 
        isset($_POST['meaning']) && 
        isset($_POST['imagegroup']) &&
        isset($_FILES['voice']['name'])) 
    {
        $voice_name = $_FILES['voice']['name'];
        $typeVoice = explode(".",$voice_name);
        $typeVoice = end($typeVoice);
            if($typeVoice == "wav" || $typeVoice == "WAV" || $typeVoice == "MP3" || $typeVoice == "mp3")
            {
                $pathVoice = $newVoicePath.".".$typeVoice;
                if(move_uploaded_file($_FILES['voice']['tmp_name'],$pathVoice))
                {           
                    $sql_insert_info_learn = "INSERT teach(state_id,teach_id,word,meaning,voice,image_group) values(
                              '".$_GET['stateId']."',
                              '".$_GET['orderId']."',
                              '".$_POST['word']."',
                              '".$_POST['meaning']."','$pathVoice',
                              '$imgGroupName')";
                    mysqli_query($mysqli_insert_info_learn,$sql_insert_info_learn);
                }
            }
            else{ echo "Error Type"; }
    }
    mysqli_close($mysqli_insert_info_learn);
?>
<?php 
    $mysqli_img = new mysqli(DB_HOST , DB_USER , DB_PASS , DB_NAME) or die(mysqli_connect_error());
    mysqli_set_charset($mysqli_img,"utf8");
            
    $sql_img = "SELECT image_group FROM teach WHERE teach_id = '".$_GET['orderId']."'";
    $result_img = mysqli_query($mysqli_img,$sql_img);
    $imgs = array();
    
    if (!empty($result_img)) {
        while ($img = $result_img->fetch_assoc()) {
            $imgs[] = $img;
        }
    }
    mysqli_close($mysqli_img);
?>
<?php  
    $mysqli_select_all_Learn = new mysqli(DB_HOST , DB_USER , DB_PASS , DB_NAME) or die(mysqli_connect_error());
    mysqli_set_charset($mysqli_select_all_Learn,"utf8");
            
    $sql_select_all_Learn = "SELECT * FROM teach WHERE teach_id = '".$_GET['orderId']."'";
    $result_all_learn = mysqli_query($mysqli_select_all_Learn,$sql_select_all_Learn);
    $learns_all = array();
    
    if (!empty($result_all_learn)) {
        while ($learn_all = $result_all_learn->fetch_assoc()) {
            $learns_all[] = $learn_all;
        }
    }
    mysqli_close($mysqli_select_all_Learn);
?>
<?php 
    $mysqli_hasGroup = new mysqli(DB_HOST , DB_USER , DB_PASS , DB_NAME) or die(mysqli_connect_error());
    mysqli_set_charset($mysqli_hasGroup,"utf8");
            
    $sql_hasGroup = "SELECT COUNT(image_group) as hasImgGroup FROM teach WHERE teach_id = '".$_GET['orderId']."'";
    $result_hasGroup = mysqli_query($mysqli_hasGroup,$sql_hasGroup);
    $datas_has_group = array();
    
    if (!empty($result_hasGroup)) {
        while ($data_has_group = $result_hasGroup->fetch_assoc()) {
            $datas_has_group[] = $data_has_group;
        }
    }
    mysqli_close($mysqli_hasGroup);
?>
<div class="container" style="width: 100%;margin-top: 10px">
    <h1 class="text-center"><?=$_GET["orderId"];?></h1>
        <?php for ($i=0; $i<count($datas_has_group) ; $i++) { ?>
            <?php if ($datas_has_group[$i]['hasImgGroup'] == 0 ){ ?>
            <form action="" method="POST" enctype="multipart/form-data" style="margin-bottom:20px;">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Word :</label>
                        </div>
                        <div class="col-md-12">
                            <input type="text" name="word" class="form-control" id="" placeholder="Word" required/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Meaning :</label>
                        </div>
                        <div class="col-md-12">
                            <input type="text" name="meaning" class="form-control" id="" placeholder="Meaning" required/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Voice :</label>
                        </div>
                        <div class="col-md-12">
                            <input type="file" name="voice" placeholder="Voice" required/>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="imagegroup" value="1" class="form-control" />
                <center>  
                    <button type="submit" value="Upload" class="btn btn-success">Save</button>
                </center>  
            </form>
            <?php } ?>
        <?php } ?>
        <?php for ($i=0; $i<count($imgs); $i++) { 
            $_SESSION["val_img"] = $imgs[$i]['image_group'];
              include 'createLearnImg.php';
        } ?>
</div>