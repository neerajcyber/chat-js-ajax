<?php 
  session_start();

  include_once "../../_config.php";
  // if(!isset($_SESSION['login_id'])){
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
    <section class="chat-area">
      <header>
        <?php 
          $user_id = mysqli_real_escape_string($conn, $_GET['login_id']);
          $sql = mysqli_query($conn, "SELECT * FROM registation WHERE login_id = {$user_id}");
          if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
            $images='';
            $s=mysqli_query($conn, "SELECT * FROM `images` WHERE `login_id`='".$row['login_id']."'");
            while($r=mysqli_fetch_assoc($s)){
                $images.=$r['profile_pic'];
            }
          }else{
            header("location: users.php");
          }
        ?>
        <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        <img src="<?php echo $images; ?>" alt="">
        <div class="details">
          <span><?php echo $row['first_name']. " " . $row['last_name'] ?></span>
          <p><?php echo $row['status_online']; ?></p>
        </div>
      </header>
      <div class="chat-box">

      </div>
      <form action="#" class="typing-area">
        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
        <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
        <button><i class="fab fa-telegram-plane"></i></button>
      </form>
    </section>
  </div>

  <script src="../js/chat.js"></script>
<?php } ?>
</body>
</html>
