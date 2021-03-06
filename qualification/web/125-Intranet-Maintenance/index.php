<?php
  include('db.php');
  $auth_email = "";
  if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password = md5($password);

    $query = "SELECT * FROM users WHERE email='$email' AND password='$password';";

    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    $count = mysqli_num_rows($result);

    if ($count == 1) {
        $auth_email = $row['email'];
    }
  }
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=1,initial-scale=1,user-scalable=1" />
    <title>The Company | Login</title>

    <link href="http://fonts.googleapis.com/css?family=Lato:100italic,100,300italic,300,400italic,400,700italic,700,900italic,900" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/styles.css" />
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    
    <section class="container login-form">
        <section>
            <form method="post" action="" role="login">
                <img src="assets/images/logo.png" alt="" class="img-responsive" />

                <?php
                    if ($auth_email != "") {
                        echo "<h3>Halo, " . $auth_email . "</h3></br>";
                        echo "<p>Jaringan perusahaan sedang maintenance. Harap menunggu. Presensi Anda akan tetap dihitung.</p>";
                        echo "<p>Jika ada pertanyaan silahkan kirimkan email ke itsupport@thecompa.ny</p>";
                        system("echo Presensi " . $auth_email . " >> /tmp/presensi.txt");
                        system("date >> /tmp/presensi.txt");
                    } else {
                ?>
            
                <div class="form-group">
                    <input type="email" name="email" required class="form-control" placeholder="Email address" />
                </div>
                
                <div class="input-group">
                    <input type="password" name="password" required class="form-control" placeholder="Password" />
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button" id="tooltip" data-toggle="tooltip" data-placement="top" title="Password Dari IT Support">?</button>
                    </span>
                </div>
                
                <button type="submit" name="go" class="btn btn-primary btn-block">Login Now</button>

                <?php
                    }
                ?>
            </form>
        </section>
    </section>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    
    <script>
    <!--
    $( document ).ready(function() {
        $('#tooltip').tooltip();
    });
    -->
    </script>

</body>
</html>

