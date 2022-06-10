<?php
    require_once "api/connection.php";
    session_start();
    if (isset($_SESSION['user1']) && !empty($_SESSION["user1"])) {
        $data1 = unserialize($_SESSION['user1']);
    }
    $sg = "disabled";
    if ((isset($_SESSION['user1']) && !empty($_SESSION["user1"]))) {
        $sg = "";
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SUDOKU</title>
    <link rel="stylesheet" type="text/css" href="style.css">
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
    <!-- Modal Alert-->
    <div class="modal fade" id="alertmodalsuccess" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="background-color: #f0e7dc;">
                <div class="modal-body text-center">
                    <div class="svg-box">
                        <svg class="circular green-stroke">
                            <circle class="path" cx="75" cy="75" r="50" fill="none" stroke-width="5" stroke-miterlimit="10" />
                        </svg>
                        <svg class="checkmark green-stroke">
                            <g transform="matrix(0.79961,8.65821e-32,8.39584e-32,0.79961,-489.57,-205.679)">
                                <path class="checkmark__check" fill="none" d="M616.306,283.025L634.087,300.805L673.361,261.53" />
                            </g>
                        </svg>
                    </div>
                    <h2 style="color:#7CB342;">Success</h2>
                    <div class="text-center mt-5">
                        <button type="button" class="btn btn-outline-success" onclick="refresh()">Continue</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="alertmodalfail" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="background-color: #f0e7dc;">
                <div class="modal-body text-center">
                    <div class="svg-box">
                        <svg class="circular red-stroke">
                            <circle class="path" cx="75" cy="75" r="50" fill="none" stroke-width="5" stroke-miterlimit="10" />
                        </svg>
                        <svg class="cross red-stroke">
                            <g transform="matrix(0.79961,8.65821e-32,8.39584e-32,0.79961,-502.652,-204.518)">
                                <path class="first-line" d="M634.087,300.805L673.361,261.53" fill="none" />
                            </g>
                            <g transform="matrix(-1.28587e-16,-0.79961,0.79961,-1.28587e-16,-204.752,543.031)">
                                <path class="second-line" d="M634.087,300.805L673.361,261.53" />
                            </g>
                        </svg>
                    </div>
                    <h2 style="color:#FF6245;">Error</h2>
                    <div class="text-center mt-5">
                        <button type="button" class="btn btn-outline-danger" onclick="refresh()">Continue</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="howtoplaymodal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">

                <div class="modal-header" style="background-color: #523322;">
                    <h5 class="modal-title">How To Play</h5>
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal" aria-label="Close">Close</button>
                </div>

                <div class="modal-body text-black p-3" style="background-color: #f0e7dc;">
                    <h1 class="text-center mb-5">ATURAN PERMAINAN SUDOKU</h1>

                    <h3 class="mt-3">TUJUAN DARI PERMAINAN</h3>
                    <p>Tujuan dari permainan ini adalah mengisi semua grid dengan angka 1-9.</p>
                    <br>
                    <p>Angka yang diisi tidak boleh ada di dalam baris dan kolom pada lokasi yang diisikan, jika sudah ada angka yang sama maka harus diganti dengan angka yang lainnya. </p>
                    
                    <h1 class="text-center mt-5">PENILAIAN PERMAINAN</h1>
                    <p>Poin didasarkan pada durasi permainan dimana semakin cepat diselesaikan maka akan semakin besar poin yang didapatkan.</p>
                    <p>Anda dapat menggunakan fitur "HINT" yang dimana akan memberikan 1 posisi tepat pada grid Sudoku, namun tiap kali penggunaan "HINT" akan menambahkan waktu 1 menit ke timer anda.</p>
                    <p>Anda dapat menggunakan fitur "RESTART" untuk mengulang kembali permainan pada grid Sudoku yang anda mainkan.</p>
                    <p>Anda dapat menggunakan fitur "SURRENDER" kapan pun bila merasa tidak mampu menyelesaikan permainan yang telah anda mulai ;)</p>
                    <h3 class="mt-3">PENGALI SKOR AKHIR</h3>
                    <p>Tingkat kesulitan yang anda pilih akan sangat mempengaruhi poin akhir yang akan anda dapatkan, dimana poin yang didapatkan akan dikalikan dengan pengali sesuai tingkat kesulitan yang dipilih.</p?>
                    <p>1. Very Easy: 1x</p>
                    <p>2. Easy: 1.5x</p>
                    <p>3. Normal: 2x</p>
                    <p>4. Hard: 2.5x</p>
                    <p>5. Very Hard: 3x</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="align-middle">
            <div class="row align-items-center" style="min-height: 100vh;">
                <div class="col-md-3 my-auto"></div>
                <div class="col-md-6 my-auto">
                    <?php
                    if (isset($_SESSION['user1']) && !empty($_SESSION["user1"])) {
                        echo '<h2 class="text-center mb-4">Player</h2>';
                        echo '<div class="text-center ">';
                        echo '<div class="p-3 mb-4 scale-in-ver-center" style="outline: solid #523322 5pt; border-radius: 5px; color: black; background-color: #f0e7dc;">';
                        echo '<h3>' . $data1['username'] . '</h3>';
                        echo '<h4>' . $data1['asal_sekolah'] . '</h4>';
                        echo '</div>';
                        echo '<button class="btn btn-outline-warning" onclick="startgame()" <?php echo $sg ?>>Start Game</button>';
                        echo '<button class="btn btn-outline-warning" id="btnHowToPlay">How to play</button>';
                        echo '<button onclick="highscore()" class="btn btn-outline-warning" id="btnHowToPlay">High Score</button>';
                        echo '<button class="btn btn-outline-danger" id="logout1">Logout</button></div>';
                    }
                    ?>

                    <div id="p1loginform">
                        <h2 class="text-center mb-4">Login</h2>
                        <div class="mb-3">
                            <label for="inputUsernameP1" class="form-label">Username</label>
                            <input type="text" class="form-control" id="inputUsernameP1">
                        </div>
                        <div class="mb-3">
                            <label for="inputPasswordP1" class="form-label">Password</label>
                            <input type="password" class="form-control" id="inputPasswordP1">
                        </div>
                        <div class="text-center mt-4">
                            <button class="btn btn-lg btn-outline-warning" id="login1">Login</button>
                        </div>
                        <!-- <div class="text-center mt-4">
                            <button class="btn btn-lg mb-4 btn-outline-warning" onclick="startgame()" <?php echo $sg ?>>Start Game</button>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-lg btn-outline-warning" id="btnHowToPlay">How to play</button>
                        </div> -->
                        
                        
                    </div>
                </div>
                <div class="col-md-3 my-auto"></div>
            </div>
        </div>
    </div>


    <script>
        function makeid() {
            var text = "";
            var possible = "abcdefghijklmnopqrstuvwxyz0123456789";

            for (let i = 0; i < 6; i++)
                text += possible.charAt(Math.floor(Math.random() * possible.length));

            return text;
        }

        function startgame() {
            window.location.href = "game.php?id=" + makeid();
        }

        function refresh() {
            window.location.href = "loginPage.php"
        }

        function highscore(){
            window.location.href = "highScore.php";
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