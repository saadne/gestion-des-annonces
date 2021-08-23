<?php
    include('config/connect_db.php');
    $id= $_GET['id'];

    $sql = "SELECT * FROM annoce WHERE numero_annoce = '$id' ";

    // faire query pour get resultas

    $result = mysqli_query($conn, $sql);

    $data = mysqli_fetch_array($result);

    $numero_personne = $data['deposer_par'];

    $sql_personne = "SELECT * FROM personne WHERE numero_personne = '$numero_personne' ";

    $result_personne = mysqli_query($conn, $sql_personne);

    $data_personne = mysqli_fetch_array($result_personne);



    if(isset($_POST['delete'])){
        $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);
        $sql_delete = "DELETE FROM annoce WHERE numero_annoce = $id_to_delete";

        if(mysqli_query($conn, $sql_delete)){
            header('Location: annonce.php');
        }else{
            echo "query error" . mysqli_error($conn);
        }
    }
    // close connection
    mysqli_close($conn);

?>


<html>
    <?php include('templates/header.php')?>
            
            <div class="annoce-detail">
            
                    <div class="single-annoce">
                     <a class= "link"href="./annonce.php">Retour</a>
                        <div class="ann">
                            <img src="./images/<?php echo $data['image_annonce'] ?>" alt="">
                            <div class="data-detail">
                                <h4 class="espace">Nom: <?php echo $data['libelle']; ?></h4>
                                <h5 class="espace">Prix: <?php echo $data['prix'] ;?> MRU</h5>
                                <p class="espace"><b>Description:</b> <?php echo $data['description']; ?></p>
                            </div>
                            <div class="deposer_par">
                                <h4>Contacter le deposant</h4>
                                <ul>
                                    <li>Nom: <?php echo $data_personne['nom']?></li>
                                    <li>Prenom: <?php echo $data_personne['prenom']?></li>
                                    <li>Email: <?php echo $data_personne['email']?></li>
                                    <li>Telephone: <?php echo $data_personne['tel']?></li>
                                </ul>
                            </div>
                        </div>
                        <div class="buttons btn-annoce">
                                <a href="update_annoce.php?id=<?php echo $data['numero_annoce'];?>"><button class=" btn modifier">Modifier</button></a>
                                <form action="detail_annoce.php" method="POST">
                                    <input type="hidden" name="id_to_delete" value="<?php echo $data['numero_annoce'] ?>">
                                    <button type="submit" name="delete" value="delete" class=" btn suprime">Supprimer</button>
                                </form>
                            </div>
                    </div>
            </div>
    <script src="app.js"></script>  
    
</html>


