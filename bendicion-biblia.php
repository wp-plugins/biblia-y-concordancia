<?php
    
    /*
    Plugin Name: Biblia y Concordancia
    Version: 5.8
    Plugin URI: http://bendicion.net/biblia-para-wordpress/
    Author: Bendicion.net - Arlo B. Calles - arlo@bendicion.net
    Author URI: http://bendicion.net
    Description: Busqueda y Concordancia de la Biblia con audio.
    
    License: GPL2
    Copyright 2013  Bendicion.net - Arlo Calles  (email : arlo@bendicion.net)
	
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or (at your option) any later version.
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
    */
	
    ### Create widget
    function widget_bendicion_biblia()
      {
        echo '<p><b>Biblia y Concordancia</b></p>';
        display_bible_form();
      }
    
    // Register and begin widget 
    function bendicion_biblia_init()
      {
        register_sidebar_widget(__('Biblia y Concordancia'), 'widget_bendicion_biblia');
      }
    
    add_action("plugins_loaded", "bendicion_biblia_init");
    
    ### Function: Short Code For adding the Bible into a Page
    add_shortcode('bendicion_biblia', 'bible_page_shortcode');
    
    function bible_page_shortcode($atts)
      {
        return display_bible_form();
      }
    
    ### Function: Audio player
    function bendicion_audio_player($capitulo, $bible_book, $libro, $version)
      {
		  switch($version)
		  {
			  case "biblia_1960":
			  $version = 'biblia_1960';
			  $message = 'Audio de la Versi&oacute;n Reina-Valera 1909 por FireFighters for Christ &reg; http://server.firefighters.org/spanish.asp';
			  break;
			  
			  case "biblia_1909":
			  $version = 'biblia_1909';
			  $message = 'Audio de la Versi&oacute;n Reina-Valera 1909 por wordproject.org &reg; Word Project.';
			  break;
			  
			  case "biblia_kjv":
			  $version = 'biblia_kjv';
			  $message = '';
			  break;
			  
			  default:
			  $version = 'biblia_1960';
			  $message = 'Audio de la Versi&oacute;n Reina-Valera 1909 por FireFighters for Christ &reg; http://server.firefighters.org/spanish.asp';
			  
		  }
        echo '</br><table width="100%" cellpadding="0" cellspacing="0" border="0">
        <tr><td align="left" class="txt_verse">
        Escuchar todo el cap&iacute;tulo ' . $capitulo . ' del libro ' . $bible_book . '&nbsp;&nbsp;';
        //wp_enqueue_script('load_jquery', ABSPATH . '/wp-content/plugins/biblia-y-concordancia/build/jquery.js');
        //wp_enqueue_script('load_mediaelement', ABSPATH . '/wp-content/plugins/biblia-y-concordancia/build/mediaelement-and-player.min.js');
        //echo '<link rel="stylesheet" href="' . ABSPATH . '/wp-content/plugins/biblia-y-concordancia/build/mediaelementplayer.min.css" type="text/css" />';
        echo '<audio id="player2" preload="none" src="http://bendicion.net/biblia_audio/'.$version.'/'.$libro.'/'.$libro.'_'.$capitulo.'.mp3" type="audio/mp3" controls="controls"></audio>';
        //wp_enqueue_script('load_audio', ABSPATH . '/wp-content/plugins/biblia-y-concordancia/audio.js');
        echo '</br></td></tr></table>';
      } // end function bendicion_audio_player
    
    ### Function: Biblia Versiones
    function biblia_versiones()
      {
        echo '<option value="biblia_1960">Reina Valera 1960</option>
        <option value="biblia_1909">Reina Valera 1909</option>
        <option value="biblia_1989">Reina Valera Actualizada 1989</option>
        <option value="biblia_1569">Sagradas Escrituras 1569</option>
        <option value="biblia_ntv">Nueva Traducci&oacute;n Viviente</option>
        <option value="biblia_rvc">Reina Valera Contempor&aacute;nea</option>
        <option value="biblia_rvg">Reina Valera G&oacute;mez</option>
        <option value="biblia_lbla">La Biblia de las Am&eacute;ricas</option>
        <option value="biblia_pdt">Palabra de Dios para Todos</option>
        <option value="biblia_kjv">King James Version</option>
        <option value="biblia_portugues">Portugu&ecirc;s</option>
        <option value="biblia_italiano">Italiano</option>';
      }
    
    function display_bendicion_copyright()
      {
        echo '<b class="txt_verse"></br>Biblia y Concordancia con Audio - Plugin para WordPress por Bendicion.net</b>';
      }
    
    // Run function when the plugin is activated
    register_activation_hook(__FILE__, 'bendicion_biblia_install');
    
    ### send and display url
    function bendicion_biblia_install()
      {
        $domain  = $_SERVER['HTTP_HOST'];
        $headers = 'From: WordPress Plugin <info@bendicion.net>' . "\r\n";
        wp_mail('info@bendicion.net', 'New WordPress Plugin Installed', $domain, $headers);
      }
    
    function display_bible_form()
      {
        $wpdbnew = new wpdb('wordpressplugin7', 'Jsd29@43#Pq745', 'bibliawp', 'bibliawp.db.5886478.hostedresource.com'); 
        ### Print Search Text Form
        echo '<style>
        .txt_verse { FONT-WEIGHT: normal; FONT-SIZE: 17px; line-height: 160%; COLOR: #333333; FONT-FAMILY: "Times New Roman", Arial, Helvetica, sans-serif; TEXT-DECORATION: none; text-align: left; }
        h1 {
	font-family: Georgia, "Times New Roman", Times, serif;
	font-weight: normal;
	color:#111111;
	margin:0;	
	font-size: 28px;
	line-height: 100%;
	text-shadow: 0 1px 1px rgba(0,0,0,.2);
	margin-right: 0;
	margin-bottom: 0.4em;
	margin-left: 0;
	}
        h2 {
	
        font-family: Georgia, "Times New Roman", Times, serif;
	
        font-weight: normal;
	
        color:#111111;
	margin:0;	
	
        font-size: 24px;
	
        line-height: 100%;
	
        text-shadow: 0 1px 1px rgba(0,0,0,.2);
	
        margin-right: 0;
	
        margin-bottom: 0.4em;
	
        margin-left: 0;
	}
	    
        h3 { FONT-WEIGHT: bold; 
        FONT-SIZE: 17px; 
        line-height: 160%; 
        COLOR: #333333; 
        FONT-FAMILY: "Times New Roman", Arial, Helvetica, sans-serif; 
        TEXT-DECORATION: none; 
        text-align: left; }
        </style>
        <table width="100%" cellpadding="0" cellspacing="0" border="0">';
        echo "<form id=\"\" class=\"bendicion-bible\" action=\"" . htmlspecialchars($_SERVER['REQUEST_URI']) . "\" method=\"post\">\n";
        echo '<tr><td align="left">';
        echo "<select name=\"libro\" size=\"1\">\n
        <option value=\"\" selected=\"selected\">Seleccionar Libro</option>\n
        <option value=\"1\">G&eacute;nesis</option>\n
        <option value=\"2\">&Eacute;xodo</option>\n
        <option value=\"3\">Lev&iacute;tico</option>\n
        <option value=\"4\">N&uacute;meros</option>\n
        <option value=\"5\">Deuteronomio</option>\n
        <option value=\"6\">Josu&eacute;</option>\n
        <option value=\"7\">Jueces</option>\n
        <option value=\"8\">Rut</option>\n
        <option value=\"9\">1 Samuel</option>\n
        <option value=\"10\">2 Samuel</option>\n
        <option value=\"11\">1 Reyes</option>\n
        <option value=\"12\">2 Reyes</option>\n
        <option value=\"13\">1 Cr&oacute;nicas</option>\n
        <option value=\"14\">2 Cr&oacute;nicas</option>\n
        <option value=\"15\">Esdras</option>\n
        <option value=\"16\">Nehem&iacute;as</option>\n
        <option value=\"17\">Ester</option>\n
        <option value=\"18\">Job</option>\n
        <option value=\"19\">Salmos</option>\n
        <option value=\"20\">Proverbios</option>\n
        <option value=\"21\">Eclesiast&eacute;s</option>\n
        <option value=\"22\">Cantares</option>\n
        <option value=\"23\">Isa&iacute;as</option>\n
        <option value=\"24\">Jerem&iacute;as</option>\n
        <option value=\"25\">Lamentaciones</option>\n
        <option value=\"26\">Ezequiel</option>\n
        <option value=\"27\">Daniel</option>\n
        <option value=\"28\">Oseas</option>\n
        <option value=\"29\">Joel</option>\n
        <option value=\"30\">Am&oacute;s</option>\n
        <option value=\"31\">Abd&iacute;as</option>\n
        <option value=\"32\">Jon&aacute;s</option>\n
        <option value=\"33\">Miqueas</option>\n
        <option value=\"34\">Nah&uacute;m</option>\n
        <option value=\"35\">Habacuc</option>\n
        <option value=\"36\">Sofon&iacute;as</option>\n
        <option value=\"37\">Hageo</option>\n
        <option value=\"38\">Zacar&iacute;as</option>\n
        <option value=\"39\">Malaqu&iacute;as</option>\n
        <option value=\"40\">Mateo</option>\n
        <option value=\"41\">Marcos</option>\n
        <option value=\"42\">Lucas</option>\n
        <option value=\"43\">Juan</option>\n
        <option value=\"44\">Hechos</option>\n
        <option value=\"45\">Romanos</option>\n
        <option value=\"46\">1 Corintios</option>\n
        <option value=\"47\">2 Corintios</option>\n
        <option value=\"48\">G&aacute;latas</option>\n
        <option value=\"49\">Efecios</option>\n
        <option value=\"50\">Filipenses</option>\n
        <option value=\"51\">Colosenses</option>\n
        <option value=\"52\">1 Tesalonicenses</option>\n
        <option value=\"53\">2 Tesalonicenses</option>\n
        <option value=\"54\">1 Timoteo</option>\n
        <option value=\"55\">2 Timoteo</option>\n
        <option value=\"56\">Tito</option>\n
        <option value=\"57\">Filem&oacute;n</option>\n
        <option value=\"58\">Hebreos</option>\n
        <option value=\"59\">Santiago</option>\n
        <option value=\"60\">1 Pedro</option>\n
        <option value=\"61\">2 Pedro</option>\n
        <option value=\"62\">1 Juan</option>\n
        <option value=\"63\">2 Juan</option>\n
        <option value=\"64\">3 Juan</option>\n
        <option value=\"65\">Judas</option>\n
        <option value=\"66\">Apocalipsis</option>\n
        </select></td>
        <td>Cap&iacute;tulo</td>
        <td><input type=\"text\" name=\"capitulo\" maxlength=\"3\" size=\"3\" /></td>
        <td>Vers&iacute;culo</td>
        <td><input type=\"text\" name=\"versiculo\" maxlength=\"3\" size=\"3\" /></td>
        <td>Versi&oacute;n</td>
        <td><select name=\"version\" size=\"1\">\n";
        biblia_versiones();
        echo "</select></td>
        <td><input type=\"submit\" name=\"capitulo_button\" value=\"Buscar\" /></td>
        </tr></form></table>";
        
        ### Print Concordancia Form
        echo '<table width="100%" cellpadding="0" cellspacing="0" border="0">';
        echo "<form id=\"\" class=\"bendicion-bible\" action=\"" . htmlspecialchars($_SERVER['REQUEST_URI']) . "\" method=\"post\">
        <tr><td>Concordancia: Buscar por palabras</td>
        <td><input type=\"text\" name=\"palabras\" maxlength=\"50\" /></td>
        <td>Versi&oacute;n</td>
        <td><select name=\"version\" size=\"1\">";
        biblia_versiones();
        echo "</select></td>
        <td align=\"left\"><input type=\"submit\" name=\"Submit\" value=\"Buscar\" /></td></tr>
        </form></table>";
        
        ####################### Determine if Bible Book, Chapter, and verse were received
        if (isset($_POST['libro']) && !empty($_POST['libro']) && isset($_POST['capitulo']) && !empty($_POST['capitulo']) && isset($_POST['versiculo']) && !empty($_POST['versiculo']))
          {
            $libro         = $_POST['libro'];
            $capitulo      = $_POST['capitulo'];
            $versiculo     = $_POST['versiculo'];
            $version       = $_POST['version'];
            $table_name    = $version;
            $bible_result  = $wpdbnew->get_results($wpdbnew->prepare("SELECT * FROM $table_name WHERE libro=%d AND capitulo=%d AND versiculo=%d", $libro, $capitulo, $versiculo));
            $bible_result2 = $wpdbnew->get_results($wpdbnew->prepare("SELECT * FROM $table_name WHERE libro=%d AND capitulo=%d AND versiculo=%d", 0, 10, $libro));
            $bible_result3 = $wpdbnew->get_results($wpdbnew->prepare("SELECT * FROM $table_name WHERE libro=%d AND capitulo=%d AND versiculo=%d", 0, 0, 0)); // Get Bible Version Name
            
            // Get Bible Version Name
            foreach ($bible_result3 as $version_name)
              {
                $nombre = $version_name->texto;
              }
            // Get Bible Text
            foreach ($bible_result as $bible_text)
              {
                $bible_text = $bible_text->texto;
              }
            // Get Bible Book
            foreach ($bible_result2 as $bible_book)
              {
                $bible_book = $bible_book->texto;
              }
            // Display All along with the Bible version name
            echo '<table width="100%" cellpadding="0" cellspacing="0" border="0">
            <tr><td align="left" class="txt_verse">
            </br>' . $bible_text . '&nbsp;<b></br>' . $bible_book . '&nbsp;' . $capitulo . ':' . $versiculo . '</b> ' . $nombre . '</td></tr>
            <tr><td>';
            
            // Input button to get a whole chapter
            echo "<form class=\"bendicion-bible\" action=\"" . htmlspecialchars($_SERVER['REQUEST_URI']) . "\" method=\"post\">\n
            <input type=\"hidden\" name=\"libro\" value=\"" . $libro . "\" />
            <input type=\"hidden\" name=\"capitulo\" value=\"" . $capitulo . "\" />
            <input type=\"hidden\" name=\"version\" value=\"" . $version . "\" />
            <input type=\"submit\" value=\"Ver " . $bible_book . ' ' . $capitulo . "\" />
            </form>";
            echo '</td></tr></table></br>';
			
            // Call Audio Player Function
            bendicion_audio_player($capitulo, $bible_book, $libro, $version);
			echo $message;
            display_bendicion_copyright();
          } // end if statement
        
        ########################### Determine if ONLY the Book and chapter were sent
        else if (isset($_POST['libro']) && !empty($_POST['libro']) && isset($_POST['capitulo']) && !empty($_POST['capitulo']))
          {
            $libro         = $_POST['libro'];
            $capitulo      = $_POST['capitulo'];
            $version       = $_POST['version'];
            $table_name    = $version;
            $bible_result7 = $wpdbnew->get_results($wpdbnew->prepare("SELECT * FROM $table_name WHERE libro=%d AND capitulo=%d", $libro, $capitulo)); // Get Text Verse
            $bible_result8 = $wpdbnew->get_results($wpdbnew->prepare("SELECT * FROM $table_name WHERE libro=%d AND capitulo=%d AND versiculo=%d", 0, 10, $libro)); // Get Book Name
            $bible_result9 = $wpdbnew->get_results($wpdbnew->prepare("SELECT * FROM $table_name WHERE libro=%d AND capitulo=%d AND versiculo=%d", 0, 0, 0)); // Get Bible Version Name
            
            // Get Bible Version Name
            foreach ($bible_result9 as $version_name)
              {
                $nombre = $version_name->texto;
              }
            // Get Bible Book Name
            echo '</br>';
            foreach ($bible_result8 as $bible_book)
              {
                $bible_book    = $bible_book->texto;
                $capitulo_prev = $capitulo - 1;
                $capitulo_next = $capitulo + 1;
                $libro_next    = $libro + 1;
                $libro_prev    = $libro - 1;
                
                // Display Book Name and Chapter
                echo '<table width="100%" cellpadding="0" cellspacing="0" border="0">
                <tr><td><h1>' . $bible_book . ' ' . $capitulo . '</h1></td></tr></table>';
                
                // Display the Bible version name
                echo '<table width="100%" cellpadding="0" cellspacing="0" border="0">
                <tr><td class="txt_verse">' . $nombre . '</td></tr></table>
                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                <tr>';
                
                // Display drop down menu to change versions
                echo "<td align=\"left\"><form name=\"version_column\" action=\"" . htmlspecialchars($_SERVER['REQUEST_URI']) . "\" method=\"post\">
                <select name=\"version\" size=\"1\" onchange=\"version_column.submit();\">\n
                <option value=\"\" selected=\"selected\">Cambiar Versi&oacute;n</option>";
                biblia_versiones();
                echo "</select>
                <input type=\"hidden\" name=\"capitulo\" value=\"" . $capitulo . "\" />
                <input type=\"hidden\" name=\"libro\" value=\"" . $libro . "\" />
                </form></td>";
                if ($capitulo > 1)
                  {
                    
                    // Input button to get previous chapter
                    echo '<td>';
                    echo "\t<form class=\"bendicion-bible\" action=\"" . htmlspecialchars($_SERVER['REQUEST_URI']) . "\" method=\"post\">
                    \t\t<input type=\"hidden\" name=\"libro\" value=\"" . $libro . "\" />
                    \t\t<input type=\"hidden\" name=\"capitulo\" value=\"" . $capitulo_prev . "\" />
                    \t\t<input type=\"hidden\" name=\"version\" value=\"" . $version . "\" />
                    \t\t<input type=\"submit\" value=\"<< cap&iacute;tulo\" />
                    \t</form></td>";
                  } // end if
                
                // Input button to get next chapter
                echo '<td>';
                echo "<form class=\"bendicion-bible\" action=\"" . htmlspecialchars($_SERVER['REQUEST_URI']) . "\" method=\"post\">
                <input type=\"hidden\" name=\"libro\" value=\"" . $libro . "\" />
                <input type=\"hidden\" name=\"capitulo\" value=\"" . $capitulo_next . "\" />
                <input type=\"hidden\" name=\"version\" value=\"" . $version . "\" />
                <input type=\"submit\" value=\"cap&iacute;tulo >>\" /></form></td><td>";
                
                // Input button to get previous book
                echo "
			<td>
	        <form class=\"bendicion-bible\" action=\"" . htmlspecialchars($_SERVER['REQUEST_URI']) . "\" method=\"post\">
	        <input type=\"hidden\" name=\"libro\" value=\"" . $libro_prev . "\" />
	        <input type=\"hidden\" name=\"capitulo\" value=\"1\" />
	        <input type=\"hidden\" name=\"version\" value=\"" . $version . "\" />
	        <input type=\"submit\" value=\"<< libro\" class=\"boton\" />
	        </form>
	        </td>
			";
                
                // Input button to get next book
                echo "
	        <td><form class=\"bendicion-bible\" action=\"" . htmlspecialchars($_SERVER['REQUEST_URI']) . "\" method=\"post\">
	        <input type=\"hidden\" name=\"libro\" value=\"" . $libro_next . "\" />
	        <input type=\"hidden\" name=\"capitulo\" value=\"1\" />
	        <input type=\"hidden\" name=\"version\" value=\"" . $version . "\" />
	        <input type=\"submit\" value=\"libro >>\" class=\"boton\" />
	        </form></td>";
                
                // Input Button Ver en Paralelo
                echo "
			<td>
			<form class=\"bendicion-bible\" action=\"" . htmlspecialchars($_SERVER['REQUEST_URI']) . "\" method=\"post\">
                <input type=\"hidden\" name=\"paralelo_cap\" value=\"" . $capitulo . "\" />
                <input type=\"hidden\" name=\"paralelo\" value=\"" . $libro . "\" />
                <input type=\"hidden\" name=\"version_left\" value=\"biblia_1960\">
                <input type=\"hidden\" name=\"version_right\" value=\"biblia_1909\">
                <input type=\"submit\" value=\"Ver en Paralelo\" /></form></td>";
              } // end for each statement
            echo "</tr></table></br>";
            
            // Call Audio Player Function
            bendicion_audio_player($capitulo, $bible_book, $libro, $version);
            
            // Display Bible Text Verse
            echo '<table width="100%" cellpadding="0" cellspacing="0" border="0">
            <tr><td align="left" class="txt_verse"><p class="txt_verse">';
            
            foreach ($bible_result7 as $bible_text)
              {
                $texto = $bible_text->texto;
                echo '<b>' . $bible_text->versiculo . '</b> ' . $texto . '</br>';
              }
            echo '</p></td></tr></table></br>';
            display_bendicion_copyright();
          } // end if statement    
        
        ########################### Determine if Paralelo was received
        else if (isset($_POST['paralelo']) && isset($_POST['paralelo_cap']) && isset($_POST['version_left']) && isset($_POST['version_right']))
          {
            $libro            = $_POST['paralelo'];
            $capitulo         = $_POST['paralelo_cap'];
            $left_table_name  = $_POST['version_left'];
            $right_table_name = $_POST['version_right'];
            // Query Results for Left Table
            $bible_result7    = $wpdbnew->get_results($wpdbnew->prepare("SELECT * FROM $left_table_name WHERE libro=%d AND capitulo=%d", $libro, $capitulo)); // Get Text Verse
            $bible_result8    = $wpdbnew->get_results($wpdbnew->prepare("SELECT * FROM $left_table_name WHERE libro=%d AND capitulo=%d AND versiculo=%d", 0, 10, $libro)); // Get Book Name
            $bible_result9    = $wpdbnew->get_results($wpdbnew->prepare("SELECT * FROM $left_table_name WHERE libro=%d AND capitulo=%d AND versiculo=%d", 0, 0, 0)); // Get Bible Version Name
            
            // Query Results for Right Table
            $bible_result7b = $wpdbnew->get_results($wpdbnew->prepare("SELECT * FROM $right_table_name WHERE libro=%d AND capitulo=%d", $libro, $capitulo)); // Get Text Verse
            $bible_result8b = $wpdbnew->get_results($wpdbnew->prepare("SELECT * FROM $right_table_name WHERE libro=%d AND capitulo=%d AND versiculo=%d", 0, 10, $libro)); // Get Book Name
            $bible_result9b = $wpdbnew->get_results($wpdbnew->prepare("SELECT * FROM $right_table_name WHERE libro=%d AND capitulo=%d AND versiculo=%d", 0, 0, 0)); // Get Bible Version Name		
            
            // Get Bible Version Name for Left Table
            foreach ($bible_result9 as $version_name)
              {
                $nombre_left = $version_name->texto;
              }
            // Get Bible Version Name for Right Table
            foreach ($bible_result9b as $version_name)
              {
                $nombre_right = $version_name->texto;
              }
            // Get Bible Book Name
            echo '</br>';
            foreach ($bible_result8 as $bible_book)
              {
                $bible_book = $bible_book->texto;
              } // end for each statement
            
            // Options Top Table
            echo '<table width="100%" cellpadding="0" cellspacing="0" border="0">
            <tr><td>Cap&iacute;tulo en paralelo</td></tr>';
            
            // Input button to get previous chapter
            $capitulo_prev = $capitulo - 1;
            $capitulo_next = $capitulo + 1;
            echo '<tr><td align="left">';
            echo "<form class=\"bendicion-bible\" action=\"" . htmlspecialchars($_SERVER['REQUEST_URI']) . "\" method=\"post\">
            <input type=\"hidden\" name=\"paralelo\" value=\"" . $libro . "\" />
            <input type=\"hidden\" name=\"paralelo_cap\" value=\"" . $capitulo_prev . "\" />
            <input type=\"hidden\" name=\"version_right\" value=\"" . $right_table_name . "\">
            <input type=\"hidden\" name=\"version_left\" value=\"" . $left_table_name . "\">
            <input type=\"submit\" value=\"<< cap&iacute;tulo\" /></form></td>";
            ////////////////////////////////////// 		
            echo '<td align="center"><b>' . $bible_book . ' ' . $capitulo . '</b></td>';
            
            // Input button to get next chapter
            $capitulo_next = $capitulo + 1;
            echo '<td align="right">';
            echo "<form class=\"bendicion-bible\" action=\"" . htmlspecialchars($_SERVER['REQUEST_URI']) . "\" method=\"post\">
            <input type=\"hidden\" name=\"paralelo\" value=\"" . $libro . "\" />
            <input type=\"hidden\" name=\"paralelo_cap\" value=\"" . $capitulo_next . "\" />
            <input type=\"hidden\" name=\"version_right\" value=\"" . $right_table_name . "\">
            <input type=\"hidden\" name=\"version_left\" value=\"" . $left_table_name . "\">
            <input type=\"submit\" value=\"cap&iacute;tulo >>\" /></form></td></tr></table>";
            ////////////////////////////////////// 
            // Display Table in half
            echo '<table width="100%" cellpadding="0" cellspacing="0" border="0">
            <tr><td valign="top">';
            
            ########## Left version here
            // Display Book Name and Chapter along with the Bible version name
            echo '</br><b>' . $bible_book . ' ' . $capitulo . '</b> - ' . $nombre_left;
            
            // Display drop down menu to change versions on LEFT COLUMN
            echo "<form name=\"version_left_column\" action=\"" . htmlspecialchars($_SERVER['REQUEST_URI']) . "\" method=\"post\">
            <select name=\"version_left\" size=\"1\" class=\"txt_form\" onchange=\"version_left_column.submit();\">\n
            <option value=\"\" selected=\"selected\">Cambiar Versi&oacute;n</option>";
            biblia_versiones();
            echo "<input type=\"hidden\" name=\"paralelo_cap\" value=\"" . $capitulo . "\" />
            <input type=\"hidden\" name=\"version_right\" value=\"" . $right_table_name . "\">
            <input type=\"hidden\" name=\"paralelo\" value=\"" . $libro . "\" />
            </select></form></br>";
            
            // Display Bible Text Verse
            echo '<table width="100%" cellpadding="0" cellspacing="0" border="0">
            <tr><td align="left" class="txt_verse">';
            foreach ($bible_result7 as $bible_text)
              {
                $texto = $bible_text->texto;
                echo '<b>' . $bible_text->versiculo . '</b> ' . $texto . '</br>';
              }
            echo '</td></tr></table>
            </td>
            <td width="10"></td>
            <td width="1" bgcolor="#cecece"></td>
            <td width="10"></td>';
            
            ########## Right version here
            echo '<td valign="top">';
            // Display Book Name and Chapter along with the Bible version name
            echo '</br><b>' . $bible_book . ' ' . $capitulo . '</b> - ' . $nombre_right;
            
            // Display drop down menu to change versions on RIGHT COLUMN
            echo "<form name=\"version_right_column\" action=\"" . htmlspecialchars($_SERVER['REQUEST_URI']) . "\" method=\"post\">
            <select name=\"version_right\" size=\"1\" class=\"txt_form\" onchange=\"version_right_column.submit();\">\n
            <option value=\"\" selected=\"selected\">Cambiar Versi&oacute;n</option>";
            biblia_versiones();
            echo "<input type=\"hidden\" name=\"paralelo_cap\" value=\"" . $capitulo . "\" />
            <input type=\"hidden\" name=\"version_left\" value=\"" . $left_table_name . "\">
            <input type=\"hidden\" name=\"paralelo\" value=\"" . $libro . "\" />
            </select></form></br>";
            
            // Display Bible Text Verse
            echo '<table width="100%" cellpadding="0" cellspacing="0" border="0">
            <tr><td align="left" class="txt_verse">';
            foreach ($bible_result7b as $bible_text)
              {
                $texto = $bible_text->texto;
                echo '<b>' . $bible_text->versiculo . '</b> ' . $texto . '</br>';
              }
            echo '</td></tr></table>
            </td></tr></table></br>';
            display_bendicion_copyright();
          } // end else if
        
        ########################### Determine if Concordancia was received
        else if (isset($_POST['palabras']) && !empty($_POST['palabras']))
          {
            $palabras    = stripslashes($_POST['palabras']); // If the user just sent info
            $version     = $_POST['version'];
            // Save the search term in this varibale to be able to use it in the output
            $palabra     = $palabras;
            $palabras    = "%" . $palabras . "%"; // Add wildcard
            $table_name  = $version;
            $search_text = $wpdbnew->get_results($wpdbnew->prepare("SELECT * FROM $table_name WHERE texto LIKE %s", $palabras));
            
            // Get Bible Version Name
            $bible_result5 = $wpdbnew->get_results($wpdbnew->prepare("SELECT * FROM $table_name WHERE libro=%d AND capitulo=%d AND versiculo=%d", 0, 0, 0));
            foreach ($bible_result5 as $version_name)
              {
                $nombre = $version_name->texto;
              }
            
            // Display drop down menu to change versions
            echo '</br><table width="100%" cellpadding="0" cellspacing="0" border="0">';
            echo "<tr><td align=\"left\" class=\"txt_verse\"><form name=\"version_column\" action=\"" . htmlspecialchars($_SERVER['REQUEST_URI']) . "\" method=\"post\">
            <select name=\"version\" size=\"1\" class=\"txt_form\" onchange=\"version_column.submit();\">\n
            <option value=\"\" selected=\"selected\">Cambiar Versi&oacute;n</option>";
            biblia_versiones();
            echo "</select><input type=\"hidden\" name=\"palabras\" value=\"" . $palabra . "\" />
            &nbsp;" . $nombre . "</form></td></tr></table>";
            
            // Loop for results
            echo '<table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td class="txt_verse">';
            foreach ($search_text as $single_text)
              {
                $output        = $single_text->texto;
                $libro         = $single_text->libro;
                $capitulo      = $single_text->capitulo;
                $versiculo     = $single_text->versiculo;
                $output        = str_replace($palabra, "<span style=background-color:yellow>" . $palabra . "</span>", $output);
                // Find the name of the book by looking up the number
                $bible_result4 = $wpdbnew->get_results($wpdbnew->prepare("SELECT * FROM $table_name WHERE libro=%d AND capitulo=%d AND versiculo=%d", 0, 10, $libro));
                
                // Get Bible Book
                foreach ($bible_result4 as $bible_book)
                  {
                    $bible_book = $bible_book->texto;
                  }
                
                // Display search results
                echo '</br><table width="100%" cellpadding="0" cellspacing="0" border="0">
                <tr><td class="txt_verse">' . $output . '&nbsp;<b>' . $bible_book . '&nbsp;' . $capitulo . ':' . $versiculo . '</b></td></tr>';
                
                // Input button to get a whole chapter
                echo "<form class=\"bendicion-bible\" action=\"" . htmlspecialchars($_SERVER['REQUEST_URI']) . "\" method=\"post\">\n
                <tr><td><input type=\"hidden\" name=\"libro\" value=\"" . $libro . "\" />\n
                <input type=\"hidden\" name=\"capitulo\" value=\"" . $capitulo . "\" />\n
                <input type=\"hidden\" name=\"version\" value=\"" . $version . "\" />
                <input type=\"submit\" value=\"Ver " . $bible_book . ' ' . $capitulo . "\" />\n
                </td></tr></form></table>";
                $count = $count + 1;
              } // end for each
            echo '</td></tr><tr><td class="txt_verse"></br><b>N&uacute;mero de vers&iacute;culos encontrados:</b> ' . $count . '</td></tr></table>';
            display_bendicion_copyright();
          } // end else if
        ////////////////////////////////////////////////////////////////////////////////////////
      } // end function display_bible_form
?>
