<!DOCTYPE HTML>
<html>
<head>
  <meta charset="utf-8">
</head>

<body>
  <form method="GET" action="">
    <input type="text" name="num" autocomplete="off">
    <input type="submit">
  </form>
<?php
  if(isset($_GET['num'])) {
    $num = $_GET['num'];
    $pattern = array();
    $pattern[0] = '/\d*?\./';
    $replacement = array();
    $replacement[0] = '';
    $num = preg_replace($pattern, $replacement, $num);
    $num = shell_exec('look '.$num.' list.txt');
    echo $num;
  }
?>
</body>
</html>
