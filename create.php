<?php
//initialize session
session_start();

// PHP charset
ini_set('default_charset', 'UTF-8');

if( $_SESSION['login'] == TRUE){

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

if($_SERVER["REQUEST_METHOD"] == "POST") {

	if (empty($_POST["nome"])) {
		$nomeErr = "Name is required!";
	  } else {
      $nome = test_input($_POST["nome"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^([^[:punct:]\d]+)$/",$nome)) {
        $nomeErr = "Only letters and white space allowed.";
      }
	  }
	  
	  if (empty($_POST["email"])) {
		$emailErr = "Email is required!";
	  } else {
      $email = test_input($_POST["email"]);
      // verifica o formato do email
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format!";
      }
    }

    
    if (strlen($_POST["password"]) < 5) {    
      $passwordErr = "Password must have min. 5 characters!";
      } elseif ($_POST["password"] != $_POST["rpassword"]){
        $passwordErr = "Passwords does not match!";
        } else { 
          $password = test_input($_POST["password"]);
      }

	if ($nomeErr =="" AND $emailErr == "" AND $passwordErr == ""){
		$query = "INSERT INTO contatos (nome, email, password)
		VALUES ('$nome',  '$email', '$password')";
    mysqli_query ($conn,$query);
    $disabled = "disabled";
    $hidden = "hidden";
	}
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- insert here the reference to stylesheet file -->
    <link href="create.css" rel="stylesheet">
    <link href="index.css" rel="stylesheet">
    <title>EXEMPLE TO MANAGE DATABASE WITH PHP</title>
  </head>

  <body>
  <header>
      <!-- navigation bar -->
      <nav>
        
        <div>
          <ul>
              <a href="#">CRUD</a>
              <a href="index.php">Home</a>
              <a href="read.php">List data</a>
              <a href="create.php">Create new</a>
              <a href="close_session.php">End session</a>
           
          </ul>

          <!-- search form -->
          <form name="frmPesquisa" method="post" action="read.php">
            <input type="text" placeholder="Search" aria-label="Search" name="pesquisa">
            <button type="submit">Search</button>
          </form>

        </div>
      </nav>
      <!-- /.navigation bar -->
    </header>
    <main>

      <div><!-- info -->
        <?php
          if($_SERVER["REQUEST_METHOD"] == "POST" AND $nomeErr =="" AND $emailErr == "" AND $passwordErr =="") {
        ?>
          <div>
            <h4 >Info!</h4>
            <hr>
            Data were sent to database.
          </div>
        <?php
            }	
        ?>
        <?php if($nomeErr !="" OR $emailErr != "" OR $passwordErr !="") { ?>
          <div>
              <h4>Alert!</h4>
              <hr>
              <p><?PHP echo $nomeErr ?></p>
              <p><?PHP echo $emailErr ?></p>
              <p><?PHP echo $passwordErr ?></p>
          </div>
        <?php }	?>
      </div><!-- /.info -->

      <div><!-- contentor do formulario --> 
        <form name="frmInserir" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div>
              <label>Name </label>
              <div >
                <input name="nome" type="text" value="<?php echo $nome;?>" placeholder="Name" <?php echo $disabled ?>>
              </div>
            </div>
            <div>
              <label>Email </label>
              <div>
                <input name="email" type="email" value="<?php echo $email;?>" placeholder="Email" <?php echo $disabled ?>>
              </div>
            </div>
            <div <?php echo $hidden ?>>
              <label>Password </label>
              <div>
                <input name="password" type="password" placeholder="Password [min. 5 characters]"/>
              </div>
            </div>
            <div <?php echo $hidden ?>>
              <label>Repeat password </label>
              <div>
                <input name="rpassword" type="password" placeholder="Repeat password"/>
              </div>
            </div>
            <div>
              <div>
                <div>	
                  <button name="gravar" type="submit" <?php echo $disabled ?>>Save</button>
                  <button name="limpar" type="reset" >Reset</button>
                  <a href="read.php">Back to list</a>
                </div>
              </div>
            </div>
        </form>
      </div><!-- /.container -->

      <!-- footer -->
      <footer>
        <p>&copy; Lorena Seabra 2023</p>
      </footer>
      <!-- /.footer -->
    </main>
  </body>
</html>
<?php
// close connection
mysqli_close ($conn);
} else {
  header ('Location: login.php');
} 
?>
