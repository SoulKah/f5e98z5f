<?php
ob_start();
session_start();

include_once 'includes/_connect.php';
include_once 'includes/_functions.php';
 
if (login_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Admin Control Panel Login</title>
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
              <input type="text" name="email" id="login" placeholder="admin@example.com">
            </p>

            <p>
              <label for="password">Password:</label>
              <input type="password" name="password" id="password" placeholder="password">
            </p>

            <p class="login-submit">
              <button type="submit" class="login-button" onclick="formhash(this.form, this.form.password);"/>Login!</button>
            </p>
        </form>
 
<?php
            /*echo '<p>Currently logged ' . $logged . '.</p>';
            echo "<p>If you don't have a login, please <a href='register.php'>register</a></p>";*/
        } 

        else
        {
            header('Location: view.php');
        }
?>     
       </div>
    </body>
</html>