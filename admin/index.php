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
            <h1>Liste des items </h1><a class="btn btn-success btn-lg btnAdd" href="insert.php" role="button"><svg class="bi bi-plus" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M8 3.5a.5.5 0 01.5.5v4a.5.5 0 01-.5.5H4a.5.5 0 010-1h3.5V4a.5.5 0 01.5-.5z" clip-rule="evenodd" />
                    <path fill-rule="evenodd" d="M7.5 8a.5.5 0 01.5-.5h4a.5.5 0 010 1H8.5V12a.5.5 0 01-1 0V8z" clip-rule="evenodd" />
                </svg> Ajouter</a>
            <table class="table table-striped table-bordered">
                <thead>
                    <!--Partie où je place le nom des colonnes-->
                    <tr>
                        <!--Première ligne de mon tableau-->
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Prix</th>
                        <th>Catégorie</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require 'database.php'; // Me permet d'utiliser mon fichier database.php 
                    $db = Database::connect();  // Variable me permettant de staocker le résultat de ma fonction connect()
                    $statement = $db->query('SELECT items.id, items.name, items.description, items.price, categories.name AS category 
                                             FROM items LEFT JOIN categories ON items.category = categories.id
                                             ORDER BY items.id DESC'); // Cette requête me permet de joindre les deux tables et de pouvoir récupérer les infos dont j'ai besoin
                    while ($item = $statement->fetch()) { // Pour chaque ligne récupérée de ma requête j'applique le reste du code pour l'affichage

                        echo '<tr>';
                        echo '<td>' . $item['name'] . '</td>';
                        echo '<td>' . $item['description'] . '</td>';
                        echo '<td>' . number_format((float) $item['price'], 2, ".", "") . '</td>'; // Formate mon chiffre en lui précisant son format, sa valeur, le nombre de chiffre après la virgule, l'élément pour séparer (virgules,point);
                        echo '<td>' . $item['category'] . '</td>';
                        echo '<td width=346>'; //Me permet d'aligner les trois boutons sur la même ligne
                        echo '<a class="btn btn-secondary" href="view.php?id=' . $item['id'] . '" role="button"><svg class="bi bi-eye" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.134 13.134 0 001.66 2.043C4.12 11.332 5.88 12.5 8 12.5c2.12 0 3.879-1.168 5.168-2.457A13.134 13.134 0 0014.828 8a13.133 13.133 0 00-1.66-2.043C11.879 4.668 10.119 3.5 8 3.5c-2.12 0-3.879 1.168-5.168 2.457A13.133 13.133 0 001.172 8z" clip-rule="evenodd" />
                                    <path fill-rule="evenodd" d="M8 5.5a2.5 2.5 0 100 5 2.5 2.5 0 000-5zM4.5 8a3.5 3.5 0 117 0 3.5 3.5 0 01-7 0z" clip-rule="evenodd" />
                                </svg> voir</a>';
                        echo '<a class="btn btn-primary" href="update.php?id=' . $item['id'] .  '" role="button"><svg class="bi bi-pen" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M5.707 13.707a1 1 0 01-.39.242l-3 1a1 1 0 01-1.266-1.265l1-3a1 1 0 01.242-.391L10.086 2.5a2 2 0 012.828 0l.586.586a2 2 0 010 2.828l-7.793 7.793zM3 11l7.793-7.793a1 1 0 011.414 0l.586.586a1 1 0 010 1.414L5 13l-3 1 1-3z" clip-rule="evenodd" />
                                    <path fill-rule="evenodd" d="M9.854 2.56a.5.5 0 00-.708 0L5.854 5.855a.5.5 0 01-.708-.708L8.44 1.854a1.5 1.5 0 012.122 0l.293.292a.5.5 0 01-.707.708l-.293-.293z" clip-rule="evenodd" />
                                    <path d="M13.293 1.207a1 1 0 011.414 0l.03.03a1 1 0 01.03 1.383L13.5 4 12 2.5l1.293-1.293z" />
                                </svg> Modifier</a>';
                        echo '<a class="btn btn-danger" href="delete.php?id=' . $item['id'] . '" role="button"><svg class="bi bi-trash2" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M3.18 4l1.528 9.164a1 1 0 00.986.836h4.612a1 1 0 00.986-.836L12.82 4H3.18zm.541 9.329A2 2 0 005.694 15h4.612a2 2 0 001.973-1.671L14 3H2l1.721 10.329z" clip-rule="evenodd" />
                                    <path d="M14 3c0 1.105-2.686 2-6 2s-6-.895-6-2 2.686-2 6-2 6 .895 6 2z" />
                                    <path fill-rule="evenodd" d="M12.9 3c-.18-.14-.497-.307-.974-.466C10.967 2.214 9.58 2 8 2s-2.968.215-3.926.534c-.477.16-.795.327-.975.466.18.14.498.307.975.466C5.032 3.786 6.42 4 8 4s2.967-.215 3.926-.534c.477-.16.795-.327.975-.466zM8 5c3.314 0 6-.895 6-2s-2.686-2-6-2-6 .895-6 2 2.686 2 6 2z" clip-rule="evenodd" />
                                </svg> Supprimer</a>';
                        echo '</td>';
                        echo '</tr>';
                    }

                    Database::disconnect();

                    ?>


                </tbody>
            </table>

        </div>
    </div>

</body>

</html>