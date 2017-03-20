<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Vocab Teach: Learn Languages</title>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <link rel="stylesheet" href="style2.css">
        <style>
            label{
                float: left;
            }
            .float-right{
                float: right;
            }
            .dataTables_filter > label{
                float: right;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <nav class="navbar navbar-inverse">
                  <div class="container-fluid">
                    <div class="navbar-header">
                      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span> 
                      </button>
                      <a class="navbar-brand" href="#">Vocab Teach</a>
                    </div>
                    <div class="collapse navbar-collapse" id="myNavbar">
                      <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a onClick='location.href="?main"'>Home</a>
                            </li>
                            <li>
                                <a onClick='location.href="?createSubject"'>Create Subject</a>
                            </li>
                            <li>
                                <a onClick='location.href="?learnlog"'>Show Learn</a>
                            </li>
                            <li>
                                <a onClick='location.href="?questionlog"'>Show Question</a>
                            </li>
                            <li>
                                <a href="login.php">Log out</a>
                            </li>
                        </ul>
                    </div>
                  </div>
                </nav>
                <div class="row">
                    <div class="col-md-12">
                        <div class="container-fluid">
                            <?php
                             if($_GET){
                                if (isset($_GET['main'])) {
                                    include 'components/comIndex.php';
                                }
                                else if (isset($_GET['createSubject'])) {
                                    include 'Used/createSub.php';
                                }
                                else if (isset($_GET['learnlog'])) {
                                    include 'components/comLearnLog.php';
                                }
                                else if (isset($_GET['questionlog'])) {
                                    include 'components/comQuestionLog.php';
                                }
                                else if (isset($_GET['stateId'])) {
                                    include 'Used/createLevelsubject.php';
                                }
                                else if (isset($_GET['UpdateLearnId'])) {
                                    include 'updateLearn.php';
                                }
                                else if (isset($_GET['UpdateQuestionId'])) {
                                    include 'updateQuestion.php';
                                } 
                                else if (isset($_GET['UpdateAnswerId'])) {
                                    include 'updateAnswer.php';
                                } 
                             }else{
                                    include 'components/comIndex.php';
                             }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- jQuery -->
        <script src="//code.jquery.com/jquery.js"></script>
        <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
        <!-- Bootstrap JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <!-- <script src="http://malsup.github.com/jquery.form.js"></script>  -->
        <!-- <script src="control.js"></script> -->
        <script>
            $(document).ready(function() {
                $('#example').DataTable();
            } );
        </script>
    </body>
</html>