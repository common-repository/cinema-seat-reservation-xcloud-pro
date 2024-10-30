<?php
if (!defined('ABSPATH')) {
  exit();
}
// Funzione per elaborare lo shortcode chiamato ...
// questa funzione viene richiamata automaticamente da wordpress
function my_shortcode_xcloud_cinema($options,$content=null) 
{
  // Estraggo le opzioni indicate nello shortcode e assegno
  // dei valori di default nel caso non vengano specificati
  $opzioni = shortcode_atts(array(
    'width'    => '',  // default value
    'height'   => '',  // default value
    'theme'    => '', // default value
  ),$options);

  // Preparazione variabile con URL del video
  $parametro_1 = array();
  $opzioni_estratte = get_option('xcloud_cinema_option');
  $parametro_1 = $opzioni_estratte['param1'];

  // Creazione codice HTML per inserire un video youtube
  $HTML = $parametro_1;

  // FUTURE FUNZIONI 

  // $HTML  = '<div  ';
  // $HTML .= 'width="' .$opzioni['width'].'" ';
  // $HTML .= 'height="'.$opzioni['height'].'" ';
  // $HTML .= '>';
  // $HTML .= $parametro_1;
  // $HTML .= '</div>';


  // Se si vuole in qualche maniera tenere conto del contenuto
  // indicato nella modalità estesa e quindi del testo HTML
  // presente tra apertura e chiusura shortcode ricordate che
  // trovate tutta la stringa nella variabile $content

  if (!is_null($content)) {}

  // Ritorno il codice finale HTML dello shortcode
  return $HTML;
}

// Associazione shortcode alla funzione PHP
add_shortcode('xcloud-cinema','my_shortcode_xcloud_cinema');

?>