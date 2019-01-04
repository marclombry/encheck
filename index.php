<?php
$container="";
$currentFile = "ORDER_20181227-0825.txt";
$file = fopen($currentFile,'r');
if (!file_exists($currentFile)) {
	die("File does not exist");
}

function entcheck($lines){
	$code=null;
	$content='<table style="width:100%;border-collapse:collapse;"><thead><tr style="border:2px solid #ddd;"><th>ENT</th><th>NBLIG</th></tr></thead><tbody>';
	foreach($lines as $key =>$value){
		if(substr($lines[$key], 0,3) =='ENT'){
			$listeLig=null;
			$code = explode(' ',$value);
			$listeCode[] =$code[0];
		}
		if(substr($lines[$key], 0,3) =='LIG'){
			$lig = explode(' ',$value);
			$listeLig[] =$lig[0];
			$tab[$code[0]] = $listeLig;
		}
	}
	foreach ($tab as $key => $value) {
		$nbLigne = count($value);
		$content.= "<tr style='border:2px solid #ddd;'><td>$key</td><td>$nbLigne<td></tr>";
	}
	$content.= "</tbody></table>";
	return $content;
}

//echo $container;

$dir = "./";
//  si le dossier pointe existe
if (is_dir($dir)) {

   // si il contient quelque chose
   if ($dh = opendir($dir)) {

       // boucler tant que quelque chose est trouve
       while (($file = readdir($dh)) !== false) {
       		if($file !=='index.php' && $file !=='.' && $file !=='..'){
       			var_dump($file);
       			$file = file($file);
       			$container.=entcheck($file);
       			 //echo "fichier : $file : type : " . filetype($dir . $file) . "<br />\n";
       		}
           // affiche le nom et le type
          
       }
       // on ferme la connection
       closedir($dh);
   }
}

echo $container;