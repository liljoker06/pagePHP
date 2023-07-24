<!DOCTYPE html>
<html>
<head>
    <title>Ajouter/Modifier un article</title>
    <style>
        
form {
  width: 300px;
  margin: 0 auto;
}

label {
  display: block;
  margin-bottom: 5px;
}

input[type="text"],
textarea {
  width: 100%;
  padding: 5px;
  margin-bottom: 10px;
}

input[type="submit"] {
  padding: 10px 20px;
  background-color: #4CAF50;
  color: #fff;
  border: none;
  cursor: pointer;
}


h2 {
  text-align: center;
  margin-bottom: 20px;
}


.message {
  color: #ff0000;
  margin-bottom: 10px;
}

.success {
  color: #4CAF50;
}

.error {
  color: #ff0000;
}


    </style>
</head>
<body>
    <h2>Ajouter/Modifier un article</h2>
    <form method="post" action="">
        <label for="nom_article">Nom de l'article:</label>
        <input type="text" name="nom_article" id="nom_article" required><br><br>

        <label for="description">Description:</label>
        <textarea name="description" id="description" required></textarea><br><br>

        <input type="submit" name="submit" value="Enregistrer">
    </form>

    <?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "entretien";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("La connexion a échoué : " . $conn->connect_error);
    }

    
    if (isset($_POST['submit'])) {
        $nom_article = $_POST['nom_article'];
        $description = $_POST['description'];

       
        $sql = "SELECT * FROM articles WHERE nom_article='$nom_article'";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            $sql = "UPDATE articles SET description='$description' WHERE nom_article='$nom_article'";
            if ($conn->query($sql) === TRUE) {
                echo "L'article a été modifié avec succès.";
            } else {
                echo "Erreur lors de la modification de l'article : " . $conn->error;
            }
        } else {
            $sql = "INSERT INTO articles (nom_article, description) VALUES ('$nom_article', '$description')";
            if ($conn->query($sql) === TRUE) {
                echo "L'article a été ajouté avec succès.";
            } else {
                echo "Erreur lors de l'ajout de l'article : " . $conn->error;
            }
        }
    }
    ?>
</body>
</html>
