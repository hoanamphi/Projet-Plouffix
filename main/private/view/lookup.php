<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" lang="fr">
</head>

<body>
  <t1>Inverter de Plouffe</t1>
    <form action="../controller/controller.php" method="get">
      <input type="text" name="num">
      <input type="submit">
    </form>
    <?php
    require_once('../controller/controller.php');

      function affichageNum($num) {
        echo $num;
      }

      function affichageErrorMsg() {
        echo "error";
      }
     ?>
</body>

</html>
