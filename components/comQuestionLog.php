<?php 
    include './connect.php';

    $mysqli_log_ques = new mysqli(DB_HOST , DB_USER , DB_PASS , DB_NAME) or die(mysqli_connect_error());
    mysqli_set_charset($mysqli_log_ques,"utf8");
    $query_log_ques = "SELECT * FROM question JOIN answer ON question.answer_id = answer.answer_id;";
    
    $result_log_ques = mysqli_query($mysqli_log_ques,$query_log_ques);

    $datas_log_ques = array();

    if (!empty($result_log_ques)) {

        while ($data_log_ques = $result_log_ques->fetch_assoc()) {
            $datas_log_ques[] = $data_log_ques;
        }
      }
    mysqli_close($mysqli_log_ques);
?>

<div class="panel panel-default">
  <div class="panel-heading">Question Log</div>
  <div class="panel-body">
    <table id="example" class="table table-striped table-bordered text-center" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th class="text-center">Subject Name</th>
                <th class="text-center">Question Code</th>
                <th class="text-center">Question Name</th>
                <th class="text-center">Correct Answer</th>
                <th class="text-center">Answer 1</th>
                <th class="text-center">Answer 2</th>
                <th class="text-center">Answer 3</th>
                <th class="text-center">Answer 4</th>
                <th class="text-center">Edit / Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php for($i=0; $i <count($datas_log_ques) ; $i++) { 
                $_SESSION['answer_id'] = $datas_log_ques[$i]['answer_id'];
                $_SESSION['order_ques'] = $datas_log_ques[$i]['question_id'];
                $_SESSION['state_id'] = $datas_log_ques[$i]['state_id']; ?>
                <tr>
                    <td>
                        <?php 
                            $mysqli_log_state = new mysqli(DB_HOST , DB_USER , DB_PASS , DB_NAME) or die(mysqli_connect_error());
                            mysqli_set_charset($mysqli_log_state,"utf8");
                            $query_log_state = "SELECT * FROM state JOIN question  ON question.state_id = state.state_id GROUP BY state.state_id";
                            
                            $result_log_state = mysqli_query($mysqli_log_state,$query_log_state);

                            $datas_log_state = array();

                            if (!empty($result_log_state)) {

                                while ($data_log_state = $result_log_state->fetch_assoc()) {
                                    $datas_log_state[] = $data_log_state;
                                }
                              }
                            mysqli_close($mysqli_log_state);
                        ?>
                        <?php 
                            for ($j=0; $j <count($datas_log_state); $j++) { 
                                echo $datas_log_state[$j]['state_name'];
                            }
                        ?>                            
                    </td>
                    <td><?php echo $datas_log_ques[$i]['question_id']; ?></td>
                    <td><?php echo $datas_log_ques[$i]['question_name']; ?></td>
                    <td><?php echo $datas_log_ques[$i]['correct']; ?></td>
                    <td><?php echo $datas_log_ques[$i]['answer1']; ?></td>
                    <td><?php echo $datas_log_ques[$i]['answer2']; ?></td>
                    <td><?php echo $datas_log_ques[$i]['answer3']; ?></td>
                    <td><?php echo $datas_log_ques[$i]['answer4']; ?></td>
                    <td>
                        <form method="GET">
                            <button name="UpdateQuestionId" value="<?=$datas_log_ques[$i]['question_id'];?>" class="btn btn-info">
                                Edit Name
                            </button>
                        </form>
                        <form method="GET">
                            <button   
                                    class="btn btn-warning"
                                    name="UpdateAnswerId"
                                    value="<?= $_SESSION['answer_id'];?>">
                                    Edit Ans
                            </button>
                            <input type="hidden" name="stateUpdate" value="<?= $datas_log_ques[$i]['state_id']; ?>">
                            <input type="hidden" name="questionUpdate" value="<?= $datas_log_ques[$i]['question_id']; ?>">
                        </form>
                        <a href="./deleteQuestion.php?DeleteQuestionId=<?=$datas_log_ques[$i]['question_id'];?>" class="btn btn-danger" onClick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>

            <?php } ?>
        </tbody>
    </table>
    <div class="clearfix"></div>
  </div>
</div>