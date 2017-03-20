<?php 
    include './connect.php';

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

<?php 
    $mysqli_delete_learn = new mysqli(DB_HOST , DB_USER , DB_PASS , DB_NAME) or die(mysqli_connect_error());
    mysqli_set_charset($mysqli_delete_learn,"utf8");
    
    if (isset($_GET['DeleteLearnId'])) {
        $query_delete_learn = "DELETE FROM teach WHERE teach_id = $DeleteLearnId";
    
        $result_delete_learn = mysqli_query($mysqli_delete_learn,$query_delete_learn);  
    }
    mysqli_close($mysqli_delete_learn); ?>
<div class="panel panel-default">
  <div class="panel-heading">Learn Log</div>
  <div class="panel-body">
    <table id="example" class="table table-striped table-bordered text-center" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th class="text-center">Subject Name</th>
                <th class="text-center">Learn Code</th>
                <th class="text-center">Word</th>
                <th class="text-center">Meaning</th>
                <th class="text-center">Voice</th>
                <th class="text-center">Image</th>
                <th class="text-center">Edit / Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php for($i=0; $i <count($datas_log_learn); $i++) { ?>
                <tr>
                    <td><?php echo $datas_log_learn[$i]['state_name']; ?></td>
                    <td><?php echo $datas_log_learn[$i]['teach_id']; ?></td>
                    <td><?php echo $datas_log_learn[$i]['word']; ?></td>
                    <td><?php echo $datas_log_learn[$i]['meaning']; ?></td>
                    <td>
                        <a href="<?php echo $datas_log_learn[$i]['voice']; ?>">
                            <?php echo $datas_log_learn[$i]['voice']; ?>
                        </a>
                    </td>
                    <td>
                        <?php 
                            $_SESSION["log"][$i] = $datas_log_learn[$i]['image_group'];
                            $mysqli_log_img = new mysqli(DB_HOST , DB_USER , DB_PASS , DB_NAME) or die(mysqli_connect_error());
                            mysqli_set_charset($mysqli_log_img,"utf8");
                            $query_log_img = "SELECT * FROM image WHERE image_group ='".$_SESSION["log"][$i]."'
                            ";
                            
                            $result_log_img = mysqli_query($mysqli_log_img,$query_log_img);
                            $datas_log_img = array();
                            while ($data_log_img = $result_log_img->fetch_assoc()) {
                                $datas_log_img[] = $data_log_img;
                            }
                            mysqli_close($mysqli_log_img);
                            for ($j=0; $j<count($datas_log_img); $j++) {?>
                            <a href="<?= $datas_log_img[$j]['path_image'];?>">
                                <?= $datas_log_img[$j]['image_name'];?>&nbsp;
                            </a>
                            
                        <?php } ?>
                    </td>
                    <td>
                        <form method="GET">
                            <button name="UpdateLearnId" value="<?=$datas_log_learn[$i]['teach_id']; ?>" class="btn btn-info">
                                Edit
                            </button>
                            <a href="./deleteLearn.php?DeleteLearnId=<?=$datas_log_learn[$i]['teach_id'];?>" class="btn btn-danger" onClick="return confirm('Are you sure?')">Delete</a>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

<!-- Modal -->
    <div class="clearfix"></div>
  </div>
</div>