
<?php

if(!empty($_FILES)){
    require("imgClass.php");
    $img = $_FILES['img'];
    $extension=  strtolower(substr($img['name'], -3));
    $allow_ext = array("jpg", "png" , 'jpeg');
    $size = $img['size'];
   // print_r($_FILES);
    if( in_array($extension , $allow_ext)) {
        move_uploaded_file($img['tmp_name'],"upload/".$img['name']);
        Image::imageRedimention("upload/".$img['name'],"upload/min",$img['name'],215,112);
    }
    else {
       echo "Le fcher n'est pas autoriser";
    }

}
?>



<?PHP
    //On teste si le formulaire a été soumis
        if (isset($_POST['Valider']))
        {
        
        //on se connecte au srveur
        $conn = mysqli_connect('127.0.0.1', 'root', '');  

    if (! $conn) {  

        die("Connection failed" . mysqli_connect_error());  

    }
    // on selectionne la base de données
    mysqli_select_db($conn, 'pagination'); 
    
    //on insere les données  dans la table 
    $extension=  strtolower(substr($img['name'], -3));
    $size = $img['size'];
    $nom= $img['name'];
    $chemin = "upload/min/".$img['name'];
    $sql=" INSERT INTO `galerie1` (`id`, `nom`, `chemin`,`taille`, `extension`)
    VALUES('','$nom','$chemin','$size','$extension')";

    if (!mysqli_query($conn,$sql))
    {
    die('impossible d’ajouter cet enregistrement : ' .  mysqli_connect_error());
    }
    //echo "L’enregistrement est ajouté ";
    mysqli_close($conn);
    }
    $conn = mysqli_connect('127.0.0.1', 'root', '');  
    mysqli_select_db($conn, 'pagination'); 
    
    
    $limit = 4;  
    

    $result = mysqli_query($conn, "SELECT * FROM galerie1");  

    $total_rows = mysqli_num_rows($result);    


    $total_pages = ceil($total_rows / $limit);    


    if (!isset ($_GET['page']) ) {  

        $page_number = 1;  

    } else {  

        $page_number = $_GET['page'];  

    }    
    
 




    $initial_page = ($page_number-1) * $limit;   

   

    $getQuery = "SELECT DISTINCT *  FROM galerie1 LIMIT " . $initial_page . ',' . $limit; 
     

    $result = mysqli_query($conn, $getQuery);  
    
   /* $dossier = "upload/min";
    $dir= opendir($dossier);
   while($file = readdir($dir)){
      // echo $file;
   }*/

   
   echo "<table align=\"center\" >";
    echo "<tr>";
    
    while ($row = mysqli_fetch_array($result)) {  
      // echo  $row['ID'];
      
     
    //$allow_ext = array("jpg", "png" , 'jpeg');
    //$extension=  strtolower(substr($file, -3));
    //echo $row['nom'];
    //if( in_array($extension , $allow_ext)){
        
       
if($row['ID'] % 2 == 0) {
   
   
                    echo "<td>"; 
    ?> 
                
                    <img tyle="border-color:#000000;" border="5"  width="215" height="112" src= " <?php echo  $row['chemin'] ?>"    />
                    <?php
                    echo "<br>";
                    echo $row['nom'] ;
                    echo "<br>";

                    echo "<tr>";
                    echo "</td>";
                    echo "<br>";
                   
                    
            }
            else{
            
              
        
                echo "<td>"; 
                ?> 
                            
                                <img tyle="border-color:#000000;" border="5"  width="215" height="112" src= " <?php echo  $row['chemin'] ?>"    />
                                <?php
                                echo "<br>";
                                echo $row['nom'];
                                echo "<br>";
                                
                                echo "</td>";
                                
                                
                                
            }
            
            
                               
               
        }
        echo "</tr>"; 
   echo "</table>";


  
   
   ?>    
    
 
    
<div Align=Center>
    <?php
 if ($page_number-1 > 0){
echo "<a href='index.php?page=".($page_number-1)."'class='button' >Previous</a>"; 
 }
echo "       ";
for ($i=1; $i<=$total_pages; $i++) {  
    echo "<a href='index.php?page=" .$i.  "  '>"  .$i. "</a>";
    echo "  ";
}
echo "       ";
if ($page_number < $total_pages){
echo "<a href='index.php?page=".($page_number+1)."' class='button'>Next</a>";
} 
     

?>
</div>

<html>
    <style>

.contenant {
  position: center;
  text-align: center;
  color: black;
}

.texte_centrer {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}
* {
  box-sizing: border-box;
}


/* Create two equal columns that floats next to each other */
.column {
  float: left;
  width: 50%;
  padding:0 10px;
}
.name {
  text-align: center;
  padding: 32px;
}
.column img {
    margin-top: 8px;
  vertical-align: middle;
}


</style>
   <body>
   <div Align=Center>
   <form enctype="multipart/form-data" action="index.php" method="POST">
    <!-- MAX_FILE_SIZE must precede the file input field -->
    <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
    <!-- Name of input element determines name in $_FILES array -->
     <input name="img" type="file" />
    <input type="submit" name="Valider" value="Envoyer"  />
</div>
</form>


    </body>
</html>
