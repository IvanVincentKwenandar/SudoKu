<?php
    include_once "connection.php";
    session_start();

    $id_game = $_POST['id'];
    $timer = (int)$_POST['timer'];
    $score = (int)$_POST['score'];
    $id_team1 = (int)$_POST['idp1'];

    $sql = "INSERT INTO game3(id, time, score, id_team1) VALUES ('$id_game',$timer,$score,$id_team1)";
    $result = mysqli_query($con, $sql);
    echo $result;
?>