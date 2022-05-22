<?php
include '../sidemenu.php';

  if ($role == 1 ) {
    $records = mysqli_query($con,"select * from skelbimai ORDER BY id DESC");

    while($data = mysqli_fetch_array($records))
    {
      ?>
      <table style='margin-bottom: 1rem;'
            <tr>
              <td>
                <a class='delete' style="margin-right: 1rem; text-decoration: none" href="delete.php?id=<?php echo $data['id']; ?>">Ištrinti</i></a>
              </td>
              <td>
                <h2><?echo $data['skelbimas'];?></h2>
                <p style='margin-top: -1rem; font-size: 10px'>Paskelbta: <?echo $data['reg_date'];?></p>
              </td>
            </tr>
          </table>


        <?php
    }
    ?>
    <form method="post" action="home">
      <div style="margin-top: 3rem">
        <input class="ivedimas" type="text" name="skelbimas" placeholder="Antraštė" id="skelbimas" required autocomplete="off">
        <button class="button" role="button" type="submit">Skelbti</button>
      </div>
    </form>
    <?php
  }
  else{
    $records = mysqli_query($con,"select * from skelbimai ORDER BY id DESC");

    while($data = mysqli_fetch_array($records))
    {
      ?>
      <table style='margin-bottom: 1rem;'
            <tr>
              <td>
                <h2><?echo $data['skelbimas'];?></h2>
                <p style='margin-top: -1rem; font-size: 10px'>Paskelbta: <?echo $data['reg_date'];?></p>
              </td>
            </tr>
          </table>


        <?php
    }
  }

?>
<head>
  <meta charset="UTF-8">
</head>

<?php
$skelbimas = mysqli_real_escape_string($con, $_REQUEST['skelbimas']);
if(empty($skelbimas))
{
}
else{
  $sql = "INSERT INTO skelbimai (skelbimas) VALUES ('$skelbimas')";

    if(mysqli_query($con, $sql)){

      echo "<script> location.href='../home/home'; </script>";
              exit;

    }
    else{
    }
}
mysqli_close($con);

?>
