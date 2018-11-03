<?php defined('BASEPATH') OR exit('No direct script access allowed');


  //To make date in database format
  if (!function_exists('make_date'))
  {
  	function make_date($date)
  	{
  		$jr = $date[0].$date[1];
  		$moi = $date[3].$date[4];
  		$ann = $date[6].$date[7].$date[8].$date[9];
  		$date = $ann.'-'.$moi.'-'.$jr;
  		return $date;
  	}
  }

  //To get right explanation
  if (!function_exists('get_droit')) {
  	function get_droit($lettre) {
  		$lib='';
      if ($lettre =='S') $lib='Supprimer';
  		if ($lettre =='C') $lib='Consulter';
  		if ($lettre =='R') $lib='Restaurer';
  		if ($lettre =='A') $lib='Enregistrer | Modifier';
  		return $lib;
  	}
  }

  if (!function_exists('get_icon')){
  	function get_icon($lettre) {
  		$lib='';
  		if ($lettre =='S') $lib='fa fa-trash-o';
  		if ($lettre =='C') $lib='fa fa-eye';
  		if ($lettre =='R') $lib='fa fa-undo';
  		if ($lettre =='A') $lib='fa fa-pencil';
  		return $lib;
  	}
  }

  //To upload a picture from a form
  if (!function_exists('upload')) {
  	function upload($file,$doss,$id)
  	{
  		if(isset($_FILES[$file]['type'])) {
  			$extension = pathinfo($_FILES[$file]['name']);
  			$validextensions = array("jpeg", "jpg", "png","pdf", "PNG", "JPG", "JPEG","PDF");

  			if (in_array($extension['extension'], $validextensions) && ($_FILES[$file]['size'] <= 1048576))
  				if ($_FILES[$file]['error'] == 0) {
  					$sourcePath = $_FILES[$file]['tmp_name'];//Recovery of the temporary name
  					$targetPath = "upload/img/".$doss."/".$id.".".$extension['extension']; // Folder stocking data
  					move_uploaded_file($sourcePath,$targetPath) ;
  					return $id.".".$extension['extension'];
  				}
          else return 'erreur';
        else return 'non extension';
  		}
  		else return 'non type';
  	}
  }

  //To verify that the birthdate given is valid
  if (!function_exists('date_before')) {
  	function date_before($birth,$fin)
  	{
  		$birth = explode('/', $birth);
  		$fin = explode('/', $fin);

  		$birth = mktime(0,0,0,$birth[1], $birth[0], $birth[2]);
  		$fin = mktime(0,0,0,$fin[1], $fin[0], $fin[2]);

  		$d = $birth - $fin;

  		return ($d<0) ? true : false ;
  	}
  }

  //To verify that the date given is valid
  if (!function_exists('valid_date')) {
  	function valid_date($date)
  	{
  		$date = explode('/', $date);
  		$fin = explode('/', date('d/m/Y'));

  		$date = mktime(0,0,0,$date[1], $date[0], $date[2]);
  		$fin = mktime(0,0,0,$fin[1], $fin[0], $fin[2]);

  		$d = $date - $fin;

  		return ($d>=0) ? true : false ;
  	}
  }

  //To calculate the difference between two date
  if (!function_exists('duree')) {
  	function duree($debut,$fin=null)
  	{
  		if (is_null($fin)) $fin = date('d/m/Y');

  		$debut = explode('/', $debut);
  		$fin = explode('/', $fin);

  		$debut = mktime(0,0,0,$debut[1], $debut[0], $debut[2]);
  		$fin = mktime(0,0,0,$fin[1], $fin[0], $fin[2]);

  		$d = $fin - $debut;

  		return array("an"=>date('Y',$d) - 1970, "mois"=>date('m',$d) - 1, "jours"=>date('d',$d) - 1);
  	}
  }

  //To calculate the right date to obtain a specific year
  if (!function_exists('date_needed')) {
  	function date_needed($age)
  	{
  		$fin = date('d/m/Y');
  		$r = $fin;
  		$fin = explode('/', $fin);

  		$age = mktime(0,0,0,1,1, $age+ 1970);
  		$fin = mktime(0,0,0,$fin[1], $fin[0], $fin[2]);

  		$d = $fin - $age;
  		$d = date('d/m/Y',$d);

  		return $d;
  	}
  }

  //To compare two crypt password
  if (!function_exists('check_user')) {
  	function check_password($pas1,$pas2) {
  		return password_verify($pas1,$pas2);
  	}
  }

  // public function new_sauvegarde() {
  //
  //   $dir_source = 'upload/img';
  //   $dir_dest = 'upload/backup/'.date('d-m-Y à H', local_to_gmt()).'h'.date('i', local_to_gmt());
  //
  //   mkdir($dir_dest, 0755);
  //   // On crée une ressource iterator de type récursif sur le dossier afin de pouvoir parcourir un à un les éléments qui composent le dossier. L'attribute SKIP_DOTS permet d'ignorer les fichiers points "." et ".."
  //   $dir_iterator = new RecursiveDirectoryIterator($dir_source, RecursiveDirectoryIterator::SKIP_DOTS);
  //
  //   // On exécute l'itérateur de façon récursive sur le dossier (tous les éléments qui le composent seront copiés).Nous utilisons le mode SELF_FIRST afin que l'itération retourne le nom des dossiers en premier, et ensuite le nom des fichiers, ceci afin de créer en premier les répertoires parents de chaque fichier.
  //   $iterator = new RecursiveIteratorIterator($dir_iterator, RecursiveIteratorIterator::SELF_FIRST);
  //   foreach($iterator as $element){
  //
  //      if($element->isDir()){
  //         mkdir($dir_dest . DIRECTORY_SEPARATOR . $iterator->getSubPathName());
  //      } else{
  //         copy($element, $dir_dest . DIRECTORY_SEPARATOR . $iterator->getSubPathName());
  //      }
  //   }
  // }

  //To send sms
  if(!function_exists('send_sms'))
  {
  	function send_sms($destinataire, $messsage)
  	{
  		$tailleMsg = strlen($messsage);
  		//$numeroDest = trim($destinataire);
  		$numeroDest = urlencode(trim($destinataire));
  		$message = urlencode($messsage);

  		$url = "121.241.242.114:8080/sendsms?username=ntic-yoeko&password=Azerty&type=0&dlr=1&destination=228". $numeroDest ."&source=AfroCash&message=". $message;
  		$ch = curl_init($url);
  	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

  	    $resultat = curl_exec($ch);
  	    curl_close($ch);

  	    if (!$resultat) {
  	        return false;
  	    } else {
  	        return $resultat;
  	    }
  	}
  }
