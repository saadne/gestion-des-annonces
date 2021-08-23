
<?php
    include('config/connect_db.php');

    // ecrire query pour tout les personne
    $sql = "SELECT * FROM annoce";

    // faire query pour get resultas
    $result_per_page  = 6;
    $result = mysqli_query($conn, $sql);
    $number_of_result = mysqli_num_rows($result);

    // afficher les donnees sous form de list

    $annocess = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $number_of_page = ceil($number_of_result/$result_per_page);
    // free result from memory
    mysqli_free_result($result);

    if(!isset($_GET['page'])){
        $page=1;
    }
    else{
        $page = $_GET['page'];
    }
    
    $this_page_first = ($page-1)*$result_per_page;
    $sql = "SELECT * FROM annoce LIMIT " . $this_page_first . ',' . $result_per_page;
    $result = mysqli_query($conn, $sql);
    $annoces = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    // delete personne
    // if(isset($_POST['delete'])){
    //     $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);
    //     $sql_delete = "DELETE FROM personne WHERE numero_personne = $id_to_delete";

    //     if(mysqli_query($conn, $sql_delete)){
    //         header('Location: personnes.php');
    //     }else{
    //         echo "query error" . mysqli_error($conn);
    //     }
    // }
    // close connection
    mysqli_close($conn);


?>

<html>
    <head>
        
    </head>
    <?php include('templates/header.php')?>
            <div class="search-bar">
            <form action="search.php" method="POST">
                <input type="text" autocomplete="off" class="search" placeholder="Rechercher" name="search">
                <button type="submit" name="submit-search">Search</button>
            </form>
            </div>
            
            <div class="header-content">
            <?php foreach($annoces as $annoce){  ?>
                <a href="detail_annoce.php?id=<?php echo $annoce['numero_annoce']?>">
                    <div class="annoce">
                        <img src="./images/<?php echo $annoce['image_annonce']?>" alt="">
                        <div class="data">
                            <h4><?php echo $annoce['libelle']?></h4>
                            <p><?php echo $annoce['prix']?> MRU</p>
                        </div>
                    </div>
                </a>
            <?php } ?>
            </div>
            <div class="pagination">
                <div class="tag">
                <?php for($page = 1; $page<= $number_of_page; $page++ ) { ?>
                <a href="annonce.php?page=<?php echo $page ?>"><?php echo $page ?></a>
                <?php }?>
                </div>
                <p>nombre des annonces: <?php echo count($annocess) ?></p>
            </div>
    <script src="app.js"></script>  
    
</html>


   
