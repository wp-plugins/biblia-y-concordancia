<? /*
   Plugin Name: Biblia y Concordancia
   Plugin URI:  http://bendicion.net/biblia-para-wordpress/
   Description: Busqueda y concordancia de la Biblia Reina Valera 1909 y 1960.
   Version: 2.0
   Author: Bendicion.net - Arlo B. Calles
   Author URI: http://bendicion.net
   License: GPL2
   
   Copyright 2013  Bendicion.net - Arlo Calles  (email : arlo@bendicion.net)
   This program is free software; you can redistribute it and/or modify
   it under the terms of the GNU General Public License as published by
   the Free Software Foundation; either version 2 of the License, or
   (at your option) any later version.
   
   This program is distributed in the hope that it will be useful,
   but WITHOUT ANY WARRANTY; without even the implied warranty of
   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
   GNU General Public License for more details.
   You should have received a copy of the GNU General Public License
   along with this program; if not, write to the Free Software
   Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
   */
global $bendicion_biblia_db_version;
$bendicion_biblia_db_version = "2.0";

### Create widget
function widget_bendicion_biblia() {
  echo '<p><b>Biblia y Concordancia</b></p>';
  display_bible_form();
}
// Register and begin widget 
function bendicion_biblia_init() {
  register_sidebar_widget(__('Biblia y Concordancia'), 'widget_bendicion_biblia');     
}
add_action("plugins_loaded", "bendicion_biblia_init");
// Run function when the plugin is activated
register_activation_hook(__FILE__, 'bendicion_biblia_install');

### Create table and insert data
function bendicion_biblia_install() {
	global $wpdb;
	global $bendicion_biblia_db_version;
	
    // If table bendicion_biblia_1960 doesn't exist
	$table_name = $wpdb->prefix . "bendicion_biblia_1960";
	if($wpdb->get_var("show tables like $table_name") != $table_name)
	{
    // Import data file for Bible version RV 1960
	require_once(ABSPATH . 'wp-content/plugins/biblia-y-concordancia/bendicion_biblia_database_1960.php');
//echo file_get_contents('http://bendicion.net/wp-content/plugins/biblia-y-concordancia/bendicion_biblia_database.php');
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql);
	add_option("bendicion_biblia_db_version", $bendicion_biblia_db_version);
	}
	
	// If table bendicion_biblia_1909 doesn't exist
	$table_name_2 = $wpdb->prefix . "bendicion_biblia_1909";
	if($wpdb->get_var("show tables like $table_name_2") != $table_name_2)
	{
    // Import data file for Bible version RV 1909
	$table_name_2 = $wpdb->prefix . "bendicion_biblia_1909";
	require_once(ABSPATH . 'wp-content/plugins/biblia-y-concordancia/bendicion_biblia_database_1909.php');
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql);
	add_option("bendicion_biblia_db_version", $bendicion_biblia_db_version);
	}	
}
### Run function when the plugin is deactivated
register_deactivation_hook(__FILE__, 'bendicion_biblia_uninstall');

// Delete table
function bendicion_biblia_uninstall() {
	global $wpdb;
	$table_name = $wpdb->prefix . "bendicion_biblia_1960";
	$bible_delete_table = $wpdb->get_results( $wpdb->prepare("DROP TABLE $table_name") );
	$table_name = $wpdb->prefix . "bendicion_biblia_1909";
	$bible_delete_table = $wpdb->get_results( $wpdb->prepare("DROP TABLE $table_name") );
}

### Function: Short Code For adding the Bible into a Page
add_shortcode('bendicion_biblia', 'bible_page_shortcode');
function bible_page_shortcode($atts) {
	return display_bible_form();
}

### Function: Display Bible Form
function display_bible_form() {
$highlight_color = 'ffff00';

### Print Search Text Form
  echo "\t<form id=\"\" class=\"bendicion-bible\" action=\"".htmlspecialchars($_SERVER['REQUEST_URI'])."\" method=\"post\">\n";
  echo "<select name=\"libro\" size=\"1\">\n";
  echo "<option value=\"\" selected=\"selected\">Seleccionar Libro</option>\n";  
  echo "<option value=\"1\">G&eacute;nesis</option>\n";
  echo "<option value=\"2\">&Eacute;xodo</option>\n";
  echo "<option value=\"3\">Lev&iacute;tico</option>\n";
  echo "<option value=\"4\">N&uacute;meros</option>\n";
  echo "<option value=\"5\">Deuteronomio</option>\n";
  echo "<option value=\"6\">Josu&eacute;</option>\n";
  echo "<option value=\"7\">Jueces</option>\n";
  echo "<option value=\"8\">Rut</option>\n";
  echo "<option value=\"9\">1 Samuel</option>\n";
  echo "<option value=\"10\">2 Samuel</option>\n";
  echo "<option value=\"11\">1 Reyes</option>\n";
  echo "<option value=\"12\">2 Reyes</option>\n";
  echo "<option value=\"13\">1 Cr&oacute;nicas</option>\n";
  echo "<option value=\"14\">2 Cr&oacute;nicas</option>\n";
  echo "<option value=\"15\">Esdras</option>\n";
  echo "<option value=\"16\">Nehem&iacute;as</option>\n";
  echo "<option value=\"17\">Ester</option>\n";
  echo "<option value=\"18\">Job</option>\n";
  echo "<option value=\"19\">Salmos</option>\n";
  echo "<option value=\"20\">Proverbios</option>\n";
  echo "<option value=\"21\">Eclesiast&eacute;s</option>\n";
  echo "<option value=\"22\">Cantares</option>\n";
  echo "<option value=\"23\">Isa&iacute;as</option>\n";
  echo "<option value=\"24\">Jerem&iacute;as</option>\n";
  echo "<option value=\"25\">Lamentaciones</option>\n";
  echo "<option value=\"26\">Ezequiel</option>\n";
  echo "<option value=\"27\">Daniel</option>\n";
  echo "<option value=\"28\">Oseas</option>\n";
  echo "<option value=\"29\">Joel</option>\n";
  echo "<option value=\"30\">Am&oacute;s</option>\n";
  echo "<option value=\"31\">Abd&iacute;as</option>\n";
  echo "<option value=\"32\">Jon&aacute;s</option>\n";
  echo "<option value=\"33\">Miqueas</option>\n";
  echo "<option value=\"34\">Nah&uacute;m</option>\n";
  echo "<option value=\"35\">Habacuc</option>\n";
  echo "<option value=\"36\">Sofon&iacute;as</option>\n";
  echo "<option value=\"37\">Hageo</option>\n";
  echo "<option value=\"38\">Zacar&iacute;as</option>\n";
  echo "<option value=\"39\">Malaqu&iacute;as</option>\n";
  echo "<option value=\"40\">Mateo</option>\n";
  echo "<option value=\"41\">Marcos</option>\n";
  echo "<option value=\"42\">Lucas</option>\n";
  echo "<option value=\"43\">Juan</option>\n";
  echo "<option value=\"44\">Hechos</option>\n";
  echo "<option value=\"45\">Romanos</option>\n";
  echo "<option value=\"46\">1 Corintios</option>\n";
  echo "<option value=\"47\">2 Corintios</option>\n";
  echo "<option value=\"48\">G&aacute;latas</option>\n";
  echo "<option value=\"49\">Efecios</option>\n";
  echo "<option value=\"50\">Filipenses</option>\n";
  echo "<option value=\"51\">Colosenses</option>\n";
  echo "<option value=\"52\">1 Tesalonicenses</option>\n";
  echo "<option value=\"53\">2 Tesalonicenses</option>\n";
  echo "<option value=\"54\">1 Timoteo</option>\n";
  echo "<option value=\"55\">2 Timoteo</option>\n";
  echo "<option value=\"56\">Tito</option>\n";
  echo "<option value=\"57\">Filem&oacute;n</option>\n";
  echo "<option value=\"58\">Hebreos</option>\n";
  echo "<option value=\"59\">Santiago</option>\n";
  echo "<option value=\"60\">1 Pedro</option>\n";
  echo "<option value=\"61\">2 Pedro</option>\n";
  echo "<option value=\"62\">1 Juan</option>\n";
  echo "<option value=\"63\">2 Juan</option>\n";
  echo "<option value=\"64\">3 Juan</option>\n";
  echo "<option value=\"65\">Judas</option>\n";
  echo "<option value=\"66\">Apocalipsis</option>\n";
  echo "</select>\n";
  echo "\t\t<input type=\"text\" name=\"capitulo\" maxlength=\"3\" size=\"4\" onBlur=\"if (value == '') {value = 'cap&iacute;tulo'}\" 
                        onFocus=\"if (value == 'cap&iacute;tulo') {value =''}\" 
                        value=\"cap&iacute;tulo\" />"."\n";
  echo "\t\t<input type=\"text\" name=\"versiculo\" maxlength=\"3\" size=\"4\" onBlur=\"if (value == '') {value = 'vers&iacute;culo'}\" 
                        onFocus=\"if (value == 'vers&iacute;culo') {value =''}\" 
                        value=\"vers&iacute;culo\" />"."\n";
  echo "\t\t<input type=\"submit\" name=\"Submit\" value=\"Buscar\" />\n";
  echo "\t</form>\n";

### Print Concordancia Form
  echo "\t<form id=\"\" class=\"bendicion-bible\" action=\"".htmlspecialchars($_SERVER['REQUEST_URI'])."\" method=\"post\">\n";
  echo "\t\t<input type=\"text\" name=\"palabras\" maxlength=\"50\" onBlur=\"if (value == '') {value = 'Por palabras'}\" 
                        onFocus=\"if (value == 'Por palabras') {value =''}\" 
                        value=\"Por palabras\" />"."\n";
  // Give user the option to select the Bible version
  echo "Versi&oacute;n";
  echo "\t\t<input type=\"radio\" name=\"version\" value=\"rv1909\" /> RV 1909";
  echo "\t\t<input type=\"radio\" name=\"version\" value=\"rv1960\" checked /> RV 1960\n";
  					
  echo "\t\t<input type=\"submit\" name=\"Submit\" value=\"Buscar\" />\n";
  echo "\t</form>\n";

### Determine if Bible text was received
if (isset($_POST['libro']) && !empty($_POST['libro']) && isset($_POST['capitulo']) && !empty($_POST['capitulo']) && isset($_POST['versiculo']) && !empty($_POST['versiculo']))
{
   // If the user just sent info
   $libro = $_POST['libro'];
   $capitulo = $_POST['capitulo'];
   $versiculo = $_POST['versiculo'];
global $wpdb;   
$table_name = $wpdb->prefix.'bendicion_biblia_1960';
$bible_result = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_name WHERE libro=$libro AND capitulo=$capitulo AND versiculo=$versiculo") );
$bible_result2 = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_name WHERE libro=0 AND capitulo=10 AND versiculo=$libro") );
// Get Bible Text
foreach($bible_result as $bible_text) {
			$bible_text = $bible_text->texto;
       }
// Get Bible Book
foreach($bible_result2 as $bible_book) {
			$bible_book = $bible_book->texto;
       }
// Display All
echo $bible_text.'&nbsp;'.$bible_book.'&nbsp;'.$capitulo.':'.$versiculo.'</br></br>Citas b&iacute;blicas tomadas de la <b>Reina-Valera 1960 (RVR1960)</b></br>Copyright © 1960 by American Bible Society.';
}

### Determine if Concordancia was received
else if (isset($_POST['palabras']) && !empty($_POST['palabras']) && isset($_POST['version']) && !empty($_POST['version']))
{
   // If the user just sent info
   $palabras = stripslashes($_POST['palabras']);
   $version = $_POST['version'];
   // Save the search term in this varibale to be able to use it in the output
   $palabra = $palabras;
   // Add wildcard
   $palabras = "%" . $palabras . "%";
   // Connect to the database
   global $wpdb;
   //$table_name = $wpdb->prefix.'bendicion_biblia';

   if ($version == 'rv1909'){
	   $table_name = $wpdb->prefix.'bendicion_biblia_1909';
   }
   if ($version == 'rv1960'){
	   $table_name = $wpdb->prefix.'bendicion_biblia_1960';
   } 
   
   $search_text = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_name WHERE texto LIKE %s", $palabras) );
   // Loop for results
   foreach ($search_text as $single_text) {
     $output = $single_text->texto;
     $libro = $single_text->libro;
	 $capitulo = $single_text->capitulo;
	 $versiculo = $single_text->versiculo;
     $output = str_replace($palabra,"<span style=background-color:yellow>".$palabra."</span>",$output);
	 // Find the name of the book by looking up the number
	 $bible_result2 = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $table_name WHERE libro=0 AND capitulo=10 AND versiculo=$libro") );
	 // Get Bible Book
     foreach($bible_result2 as $bible_book) {
			$bible_book = $bible_book->texto;
     }
	 // Display search results
	 echo '<p>'.$output.'&nbsp;'.$bible_book.'&nbsp;'.$capitulo.':'.$versiculo.'</p>';
	 $count = $count + 1;
   }
   echo '<b>N&uacute;mero de vers&iacute;culos encontrados:</b> '.$count.'</br></br>Citas b&iacute;blicas tomadas de la <b>Reina-Valera 1960 (RVR1960)</b></br>Copyright © 1960 by American Bible Society.';
}
}
return $display_bible_form;
$wpdb->flush();
?>