
<?php
        
    include('config/connect_db.php');
    if(count($_POST)>0){
        mysqli_query($conn,"UPDATE personne SET nom= '" . $_POST['nom'] . "',prenom= '" . $_POST['prenom'] . "',
        tel= '" . $_POST['telephone'] . "' ,email= '" . $_POST['email'] . "', adress= '" . $_POST['adress'] . "'
        WHERE numero_personne= '" . $_GET['id'] . "' ");
        header('Location: personnes.php');
    }
    $result = mysqli_query($conn, "SELECT * FROM personne WHERE numero_personne = '" . $_GET['id'] . "'");
    $data = mysqli_fetch_array($result);
        
?>

<html>
    <?php include('templates/header.php')?>
    <div class="center">
        <h1 class="big-text">Modifier une personne</h1>
        <form action="" method="POST">
            <label for="nom">Nom:</label>
            <br>
            <input type="text" class="input-class" name="nom" value="<?php echo $data['nom'];?>" placeholder="Ajouter votre nom" required>
            <br>
            <label for="prenom">Prenom:</label>
            <br>
            <input type="text" class="input-class" name="prenom" value="<?php echo $data['prenom'];?>"  placeholder="Ajouter votre prenom" required>
            <br>
            <label for="telephone">Telephone:</label>
            <br>
            <input type="number" class="input-class" name="telephone" value="<?php echo $data['tel'];?>" placeholder="Ajouter votre numero de telephone" required>
            <br>
            <label for="email">Email:</label>
            <br>
            <input type="email" class="input-class" name="email" value="<?php echo $data['email'];?>" placeholder="Ajouter votre email" required>
            <br>
            <label for="adress">Adress:</label>
            <br>
            <input type="text" class="input-class" name="adress"  value="<?php echo $data['adress'];?>" placeholder="Ajouter votre adress" required>
            <br>
            <button name="update" value="update" class="button-form" type="submit">Update</button>
        </form>
    </div>
    <script src="app.js"></script>  
    
</html>