<?php
//initialize session
session_start();

// PHP charset
ini_set('default_charset', 'UTF-8');

if( $_SESSION['login'] == TRUE){

// database connection
include ("db_connect.php");

if(isset ($_POST['pesquisa'])) {
	$query = "SELECT * FROM contatos WHERE nome LIKE '%$_POST[pesquisa]%' OR email LIKE '%$_POST[pesquisa]%'";
	$result = mysqli_query ($conn, $query);	
} else {
	$query = "SELECT * FROM contatos";
	$result = mysqli_query($conn, $query);
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
    <link href="read.css" rel="stylesheet">
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

        <div> <!-- info -->
            <p><?PHP echo mysqli_num_rows ($result)?> register(s) found.</p>
        </div>

        <div> <!-- list -->
          <table>
            <tr> <!-- o que é th, tr e td-->
              <td width="80"><strong>ID</strong></td>
              <td><strong>NAME</strong></td>
              <td><strong>EMAIL</strong></td>
              <td width="80"><strong>UPDATE</strong></td>
              <td width="80"><strong>DELETE</strong></td>
            </tr>
            <?php while ($row = mysqli_fetch_assoc ($result)) { ?>
            <tr>
              <td><?PHP echo $row ["codigo"]?></td>
              <td><?PHP echo $row ["nome"]?></td>
              <td><?PHP echo $row ["email"]?></td>
              <td><a href="update.php?codigo=<?PHP echo $row ["codigo"]?>">UPDATE</a></td>
              <td><a href="delete.php?codigo=<?PHP echo $row ["codigo"]?>">DELETE</a></td>
            </tr>
            <?php } ?>
          </table>

      </div><!-- /.list -->

      <!-- FOOTER -->
      <footer">
        <p>&copy; Lorena Seabra 2023</p>
      </footer>
      <!-- /.FOOTER -->
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
    

