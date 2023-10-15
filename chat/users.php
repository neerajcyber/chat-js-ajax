<?php
session_start();
//   include_once "php/config.php";
require("../../_config.php");
// if (!isset($_SESSION['login_id'])) {
//   header("location: login.php");
// }

if (!isset($_SESSION['login_id'])) {
  header("location: ./../login.php");

}
else {
  $now = time(); // Checking the time now when home page starts.

  if ($now > $_SESSION['expire']) {
  
      session_destroy();
    
      header("location: ./../login.php");

  }
?>
<?php include_once "header.php"; ?>

<body>
  <div class="wrapper">
    <section class="users">
      <header>
        <div class="content">
          <?php
            $imag = '';
          $sql = mysqli_query($conn, "SELECT * FROM registation WHERE login_id = {$_SESSION['login_id']}");
          if (mysqli_num_rows($sql) > 0) {
            $row = mysqli_fetch_assoc($sql);
          }
        
          $s1 = mysqli_query($conn, "SELECT * FROM images  WHERE login_id='" . $_SESSION['login_id'] . "'");
          while ($r1 = mysqli_fetch_assoc($s1)) {
            $imag = $r1['profile_pic'];
          }
          ?>
          <img src="<?php echo $imag;  ?>" alt="">
          <div class="details">
            <span><?php echo $row['first_name'] . " " . $row['last_name'] ; ?></span>
            <p><?php echo $row['status_online']; ?></p>
          </div>
        </div>
        <a href="../index.php" class="logout">Back</a>
      </header>
      <div class="search">
        <span class="text">Select an user to start chat</span>
        <input type="text" placeholder="Enter name to search...">
        <button><i class="fas fa-search"></i></button>
      </div>
      <div class="users-list">

      </div>
    </section>
  </div>

  <script src="../js/users.js"></script>
<?php } ?>
</body>

</html>