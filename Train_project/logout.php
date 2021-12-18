<?php
  session_start();
  // logout으로 session을 끝낸다
  unset($_SESSION["userid"]);
  unset($_SESSION["username"]);
  
  echo("
        <script>
          location.href = 'main.php';
        </script>
       ");
?>
