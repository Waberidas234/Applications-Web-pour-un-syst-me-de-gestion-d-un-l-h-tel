<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table avec Images</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: transparent;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        img {
            max-width: 100px;
            height: auto;
        }
        form {
            margin-bottom: 20px;
        }
        .btn-reservation {
            padding: 5px 10px;
            color: white;
            background-color: #007BFF;
            text-decoration: none;
            border-radius: 5px;
        }
        .btn-reservation:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Gestion des hotels</h1>

    <!-- Formulaire d'ajout -->
    <form action="processe_hotel1.php" method="POST" enctype="multipart/form-data">
        <label for="nom">nom du hotel :</label>
        <input type="text" name="nom" id="nom" required>
        
        <button type="submit">Supprimer</button>
    </form>

    <!-- Tableau des chambres -->
    <table>
        <thead>
            <tr>
                <th>Image</th>
                <th>nonhotel</th>
                <th>adresse</th>
                <th>contact</th>
                <th>description</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Connexion à la base de données
            $conn = new mysqli('localhost', 'root', '', 'gestionhotel');
            session_start();
            if (!isset($_SESSION['admin_id'])) {
                // Si l'utilisateur n'est pas connecté, rediriger vers la page de connexion
                header("Location: connexion4.php");
                exit();
            }
            // Vérification de la connexion
            if ($conn->connect_error) {
                die("Connexion échouée : " . $conn->connect_error);
            }

            // Récupération des données
            $sql = "SELECT * FROM hotel";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td><img src='" . $row['image_path'] . "' alt='Image Chambre'></td>";
                    echo "<td>" . htmlspecialchars($row['nom_hotel']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['adresse_hotel']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['contact']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['descrip']) . "</td>";
                  
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Aucune hotel trouvée</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>
</body>
</html>
