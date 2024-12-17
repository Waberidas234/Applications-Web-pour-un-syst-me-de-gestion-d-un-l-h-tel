<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Hôtels</title>
    <style>
        body {
            font-family: Arial, sans-serif;
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
    </style>
</head>
<body>
    <h1>Liste des Hôtels</h1>
    <table>
        <thead>
            <tr>
                <th>Numéro</th>
                <th>Nom</th>
                <th>Adresse</th>
                <th>Contact</th>
                <th>Description</th>
                <th>Image</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Connexion à la base de données
            $conn = new mysqli('localhost', 'root', '', 'gestion_hotel');

            if ($conn->connect_error) {
                die("Connexion échouée : " . $conn->connect_error);
            }

            // Récupérer les hôtels
            $sql = "SELECT * FROM hotel";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['num_hotel'] . "</td>";
                    echo "<td>" . $row['nom_hotel'] . "</td>";
                    echo "<td>" . $row['adresse_hotel'] . "</td>";
                    echo "<td>" . $row['contact'] . "</td>";
                    echo "<td>" . $row['description'] . "</td>";
                    echo "<td><img src='" . $row['image_path'] . "' alt='Image Hôtel'></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Aucun hôtel trouvé</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>
</body>
</html>