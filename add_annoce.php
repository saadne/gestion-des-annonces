<?php
    
    include('config/connect_db.php');
    include('annonce.php')
    
    if(isset($_POST['submit'])){
        $libelle = mysqli_real_escape_string($conn, $_POST['libelle']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        $prix = mysqli_real_escape_string($conn, $_POST['prix']);
        $image_annonce = $_FILES["image_name"]["name"]; 
        $deposer_par = mysqli_real_escape_string($conn, $_POST['deposer_par']);
        $tempname = $_FILES["image_name"]["tmp_name"]; 
        $folder = "images/".$image_annonce;
        move_uploaded_file($tempname, $folder);
        $sql = "INSERT INTO annoce(libelle, description,prix,image_annonce,deposer_par)
         VALUES('$libelle','$description','$prix','$image_annonce','$deposer_par')";
        if(mysqli_query($conn,$sql)){
            header('Location: annonce.php');
        }else{
            echo "query error:" . mysqli_error($conn);
        }
    }
   
    $sql = "SELECT numero_personne FROM personne";
    $result = mysqli_query($conn, $sql);
    

    // afficher les donnees sous form de list

    $personnes = mysqli_fetch_all($result, MYSQLI_ASSOC);

    
    // free result from memory
    mysqli_free_result($result);
    

    // close connection
    mysqli_close($conn);
?>


<html>
    <?php include('templates/header.php')?>
    <div class="center">
        <h1 class="big-text" >Ajouter une Annonce</h1>
        <form action="add_annoce.php" method="POST" enctype="multipart/form-data">
            <label for="libelle">Libell&eacute;:</label>
            <br>
            <input type="text" class="input-class" name="libelle" placeholder="Ajouter un libelle" required>
            <br>
            <label for="description">Description:</label>
            <br>
            <textarea  name="description" cols="30" rows="2" placeholder="Ajouter une description..." required>
            </textarea>
            <br>
            <label for="prix">Prix:</label>
            <br>
            <input type="number" class="input-class" name="prix" class="inputfile" placeholder="Ajouter un prix" required>
            <br>
            <label for="image">Image:</label>
            <br>
            <input type="file" class="input-class" name="image_name"placeholder="Ajouter une image" required>
            <br>
            <label for="deposr_par">Depos&eacute; par:</label>
            <br>
            <select name="deposer_par">   
                <?php foreach($personnes as $personne){?>           
                    <option name="deposer_par" value="<?php echo intval($personne['numero_personne']);?>"required>
                    <?php echo intval($personne['numero_personne']);?></option>
                <?php }?> 
            </select> 
            <!-- <input type="number" name="deposer_par" required> -->
            <br>
            <button  name="submit" type="submit" class="button-form">Enregistrer l'annonce</button>
        </form>
    </div>
    <script src="app.js"></script>  
    
</html>