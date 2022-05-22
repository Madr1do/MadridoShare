<?php
include '../sidemenu.php';
$stmt = $con->prepare('SELECT username, email, role, image, surname, phone FROM accounts WHERE id = ?');
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($username, $email, $role, $image, $surname, $phone);
$stmt->fetch();
$stmt->close();
$id = $_SESSION['id'];

?>
<head>
<meta charset="UTF-8">
<style>
.info{
  width: 23%;
  display: inline-block;
}
.laikas{
  text-align: right;
}
@media only screen and (max-width: 400px){
  .info{
    width: 30%;
  }
  .laikas{
    text-align: center;
  }
  h4{
    font-size: 14px;
  }
}
@media only screen and (max-width: 800px){
  .laikas{
    text-align: center;
  }
}
</style>
</head>
  <div class="card94">

    <div class="row">
      <div class="column50">
        <h2 style='color: black'>Mano paskyra</h2>
        <br>
        <?php
        if (@getimagesize('../images/'.$id.'/'.$image)) {
          echo "<img class='paveiksliukas' src='../images/".$id.'/'.$image."' >";
        } else {
          echo  "<img class='paveiksliukas' src='../images/doge.jpg' >";

        }
        ?>
        <br>
        <br>
				<div style='text-align: left; margin-bottom: -2.5rem;'>
          <h4 class='info'>Vardas:</h4>
          <h4 style='display: inline-block; color: #658feb'><?=$username?></h4>
				</div>
				<br>
        <div style='text-align: left; margin-bottom: -2.5rem;'>
          <h4 class='info'>Pavardė:</h4>
          <h4 style='display: inline-block; color: #658feb'><?=$surname?></h4>
				</div>
        <br>
				<div style='text-align: left; margin-bottom: -2.5rem;'>
          <h4 class='info'>El. paštas:</h4>
          <h4 style='display: inline-block; color: #658feb'><?=$email?></h4>
				</div>
				<br>
        <div style='text-align: left; margin-bottom: -2.5rem;'>
          <h4 class='info'>Telefonas:</h4>
          <h4 style='display: inline-block; color: #658feb'><?=$phone?></h4>
				</div>
				<br>
				<div style='text-align: left; margin-bottom: -2.5rem;'>
          <h4 class='info'>Pareigos:</h4>
          <h4 style='display: inline-block; color: #658feb'><?=$pareigos?></h4>
				</div>
        <br>
        <br>

        <form action="profileedit.php?id=<?php echo $_SESSION['id'] ?>">
            <button class="button">Redaguoti</button>
        </form>
      </div>


      <div class="column50 laikas">
        <h3 style='color: #658feb'><?php echo $timer = date('Y-d-m ') . ' &nbsp; ' . $timer = date(' G:i');?></h3>
      </div>
    </div>

</div>
