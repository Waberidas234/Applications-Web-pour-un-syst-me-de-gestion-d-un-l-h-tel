<?php
// Connexion à la base de données
$conn = new mysqli("localhost", "root", "", "gestionhotel");

if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

// Récupérer les données des hôtels
$query = "SELECT * FROM hotel";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Hôtels</title>
    <style>
        .hotel-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin: 20px;
        }
        .hotel-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            width: 300px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            text-decoration: none; /* Supprime la décoration des liens */
            color: inherit; /* Garde les couleurs du texte */
        }
        .hotel-card img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            width: 100%;
            object-fit: cover;
            object-position: center;
            transition: 0.3s;
            
            margin: 0 auto;
            overflow: hidden;
        }
        .hotel-card img:hover{
            transform: scale(1.1);

        }
        .hotel-card h3 {
            color: #333;
        }
        .hotel-card p {
            color: #333;
            
        }
        .hotel-card img {
        width: 100%;
        height: 200px; /* Hauteur fixe pour toutes les images */
        object-fit: cover; /* Garantit que l'image remplit la zone sans déformation */
        border-radius: 8px;
        transition: 0.3s;
        margin: 0 auto;
        overflow: hidden;
        }

        .hotel-card img:hover {
        transform: scale(1.1);
        }
    </style>
</head>
<body>
    <center><h1>Liste des Hôtels</h1></center>
    <div class="hotel-container">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Utiliser le champ "lien" pour rediriger vers une page spécifique à chaque hôtel
                $lien = htmlspecialchars($row['lien']);
                echo '<a href="' . $lien . '" class="hotel-card">';
                echo '<img src="' . htmlspecialchars($row['image_path']) . '" alt="Image de l\'hôtel">';
                echo '<h3>' . htmlspecialchars($row['nom_hotel']) . '</h3>';
                echo '<p>Adresse : ' . htmlspecialchars($row['adresse_hotel']) . '</p>';
                echo '<p>Contact : ' . htmlspecialchars($row['contact']) . '</p>';
                echo '<p>Description:' . htmlspecialchars($row['descrip']) . '</p>';
                echo '</a>';
            }
        } else {
            echo "<p>Aucun hôtel trouvé.</p>";
        }
        ?>
    </div>
</body>
</html>
