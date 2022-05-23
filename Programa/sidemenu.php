<?php
include 'config.php';
include 'loggedin.php';
$stmt = $con->prepare('SELECT username, email, role, image FROM accounts WHERE id = ?');
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($username, $email, $role, $image);
$stmt->fetch();
$stmt->close();
include 'pareigos.php';
include 'style.css';
$chatas = '../addons/chat/chat.php';
$chatas2 = '../chat/chat.php';
$kalendorius = '../addons/calendar/calendar.php';
$kalendorius2 = '../calendar/calendar.php';
$klientai = '../addons/clients/clients.php';
$klientai2 = '../clients/clients.php';
$vartotojai = '../addons/accounts/accounts.php';
$vartotojai2 = '../accounts/accounts.php';
$failai = '../addons/myfiles/myfiles.php';
$failai2 = '../myfiles/myfiles.php';
?>

<head>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link rel="icon" type="image/x-icon" href="../../images/logo.png"  />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MadridoShare</title>
</head>
<body>

    <div class="wrapper">

        <div style='min-height: 115vh; box-shadow: rgb(149 157 165 / 20%) 0px 8px 24px;' id="showhide" class="sidebar">
          <div class="profile">
            <?php
            if (@getimagesize('../../images/'.$_SESSION['id'].'/'.$image)) {
              echo "<img class='paveiksliukas' src='../../images/".$_SESSION['id'].'/'.$image."' >";
            }
            elseif (@getimagesize('../images/'.$_SESSION['id'].'/'.$image)) {
              echo "<img class='paveiksliukas' src='../images/".$_SESSION['id'].'/'.$image."' >";
            }
            else {
              echo  "<img lass='paveiksliukas' src='../../images/doge.jpg' >";

            }?>
              <h3><?=$username?></h3>
              <h3><?=$pareigos?></h3>

          </div>
          <?php
          $irasai = mysqli_query($con,"select * from accounts where username ='".$_SESSION['username']."'");

        ?>
          <ul>
                <li>
                    <a href="../../home/home">
                        <span class="icon"><i class="fas fa-home"></i></span>
                        <span class="item">Pagrindinis</span>
                    </a>
                </li>
                <?php

                if (file_exists($chatas)) {

                  ?>
                  <li>
                      <a href="../addons/chat/chat">
                          <span class="icon"><i class="fas fa-pen-alt"></i></span>
                          <span class="item">Žinutės</span>
                      </a>
                  </li>
                  <?php

                }

                if (file_exists($chatas2)) {

                  ?>
                  <li>
                      <a href="../chat/chat">
                          <span class="icon"><i class="fas fa-pen-alt"></i></span>
                          <span class="item">Žinutės</span>
                      </a>
                  </li>
                  <?php

                }

                if (file_exists($klientai)) {

                  ?>
                  <li>
                      <a href="../addons/clients/clients">
                          <span class="icon"><i class="fas fa-users"></i></span>
                          <span class="item">Klientai</span>
                      </a>
                  </li>
                  <?php

                }

                if (file_exists($klientai2)) {

                  ?>
                  <li>
                      <a href="../clients/clients">
                          <span class="icon"><i class="fas fa-users"></i></span>
                          <span class="item">Klientai</span>
                      </a>
                  </li>
                  <?php

                }

                if (file_exists($kalendorius)) {

                  ?>
                  <li>
                      <a href="../addons/calendar/calendar">
                          <span class="icon"><i class="far fa-calendar-alt"></i></span>
                          <span class="item">Kalendorius</span>
                      </a>
                  </li>
                  <?php

                }

                if (file_exists($kalendorius2)) {

                  ?>
                  <li>
                      <a href="../calendar/calendar">
                          <span class="icon"><i class="far fa-calendar-alt"></i></span>
                          <span class="item">Kalendorius</span>
                      </a>
                  </li>
                  <?php

                }

                if (file_exists($vartotojai)) {

                  ?>
                  <li>
                      <a href="../addons/accounts/accounts">
                          <span class="icon"><i class="fas fa-user-friends"></i></span>
                          <span class="item">Vartotojai</span>
                      </a>
                  </li>
                  <?php

                }

                if (file_exists($vartotojai2)) {

                  ?>
                  <li>
                      <a href="../accounts/accounts">
                          <span class="icon"><i class="fas fa-user-friends"></i></span>
                          <span class="item">Vartotojai</span>
                      </a>
                  </li>
                  <?php

                }?>

                <li>
                    <a href="../../myprofile/profile">
                        <span class="icon"><i class="fas fa-user"></i></span>
                        <span class="item">Mano Paskyra</span>
                    </a>
                </li>

                <?php

                if (file_exists($failai)) {

                  ?>
                  <li>
                      <a href="../addons/myfiles/myfiles">
                          <span class="icon"><i class="fas fa-folder-open"></i></span>
                          <span class="item">Failai</span>
                      </a>
                  </li>
                  <?php

                }

                if (file_exists($failai2)) {

                  ?>
                  <li>
                      <a href="../myfiles/myfiles">
                          <span class="icon"><i class="fas fa-folder-open"></i></span>
                          <span class="item">Failai</span>
                      </a>
                  </li>
                  <?php

                }?>

                <li>
                    <a href="../../pletiniai/pletiniai">
                        <span class="icon"><i class="fa fa-plus-circle" aria-hidden="true"></i></span>
                        <span class="item">Plėtiniai</span>
                    </a>
                </li>


                <li>
                    <a href="../../logout">
                        <span class="icon"><i class="fas fa-sign-out-alt"></i></span>
                        <span class="item">Atsijungti</span>
                    </a>
                </li>

            </ul>


        </div>

        </div>
        <button class='butonas' onclick="myFunction()"><i class="fas fa-bars"></i></button>

    </div>

    <script>
    function myFunction() {
      var x = document.getElementById("showhide");
      if (x.style.display === "block") {
        x.style.display = "none";
      } else {
        x.style.display = "block";
      }
    }
  </script>
</body>
</html>
