<!DOCTYPE html>
<html>
<head>
    <title>liste d'article</title>

    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 20px;
}

h2 {
    color: #333;
}

ul {
    list-style-type: none;
    padding: 0;
}

li {
    margin-bottom: 10px;
}

.success {
    color: green;
}

.error {
    color: red;
}

    </style>


</head>
<body>
    <?php
    // Configuration de la connexion à la base de données
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "entretien";

    // Connexion à la base de données
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("La connexion a échoué : " . $conn->connect_error);
    }

    // Vérifier si le formulaire a été soumis
    if (isset($_POST['submit'])) {
        // Récupérer les valeurs du formulaire
        $nom_article = $_POST['nom_article'];
        $description = $_POST['description'];

        // Vérifier si l'article existe déjà dans la base de données
        $sql = "SELECT * FROM articles WHERE nom_article='$nom_article'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Mettre à jour l'article existant
            $sql = "UPDATE articles SET description='$description' WHERE nom_article='$nom_article'";
            if ($conn->query($sql) === TRUE) {
                echo "L'article a été modifié avec succès.";
            } else {
                echo "Erreur lors de la modification de l'article : " . $conn->error;
            }
        } else {
            // Insérer un nouvel article dans la base de données
            $sql = "INSERT INTO articles (nom_article, description) VALUES ('$nom_article', '$description')";
            if ($conn->query($sql) === TRUE) {
                echo "L'article a été ajouté avec succès.";
            } else {
                echo "Erreur lors de l'ajout de l'article : " . $conn->error;
            }
        }
    }

    // Récupérer tous les articles de la base de données
    $sql = "SELECT * FROM articles";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h2>Liste des articles</h2>";
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
            echo "<li>" . $row["nom_article"] . ": " . $row["description"] . "</li>";
        }
        echo "</ul>";
    } else {
        echo "Aucun article trouvé.";
    }
    
    $conn->close();
    ?>
</body>
</html>
