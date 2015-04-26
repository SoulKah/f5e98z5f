<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
sec_session_start();
?>
<!doctype html>
<html>
	<head>
        <title>DEV</title>
        <link href="../css/admin.css" rel="stylesheet" type="text/css">
        
        <!-- Add Awesomefont -->
        <link href="../css/font-awesome.css" rel="stylesheet" type="text/css">
        
        <!-- Add jQuery library -->
        <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

        <!-- Add fancyBox -->
        <link rel="stylesheet" href="../fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
        <script type="text/javascript" src="../fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>

        <!-- Optionally add helpers - button, thumbnail and/or media -->
        <link rel="stylesheet" href="../fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
        <script type="text/javascript" src="../fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
        <script type="text/javascript" src="../fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>

        <link rel="stylesheet" href="../fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
        <script type="text/javascript" src="../fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        
        <script type="text/javascript">
            $(document).ready(function() {
                $(".fancybox").fancybox();
            });
            
            $(document).ready(function() {
                $(".various").fancybox({

                    fitToView	: false,
                    width		: '70%',
                    height		: '70%',
                    autoSize	: false,
                    closeClick	: false,
                    openEffect	: 'fade',
                    closeEffect	: 'fade',
                    afterClose  : function() { document.location.reload(true) }
                });
            });
            
        </script>
        
        <script>
            $(function() {
                var availableTags = [
                    "Alfaromeo",
                    "Audi",
                    "BMW",
                    "Ford",
                    "BMW",
                    "Landrover",
                    "Mercedes",
                    "Opel",
                    "Peugeot",
                    "Renault",
                    "Seat",
                    "Volkswagen",
                    "Volvo"
                ];
                $( "#tags" ).autocomplete({
                    source: availableTags
                });
            });
        </script>
        
        <script type="text/javascript">

        function handleEnter (field, event) {
                var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
                if (keyCode == 13) {
                    var i;
                    for (i = 0; i < field.form.elements.length; i++)
                        if (field == field.form.elements[i])
                            break;
                    i = (i + 1) % field.form.elements.length;
                    field.form.elements[i].focus();
                    return false;
                } 
                else
                return true;
            }      

        </script>
        
        <!-- Load CKEditor -->
        <script src="ckeditor/ckeditor.js"></script>
        
	</head>
    
    <body>
    <?php if (login_check($mysqli) == true) : ?>
    <div id="wrapper">
        <div id="left">
            <div id="left-wrap">
                <h1>ACP</h1>
                <h3>Welcome, <?php echo htmlentities($_SESSION['username']); ?>!</h3>
                <nav>
                    <ul>
                        <li><a href="view.php">Overzicht <i class="fa fa-list"></i></a></li>
                        <li class="current"><a href="add.php?type=auto" class='various fancybox.iframe'>Wagen toevoegen <i class="fa fa-user-plus"></i></a></li>
                        <li><a href="includes/logout.php">Uitloggen <i class="fa fa-sign-out"></i></a></li>
                    </ul>
                </nav>
            </div>
        </div>
        <div id="right">
            <div id="right-wrap">
                <a href="#" id="toggleNav"><i class="fa fa-chevron-left arrow fa-3x"></i></a>
                <h1>Wagen toevoegen aan stock</h1><br>

            <?php
                include '../functions.php';
                include '../config/config.php';
                dbconnect();

                $type = $_GET['type'];

                    if (!$_POST && $type == "auto")
                    { 
                    ?>
                        <form action="toevoegen.php?type=auto" method="post" id="form">
                        <table width='50%'>
                        <thead>
                            <th colspan='2'>Wagen toevoegen</th>
                        </thead>
                        <tr>
                            <td>Merk</td>
                            <td>
                                <div class="ui-widget">
                                  <input id="tags" name="merk" onkeypress="return handleEnter(this, event)">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Model</td>
                            <td><input type="text" name="model" onkeypress="return handleEnter(this, event)"/></td>
                        </tr>
                        <tr>
                            <td>Jaar</td>
                            <td>
                                <select name="jaar" onkeypress="return handleEnter(this, event)">
                                    <option value="2015" selected>2015</option>
                                    <option value="2014">2014</option>
                                    <option value="2013">2013</option>
                                    <option value="2012">2012</option>
                                    <option value="2011">2011</option>
                                    <option value="2010">2010</option>
                                    <option value="2009">2009</option>
                                    <option value="2008">2008</option>
                                    <option value="2007">2007</option>
                                    <option value="2006">2006</option>
                                    <option value="2005">2005</option>
                                    <option value="2004">2004</option>
                                    <option value="2003">2003</option>
                                    <option value="2002">2002</option>
                                    <option value="2001">2001</option>
                                    <option value="2000">2000</option>
                                    <option value="1999">1999</option>
                                    <option value="1998">1998</option>
                                    <option value="1997">1997</option>
                                    <option value="1996">1996</option>
                                    <option value="1995">1995</option>
                                    <option value="1994">1994</option>
                                    <option value="1993">1993</option>
                                    <option value="1992">1992</option>
                                    <option value="1991">1991</option>
                                    <option value="1990">1990</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Cilinder</td>
                            <td><input type="text" name="cilinder" onkeypress="return handleEnter(this, event)"/></td>
                        </tr>
                        <tr>
                            <td>PK</td>
                            <td><input type="text" name="pk" onkeypress="return handleEnter(this, event)"/></td>
                        </tr>
                        <tr>
                            <td>Vermogen</td>
                            <td><input type="text" name="vermogen" onkeypress="return handleEnter(this, event)"/></td>
                        </tr>
                        <tr>
                            <td>Kleur</td>
                            <td><input type="text" name="kleur" onkeypress="return handleEnter(this, event)"/></td>
                        </tr>
                        <tr>
                            <td>Aantal Deuren</td>
                            <td>
                                <select name="deuren" onkeypress="return handleEnter(this, event)">
                                    <option value="3">3</option>
                                    <option value="5" selected>5</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Versnellingen</td>
                            <td>
                                <select name="versnellingen" onkeypress="return handleEnter(this, event)">
                                    <option value="5" selected>5</option>
                                    <option value="6">6</option>
                                    <option value="Automatisch">Automatisch</option>
                                </select>
                            </td>
                        </tr>
                            <tr>
                            <td>Brandstof</td>
                            <td>
                                <select name="brandstof" onkeypress="return handleEnter(this, event)">
                                    <option value="Benzine" selected>Benzine</option>
                                    <option value="Diesel">Diesel</option>
                                    <option value="Gas">Gas</option>
                                    <option value="LPG">LPG</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Kilometer stand</td>
                            <td><input type="text" name="km" onkeypress="return handleEnter(this, event)"/></td>
                        </tr>
                        <tr>
                            <td>Opties</td>
                            <td>
                                <textarea name="opties" id="editor1" rows="10" cols="80"></textarea>
                                <script>
                                    // Replace the <textarea id="editor1"> with a CKEditor
                                    // instance, using default configuration.
                                    CKEDITOR.replace( 'editor1' );
                                </script>
                            </td>
                        </tr>
                        <tr>
                            <td>Prijs</td>
                            <td><input type="text" name="prijs" onkeypress="return handleEnter(this, event)"/></td>
                        </tr>
                        <tr>
                            <td colspan='2'><input type="submit" name="toevoegen" value="Wagen toevoegen"/></td>
                        </tr>
                        </table>
                        </form>

                        <?php
                        }

                        else if ($_POST && $type == "auto")
                        { 
                            dbconnect();
                            auto_toevoegen();
                            mysqli_close($connect);
                        }

            ?>
            </div>
        </div>   
    </div>
    <?php else :
        header("Location: ../admin");
    endif; ?>
    </body>
    
</html>
        
                <!-- Add Nav Slide -->
        <script src="../admin/js/nav.js"></script>