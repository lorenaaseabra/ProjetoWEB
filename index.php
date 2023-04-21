<?php
//initialize session
session_start();

// PHP charset
ini_set('default_charset', 'UTF-8');

if( $_SESSION['login'] == TRUE){
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- insert here the reference to stylesheet file -->
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

          <section class ="forms">
            <form name="frmPesquisa" method="post" action="read.php">
              <input type="text" placeholder="Search" aria-label="Search" name="pesquisa">
              <button type="submit">Search</button>
            </form>
          </section>

        </div>
      </nav>
      <!-- /.navigation bar -->
    </header>

    <main>     
      <div><!-- container --> 
        <div>
          <div>
            <div>
              <div>
                <h2>About the example</h2>
              </div>
              <div>
                <p>The CRUD application is intended to exemplify the adoption of PHP techniques to interact with a database and manage text content. </p>
                <p>For example, variables, cycles, decisions, forms, database maintenance, sessions, file include, etc..</p>
              </div>
            </div>
          </div>
          <div>
            <div>
              <div>
                <h2>The approach</h2>
              </div>
              <div>
                <p>The code followed a procedural approach.</p>
              </div>
            </div>
          </div>  
          <div>
            <div>
              <div>
                <h2>Suggestions</h2>
              </div>
              <div>
                <p>Future developments suggestions: Migrate to object-oriented or to data-oriented.</p>
              </div>
            </div>
          </div>
        </div>
        
      </div><!-- /.container -->




      <!-- FOOTER -->
      <footer>
        <p>&copy; Lorena Seabra 2023</p>
      </footer>
      <!-- /.FOOTER -->
    </main>

</body>
</html>
<?php 
} else {
  header ('Location: login.php');
} 
?>