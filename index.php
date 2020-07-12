<?php
  include ("koneksi.php");
  session_start();
  $error = '';
  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = mysqli_real_escape_string($con,$_POST['username']);
    $password = mysqli_real_escape_string($con,$_POST['password']);

    $sql = mysqli_query($con, "SELECT * FROM login WHERE username = '$username' AND password = '$password'");
    $row = mysqli_fetch_array($sql,MYSQLI_ASSOC);
    $active = $row['active'];

    $count = mysqli_num_rows($sql);

    if ($count == 1) {
      $_SESSION['login_user'] = $username;
      header("location: form/dashboard.php");
    }
    else {
      header("location:index.php");
      $error = "Invalid username or password";
    }
  }
?>
<html>
<head>
  <title>Perpustakaan - Login</title>
  <link rel="stylesheet" href="template/css/style.css" />
</head>
<body>
  <div id="page-wrap" class="login">
    <center>
      <h3>Perpustakaan - Login</h3>
      <form action="" method="post">
        <input type="text" name="username" placeholder="username" required><br /><br />
        <input type="password" name="password" placeholder="password" required><br /><br />
        <button type="submit" name="submit">LOGIN</button>
      </form>
    </center>
  </div>
</body>
</html>
