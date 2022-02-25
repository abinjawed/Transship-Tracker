<?php

  error_reporting(0);


  $conn = mysqli_connect("localhost", "root", "", "estimate")or die(mysqli_error());

  $query = "SELECT SUM(plusorminus) As sum FROM `zoneA1`";

  $query_result = mysqli_query($conn , $query);

  while($row = mysqli_fetch_assoc($query_result)) {

    $output = "Pallets in Zone A1 : ".$row['sum'];

  }

  $sql = "SELECT * FROM `zoneA1`";

  $result = mysqli_query($conn , $sql);

?>

<!DOCTYPE html>
<html>
<head>

  <!--Update display page every 5 seconds-->
  <meta http-equiv="refresh" content="5"/>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

      <link rel="stylesheet" href="assets/css/demo.css">
</head>
<body>

<div class="body-container" style="padding:20px; font-weight: bold; font-size:15px;   font-family: Arial, Helvetica, sans-serif; color:white; background-color: black;">

<!--  <h1 style="text-align:center;">Zone A1</h1>
  <hr/>-->

  <?php

      echo $output;

  ?>

  <table style="display:none">

    <tr>

      <th>Record #</th>

      <th>Date #</th>

      <th>Container ID #</th>

      <th>Transaction</th>

    </tr>

    <?php

        while($row = mysqli_fetch_assoc($result)) {

          echo "<tr>

          <td>".$row['id']."</td>

          <td>".$row['todaysdate']."</td>

          <td>".$row['containerid']."</td>

          <td>".$row['plusorminus']."</td>

          </tr>";
        }

    ?>

  </table>
</div>
  <script src=""></script>

</body>
</html>
