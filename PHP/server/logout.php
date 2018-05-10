<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
      session_start();

      if (isset($_SESSION['username'])) {
        session_destroy();
        echo "OK";
      }
     ?>
     <script type="text/javascript">
       localStorage.setItem("username","");
     </script>
  </body>
</html>
