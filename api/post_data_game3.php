<?php
    include_once "connection.php";
    session_start();

    $id_game = $_POST['id'];
    $timers = (int)$_POST['timers'];
    $score = (int)$_POST['score'];
    $id_team1 = (int)$_POST['idp1'];
    $difficulties = $_POST['difficulties'];

    $sql = "INSERT INTO `game3` (`id`, `time`, `score`, `id_team1`, `difficulties`) VALUES ('$id_game',$timers,$score,$id_team1,$difficulties)";
    $result = mysqli_query($con, $sql);
    echo $result;
?>