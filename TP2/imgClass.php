

<?php

class Image{

    static function imageRedimention($img, $chemin, $nom,$nlargeur =100, $nhauteur = 100){

        //récupérer les dimensions de l'image 
        $dimension=getimagesize($img);
        //créer une image 
        if(substr(strtolower($img),-4)==".jpg"){$image= imagecreatefromjpeg($img);}
        else if (substr(strtolower($img),-4)==".jpeg"){$image=imagecreatefromjpeg($img);}
        else if (substr(strtolower($img),-4)==".png"){$image= imagecreatefrompng($img);}
        else{return false;}

        //Création de l'image 

        $mini_image = imagecreatetruecolor( $nlargeur, $nhauteur);
        //gérer la posotion et le redimensionnement de l image nitiale 
        if($dimension[0]>($nlargeur/$nhauteur)*$dimension[1] ){ $dimY=$nhauteur; $dimX=round($nhauteur*$dimension[0]/$dimension[1]); $decalX=($dimX-$nlargeur)/2; $decalY=0;}
        if($dimension[0]<($nlargeur/$nhauteur)*$dimension[1]){ $dimX=$nlargeur; $dimY=round($nlargeur*$dimension[1]/$dimension[0]); $decalY=($dimY-$nhauteur)/2; $decalX=0;}
        if($dimension[0]==($nlargeur/$nhauteur)*$dimension[1]){ $dimX=$nlargeur; $dimY=$nhauteur; $decalX=0; $decalY=0;}

        imagecopyresampled($mini_image,$image,-$decalX,-$decalY,0,0,$dimX,$dimY,$dimension[0],$dimension[1]);
        imagejpeg($mini_image , $chemin."/".$nom ,90);
          
        return true;

    }
}