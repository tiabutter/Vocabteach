<?php 
    include 'connect.php';
        $mysqli_learn_update = new mysqli(DB_HOST , DB_USER , DB_PASS , DB_NAME) or die(mysqli_connect_error());
        mysqli_set_charset($mysqli_learn_update,"utf8");
        $ran_voice_range = rand();
        $newVoicePath_Update = './voices/'.'voice'.$ran_voice_range;

        if(isset($_POST['wordupdate']) && isset($_POST['meaningupdate']) && 
            isset($_FILES['voiceupdate']['name']) ) {
            $voice_update = $_FILES['voiceupdate']['name'];
            $typeVoice = explode(".",$voice_update);
            $typeVoice = end($typeVoice);
            if($typeVoice == "WAV" || $typeVoice == "wav" || $typeVoice == "MP3" || $typeVoice == "mp3" )
            {
                echo $typeVoice;
                $pathVoice = $newVoicePath_Update.".".$typeVoice;
                if(move_uploaded_file($_FILES['voiceupdate']['tmp_name'],$pathVoice))
                {            
                    $query_learn_update = "UPDATE teach SET word='".$_POST['wordupdate']."',meaning='".$_POST['meaningupdate']."', voice='$pathVoice' 
                    WHERE teach_id = '".$_GET["UpdateLearnId"]."'";
                    mysqli_query($mysqli_learn_update,$query_learn_update);
                    header('Location: http://www.realtime-dev.com/?learnlog');
                }
            }
            else{ echo "Error Type"; }   
        }
         mysqli_close($mysqli_learn_update);
?>

<div class="panel panel-default">
  <div class="panel-heading">Update Learn Log</div>
  <div class="panel-body">
    <form action="" method="POST" role="form" enctype="multipart/form-data">
        <legend>Update Learn Form</legend>
        <div class="form-group">
            <div class="row">
                <div class="col-md-5">
                    <label for="" class="float-right">Word :</label>
                </div>
                <div class="col-md-5">
                    <input type="text" name="wordupdate" class="form-control" id="" placeholder="Word" required/>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-5">
                    <label for="" class="float-right">Meaning :</label>
                </div>
                <div class="col-md-5">
                    <input type="text" name="meaningupdate" class="form-control" id="" placeholder="Meaning" required/>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-5">
                    <label for="" class="float-right">Voice :</label>
                </div>
                <div class="col-md-5">
                    <input type="file" name="voiceupdate" placeholder="Voice" required/>
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