<?php
// inclure le fichier de configuration de la base de données
require_once '../crud/config.php';

// établir une connexion à la base de données
try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    // configurer PDO pour afficher les erreurs SQL
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

if(isset($_POST['submit'])){
    $instrument=$_POST['instrument'];
    $category_instrument=$_POST['category_instrument'];
    $artiste=$_POST['artiste'];
    $media=$_POST['media'];
    $url = $_POST['url'];

    try {
        // insérer les données dans la table artiste
        $stmt = $pdo->prepare("INSERT INTO artiste (nom, wiki_url, website_url) VALUES (:nom, :wiki_url, :website_url)");
        $stmt->bindParam(':nom', $artiste);
        if (strpos($url, 'wikipedia.org') !== false) {
            $stmt->bindParam(':wiki_url', $url);
            $stmt->bindValue(':website_url', NULL, PDO::PARAM_NULL);
        } else {
            $stmt->bindParam(':website_url', $url);
            $stmt->bindValue(':wiki_url', NULL, PDO::PARAM_NULL);
        }
        $stmt->execute();

        // récupérer l'ID de l'artiste inséré
        $id_artiste = $pdo->lastInsertId();

        // insérer les données dans la table instrument
        $stmt = $pdo->prepare("INSERT INTO instrument (titre, description) VALUES (:titre, :description)");
        $stmt->bindParam(':titre', $instrument);
        $stmt->bindParam(':description', $_POST['titre']);
        $stmt->execute();

        // récupérer l'ID de l'instrument inséré
        $id_instrument = $pdo->lastInsertId();

        // insérer les données dans la table media
        $stmt = $pdo->prepare("INSERT INTO media (media_url) VALUES (:media_url)");
        $stmt->bindParam(':media_url', $media);
        $stmt->execute();

        // récupérer l'ID du media inséré
        $id_media = $pdo->lastInsertId();

        // insérer les données dans la table instrument_project
        $stmt = $pdo->prepare("INSERT INTO instrument_project (id_instrument, category_instrument, id_artiste, id_media) VALUES (:id_instrument, :category_instrument, :id_artiste, :id_media)");
        $stmt->bindParam(':id_instrument', $id_instrument);
        $stmt->bindParam(':category_instrument', $category_instrument);
        $stmt->bindParam(':id_artiste', $id_artiste);
        $stmt->bindParam(':id_media', $id_media);
        $stmt->execute();

        echo "Ajout réussi !";
    } catch (PDOException $e) {
        die("Erreur d'insertion : " . $e->getMessage());
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
                <label><strong>Ajout d'un instrument</strong></label>
                <input type="text" class="form-control" placeholder="Entrez le nom de l'instrument" name="titre" autocomplete="off">
                <br>
                <input type="text" class="form-control" placeholder="Entrez la déscription de l'instrument" name="instrument" autocomplete="off">
            </div>

            <div class="form-group">
                <label for="category_instrument">Selectionner une catégorie:</label>

                <select name="category_instrument" id="category_instrument">
                    <option value="">--Selectionner une catégorie--</option>
                    <option value="biseau">Biseau</option>
                    <option value="anche simple">Anche simple</option>
                    <option value="anche double">Anche double</option>
                    <option value="anche libre">Anche libre</option>
                </select>
            </div>

            <div class="form-group">
                <label>Artiste</label>
                <input type="text" class="form-control" placeholder="Entrez le nom de l'artiste" name="artiste" autocomplete="off">
                <br>
                <label for="wiki_url">Adresse Wikipedia de l'artiste :</label>
                <input type="url" name="wiki_url" id="wiki_url" placeholder="https://fr.wikipedia.org/wiki/Nom_de_l'artiste" autocomplete="off">
                <br>
                <label for="website_url">Adresse du site web de l'artiste :</label>
                <input type="url" name="website_url" id="website_url" placeholder="https://www.nomdelartiste.com/" autocomplete="off">
            </div>

            <div class="form-group">
                <label>Media</label>
                <input type="text" class="form-control" placeholder="Lien vers extrait de son ou de vidéo" name="media_url" autocomplete="off">
                <br>
                <label for="media_file">Fichier media :</label>
                <input type="file" name="media_file" id="media_file" accept=".jpg,.jpeg,.png,.mp3,.mp4">
            </div>

            <button type="submit" class="btn btn-primary" name="submit">Valider</button>
        </form>
    </div>

</body>

</html>
