<?php
    $taskList = $_POST['taskList'];
    session_start();
    $username =  $_SESSION['username'];
    $userfile = "list_" . $username . ".json";
    file_put_contents($userfile, $taskList);
?>
