<?php
  require_once "api/connection.php";
  session_start();
  if (isset($_SESSION['user1']) && !empty($_SESSION["user1"])) {
    $data1 = unserialize($_SESSION['user1']);
  }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200&family=Source+Sans+Pro:wght@200&display=swap" rel="stylesheet">
    <title>Sudoku</title>
</head>
<body>
    <nav class="app-bar">
        <button onclick="HamburgerButtonClick();" class="button bar-button hamburger-button">
          <span class="material-icons">Menu</span>
        </button>
        <div class="bar-font title">Sudoku</div>
        <div id="moreoption-sec" class="more-option-div more-button">
          <button onclick="moreOptionButtonClick()" class="button bar-button">
            <span>More</span>
          </button>
          <!-- it is important to put these styles in here because if I do not do that it will not work in javaScript-->
          <div id="more-option-list" style="visibility: hidden;max-height: 10px;max-width: 40px;min-width: 40px;" class="more-option-list">
            <button onclick="hintButtonClick()" ripple-color="#003c8f" class="button nav-item vertical-adjust">Hint</button>
            <button onclick="restartButtonClick()" ripple-color="#003c8f" class="button nav-item vertical-adjust">Restart</button>
            <button onclick="SurrenderButtonClick()" ripple-color="tomato" class="button nav-item vertical-adjust">Surrender</button>
          </div>
        </div>
      
        <!-- <button id="pause-btn" onclick="pauseGameButtonClick()" class="button bar-button more-button">
          
          <span id="pause-text">Pause</span>
        </button> -->
        <button id="check-btn" onclick="checkButtonClick()" class="button bar-button more-button">
          
          <span>Check</span>
        </button>
        <button id="isunique-btn" style="display: none;" onclick="isUniqueButtonClick();" class="button bar-button more-button">
          
          <span>Is unique</span>
        </button>
        <button id="solve-btn" style="display: none;" onclick="solveButtonClick()" class="button bar-button more-button">
          
          <span>Solve</span>
        </button>
      
      </nav>
      <br>
      <br>

      <div id="hamburger-menu" class="hamburger-menu">
        <nav id="nav-menu" class="nav-menu">
          <div class="nav-head">
            <div class="nav-head-img">
              <img src="https://image.ibb.co/jmuOKn/icon.jpg" art="" />
            </div>
            <div class="nav-head-title">Sudoku</div>
          </div>
          <ul class="nav-items">
            <button onclick="showDialogClick('dialog');" ripple-color="#003c8f" class="button nav-item vertical-adjust">
              <div>
               
                <span style="left:12px;">New game</span>
              </div>
            </button>
            <button onclick="showDialogClick('about-dialog');" ripple-color="#003c8f" class="button nav-item vertical-adjust">
              <div>
               
                <span style="left:12px;">About</span>
              </div>
            </button>
            <!-- <button onclick="logouts()" ripple-color="#003c8f" class="button nav-item vertical-adjust">
              <div>
               
                <span style="left:12px;">Exit</span>
              </div>
            </button> -->
            <div class="bar-footer">
              <ul>
                <a href="#" class="bar-footer-link">Site feedback</a>
                <a href="#" class="bar-footer-link">Privacy</a>
                <a href="#" class="bar-footer-link">Terms</a>
              </ul>
            </div>
          </ul>
        </nav>
        <div class="nav-menu-blank" onclick="hideHamburgerClick()">
      
        </div>
      </div>
      
      <div class="floating">
        <button onclick="showDialogClick('dialog');" class="button floating-btn vertical-adjust">
          <span class="material-icons">New Game</span>
        </button>
      </div>
      
      <div id="dialog" class="dialog">
        <div id="dialog-box" class="dialog-content">
          <div class="dialog-header">New game</div>
      
          <div class="dialog-body">
            <!-- <label for="Name">
              <input id="Name" type="text" name="Name" placeholder="Input your/team name">
            </label> -->
            <p>Select game difficulty to get started.</p>
            <ul>
              <li class="radio-option">
                <label for="very-easy">
                  <input id="very-easy" value="Very Easy" type="radio" name="difficulty"> Very easy
                </label>
              </li>
              <li class="radio-option">
                <label for="easy">
                  <input id="easy" value="Easy" type="radio" name="difficulty"> Easy
                </label>
              </li>
              <li class="radio-option">
                <label for="normal">
                  <input id="normal" value="Normal" type="radio" name="difficulty"> Normal
                </label>
              </li>
              <li class="radio-option">
                <label for="hard">
                  <input id="hard" value="Hard" type="radio" name="difficulty"> Hard
                </label>
              </li>
              <li class="radio-option">
                <label for="very-hard">
                  <input id="very-hard" value="Expert" type="radio" name="difficulty"> Expert
                </label>
              </li>
            </ul>
          </div>
      
          <div class="dialog-footer">
            <button onclick="startGameButtonClick();" ripple-color="#003c8f" class="button dialog-btn vertical-adjust">OK</button>
            <button onclick="hideDialogButtonClick('dialog');" ripple-color="#202020" class="button dialog-btn vertical-adjust">Cancel</button>
          </div>
        </div>
      </div>
      
      <div id="about-dialog" class="dialog">
      
        <div id="about-dialog-box" onblur="hideDialogButtonClick('about-dialog');" class="dialog-content about-dialog-content">
          <div class="dialog-header">ManproTI</div>
      
          <div class="dialog-body">
            <div class="card-group">
              <div class="card dialog-card">
                <div class="about-card-img">
                  <img src="" alt="" />
                </div>
                <div class="about-card-title">Nama</div>
                <div class="about-card-content">Angkatan</div>
                <div class="about-card-quote">Text.</div>
              </div>
              <div class="card dialog-card">
                <div class="about-card-img">
                  <img src="" alt="" />
                </div>
                <div class="about-card-title">Nama</div>
                <div class="about-card-content">Angkatan</div>
                <div class="about-card-quote">Text.</div>
              </div>
              <div class="card dialog-card">
                <div class="about-card-img">
                  <img src="" alt="" />
                </div>
                <div class="about-card-title">Nama</div>
                <div class="about-card-content">Angkatan</div>
                <div class="about-card-quote">Text.</div>
              </div>
              <div class="card dialog-card">
                <div class="about-card-img">
                  <img src="" alt="" />
                </div>
                <div class="about-card-title">Nama</div>
                <div class="about-card-content">Angkatan</div>
                <div class="about-card-quote">Text.</div>
              </div>
              <div class="card dialog-card">
                <div class="about-card-img">
                  <img src="" alt="" />
                </div>
                <div class="about-card-title">Nama</div>
                <div class="about-card-content">Angkatan</div>
                <div class="about-card-quote">Text.</div>
              </div>
              <div class="card dialog-card">
                <div class="about-card-img">
                  <img src="" alt="" />
                </div>
                <div class="about-card-title">Nama</div>
                <div class="about-card-content">Angkatan</div>
                <div class="about-card-quote">Text.</div>
              </div>
      
            </div>
          </div>
      
          <div class="dialog-footer">
            <button onclick="hideDialogButtonClick('about-dialog');" ripple-color="#003c8f" class="button dialog-btn vertical-adjust">OK</button>
          </div>
        </div>
      </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="body" id="sudoku">
                    <div class="card game">
                        <table id="puzzle-grid">
                            <tr>
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                    
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                    
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                            </tr>
                    
                            <tr>
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                    
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                    
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                            </tr>
                    
                            <tr>
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                    
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                    
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                            </tr>
                    
                            <tr>
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                    
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                    
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                            </tr>
                    
                            <tr>
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                    
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                    
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                            </tr>
                    
                            <tr>
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                    
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                    
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                            </tr>
                    
                            <tr>
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                    
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                    
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                            </tr>
                    
                            <tr>
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                    
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                    
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                            </tr>
                    
                            <tr>
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                    
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                    
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                            <td>
                                <input type="text" maxlength="1" onchange="checkInput(this)" disabled />
                            </td>
                            </tr>
                    
                        </table>
                    </div>
                </div>
                <div class="card status">
                    <div id="game-number"><?php echo $_GET['id'] ?></div>
                    <ul class="game-status">
                      <li>
                        <div class="vertical-adjust">
                          <span id="timer-label">Time</span>
                        </div>
                        <div id="timer" class="timer">00:00</div>
                      </li>
              
                      <li>
                        <div class="vertical-adjust">
                          <span id="game-difficulty-label">Game difficulty</span>
                        </div>
                        <div id="game-difficulty" class="timer">Hello</div>
                      </li>
                      <li>
                        <div class="vertical-adjust">
                          <span>Remaining numbers</span>
                        </div>
                        <div class="remain-table">
                          <div class="remain-column">
                            <div class="remain-cell">
                              <div class="remain-cell-header">1</div>
                              <div onchange="document.write('Hello');" id="remain-1" class="remain-cell-content">0</div>
                            </div>
                            <div class="remain-cell">
                              <div class="remain-cell-header">4</div>
                              <div id="remain-4" class="remain-cell-content">0</div>
                            </div>
                            <div class="remain-cell">
                              <div class="remain-cell-header">7</div>
                              <div id="remain-7" class="remain-cell-content">0</div>
                            </div>
                          </div>
                          <div class="remain-column">
                            <div class="remain-cell">
                              <div class="remain-cell-header">2</div>
                              <div id="remain-2" class="remain-cell-content">0</div>
                            </div>
                            <div class="remain-cell">
                              <div class="remain-cell-header">5</div>
                              <div id="remain-5" class="remain-cell-content">0</div>
                            </div>
                            <div class="remain-cell">
                              <div class="remain-cell-header">8</div>
                              <div id="remain-8" class="remain-cell-content">0</div>
                            </div>
                          </div>
                          <div class="remain-column">
                            <div class="remain-cell">
                              <div class="remain-cell-header">3</div>
                              <div id="remain-3" class="remain-cell-content">0</div>
                            </div>
                            <div class="remain-cell">
                              <div class="remain-cell-header">6</div>
                              <div id="remain-6" class="remain-cell-content">0</div>
                            </div>
                            <div class="remain-cell">
                              <div class="remain-cell-header">9</div>
                              <div id="remain-9" class="remain-cell-content">0</div>
                            </div>
                          </div>
                
                        </div>
                      </li>
                    </ul>
                  </div>
            </div>
        </div>
    </div>
    
    <div class="footer vertical-adjust">
    <span>Created by ManproTI Team</span>
    <a href="#" onclick="showDialogClick('about-dialog');">#vkWasHere</a>
    <span> . © 2022 all right reserved.</span>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js" integrity="sha512-z4OUqw38qNLpn1libAN9BsoDx6nbNFio5lA6CuTp9NlK83b89hgyCVq+N5FdBJptINztxn1Z3SaKSKUS5UP60Q==" crossorigin="anonymous"></script>
    <script src="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.js"></script>
    <script src="js/app.js">
      let gameState = {
        "id": "",
        "timers": "",
        "player": [{
            "id":0,
            "name": "Dummy1"
        }, {
            "id":0,
            "name": "Dummy2"
        }]
      };
      gameState.id = "<?php echo $_GET['id'] ?>";
      gameState.player[0].id = "<?php echo $data1['id'] ?>";
      gameState.player[0].name = "<?php echo $data1['username'] ?>";
    </script>
</body>
</html>