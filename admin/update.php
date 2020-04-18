<?php

require 'database.php';

if(!empty($_GET['id'])){ // Première visite sur la page.
    $id = checkInput($_GET['id']); // Stocke l'ID de l'élément sélectionné pour rediriger sur la même page après les modifications grâce à la méthode POST
}

$nameError = $descriptionError = $priceError = $categoryError = $imageError = $name = $description = $price = $category = $image = ""; // Initialise mes variables pour la première visite de la page.

if (!empty($_POST)) { // Deuxième visite sur la page.
    $name = checkInput($_POST['name']);
    $description = checkInput($_POST['description']); // Toutes ses lignes me permettent de sécuriser les données entrantes de l'utilisateur.
    $price = checkInput($_POST['price']);
    $category = checkInput($_POST['category']);
    $image = checkInput($_FILES['image']['name']); // Récupère le nom de l'image 
    $imagePath = '../images/' . basename($image); // Récupère le chemin de l'image
    $imageExtension = pathinfo($imagePath, PATHINFO_EXTENSION); // Me récupère l'extention de l'image (jpg, png, etc).
    $isSuccess = true; // Me permettra de définir si mon formulaire a bien était renseigné.
   

    if (empty($name)) { // Suite de if pour vérifier si les champs sont vide et afficher une erreur si c'est le cas.
        $nameError = "Ce champ ne peut pas être vide ";
        $isSuccess = false;
    }
    if (empty($description)) {
        $descriptionError = "Ce champ ne peut pas être vide ";
        $isSuccess = false;
    }
    if (empty($price)) {
        $priceError = "Ce champ ne peut pas être vide ";
        $isSuccess = false;
    }
    if (empty($category)) {
        $categoryError = "Ce champ ne peut pas être vide ";
        $isSuccess = false;
    }
    if (empty($image)) {
       $isImageUpdated = false; // Permet de laisser la même image déjà présente en base de données.
    } else { // La suite dans le else me permet de vérifier toutes mes conditions sur l'images télécharger.
        $isImageUpdated = true;
        $isUploadSuccess = true;
        if ($imageExtension != "jpg" && $imageExtension != "png" && $imageExtension != "jpeg" && $imageExtension != "gif") { // Vérifie que l'image est dans un format pris en charge.
            $imageError = "Les fichiers autorisés sont : .jpg, .jpeg, .png, .gif";
            $isUploadSuccess = false;
        }
        if (file_exists($imagePath)) { //  file_exists me permet de vérifier si le nom d'une image existe déjà
            $imageError = "Le fichier existe déjà";
            $isUploadSuccess = false;
        }
        if ($_FILES["image"]["size"] > 500000) { // Vérifie la taille du fichier 
            $imageError = "Le fichier ne doit pas depasser les 500Kb";
            $isUploadSuccess = false;
        }
        if ($isUploadSuccess) { // 
            if (!move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath)) { // Cette fonction déplace mon image téléchargée au bon endroit grâce à une variable temporaire "tmp_name" et elle me renvoit true ou false.
                $imageError = "Il y a eu une erreur lors de l'upload";
                $isUploadSuccess = false;
            }
        }
    }
    if (($isSuccess && $isImageUpdated &&$isUploadSuccess) || ($isSuccess && !$isImageUpdated)) {
        $db = Database::connect();
        if($isImageUpdated){
            $statement = $db->prepare("UPDATE items set name = ?, description = ?, price = ?, category = ?, image= ? WHERE id = ?");
            $statement->execute(array($name, $description, $price, $category, $image, $id));
        } // Toutes ces valeurs concernent le deuxième passage. Les variables stockent les valeur du formulaire en POST.
        else{
            $statement = $db->prepare("UPDATE items set name = ?, description = ?, price = ?, category = ? WHERE id = ?");
            $statement->execute(array($name, $description, $price, $category, $id)); // Le else correspond au cas où l'image n'est pas modifier.
        }

        Database::disconnect();
        header("Location: index.php"); // Fonction permettant de revenir à la page index.php une fois l'insertion faite dans la base de données pour vérifier l'ajout dans la liste des items.
    }
    else if($isImageUpdated && !$isUploadSuccess) {
        $db = Database::connect();
        $statement = $db->prepare("SELECT image FROM items WHERE id=?"); // Empêche de modifier le nom de l'image sur ma page en cas d'erreur (mauvais format etc).
        $statement->execute(array($id));
        $item = $statement->fetch();
        $image = $item['image'];

    Database::disconnect();
    }
}
else{ // Correspond au premier passage dans ma page et au remplissage des données.

    $db = Database::connect();
    $statement = $db->prepare("SELECT * FROM items WHERE id=?");
    $statement->execute(array($id));
    $item = $statement->fetch();
    $name = $item['name']; // Je stocke mes données transmise du GET de $item dans mes variables du formulaire.
    $description = $item['description'];
    $price = $item['price'];
    $category = $item['category'];
    $image = $item['image'];

    Database::disconnect();
}




function checkInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Holtwood+One+SC&display=swap" rel="stylesheet">



    <title> Burger Code</title>
</head>

<body>

    <h1 class="text-logo"><svg class="bi bi-controller" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M11.119 2.693c.904.19 1.75.495 2.235.98.407.408.779 1.05 1.094 1.772.32.733.599 1.591.805 2.466.206.875.34 1.78.364 2.606.024.815-.059 1.602-.328 2.21a1.42 1.42 0 01-1.445.83c-.636-.067-1.115-.394-1.513-.773a11.307 11.307 0 01-.739-.809c-.126-.147-.25-.291-.368-.422-.728-.804-1.597-1.527-3.224-1.527-1.627 0-2.496.723-3.224 1.527-.119.131-.242.275-.368.422-.243.283-.494.576-.739.81-.398.378-.877.705-1.513.772a1.42 1.42 0 01-1.445-.83c-.27-.608-.352-1.395-.329-2.21.024-.826.16-1.73.365-2.606.206-.875.486-1.733.805-2.466.315-.722.687-1.364 1.094-1.772.486-.485 1.331-.79 2.235-.98.932-.196 2.03-.292 3.119-.292 1.089 0 2.187.096 3.119.292zm-6.032.979c-.877.185-1.469.443-1.733.708-.276.276-.587.783-.885 1.465a13.748 13.748 0 00-.748 2.295 12.351 12.351 0 00-.339 2.406c-.022.755.062 1.368.243 1.776a.42.42 0 00.426.24c.327-.034.61-.199.929-.502.212-.202.4-.423.615-.674.133-.156.276-.323.44-.505C4.861 9.97 5.978 9.026 8 9.026s3.139.943 3.965 1.855c.164.182.307.35.44.505.214.25.403.472.615.674.318.303.601.468.929.503a.42.42 0 00.426-.241c.18-.408.265-1.02.243-1.776a12.354 12.354 0 00-.339-2.406 13.753 13.753 0 00-.748-2.295c-.298-.682-.61-1.19-.885-1.465-.264-.265-.856-.523-1.733-.708-.85-.179-1.877-.27-2.913-.27-1.036 0-2.063.091-2.913.27z" clip-rule="evenodd" />
            <path d="M11.5 6.026a.5.5 0 11-1 0 .5.5 0 011 0zm-1 1a.5.5 0 11-1 0 .5.5 0 011 0zm2 0a.5.5 0 11-1 0 .5.5 0 011 0zm-1 1a.5.5 0 11-1 0 .5.5 0 011 0zm-7-2.5h1v3h-1v-3z" />
            <path d="M3.5 6.526h3v1h-3v-1zM3.051 3.26a.5.5 0 01.354-.613l1.932-.518a.5.5 0 01.258.966l-1.932.518a.5.5 0 01-.612-.354zm9.976 0a.5.5 0 00-.353-.613l-1.932-.518a.5.5 0 10-.259.966l1.932.518a.5.5 0 00.612-.354z" />
        </svg> Burger Code <svg class="bi bi-controller" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M11.119 2.693c.904.19 1.75.495 2.235.98.407.408.779 1.05 1.094 1.772.32.733.599 1.591.805 2.466.206.875.34 1.78.364 2.606.024.815-.059 1.602-.328 2.21a1.42 1.42 0 01-1.445.83c-.636-.067-1.115-.394-1.513-.773a11.307 11.307 0 01-.739-.809c-.126-.147-.25-.291-.368-.422-.728-.804-1.597-1.527-3.224-1.527-1.627 0-2.496.723-3.224 1.527-.119.131-.242.275-.368.422-.243.283-.494.576-.739.81-.398.378-.877.705-1.513.772a1.42 1.42 0 01-1.445-.83c-.27-.608-.352-1.395-.329-2.21.024-.826.16-1.73.365-2.606.206-.875.486-1.733.805-2.466.315-.722.687-1.364 1.094-1.772.486-.485 1.331-.79 2.235-.98.932-.196 2.03-.292 3.119-.292 1.089 0 2.187.096 3.119.292zm-6.032.979c-.877.185-1.469.443-1.733.708-.276.276-.587.783-.885 1.465a13.748 13.748 0 00-.748 2.295 12.351 12.351 0 00-.339 2.406c-.022.755.062 1.368.243 1.776a.42.42 0 00.426.24c.327-.034.61-.199.929-.502.212-.202.4-.423.615-.674.133-.156.276-.323.44-.505C4.861 9.97 5.978 9.026 8 9.026s3.139.943 3.965 1.855c.164.182.307.35.44.505.214.25.403.472.615.674.318.303.601.468.929.503a.42.42 0 00.426-.241c.18-.408.265-1.02.243-1.776a12.354 12.354 0 00-.339-2.406 13.753 13.753 0 00-.748-2.295c-.298-.682-.61-1.19-.885-1.465-.264-.265-.856-.523-1.733-.708-.85-.179-1.877-.27-2.913-.27-1.036 0-2.063.091-2.913.27z" clip-rule="evenodd" />
            <path d="M11.5 6.026a.5.5 0 11-1 0 .5.5 0 011 0zm-1 1a.5.5 0 11-1 0 .5.5 0 011 0zm2 0a.5.5 0 11-1 0 .5.5 0 011 0zm-1 1a.5.5 0 11-1 0 .5.5 0 011 0zm-7-2.5h1v3h-1v-3z" />
            <path d="M3.5 6.526h3v1h-3v-1zM3.051 3.26a.5.5 0 01.354-.613l1.932-.518a.5.5 0 01.258.966l-1.932.518a.5.5 0 01-.612-.354zm9.976 0a.5.5 0 00-.353-.613l-1.932-.518a.5.5 0 10-.259.966l1.932.518a.5.5 0 00.612-.354z" />
        </svg>
    </h1>
    <div class="container admin">
        <div class="row">
            <div class="col-sm-6">
                <h1>Modifier un item </h1>
                <br>
                <form action="<?php echo 'update.php?id=' . $id; ?>" class="form" method="POST" role="form" enctype="multipart/form-data"> <!--L'echo par la méthode POST me permet de récupérer les données de l'élément à la redirection de la page.-->
                   
                    <div class="form-group">
                        <label for="name">Nom:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nom" value="<?php echo $name; ?>">
                        <span class="help-inline"><?php echo $nameError; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <input type="text" class="form-control" id="description" name="description" placeholder="Description" value="<?php echo $description; ?>">
                        <span class="help-inline"><?php echo $descriptionError; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="price">Prix: (en €)</label>
                        <input type="number" step="0.01" class="form-control" id="price" name="price" placeholder="Prix" value="<?php echo $price; ?>">
                        <span class="help-inline"><?php echo $priceError; ?></span>

                    </div>
                    <div class="form-group">
                        <label for="category">Catégorie:</label>
                        <select class="form-control" name="category" id="category">
                            <?php
                            $db = Database::connect();
                            foreach ($db->query("SELECT * FROM categories") as $row) { // Va me permettre de parcourir ma base données et afficher pour chaque ligne les résultats.
                                if($row['id'] == $category)
                                echo '<option selected="selected" value="' . $row['id'] . '">' . $row['name'] . '</option>'; // Va me permettre d'afficher la catégorie directement affectée dans la base de donnée pour l'élément à modifier.
                                else
                                echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                            };
                            Database::disconnect();
                            ?>
                        </select>

                    </div>
                    <div class="form-group">
                        <label for="">Image:</label>
                        <p>
                            <?php echo $image; ?>
                        </p>
                        <label for="image">Image:</label>
                        <input type="file" id="image" name="image">
                        <span class="help-inline"><?php echo $imageError; ?></span>
                    </div>

                    <br>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-success"> Modifier</button>
                        <a class="btn btn-info" role="button" href="index.php"> Retour</a>
                    </div>
                </form>
            </div>

            <div class="col-sm-6 site">
                <div class="img-thumbnail" >
                <img class="img-fluid max-width: 100%" src=" <?php echo '../images/' . $image; ?>" alt="...">
                    <div class="price"><?php echo number_format((float) $price, 2, '.', '') . ' €'; ?></div>
                    <div class="caption">
                        <h4><?php echo $name; ?></h4>
                        <p><?php echo $description; ?></p>
                        <a href="#" class="btn btn-primary orange" role="button">Commander</a>
                    </div>
                </div>
            </div>
        </div>

</body>

</html>