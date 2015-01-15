<?php
    /*
    Plugin Name: Biblia y Concordancia con Audio
    Version: 6.3
    Plugin URI: http://bibleplugin.com/
    Author: Bendicion.net - BiblePlugin.com - Arlo B. Calles - arlo@bendicion.net
    Author URI: http://bendicion.net
    Description: Busqueda y Concordancia de la Biblia con audio.
    
    License: GPL2
    Copyright 2015  Bendicion.net - Arlo Calles  (email : arlo@bendicion.net)
    */
	
    ### Create widget
    function widget_bendicion_biblia() {
        echo '<p><b>Biblia y Concordancia con Audio</b></p>';
        display_bible_form();
      }
    
    // Register and begin widget 
    function bendicion_biblia_init() {
        register_sidebar_widget(__('Biblia y Concordancia'), 'widget_bendicion_biblia');
      }
    
    add_action("plugins_loaded", "bendicion_biblia_init");
    
    ### Function: Short Code For adding the Bible into a Page
    add_shortcode('bendicion_biblia', 'bible_page_shortcode');
    
    function bible_page_shortcode($atts) {
        return display_bible_form();
      }
    
    ### Function: Audio player
    function bendicion_audio_player($capitulo, $bible_book, $libro, $version) {
		  switch($version)
		  {
			  case "biblia_1960":
			  $version = 'biblia_1960';
			  break;
			  
			  case "biblia_1909":
			  $version = 'biblia_1909';
			  break;
			  
			  case "biblia_kjv":
			  $version = 'biblia_kjv';
			  break;
			  
			  default:
			  $version = 'biblia_1960';
		  } // end switch
        echo '<table width="100%" cellpadding="0" cellspacing="0" border="0">
        <tr><td align="left" class="txt_verse">';
        echo '<audio id="player2" preload="none" src="http://bendicion.net/biblia_audio/'.$version.'/'.$libro.'/'.$libro.'_'.$capitulo.'.mp3" type="audio/mp3" controls="controls"></audio>';
        echo '</td></tr></table>';
      } // end function bendicion_audio_player
    
    ### Function: Biblia Versiones
    function biblia_versiones() {
       echo '<option value="biblia_1960" selected="selected">Reina Valera 1960 (RVR 1960)</option>
       <option value="biblia_1909">Reina Valera 1909 (RVR 1909)</option>
	   <option value="biblia_1989">Reina Valera Actualizada (RVA 1989)</option>
	   <option value="biblia_1977">Reina Valera (RV 1977)</option>
	   <option value="biblia_2000">Reina Valera (RV 2000)</option>
	   <option value="biblia_rvc">Reina Valera Contempor&aacute;nea (RVC 2011)</option>
	   <option value="biblia_rvg">Reina Valera G&oacute;mez (RVG 2004)</option>
	   <option value="biblia_1569">Sagradas Escrituras 1569</option>
	   <option value="biblia_ntv">Nueva Traducci&oacute;n Viviente (NTV 2009)</option>
	   <option value="biblia_nvi">Nueva Versi&oacute;n Internacional (NVI 1999)</option>
	   <option value="biblia_nblh">Nueva Biblia de los Hispanos (NBLH 2005)</option>
	   <option value="biblia_lbla">La Biblia de las Am&eacute;ricas (LBLA 1997)</option>
	   <option value="biblia_pdt">Palabra de Dios para Todos (PDT 2005)</option>
	   <option value="biblia_tla">Traducci&oacute;n en Lenguaje Actual (TLA 2002)</option>	   
	   <option value="biblia_dhhl">Dios Habla Hoy Edici&oacute;n Latinoamericana (DHHL 1996)</option>
	   <option value="biblia_vin">Biblia Versi&oacute;n Israelita Nazarena (VIN 2007)</option>
	   <option value="biblia_bls">Biblia en Lenguaje Sencillo (BLS 2008)</option>
	   <option value="biblia_vm">Biblia Versi&oacute;n Moderna de H.B. Pratt (VM 1929)</option>
	   <option value="biblia_blph">Biblia La Palabra Versi&oacute;n Hispanoamericana (BLPH 2011)</option>
	   <option value="biblia_kjv">King James Version (KJV)</option>';
      }
    
    function display_bendicion_copyright() {
        echo '<b class="txt_verse">Biblia y Concordancia con Audio - Plugin para WordPress por Bendicion.net</b>';
      }
    
    // Run function when the plugin is activated
    register_activation_hook(__FILE__, 'bendicion_biblia_install');
    
    ### send and display url
    function bendicion_biblia_install() {
        $domain  = $_SERVER['HTTP_HOST'];
        $headers = 'From: WordPress Plugin <info@bendicion.net>' . "\r\n";
        wp_mail('info@bendicion.net', 'New WordPress Plugin Installed', $domain, $headers);
      }

	function my_action_javascript() { ?>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script type="text/javascript" >
		$(document).ready(function(){	
			$('#libroDrop').on('change', function() {
				if ( this.value != ''){
					$("#wait_1").show();
					var libro = this.value;
					if ( libro != -1 ) {				
						var data = {
							'action': 'my_action',
							'libroSelected': libro
						};
						$.post('<?php echo admin_url( 'admin-ajax.php' ); ?>', data, function(response) {
							$("#wait_1").hide();
							$("#capituloText").show();
							$("#capituloInput").show();
							$('#capituloInput #capitulo').html(response);
						});
					}
				}
				else{
					$("#capituloText").hide();
					$("#capituloInput").hide();
					$("#versiculoText").hide();
					$("#versiculoInput").hide();
					$("#versionText").hide();
					$("#versionSelect").hide();
				}
			});
		});
		</script> <?php
	}

	add_action( 'wp_ajax_my_action', 'my_action_callback' );
	add_action( 'wp_ajax_nopriv_my_action', 'my_action_callback' );
	
	function my_action_callback() {
		$libroSelected = $_POST['libroSelected'];
		global $wpdb;
		$wpdbnew = new wpdb('wordpressplugin7', 'Jsd29@43#Pq745', 'bibliawp', 'bibliawp.db.5886478.hostedresource.com');
		$table_name = "biblia_1960";
		$getCapitulo  = $wpdbnew->get_results($wpdbnew->prepare("SELECT distinct(capitulo) FROM $table_name where libro=%d", $libroSelected));
		$CapituloData .= "<option selected>Capitulo</option>";
		foreach($getCapitulo as $row){
			$capitulo = $row->capitulo;
			$CapituloData .= "<option value=$capitulo>$capitulo</option>";
		}
		echo $CapituloData;
		die();
	}
	
	function capitulo_action_javascript() { ?>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script type="text/javascript" >
		$(document).ready(function(){	
			$( "#capitulo" ).on('change', function() {
				if ( this.value != ''){
					$("#wait_2").show();
					var capitulo = this.value;
					if ( capitulo != -1 ) {				
						var data = {
							'action': 'capitulo_action',
							'capituloSelected': capitulo
						};
						$.post('<?php echo admin_url( 'admin-ajax.php' ); ?>', data, function(response) {
							$("#wait_2").hide();
							$("#versiculoText").show();
							$("#versiculoInput").show();
							$("#versionText").show();
							$("#versionSelect").show();
							$('#versiculoInput #versiculo').html(response);
						});
					}
				}
			});
		});
		</script> <?php
	}
	add_action( 'wp_ajax_capitulo_action', 'capitulo_action_callback' );
	add_action( 'wp_ajax_nopriv_capitulo_action', 'capitulo_action_callback' );
	
	function capitulo_action_callback() {
		$capituloSelected = $_POST['capituloSelected'];
		global $wpdb;
		$wpdbnew = new wpdb('wordpressplugin7', 'Jsd29@43#Pq745', 'bibliawp', 'bibliawp.db.5886478.hostedresource.com');
		
		$getVersiculo  = $wpdbnew->get_results($wpdbnew->prepare("SELECT * FROM capitulos where capitulos=%d  LIMIT 1", $capituloSelected));
		$versiculoData	= '<option value=" " disabled="disabled" selected="selected">Vers&iacute;culo</option>';
			for($i=1;$i<=$getVersiculo[0]->versiculos;$i++) {
				$versiculoData .= '<option value="'.$i.'">'.$i.'</option>';
			}
		echo $versiculoData;
		die();
	}
	
    function display_bible_form()
    {
		global $wpdb;
		$savedLibro = get_option( 'bible_defalt_libro' );
		$savedCapitulo = get_option( 'bible_defalt_capitulo' );
		$savedVersiculo = get_option( 'bible_defalt_versiculo' );
		$savedVersion = get_option( 'bible_defalt_version' );
		$savedColor = 'yellow';
		
        $wpdbnew = new wpdb('wordpressplugin7', 'Jsd29@43#Pq745', 'bibliawp', 'bibliawp.db.5886478.hostedresource.com');
		$table_name = $_POST['version'];
		add_action( 'wp_footer', 'my_action_javascript' ); // Write JS below here
		add_action( 'wp_footer', 'capitulo_action_javascript' ); // Write JS below here
		$plugin_url = plugins_url();
		
		// Call CSS fonts
		wp_register_style('bendicion_biblia_css', $plugin_url.'/biblia-y-concordancia/css/bendicion_biblia.css');
		wp_enqueue_style( 'bendicion_biblia_css');
		
		### Print Search Text Form
        echo '<table width="100%" cellpadding="0" cellspacing="0" border="0">';
        echo '<form id="" class="bendicion-bible" action="' . htmlspecialchars($_SERVER['REQUEST_URI']) . '" method="post">';
        echo '<tr><td align="left">';
        $capitulo_drop = '<select name="capitulo" id="capitulo" class="txt_verse"><option value=" " disabled="disabled" selected="selected">Capítulo</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option><option value="32">32</option><option value="33">33</option><option value="34">34</option><option value="35">35</option><option value="36">36</option></select>';
		$versiculo_drop = '<select name="versiculo" id="versiculo" class="txt_form"><option value=" " disabled="disabled" selected="selected">Versículo</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option></select>';

		echo '<select id="libroDrop" name="libro" size="1">
        <option value="" selected="selected" disabled="disabled">Seleccionar Libro</option>n
        <option value="1">G&eacute;nesis</option>
        <option value="2">&Eacute;xodo</option>
        <option value="3">Lev&iacute;tico</option>
        <option value="4">N&uacute;meros</option>
        <option value="5">Deuteronomio</option>
        <option value="6">Josu&eacute;</option>
        <option value="7">Jueces</option>
        <option value="8">Rut</option>
        <option value="9">1 Samuel</option>
        <option value="10">2 Samuel</option>
        <option value="11">1 Reyes</option>
        <option value="12">2 Reyes</option>
        <option value="13">1 Cr&oacute;nicas</option>
        <option value="14">2 Cr&oacute;nicas</option>
        <option value="15">Esdras</option>
        <option value="16">Nehem&iacute;as</option>
        <option value="17">Ester</option>
        <option value="18">Job</option>
        <option value="19">Salmos</option>
        <option value="20">Proverbios</option>
        <option value="21">Eclesiast&eacute;s</option>
        <option value="22">Cantares</option>
        <option value="23">Isa&iacute;as</option>
        <option value="24">Jerem&iacute;as</option>
        <option value="25">Lamentaciones</option>
        <option value="26">Ezequiel</option>
        <option value="27">Daniel</option>
        <option value="28">Oseas</option>
        <option value="29">Joel</option>
        <option value="30">Am&oacute;s</option>
        <option value="31">Abd&iacute;as</option>
        <option value="32">Jon&aacute;s</option>
        <option value="33">Miqueas</option>
        <option value="34">Nah&uacute;m</option>
        <option value="35">Habacuc</option>
        <option value="36">Sofon&iacute;as</option>
        <option value="37">Hageo</option>
        <option value="38">Zacar&iacute;as</option>
        <option value="39">Malaqu&iacute;as</option>
        <option value="40">Mateo</option>
        <option value="41">Marcos</option>
        <option value="42">Lucas</option>
        <option value="43">Juan</option>
        <option value="44">Hechos</option>
        <option value="45">Romanos</option>
        <option value="46">1 Corintios</option>
        <option value="47">2 Corintios</option>
        <option value="48">G&aacute;latas</option>
        <option value="49">Efecios</option>
        <option value="50">Filipenses</option>
        <option value="51">Colosenses</option>
        <option value="52">1 Tesalonicenses</option>
        <option value="53">2 Tesalonicenses</option>
        <option value="54">1 Timoteo</option>
        <option value="55">2 Timoteo</option>
        <option value="56">Tito</option>
        <option value="57">Filem&oacute;n</option>
        <option value="58">Hebreos</option>
        <option value="59">Santiago</option>
        <option value="60">1 Pedro</option>
        <option value="61">2 Pedro</option>
        <option value="62">1 Juan</option>
        <option value="63">2 Juan</option>
        <option value="64">3 Juan</option>
        <option value="65">Judas</option>
        <option value="66">Apocalipsis</option>
        </select>';
		echo "
		<span id='wait_1' style='display: none;'>
		<img alt='Porfavor espere...' src='$plugin_url/biblia-y-concordancia/images/ajax-loader.gif'>
		</span></td>
        <td id='capituloText' style='display:none;' align='left' class='txt_verse'>Cap&iacute;tulo</td>
        <td id='capituloInput' style='display:none;' align='left'>$capitulo_drop
		<span id='wait_2' style='display: none;'>
		<img alt='Porfavor espere...' src='$plugin_url/biblia-y-concordancia/images/ajax-loader.gif'>
		</span>
		</td>
        <td id='versiculoText' style='display:none;' class='txt_verse'>Vers&iacute;culo</td>
        <td id='versiculoInput' style='display:none;'>$versiculo_drop</td>
        <td id='versionText' style='display:none;' class='txt_verse'>Versi&oacute;n</td>
        <td id='versionSelect' style='display:none;'><select id='versionDrop' name=\"version\" size=\"1\">\n";
        biblia_versiones();
        echo '</select></td><td><input type="submit" name="capitulo_button" value="Buscar" /></td></tr></form></table>';
        
        ### Print Concordancia Form
        echo '<table width="100%" cellpadding="0" cellspacing="0" border="0">';
        echo '<form id="" class="bendicion-bible" action="' . htmlspecialchars($_SERVER['REQUEST_URI']) . '" method="post">
        <tr><td class="txt_verse">Concordancia: Buscar por palabras</td>
        <td><input type="text" name="palabras" maxlength="50" /></td>
        <td class="txt_verse">Versi&oacute;n</td>
        <td><select name="version" size="1">';
        biblia_versiones();
        echo '</select></td><td align="left"><input type="submit" name="Submit" value="Buscar" /></td></tr></form></table>';
        
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
            <tr><td align="left" class="txt_verse">' . $bible_text . '&nbsp;<b></br>' . $bible_book . '&nbsp;' . $capitulo . ':' . $versiculo . '</b> ' . $nombre . '</td></tr>
            <tr><td>';
            
            // Input button to get a whole chapter
            echo '<form class="bendicion-bible" action="'. htmlspecialchars($_SERVER['REQUEST_URI']).'" method="post">
            <input type="hidden" name="libro" value="'. $libro .'" />
            <input type="hidden" name="capitulo" value="'. $capitulo.'" />
            <input type="hidden" name="version" value="'. $version.'" />
            <input type="submit" value="Ver '.$bible_book.' '.$capitulo.'" />
            </form></td></tr></table>';
			
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
            $bible_result7 = $wpdbnew->get_results($wpdbnew->prepare("SELECT * FROM $table_name WHERE libro=%d AND capitulo=%d ORDER BY versiculo ASC", $libro, $capitulo)); // Get Text Verse
            $bible_result8 = $wpdbnew->get_results($wpdbnew->prepare("SELECT * FROM $table_name WHERE libro=%d AND capitulo=%d AND versiculo=%d", 0, 10, $libro)); // Get Book Name
            $bible_result9 = $wpdbnew->get_results($wpdbnew->prepare("SELECT * FROM $table_name WHERE libro=%d AND capitulo=%d AND versiculo=%d", 0, 0, 0)); // Get Bible Version Name
            
            // Get Bible Version Name
            foreach ($bible_result9 as $version_name)
              {
                $nombre = $version_name->texto;
              }
            //echo '</br>';

		// Get Bible Book Name
		//$bible_result28 = $wpdbnew->get_results($wpdbnew->prepare("SELECT * FROM nombres_de_libros WHERE libro=%d", $libro));
            //foreach ($bible_result28 as $bible_book)
			foreach ($bible_result8 as $bible_book)
              {
				//$bible_book = $bible_book->nombre;
                $bible_book = $bible_book->texto;
              }
			  
                $capitulo_prev = $capitulo - 1;
                $capitulo_next = $capitulo + 1;
                $libro_next    = $libro + 1;
                $libro_prev    = $libro - 1;
						
        // Display book and chapter name at the very top
		echo '<table width="100%" cellpadding="0" cellspacing="0" border="0">';
		echo '<tr><td class="book_name"><br>'.$bible_book.' '.$capitulo.'</td></tr></table>';

                // Display the Bible version name
                echo '<table width="100%" cellpadding="0" cellspacing="0" border="0">
                <tr><td class="txt_verse">' . $nombre . '</td></tr></table>
                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                <tr>';
                
                // Display drop down menu to change versions
                echo "<td align=\"left\"><form name=\"version_column\" action=\"" . htmlspecialchars($_SERVER['REQUEST_URI']) . "\" method=\"post\">
                <select name=\"version\" size=\"1\" class=\"txt_verse\" onchange=\"version_column.submit();\">\n
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

			    // Check to see whether there is a next chapter or not
				$find_chapter = mysql_query("SELECT libro, capitulo FROM $table_name WHERE libro='$libro' AND capitulo='$capitulo_next'");
				if (mysql_num_rows($find_chapter))
				  {				
                // Input button to get next chapter
                echo "<td><form class=\"bendicion-bible\" action=\"" . htmlspecialchars($_SERVER['REQUEST_URI']) . "\" method=\"post\">
                <input type=\"hidden\" name=\"libro\" value=\"" . $libro . "\" />
                <input type=\"hidden\" name=\"capitulo\" value=\"" . $capitulo_next . "\" />
                <input type=\"hidden\" name=\"version\" value=\"" . $version . "\" />
                <input type=\"submit\" value=\"cap&iacute;tulo >>\" /></form></td><td>";
				} // end if
				
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
            echo "</tr></table>";
            
            // Call Audio Player Function
            bendicion_audio_player($capitulo, $bible_book, $libro, $version);
            
            // Display Bible Text Verse
            echo '<table width="100%" cellpadding="0" cellspacing="0" border="0" class="hovertable">';
            foreach ($bible_result7 as $bible_text)
              {
                $texto = $bible_text->texto;
				echo '<tr><td class="txt_verse"><sup class="txt_sup">' . $bible_text->versiculo . '</sup> ' . $texto . '</br></td></tr>';
              }
            echo '</table></br>';
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
            $bible_result7    = $wpdbnew->get_results($wpdbnew->prepare("SELECT * FROM $left_table_name WHERE libro=%d AND capitulo=%d ORDER BY versiculo ASC", $libro, $capitulo)); // Get Text Verse
            $bible_result8    = $wpdbnew->get_results($wpdbnew->prepare("SELECT * FROM $left_table_name WHERE libro=%d AND capitulo=%d AND versiculo=%d", 0, 10, $libro)); // Get Book Name
            $bible_result9    = $wpdbnew->get_results($wpdbnew->prepare("SELECT * FROM $left_table_name WHERE libro=%d AND capitulo=%d AND versiculo=%d", 0, 0, 0)); // Get Bible Version Name
            
            // Query Results for Right Table
            $bible_result7b = $wpdbnew->get_results($wpdbnew->prepare("SELECT * FROM $right_table_name WHERE libro=%d AND capitulo=%d ORDER BY versiculo ASC", $libro, $capitulo)); // Get Text Verse
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
		//$bible_result28 = $wpdbnew->get_results($wpdbnew->prepare("SELECT * FROM nombres_de_libros WHERE libro=%d", $libro));
            //foreach ($bible_result28 as $bible_book)
			foreach ($bible_result8 as $bible_book)
              {
                //$bible_book = $bible_book->nombre;
				$bible_book = $bible_book->texto;
              }
        // Display book and chapter name at the very top
		echo '<table width="100%" cellpadding="0" cellspacing="0" border="0">';
		echo '<tr><td class="book_name" colspan="6"><br>'.$bible_book.' '.$capitulo.'<br><br></td></tr>';
			
			// Input button to Remove Paralel view
		    echo "<tr><td><form class=\"bendicion-bible\" action=\"" . htmlspecialchars($_SERVER['REQUEST_URI']) . "\" method=\"post\">";
		    echo '<input type="hidden" name="libro" value="'.$libro.'" />';
		    echo '<input type="hidden" name="capitulo" value="'.$capitulo.'" />';
		    echo '<input type="hidden" name="version" value="'.$left_table_name.'">';
		    echo '<input type="submit" value="Remover Paralelo" /></form></td>';
			
		    // Input button to Add a Third Paralel view
		    echo "<td><form class=\"bendicion-bible\" action=\"" . htmlspecialchars($_SERVER['REQUEST_URI']) . "\" method=\"post\">";
		    echo '<input type="hidden" name="paralelo_cap" value="'.$capitulo.'" />';
		    echo '<input type="hidden" name="version_izquierda" value="'.$left_table_name.'">';
		    echo '<input type="hidden" name="version_derecha" value="'.$right_table_name.'">';
		    echo '<input type="hidden" name="version_third" value="biblia_lbla">';
		    echo '<input type="hidden" name="paralelo" value="'.$libro.'" />';
		    echo '<input type="submit" value="Agregar Paralelo" /></form></td>';		
			
		    // Input button to get previous book
		    if ($libro > 1) {
		    $libro_prev = $libro - 1;
		    echo "<td><form class=\"bendicion-bible\" action=\"" . htmlspecialchars($_SERVER['REQUEST_URI']) . "\" method=\"post\">";
		    echo "<input type=\"hidden\" name=\"paralelo\" value=\"".$libro_prev."\" />";
		    echo "<input type=\"hidden\" name=\"paralelo_cap\" value=\"1\" />";
	        echo "<input type=\"hidden\" name=\"version_right\" value=\"".$right_table_name."\">";
		    echo "<input type=\"hidden\" name=\"version_left\" value=\"".$left_table_name."\">";
		    echo "<input type=\"submit\" value=\"<< libro\" /></form></td>";		
		    } // end if
			
			// Input button to get next book
			$libro_next = $libro + 1;
		    echo "<td><form class=\"bendicion-bible\" action=\"" . htmlspecialchars($_SERVER['REQUEST_URI']) . "\" method=\"post\">";
		    echo "<input type=\"hidden\" name=\"paralelo\" value=\"".$libro_next."\" />";
		    echo "<input type=\"hidden\" name=\"paralelo_cap\" value=\"1\" />";
		    echo "<input type=\"hidden\" name=\"version_right\" value=\"".$right_table_name. "\">";
		    echo "<input type=\"hidden\" name=\"version_left\" value=\"".$left_table_name. "\">";
		    echo '<input type="submit" value="libro >>" /></form></td>';			
			
            // Input button to get previous chapter
			if ($capitulo > 1) {
            $capitulo_prev = $capitulo - 1;
            $capitulo_next = $capitulo + 1;
            echo '<td align="left">';
            echo "<form class=\"bendicion-bible\" action=\"" . htmlspecialchars($_SERVER['REQUEST_URI']) . "\" method=\"post\">
            <input type=\"hidden\" name=\"paralelo\" value=\"" . $libro . "\" />
            <input type=\"hidden\" name=\"paralelo_cap\" value=\"" . $capitulo_prev . "\" />
            <input type=\"hidden\" name=\"version_right\" value=\"" . $right_table_name . "\">
            <input type=\"hidden\" name=\"version_left\" value=\"" . $left_table_name . "\">
            <input type=\"submit\" value=\"<< cap&iacute;tulo\" /></form></td>";
			} // end if
            
			// Check to see whether there is a next chapter or not
			$capitulo_next = $capitulo + 1;
			$find_chapter = mysql_query("SELECT libro, capitulo FROM $left_table_name WHERE libro='$libro' AND capitulo='$capitulo_next'");
			if (mysql_num_rows($find_chapter)) {
			
			// Input button to get next chapter
            echo '<td align="right">';
            echo "<form class=\"bendicion-bible\" action=\"" . htmlspecialchars($_SERVER['REQUEST_URI']) . "\" method=\"post\">
            <input type=\"hidden\" name=\"paralelo\" value=\"" . $libro . "\" />
            <input type=\"hidden\" name=\"paralelo_cap\" value=\"" . $capitulo_next . "\" />
            <input type=\"hidden\" name=\"version_right\" value=\"" . $right_table_name . "\">
            <input type=\"hidden\" name=\"version_left\" value=\"" . $left_table_name . "\">
            <input type=\"submit\" value=\"cap&iacute;tulo >>\" /></form></td></tr></table>";
			} // end if
			
            // Display Table in half
            echo '<table width="100%" cellpadding="0" cellspacing="0" border="0">
            <tr><td valign="top" class="txt_verse">';
            
            ########## Left version here
            // Display Book Name and Chapter along with the Bible version name
            echo $nombre_left;
            
            // Display drop down menu to change versions on LEFT COLUMN
            echo "<form name=\"version_left_column\" action=\"" . htmlspecialchars($_SERVER['REQUEST_URI']) . "\" method=\"post\">
            <select name=\"version_left\" size=\"1\" class=\"txt_verse\" onchange=\"version_left_column.submit();\">\n
            <option value=\"\" selected=\"selected\">Cambiar Versi&oacute;n</option>";
            biblia_versiones();
            echo "<input type=\"hidden\" name=\"paralelo_cap\" value=\"" . $capitulo . "\" />
            <input type=\"hidden\" name=\"version_right\" value=\"" . $right_table_name . "\">
            <input type=\"hidden\" name=\"paralelo\" value=\"" . $libro . "\" />
            </select></form>";
            
            // Display Bible Text Verse
            echo '<table width="100%" cellpadding="0" cellspacing="0" border="0" class="hovertable">';
            foreach ($bible_result7 as $bible_text)
              {
                $texto = $bible_text->texto;
				echo '<tr><td class="txt_verse"><sup class="txt_sup">'.$bible_text->versiculo.'</sup> '.$texto.'</br></td></tr>';
              }
            echo '</table>
            </td>
            <td width="10"></td>
            <td width="1" bgcolor="#cecece"></td>
            <td width="10"></td>';
            
            ########## Right version here
            echo '<td valign="top" class="txt_verse">';
            // Display Book Name and Chapter along with the Bible version name
            echo $nombre_right;
            
            // Display drop down menu to change versions on RIGHT COLUMN
            echo "<form name=\"version_right_column\" action=\"" . htmlspecialchars($_SERVER['REQUEST_URI']) . "\" method=\"post\">
            <select name=\"version_right\" size=\"1\" class=\"txt_verse\" onchange=\"version_right_column.submit();\">\n
            <option value=\"\" selected=\"selected\">Cambiar Versi&oacute;n</option>";
            biblia_versiones();
            echo "<input type=\"hidden\" name=\"paralelo_cap\" value=\"" . $capitulo . "\" />
            <input type=\"hidden\" name=\"version_left\" value=\"" . $left_table_name . "\">
            <input type=\"hidden\" name=\"paralelo\" value=\"" . $libro . "\" />
            </select></form>";
            
            // Display Bible Text Verse
            echo '<table width="100%" cellpadding="0" cellspacing="0" border="0" class="hovertable">';
            foreach ($bible_result7b as $bible_text)
              {
                $texto = $bible_text->texto;
                echo '<tr><td class="txt_verse"><sup class="txt_sup">' . $bible_text->versiculo . '</sup> ' . $texto . '</br></td></tr>';
              }			
            echo '</table>
            </td></tr></table></br>';
            display_bendicion_copyright();
          } // end else if - Two Paralel
        

    ########################### Determine if a Third Paralelo Column was received
    else if (isset($_POST['version_third']) && !empty($_POST['version_third'])) {
		
       // If the user just sent info
		$libro    = $_POST['paralelo'];
		$capitulo = $_POST['paralelo_cap'];
		$left_table_name  = $_POST['version_izquierda'];
		$right_table_name = $_POST['version_derecha'];
		$third_table_name = $_POST['version_third'];

		// Get Bible Book Name
		$bible_result8 = $wpdbnew->get_results($wpdbnew->prepare("SELECT * FROM $left_table_name WHERE libro=%d AND capitulo=%d AND versiculo=%d", 0, 10, $libro));
		//$bible_result28 = $wpdbnew->get_results($wpdbnew->prepare("SELECT * FROM nombres_de_libros WHERE libro=%d", $libro));
            //foreach ($bible_result28 as $bible_book)
			foreach ($bible_result8 as $bible_book)
              {
                //$bible_book = $bible_book->nombre;
				$bible_book = $bible_book->texto;
              }
        // Display book and chapter name at the very top
		echo '<table width="100%" cellpadding="0" cellspacing="0" border="0">';
		echo '<tr><td class="book_name" colspan="6"><br>'.$bible_book.' '.$capitulo.'<br><br></td></tr>';
		
		// Input button to Remove Third Column
		echo "<tr><td><form class=\"bendicion-bible\" action=\"" . htmlspecialchars($_SERVER['REQUEST_URI']) . "\" method=\"post\">";
		echo '<input type="hidden" name="paralelo_cap" value="'.$capitulo.'" />';
		echo '<input type="hidden" name="version_left" value="'.$left_table_name.'">';
        echo '<input type="hidden" name="version_right" value="'.$right_table_name.'">';
		echo '<input type="hidden" name="paralelo" value="'.$libro.'" />';
		echo '<input type="submit" value="Remover Paralelo" /></form></td>';
		echo '<td width="5"></td>';

		// Input button to get previous book
		if ($libro > 1) {
		$libro_prev = $libro - 1;
		echo "<td><form class=\"bendicion-bible\" action=\"" . htmlspecialchars($_SERVER['REQUEST_URI']) . "\" method=\"post\">";
		echo '<input type="hidden" name="paralelo" value="'.$libro_prev.'" />';
		echo '<input type="hidden" name="paralelo_cap" value="1" />';
	    echo '<input type="hidden" name="version_derecha" value="'.$right_table_name.'">';
		echo '<input type="hidden" name="version_izquierda" value="'.$left_table_name.'">';
		echo '<input type="hidden" name="version_third" value="'.$third_table_name.'">';
		echo '<input type="submit" value="<< Libro" /></form></td>';
		} // end if

		// Input button to get next book
		$libro_next = $libro + 1;
		echo "<td><form class=\"bendicion-bible\" action=\"" . htmlspecialchars($_SERVER['REQUEST_URI']) . "\" method=\"post\">";
		echo '<input type="hidden" name="paralelo" value="'.$libro_next.'" />';
		echo '<input type="hidden" name="paralelo_cap" value="1" />';
	    echo '<input type="hidden" name="version_derecha" value="'.$right_table_name.'">';
		echo '<input type="hidden" name="version_izquierda" value="'.$left_table_name.'">';
		echo '<input type="hidden" name="version_third" value="'.$third_table_name.'">';			
		echo '<input type="submit" value="Libro >>" /></form></td>';
		
		// Input button to get previous chapter		
		if ($capitulo > 1) {
		$capitulo_prev = $capitulo - 1;
		echo "<td><form class=\"bendicion-bible\" action=\"" . htmlspecialchars($_SERVER['REQUEST_URI']) . "\" method=\"post\">";
		echo '<input type="hidden" name="paralelo" value="'.$libro.'" />';
		echo '<input type="hidden" name="paralelo_cap" value="'.$capitulo_prev.'" />';
	    echo '<input type="hidden" name="version_derecha" value="'.$right_table_name.'">';
		echo '<input type="hidden" name="version_izquierda" value="'.$left_table_name.'">';
		echo '<input type="hidden" name="version_third" value="'.$third_table_name.'">';
		echo '<input type="submit" value="<< Cap&iacute;tulo" /></form></td>';	
		} // end if

		// Check to see whether there is a next chapter or not
		$capitulo_next = $capitulo + 1;
		$find_chapter = mysql_query("SELECT libro, capitulo FROM $left_table_name WHERE libro='$libro' AND capitulo='$capitulo_next'");
			if (mysql_num_rows($find_chapter)) {
		
		// Input button to get next chapter
		echo "<td><form class=\"bendicion-bible\" action=\"" . htmlspecialchars($_SERVER['REQUEST_URI']) . "\" method=\"post\">";
		echo '<input type="hidden" name="paralelo" value="'.$libro.'" />';
		echo '<input type="hidden" name="paralelo_cap" value="'.$capitulo_next.'" />';
	    echo '<input type="hidden" name="version_derecha" value="'.$right_table_name.'">';
		echo '<input type="hidden" name="version_izquierda" value="'.$left_table_name.'">';
		echo '<input type="hidden" name="version_third" value="'.$third_table_name.'">';
		echo '<input type="submit" value="Cap&iacute;tulo >>" /></form></td></tr></table>';		
		} // end if	
		
		// Display the 3 tables
		echo '<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr>';

		##### Start Left Column Version Here
		// Get Bible Version Name for Left Column Version
		$bible_result9 = $wpdbnew->get_results($wpdbnew->prepare("SELECT * FROM $left_table_name WHERE libro=%d AND capitulo=%d AND versiculo=%d", 0, 0, 0));
            foreach ($bible_result9 as $version_name)
              {
                $nombre_left = $version_name->texto;
              }
		echo '<td width="320" valign="top" class="txt_verse">';
		echo $nombre_left; // Display version name
        // Display drop down menu to change Left Column Version
		echo "<form name=\"version_left_column\" class=\"bendicion-bible\" action=\"" . htmlspecialchars($_SERVER['REQUEST_URI']) . "\" method=\"post\">";
		echo '<select name="version_izquierda" class="txt_verse" style="width:300px;" size="1" onchange="version_left_column.submit();">';
		echo '<option value="" selected="selected" disabled="disabled">Cambiar Versi&oacute;n</option>';
        biblia_versiones();
        echo '</select>';
        echo '<input type="hidden" name="paralelo_cap" value="'.$capitulo.'" />';
        echo '<input type="hidden" name="version_derecha" value="'.$right_table_name.'">';
		echo '<input type="hidden" name="version_third" value="'.$third_table_name.'">';
		echo '<input type="hidden" name="paralelo" value="'.$libro.'" />';
	    echo '</form>';
		// Display Bible Text Verse - Left Column Version
		$bible_result7 = $wpdbnew->get_results($wpdbnew->prepare("SELECT * FROM $left_table_name WHERE libro=%d AND capitulo=%d ORDER BY versiculo ASC", $libro, $capitulo)); // Get Text Verse
		echo '<table width="100%" cellpadding="0" cellspacing="0" border="0" class="hovertable">';
            foreach ($bible_result7 as $bible_text)
              {
                $texto = $bible_text->texto;
                echo '<tr><td class="txt_verse"><sup class="txt_sup">' . $bible_text->versiculo . '</sup> ' . $texto . '</br></td></tr>';
              }	
		echo '</table>';
		echo '</td>'; // End Left Column Version
	    echo '<td width="5"></td><td width="1" bgcolor="#cecece"></td><td width="5"></td>';
		
		##### Start Middle Column Version Here
		// Get Bible Version Name for Middle Column Version
		$bible_result9b = $wpdbnew->get_results($wpdbnew->prepare("SELECT * FROM $right_table_name WHERE libro=%d AND capitulo=%d AND versiculo=%d", 0, 0, 0)); // Get Bible Version Name
            foreach ($bible_result9b as $version_name)
              {
                $nombre_right = $version_name->texto;
              }
		echo '<td width="319" valign="top" class="txt_verse">';
		echo $nombre_right; // Display version name
        // Display drop down menu to change Middle Column Version
		echo "<form name=\"version_right_column\" class=\"bendicion-bible\" action=\"" . htmlspecialchars($_SERVER['REQUEST_URI']) . "\" method=\"post\">";
		echo '<select name="version_derecha" size="1" class="txt_verse" style="width:300px;" onchange="version_right_column.submit();">';
		echo '<option value="" selected="selected" disabled="disabled">Cambiar Versi&oacute;n</option>';
        biblia_versiones();
        echo '</select>';
        echo '<input type="hidden" name="paralelo_cap" value="'.$capitulo.'" />';
        echo '<input type="hidden" name="version_izquierda" value="'.$left_table_name.'">';
		echo '<input type="hidden" name="version_third" value="'.$third_table_name.'">';
		echo '<input type="hidden" name="paralelo" value="'.$libro.'" />';
	    echo '</form>';
		// Display Bible Text Verse - Middle Column Version
		$bible_result10 = $wpdbnew->get_results($wpdbnew->prepare("SELECT * FROM $right_table_name WHERE libro=%d AND capitulo=%d ORDER BY versiculo ASC", $libro, $capitulo)); // Get Text Verse
		echo '<table width="100%" cellpadding="0" cellspacing="0" border="0" class="hovertable">';
            foreach ($bible_result10 as $bible_text)
              {
                $texto = $bible_text->texto;
                echo '<tr><td class="txt_verse"><sup class="txt_sup">' . $bible_text->versiculo . '</sup> ' . $texto . '</br></td></tr>';
              }				
		echo '</table>';
	    echo '</td>';  // End Middle Column Version
		echo '<td width="5"></td><td width="1" bgcolor="#cecece"></td><td width="5"></td>';
		
		##### Start Right Column Version Here
		// Get Bible Version Name for Right Column Version
		$bible_result9c = $wpdbnew->get_results($wpdbnew->prepare("SELECT * FROM $third_table_name WHERE libro=%d AND capitulo=%d AND versiculo=%d", 0, 0, 0)); // Get Bible Version Name
            foreach ($bible_result9c as $version_name)
              {
                $nombre_third = $version_name->texto;
              }
	    echo '<td width="319" valign="top" class="txt_verse">';
		echo $nombre_third; // Display version name
        // Display drop down menu to change versions Right Column Version
		echo "<form name=\"version_third_column\" class=\"bendicion-bible\" action=\"" . htmlspecialchars($_SERVER['REQUEST_URI']) . "\" method=\"post\">";
		echo '<select name="version_third" size="1" class="txt_verse" style="width:300px;" onchange="version_third_column.submit();">';
		echo '<option value="" selected="selected" disabled="disabled">Cambiar Versi&oacute;n</option>';
        biblia_versiones();
        echo '</select>';
        echo '<input type="hidden" name="paralelo_cap" value="'.$capitulo.'" />';
        echo '<input type="hidden" name="version_izquierda" value="'.$left_table_name.'">';
		echo '<input type="hidden" name="version_derecha" value="'.$right_table_name.'">';
		echo '<input type="hidden" name="paralelo" value="'.$libro.'" />';
	    echo '</form>';		

		// Display Bible Text Verse - Right Column Version
		$bible_result11 = $wpdbnew->get_results($wpdbnew->prepare("SELECT * FROM $third_table_name WHERE libro=%d AND capitulo=%d ORDER BY versiculo ASC", $libro, $capitulo)); // Get Text Verse
		echo '<table width="100%" cellpadding="0" cellspacing="0" border="0" class="hovertable">';
            foreach ($bible_result11 as $bible_text)
              {
                $texto = $bible_text->texto;
                echo '<tr><td class="txt_verse"><sup class="txt_sup">' . $bible_text->versiculo . '</sup> ' . $texto . '</br></td></tr>';
              }
		echo '</table>';
		echo '</td>'; // End Right Column Version
        echo '</tr></table><br><br>';		

		display_bendicion_copyright();
	} // end else if - Third Paralel View
		
        ########################### Determine if Concordancia was received
        else if (isset($_POST['palabras']) && !empty($_POST['palabras']))
          {
            $palabras    = stripslashes($_POST['palabras']); // If the user just sent info
            $version     = $_POST['version'];
            // Save the search term in this varibale to be able to use it in the output
            $palabra     = $palabras;
            $palabras    = "%" . $palabras . "%"; // Add wildcard
            $table_name  = $version;
            $search_text = $wpdbnew->get_results($wpdbnew->prepare("SELECT * FROM $table_name WHERE texto LIKE %s ORDER BY libro ASC", $palabras));
            
            // Get Bible Version Name
            $bible_result5 = $wpdbnew->get_results($wpdbnew->prepare("SELECT * FROM $table_name WHERE libro=%d AND capitulo=%d AND versiculo=%d", 0, 0, 0));
            foreach ($bible_result5 as $version_name)
              {
                $nombre = $version_name->texto;
              }
            
            // Display drop down menu to change versions
            echo '</br><table width="100%" cellpadding="0" cellspacing="0" border="0">';
            echo "<tr><td align=\"left\" class=\"txt_verse\"><form name=\"version_column\" action=\"" . htmlspecialchars($_SERVER['REQUEST_URI']) . "\" method=\"post\">
            <select name=\"version\" size=\"1\" class=\"txt_verse\" onchange=\"version_column.submit();\">\n
            <option value=\"\" selected=\"selected\">Cambiar Versi&oacute;n</option>";
            biblia_versiones();
            echo "</select><input type=\"hidden\" name=\"palabras\" value=\"" . $palabra . "\" />
            &nbsp;" . $nombre . "</form></td></tr></table>";
            
            // Loop for results
            echo '<table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td class="txt_verse">';
			
			// Function to highlight results
			function highlightStr($string, $word, $highlightColorValue) {
				// return $haystack if there is no highlight color or strings given, nothing to do.
				if (strlen($highlightColorValue) < 1 || strlen($string) < 1 || strlen($word) < 1) {
					return $string;
					}
					preg_match_all("/$word+/i", $string, $matches);
					if (is_array($matches[0]) && count($matches[0]) >= 1) {
						foreach ($matches[0] as $match) {
							$string = str_replace($match, '<span style="background-color:'.$highlightColorValue.';">'.$match.'</span>', $string);
							}
						}
					return $string;
					}			
			
            foreach ($search_text as $single_text)
              {
                $output        = $single_text->texto;
                $libro         = $single_text->libro;
                $capitulo      = $single_text->capitulo;
                $versiculo     = $single_text->versiculo;
				$highlightColorValue = $savedColor;
				
				// Call highlightStr function
				$output = highlightStr($output, $palabra, $highlightColorValue);
				//$output = str_replace($palabra, "<span style=background-color:".$savedColor.">" . $palabra . "</span>", $output);
                
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
            echo '</td></tr><tr><td class="txt_verse"></br><b>Vers&iacute;culos encontrados:</b> ' . $count . '</td></tr></table>';
            display_bendicion_copyright();
          } // end else if
        ////////////////////////////////////////////////////////////////////////////////////////
      } // end function display_bible_form
?>
