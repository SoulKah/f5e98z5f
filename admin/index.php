
<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
sec_session_start();
 
if (login_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Secure Login: Log In</title>
        <link rel="stylesheet" href="css/style.css" />
        <script type="text/JavaScript" src="js/sha512.js"></script> 
        <script type="text/JavaScript" src="js/forms.js"></script> 
    </head>
    <body>
       <div id="wrapper">
        <?php
        if (isset($_GET['error'])) {
            echo '<p class="error">Error Logging In!</p>';
        }

        if (login_check($mysqli) == false) {
        ?> 
        <form action="includes/process_login.php" method="post" name="login_form" class="login">                      
            
            <p>
              <label for="login">Email:</label>
              <input type="text" name="email" id="login" value="name@example.com">
            </p>

            <p>
              <label for="password">Password:</label>
              <input type="password" name="password" id="password" value="4815162342">
            </p>

            <p class="login-submit">
              <button type="submit" class="login-button" onclick="formhash(this.form, this.form.password);"/>Login!</button>
            </p>
        </form>
 
<?php
            /*echo '<p>Currently logged ' . $logged . '.</p>';
            echo "<p>If you don't have a login, please <a href='register.php'>register</a></p>";*/
        } 

        else {
            echo '<p>Currently logged ' . $logged . ' as <span class="current">' . ucfirst(htmlentities($_SESSION['username'])) . '</span>.</p>';
            echo '<p><a href="includes/logout.php">Inloggen op andere acccount</a>.</p>';
        }
?>     
       </div>
    </body>
</html>