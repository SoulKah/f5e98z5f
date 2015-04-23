<!doctype html>
<html>
	<head>
        <title>DEV</title>
        <link href="../css/style.css" rel="stylesheet" type="text/css">
	</head>
    
    <body>
    <div id="wrapper">
    <?php 
    $email = $_POST['email'];
    $onderwerp = $_POST['onderwerp'];
    $bericht = $_POST['bericht'];

    if (!empty($onderwerp) && !empty($bericht))
    {
        $header = "FROM: norepy@encryptor.org \r\n";
        $header .= "MIME-Version: 1.0 \r\n";
        $header .= "Content-type:text/html;charset=iso-8859-1 \r\n";

        if (!mail ($email, $onderwerp, $bericht, $header))
        {
            echo "<h1>Failed</h1><br><h2>Oops! Somesthing went wrong</h2>";
        }

        else 
        {
            echo "<h1>Succes!</h1><br><h2>Your link has been succesfuly sent to your friend</h2>";
        }   
    }
    ?> 
    </div>
    </body>
