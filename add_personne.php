
<?php
    

    if(isset($_POST['submit'])){
        
        include('config/connect_db.php');

        $nom = mysqli_real_escape_string($conn, $_POST['nom']);
        $prenom = mysqli_real_escape_string($conn, $_POST['prenom']);
        $telephone = mysqli_real_escape_string($conn, $_POST['telephone']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $adress = mysqli_real_escape_string($conn, $_POST['adress']);

        $sql = "INSERT INTO personne(nom, prenom,tel,email,adress) VALUES('$nom','$prenom','$telephone','$email','$adress')";
        if(mysqli_query($conn,$sql)){
            header('Location: personnes.php');
        }else{
            echo "query error:" . mysqli_error($conn);
        }
    }
?>



<html>
    <?php include('templates/header.php')?>
    <div class="center">
        <h1 class="big-text">Ajouter une personne</h1>
        <form action="add_personne.php" method="POST">
            <label for="nom">Nom:</label>
            <br>
            <input type="text" class="input-class" name="nom" id="nom" placeholder="Ajouter votre nom" required>
            <br>
            <label for="prenom">Prenom:</label>
            <br>
            <input type="text" class="input-class" name="prenom" id="prenom" placeholder="Ajouter votre prenom" required>
            <br>
            <label for="telephone">Telephone:</label>
            <br>
            <input type="number" class="input-class" name="telephone" id="telephone" placeholder="Ajouter votre numero de telephone" required>
            <br>
            <label for="email">Email:</label>
            <br>
            <input type="email" class="input-class" name="email" id="email" placeholder="Ajouter votre email" required>
            <br>
            <label for="adress">Adress:</label>
            <br>
            <input type="text" class="input-class" name="adress" name="adress" placeholder="Ajouter votre adress" required>
            <br>
            <button name="submit" class="button-form" type="submit">Enregistrer</button>
        </form>
    </div>
    <script src="app.js"></script>  
    
</html>

<?php
    // cross cyber sicurity
    // if(isset($_POST['submit'])){
    //     echo htmlspecialchars($_POST['nom']);
    //     echo htmlspecialchars($_POST['prenom']);
    //     echo htmlspecialchars($_POST['telephone']);
    //     echo htmlspecialchars($_POST['email']);
    //     echo htmlspecialchars($_POST['adress']);
    // }

    // $conn = mysqli_connect('localhost', 'root', '', 'gestion_annoces');
    // if(!$conn){
    //     echo "Connection Eureur:" . mysqli_connect_error();
    // }
?>