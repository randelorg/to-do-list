<?php
    $link = mysqli_connect("localhost", "root", "", "todoapp");

    if($link === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    $new_task = $_POST['new_task'];
    $status = 'unchecked';

    $sql = "INSERT INTO todolist (task_name, status)
    VALUES ('$new_task', '$status')";

    if(mysqli_query($link, $sql)){
        echo '<script>alert("Added succesfully")</script>';
        header("Location: ../index.php");
        exit();
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }

    // Close connection
    mysqli_close($link);