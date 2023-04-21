<?php
//initialize session
session_start();

// PHP charset
ini_set('default_charset', 'UTF-8');

// database connection
include ("db_connect.php");

// intialize variables
$nomeErr = $emailErr = $passwordErr= "";
$nome = $email = $password = $hidden = $disabled = "";

// "cleaning data"
function test_input($dados) {
	$dados = trim($dados);
	$dados = stripslashes($dados);
	$dados = htmlspecialchars($dados);
	return $dados;
  }

if( !empty( $_SESSION['login'] )){
    header ('Location: index.php');
} else {

  if($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (empty($_POST["email"])) {
      $emailErr = "Email is required!";
    } else {
      $email = test_input($_POST["email"]);
      // check if e-mail address is well-formed
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
      }
    }

    if (empty($_POST["password"])) {
      $nomeErr = "Password is required!";
    } else {
      $nome = test_input($_POST["password"]);
    }
    
    if ($passwordErr =="" AND $emailErr == ""){
      $query = "SELECT * FROM contatos WHERE email='$_POST[email]' AND  password='$_POST[password]'";
      $result = mysqli_query ($conn,$query);
      $row = mysqli_fetch_assoc ($result);
      if (mysqli_num_rows($result) > 0){
        $_SESSION['nome'] = $row['nome'];
        $_SESSION['login'] = TRUE;
        header ('Location: index.php');
      } else {
        $autErr ="Please verify you authentication data!";
      }
  
    }
  }
}


?>

<!DOCTYPE html>
<html lang="pt">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=ISO8859-1">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Bootstrap core CSS 
    <link href="bootstrap413/css/bootstrap.min.css" rel="stylesheet">-->

    <!-- Custom styles for this template -->
    <!--<link href="bootstrap413/css/signin.css" rel="stylesheet">-->
    <link href="style.css" rel="stylesheet">

    <title>EXEMPLE TO MANAGE DATABASE WITH PHP</title> 
  </head>

  <body>
    <main>

      <!-- info -->
      <?php
        if($_SERVER["REQUEST_METHOD"] == "POST" AND ($passwordErr !="" OR $emailErr != "" OR $autErr !="")) {
      ?>
      <div>
        <h4>Alert!</h4>
        <hr>
        <?php
          echo $autErr;
          echo $emailErr;
          echo $passwordErr;
        ?>
      </div>
      <?php } ?><!-- /.info -->

      <section class="formulario">
        <div>
          <form name="frmLogin" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">          
              <label id="text"><h1>Authentication</h1></label>
              <input type="email" name="email"  placeholder="Email" value="<?php echo $email; ?>" required autofocus>
              <input type="password" name="password" placeholder="Password" required>
              <button type="submit" id="button">Login</button>
              <p>&copy; Lorena Seabra 2023</p>
          </form>
        </div>
      </section>
    </main>

  </body>
</html>
<?php
  mysqli_close($conn);
?>