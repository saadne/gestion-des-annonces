<?php
        
    include('config/connect_db.php');
    $result = mysqli_query($conn, "SELECT * FROM annoce WHERE numero_annoce = '" . $_GET['id'] . "'");
    $data = mysqli_fetch_array($result);
    $id=$_GET['id'];
    if(count($_POST)>0){
        $libelle = mysqli_real_escape_string($conn, $_POST['libelle']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        $prix = mysqli_real_escape_string($conn, $_POST['prix']);
        $image_annonce = $_FILES["image_name"]["name"]; 
        $old_image = mysqli_real_escape_string($conn, $_POST['old_image']);
        $deposer_par = mysqli_real_escape_string($conn, $_POST['deposer_par']);
        $tempname = $_FILES["image_name"]["tmp_name"]; 
        $folder = "images/".$image_annonce;
        move_uploaded_file($tempname, $folder);

        $query = "UPDATE annoce SET libelle = '$libelle', prix='$prix',
            description='$description',image_annonce='$image_annonce',deposer_par='$deposer_par'
            WHERE numero_annoce= '" . $_GET['id'] . "'";
        if(mysqli_query($conn,$query)){
            header("Location: detail_annoce.php?id=" . $_GET['id']);
        }
        
    }
  
    $result = mysqli_query($conn, "SELECT * FROM annoce WHERE numero_annoce = '" . $_GET['id'] . "'");
    $data = mysqli_fetch_array($result);

    $sql1 = "SELECT numero_personne FROM personne";
    $result1 = mysqli_query($conn, $sql1);
    
    // afficher les donnees sous form de list

    $personnes = mysqli_fetch_all($result1, MYSQLI_ASSOC);

    // free result from memory
    mysqli_free_result($result1);
        
?>

<html>
    <?php include('templates/header.php')?>
    <div class="center">
        <h1 class="big-text">Modifier l'annonce</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <label for="nom">Libelle:</label>
            <br>
            <input type="text" class="input-class" name="libelle" value="<?php echo $data['libelle'];?>" placeholder="Ajouter un libelle" required>
            <br>
            <label for="description">Description:</label>
            <br>
            <textarea  name="description" cols="30" rows="3" placeholder="Ajouter une description..." required>
            <?php echo $data['description'];?>
            </textarea>
            <br>
            <label for="prix">Prix:</label>
            <br>
            <input type="number" class="input-class" name="prix" value="<?php echo $data['prix'];?>" class="inputfile" id="prix" placeholder="Ajouter un prix" required>
            <br>
            <label>Image:</label>
            <br>
            <input type="file" class="input-class" name="image_name">
            <br>
            <label for="image">Deposer par:</label>
            <br>
            <select name="deposer_par"> 
                <?php foreach($personnes as $personne){?>           
                    <option name="deposer_par" value="<?php echo intval($personne['numero_personne']);?>"required><?php echo intval($personne['numero_personne']);?></option>
                <?php }?> 
            </select> 
            <br>
            <button name="update" value="update"  class="button-form" type="submit">Modifier</button>
        </form>
    </div>

    <script src="app.js"></script>  
    
</html>