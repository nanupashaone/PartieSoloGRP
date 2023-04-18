<?php
include '../crud/connect.php';

if(isset($_POST['submit'])){
    $instrument=$_POST['instrument'];
    $category_instrument=$_POST['category_instrument'];
    $artiste=$_POST['artiste'];
    $media=$_POST['media'];

    $sql="insert into `instrument_project (instrument, category_instrument, artiste, media) values('$instrument','$category_instrument','$artiste','$media')";
    $result=mysqli_query($con,$sql);
    if($result) {
        echo "Ajout réussi !";
    } else {
        die(mysqli_error($con)); 
    }
}

?>


<!doctype html>
<html lang="fr">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <title>Crud operation</title>
</head>

<body>
    <div class="container my-5">
        <form method="post">
            <div class="form-group">
                <label>Instrument</label>
                <input type="text" class="form-control" placeholder="Entrez le nom de l'instrument" name="instrument" autocomplete="off">
            </div>

            <div class="form-group">
                <label>Catégorie d'instrument</label>
                <input type="text" class="form-control" placeholder="Entrez la catégorie de l'instrument" name="category_instrument" autocomplete="off">
            </div>
            <div class="form-group">
                <label>Artiste</label>
                <input type="text" class="form-control" placeholder="Artiste utilisant cet instrument" name="artiste" autocomplete="off">
            </div>
            <div class="form-group">
                <label>Media</label>
                <input type="text" class="form-control" placeholder="Lien vers extrait de son ou de vidéo" name="media" autocomplete="off">
            </div>
            

            <button type="submit" class="btn btn-primary" name="submit">Valider</button>
        </form>
    </div>


</body>

</html>