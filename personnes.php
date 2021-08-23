<?php
    include('config/connect_db.php');

    // ecrire query pour tout les personne
    $sql = "SELECT * FROM personne";

    // faire query pour get resultas

    $result = mysqli_query($conn, $sql);
    

    // afficher les donnees sous form de list

    $personnes = mysqli_fetch_all($result, MYSQLI_ASSOC);

    
    // free result from memory
    mysqli_free_result($result);
    
    // delete personne
    if(isset($_POST['delete'])){
        $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);
        $sql_delete = "DELETE FROM personne WHERE numero_personne = $id_to_delete";

        if(mysqli_query($conn, $sql_delete)){
            header('Location: personnes.php');
        }else{
            echo "query error" . mysqli_error($conn);
        }
    }
    // close connection
    mysqli_close($conn);

?>

<html>
    <head></head>
    <body>
        <?php include('templates/header.php')?>
        <script src="app.js"></script>  
        <div class="center-table">
            <h1 style="padding-top:8rem;" class="big-text">Liste des personnes</h1>
            <table class="content-table">
                <thead>
                <tr align="center">
                    <th align="center">Numero</th>
                    <th align="center">Nom</th>
                    <th align="center">Pr&eacute;nom</th>
                    <th align="center">T&eacute;lephone</th>
                    <th align="center">Email</th>
                    <th align="center">Adress</th>
                    <th align="center">Op&eacute;rations</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach($personnes as $personne):  ?>
                        <tr>     
                            <td><?php echo $personne['numero_personne'] ?></td>
                            <td><?php echo $personne['nom'] ?></td>
                            <td><?php echo $personne['prenom'] ?></td>
                            <td><?php echo $personne['tel'] ?></td>
                            <td><?php echo $personne['email'] ?></td>
                            <td><?php echo $personne['adress'] ?></td>
                            <td>
                                <div class="buttons">
                                    <a href="update.php?id=<?php echo $personne['numero_personne'];?>"><button class=" btn modifier">Modifier</button></a>
                                    <form action="personnes.php" method="POST">
                                        <input type="hidden" name="id_to_delete" value="<?php echo $personne['numero_personne'] ?>">
                                        <button type="submit" name="delete" value="delete" class=" btn suprime">Supprimer</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                        
                </tbody>
            </table>
            <p class="p-personne">nombres des personnes:<?php echo count($personnes) ?></p>
        </div>

    
    </body>
</html>

