<?php
include_once 'includes/_connect.php';
include_once 'includes/_functions.php';
 
session_start();

if (login_check($mysqli) == true)
{

$type = $_GET['type'];

    if (!$_POST && $type == "auto")
    { 

    ?>
    <!doctype html>
    <html>
        <head>
            <title>Admin Control Panel</title>
            <?php include_once "includes/_scripts.php"; ?>
            <script type="text/javascript" src="js/jquery.autocomplete.min.js"></script>
            <script type="text/javascript" src="js/data.js"></script>

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

        <div id="wrapper">
            <div id="left">
                <div id="left-wrap">
                    <h1>ACP</h1>
                    <h3>Welkom, <?php echo htmlentities($_SESSION['username']); ?>!</h3>
                    <nav>
                        <ul>
                            <li><a href="view.php">Overzicht <i class="fa fa-list"></i></a></li>
                            <li class="current"><a href="add.php?type=auto">Wagen toevoegen <i class="fa fa-car"></i></a></li>
                            <li><a href="includes/logout.php">Uitloggen <i class="fa fa-sign-out"></i></a></li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div id="right">
                <div id="right-wrap">
                    <a href="#" id="toggleNav"><i class="fa fa-chevron-right arrow fa-3x"></i><span class='toggle'>Toon navigatie</span></a>
                    <h1>Wagen toevoegen aan stock</h1><br>


                            <form action="add.php?type=auto" method="post" id="form">
                            <table width='50%'>
                            <thead>
                                <th colspan='2'>Wagen toevoegen</th>
                            </thead>
                            <tr>
                                <td>Merk</td>
                                <td>
                                    <div class="ui-widget">
                                        <input type="text" name="merk" id="autocomplete" onkeypress="return handleEnter(this, event)">
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
                                <td><input type="text" name="prijs" onkeypress="return handleEnter(this, event)" required/></td>
                            </tr>
                            <tr>
                                <td colspan='2'><input type="submit" name="toevoegen" value="Wagen toevoegen"/></td>
                            </tr>
                            </table>
                            </form>
                </div>
            </div>   
        </div>
        </body>

    </html>

    <!-- Add Nav Slide -->
    <script src="../admin/js/nav.js"></script>

    <?php
    }
    else if ($_POST && $type == "auto")
    { 
        auto_toevoegen($mysqli);
    }
}

else {
    header("Location: ../admin");
}