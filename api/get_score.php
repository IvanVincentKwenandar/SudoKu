<?php
    include_once "connection.php";
    session_start();

    header("Content-Type: application/json");

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $id_team1 = (int)$_GET['idp1'];

        $sql = "SELECT * FROM game3 WHERE `id_team1` = $id_team1 ORDER BY `difficulties` DESC";
        $query = mysqli_query($con, $sql);

        $result = array();
        while($row = mysqli_fetch_assoc($query)) {
            array_push($result, $row);
        }

        $result_count = count($result);
        $final_result = array(
            "data" => '-',
        );

        $temp_result = array();
        for($i=0; $i<$result_count; $i++){
            $temp = array(
                "idp1" => '-',
                "time" => '-',
                "score" => '-',
                "difficulties" => '-',
                "id" => '-'
            );
            
            $temp['idp1'] = $result[$i]['id_team1'];
            $temp['time'] = $result[$i]['time'];
            $temp['score'] = $result[$i]['score'];
            $temp['difficulties'] = $result[$i]['difficulties'];
            $temp['id'] = $result[$i]['id'];

            array_push($temp_result, $temp);
        }
        $final_result['data'] = $temp_result;

        echo json_encode($final_result);
    }else {
        header("HTTP/1.1 400 Bad Request");
        $error = array(
            'error' => 'Method not Allowed'
        );
    
        echo json_encode($error);
    }
?>