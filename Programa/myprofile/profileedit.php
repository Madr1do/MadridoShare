<?php

include '../sidemenu.php';

$id = $_SESSION['id']; // get id through query string

$qry = mysqli_query($con,"SELECT *from accounts WHERE id='" . $id . "'");
$data=mysqli_fetch_array($qry);

$linkas = ('../images/'.$id.'/'.$image);

if(isset($_POST['update'])) // when click on Update button
{
  $username = $_POST['username'];
  $email = $_POST['email'];
  $role = $_POST['role'];
  $password = $_POST['password'];
  $verify_password = $_POST['verify-password'];
  $surname = $_POST['surname'];
  $phone = $_POST['phone'];
  $image = $_FILES["files"]["name"];

  if (!empty($_POST['username'])){

    mysqli_query($con,"UPDATE accounts set username='$username' where id='$id'");

  }

  if (empty($_POST['username'])){

    $nera_vardo = "Neįvestas vardas!";

  }

  if (!empty($_POST['surname'])){

    mysqli_query($con,"UPDATE accounts set surname='$surname' where id='$id'");

  }

  if (empty($_POST['surname'])){

    $nera_pavardes = "Neįvesta pavardė!";

  }

  if (!empty($_POST['email'])){

      $verification = mysqli_query($con, "SELECT email FROM accounts WHERE email = '".$email."'") or exit(mysqli_error($con));
      if(mysqli_num_rows($verification)) {

        $kiekis = mysqli_query($con, "SELECT COUNT(*) FROM accounts WHERE email = ".$email."");

        echo $kiekis;


        $egzisuoja_pastas = 'Paskyra su šiuo el. paštu jau egzistuoja!';

      }

      else{

        mysqli_query($con,"UPDATE accounts set email='$email' where id='$id'");

      }

  }

  if (empty($_POST['email'])){

    $nera_pasto = "Neįvestas el. paštas!";

  }

  if (!empty($_POST['phone'])){

    mysqli_query($con,"UPDATE accounts set phone='$phone' where id='$id'");

  }

  if (empty($_POST['phone'])){

    $nera_telefono = "Neįvestas telefonas!";

  }

  if (!empty($_POST['password'])){

    if (!empty($_POST['verify-password']) && $_POST['verify-password'] == $_POST['password']){

      $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
      mysqli_query($con,"UPDATE accounts set password='$password' where id='$id'");

    }

    if (empty($_POST['verify-password'])){

      $nera_slaptazodzio_pakartojimo = "Neįvestas slaptažodžio pakartojimas!";

    }

    if ($verify_password != $password){

      if (!empty($_POST['verify-password'])){

        $nesutampa = "Slaptažodžiai nesutampa!";

      }

    }

  }

  if (!empty($_POST['role'])){

    if($_POST['role'] == 'Administratorius')
    {
       mysqli_query($con,"UPDATE accounts set role='1' where id='$id'");
    }
    if($_POST['role'] == 'Vykdytojas')
    {
       mysqli_query($con,"UPDATE accounts set role='2' where id='$id'");
    }
    if($_POST['role'] == 'Darbuotojas')
    {
       mysqli_query($con,"UPDATE accounts set role='3' where id='$id'");
    }
    if($_POST['role'] == 'Nieko')
    {
       mysqli_query($con,"UPDATE accounts set role='4' where id='$id'");
    }


  }

  if ($_FILES['files']['size'] != 0) {

          if (!file_exists('../images/'.$id)) {
              mkdir('../images/'.$id, 0777, true);
          }


            mysqli_query($con,"UPDATE accounts set image='$image' where id='$id'");

            $target_dir = '../images/'.$id.'/';
            $target_file = $target_dir . basename($_FILES["files"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            move_uploaded_file($_FILES["files"]["tmp_name"], $target_file);

            echo 'taip';

  }

  if  (!empty($_POST['username']) && !empty($_POST['surname']) && !empty($_POST['email']) && !empty($_POST['phone'])){

    if (!empty($_POST['password'])){

      if (!empty($_POST['verify-password']) && $_POST['verify-password'] == $_POST['password']){

        echo "<script> location.href='../myprofile/profile'; </script>";
                exit;

      }

    }

    if (empty($_POST['verify-password']) && empty($_POST['password'])){

        echo "<script> location.href='../myprofile/profile'; </script>";
                exit;

    }

  }

}
?>
<head>
    <meta charset="UTF-8">
    <style>
    .sidebar{
      min-height: 135vh !important;
    }
    .ivedimas{
      width: 100%;
    }
    @media only screen and (max-width: 400px){
      .button {
          width: 90%;
      }
      h2{
        text-align: center;
      }
    }
    @media only screen and (max-width: 400px){
        .button {
            width: 90%;
        }
    }
    @media only screen and (max-width: 800px){

      .ivedimas{
        margin-bottom: 0px;
      }
    }
    </style>
</head>
<div class = "wrapper">
  <form method="POST" action="profileedit" enctype="multipart/form-data" class="card94" style='text-align: left'>

  <div class="row">

    <div class="column50" >

      <div class="row">

        <h2 style="color: black;">Mano paskyros redagavimas</h2>

        <div class="column50" >

          <?php
          if (@getimagesize($linkas)) {
            echo "<img class='paveiksliukas' src='$linkas' >";
          }
          else {
            echo  "<img class='paveiksliukas' src='../images/doge.jpg' >";
          }
          ?>

        </div>

        <div class="column50" style='margin-top: 2rem;'>

          <label style="display: inline-block; cursor: pointer" class='button' for="files">Pakeisti nuotrauką</label>
          <br>
          <input style="display: inline-block; width: 20px; visibility:hidden;" type="file" id="files" name="files" />
          <br>

        </div>

      </div>

    </div>

    <div class="column50 klaida" style='margin-top: 1rem; text-align: left'>

      <p><?php echo $nera_vardo ?></p>
      <p><?php echo $nera_pavardes ?></p>
      <p><?php echo $nera_slaptazodzio ?></p>
      <p><?php echo $nera_slaptazodzio_pakartojimo ?></p>
      <p><?php echo $nesutampa ?></p>
      <p><?php echo $nera_pasto ?></p>
      <p><?php echo $egzisuoja_pastas ?></p>
      <p><?php echo $nera_telefono ?></p>

    </div>

  </div>

    <div class="row">

      <div class="column50" style='width: 92%; text-align: left'>
        <h4 class='punktas'>Vardas </h4>
        <input class="ivedimas" type="text" name="username" value="<?php echo $data['username'] ?>" >
        <br>
        <h4 class='punktas'>Pavardė </h4>
        <input class="ivedimas" type="text" name="surname" value="<?php echo $data['surname'] ?>" >
        <br>
        <h4 class='punktas'>Slaptažodis </h4>
        <input class="ivedimas" type="text" name="password" placeholder='**********'>
        <br>
        <h4 class='punktas'>Pakartokite slaptažodį </h4>
        <input class="ivedimas" type="text" name="verify-password" placeholder='**********'>
        <br>
        <h4 class='punktas'>El. Paštas </h4>
        <input class="ivedimas" type="text" name="email" value="<?php echo $data['email'] ?>" >
        <br>
        <h4 class='punktas'>Telefonas </h4>
        <input class="ivedimas" type="text" name="phone" value="<?php echo $data['phone'] ?>" >
        <br>
        <h4 class='punktas'>Pareigos </h4>
        <?php
        if ($role == 1){
          if ($data['role'] == "1"){
            ?>
            <select style='padding: 0px 16px 0px 16px !important;' class="ivedimas" type="text" name="role" id="role">
              <option value="Administratorius">Administratorius</option>
              <option value="Vykdytojas">Vykdytojas</option>
              <option value="Darbuotojas">Darbuotojas</option>
              <option value="Nepriskirta">Nepriskirta</option>
            </select>
            <?php
          }
          if ($data['role'] == "2"){
            ?>
            <select style='padding: 0px 16px 0px 16px !important;' class="ivedimas" type="text" name="role" id="role">
              <option value="Vykdytojas">Vykdytojas</option>
              <option value="Administratorius">Administratorius</option>
              <option value="Darbuotojas">Darbuotojas</option>
              <option value="Nepriskirta">Nepriskirta</option>
            </select>
            <?php
          }
          if ($data['role'] == "3"){
            ?>
            <select style='padding: 0px 16px 0px 16px !important;' class="ivedimas" type="text" name="role" id="role">
              <option value="Darbuotojas">Darbuotojas</option>
              <option value="Administratorius">Administratorius</option>
              <option value="Vykdytojas">Vykdytojas</option>
              <option value="Nepriskirta">Nepriskirta</option>
            </select>
            <?php
          }
          if ($data['role'] == "4"){
            ?>
            <select style='padding: 0px 16px 0px 16px !important;' class="ivedimas" type="text" name="role" id="role">
              <option value="Nepriskirta">Nepriskirta</option>
              <option value="Administratorius">Administratorius</option>
              <option value="Vykdytojas">Vykdytojas</option>
              <option value="Darbuotojas">Darbuotojas</option>
            </select>
            <?php
          }
        }
        if ($role == 2){
          if ($data['role'] == "2"){
            ?>
            <select style='padding: 0px 16px 0px 16px !important;' class="ivedimas" type="text" name="role" id="role">
              <option value="Vykdytojas">Vykdytojas</option>
              <option value="Darbuotojas">Darbuotojas</option>
              <option value="Nepriskirta">Nepriskirta</option>
            </select>
            <?php
          }
          if ($data['role'] == "3"){
            ?>
            <select style='padding: 0px 16px 0px 16px !important;' class="ivedimas" type="text" name="role" id="role">
              <option value="Darbuotojas">Darbuotojas</option>
              <option value="Vykdytojas">Vykdytojas</option>
              <option value="Nepriskirta">Nepriskirta</option>
            </select>
            <?php
          }
          if ($data['role'] == "4"){
            ?>
            <select style='padding: 0px 16px 0px 16px !important;' class="ivedimas" type="text" name="role" id="role">
              <option value="Nepriskirta">Nepriskirta</option>
              <option value="Vykdytojas">Vykdytojas</option>
              <option value="Darbuotojas">Darbuotojas</option>
            </select>
            <?php
          }
        }
        else{
          if ($data['role'] == "3"){
            ?>
            <select style='padding: 0px 16px 0px 16px !important;' class="ivedimas" type="text" name="role" id="role">
              <option value="Darbuotojas">Darbuotojas</option>
            </select>
            <?php
          }
          if ($data['role'] == "4"){
            ?>
            <select style='padding: 0px 16px 0px 16px !important;' class="ivedimas" type="text" name="role" id="role">
              <option value="Nepriskirta">Nepriskirta</option>
            </select>
            <?php
          }
        }
        ?>

      </div>

    </div>

        <button style='margin-bottom: 20px; margin-top: 50px' class="button" onclick="location.href='../myprofile/profile'" type='button'>Atšaukti</button>
        <button class="button" type="submit" name="update">Atnaujinti</button>
        <br>
        <br>

  </form>
</div>
