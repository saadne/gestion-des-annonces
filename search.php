<?php include('templates/header.php')?>


<?php
    include('config/connect_db.php');
    if(isset($_POST['submit-search'])){
        $search = mysqli_real_escape_string($conn,$_POST['search']);
        $sql = "SELECT a.numero_annoce, a.libelle , a.prix , 
            a.image_annonce, a.deposer_par,
            p.numero_personne, p.nom, p.prenom,p.tel FROM annoce a 
            INNER JOIN personne p
            on a.deposer_par = p.numero_personne
            WHERE p.nom LIKE '%$search%' or p.prenom LIKE '%$search%'
            or p.tel LIKE '%$search%' or p.numero_personne LIKE '%$search%'";
        $result = mysqli_query($conn,$sql);
        $number_of_result = mysqli_num_rows($result);
        if($number_of_result > 0){
            $annoces_search = mysqli_fetch_all($result, MYSQLI_ASSOC);
        }else{
           echo  "Pas d'annonce depose par cette personne";
        }
    }

?>

<div class="header-content">
    <?php foreach($annoces_search as $annoce){  ?>
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