<?php
  require_once "api/connection.php";
  session_start();
  if (isset($_SESSION['user1']) && !empty($_SESSION["user1"])) {
    $data1 = unserialize($_SESSION['user1']);
  }
  
//   $idp1 = $_GET[$data1['id']];
//   $sql = "SELECT * FROM game3 WHERE `id_team1` = '$idp' limit 1"

//   $query = mysqli_query($con, $sql);

//   $data = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SUDOKU</title>
    <link rel="stylesheet" type="text/css" href="css/score.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Changa:wght@500&display=swap" rel="stylesheet">

</head>

<body>
    <div class="container">
        <div class="align-middle">
            <div class="row align-items-center" style="min-height: 100vh;">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                <input type="hidden" name="idp1" id="idp1" value="<?php echo $data1['id'] ?>">

                <table class="table text-center" id="tableabsen">
                    <thead id="absentHeader">
                        
                    </thead>
                    <tbody id="absentTable">
                    </tbody>
                </table>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </div>

    <script src="js/score.js"></script>
    <script>load_score()</script>
    <script>
        let gameState = {
            "player": [{
                "id":0,
                "name": "Dummy1"
            }]
        };
        gameState.player[0].id = "<?php echo $data1['id'] ?>";
        gameState.player[0].name = "<?php echo $data1['username'] ?>";

        function refresh() {
            window.location.href = "highScore.php"
        }

        function returnLogin(){
            window.location.replace("loginPage.php");
        }

        $(document).ready(function() {

            if (<?php echo (isset($_SESSION['user1']) && !empty($_SESSION["user1"])) ? 'true' : 'false' ?>) {
                $('#p1loginform').hide();
            }

            $('#btnHowToPlay').click(function(event) {
                $("#howtoplaymodal").modal('show');
            });

            $('#logout1').click(function(event) {
                event.preventDefault();
                $.ajax({
                    type: "GET",
                    url: 'api/logout.php?user=1',
                    success: function(response) {
                        $('#alertmodalsuccess').modal('show');
                    },
                    error: function() {
                        $('#alertmodalfail').modal('show');
                    }
                });
            });

            $('#login1').click(function(event) {
                event.preventDefault();
                let username = $('#inputUsernameP1').val();
                let password = $('#inputPasswordP1').val();

                if (username && password) {
                    let data = new FormData();
                    data.append("username", username);
                    data.append("password", password);
                    data.append("user", 1);

                    $.ajax({
                        type: "POST",
                        data: data,
                        url: 'api/login.php',
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            response = $.parseJSON(response);
                            $('#alertmodalsuccess').modal('show');

                        },
                        error: function() {
                            $('#alertmodalfail').modal('show');
                        }
                    });
                } else {

                }
            });

        });
    </script>
</body>

</html>