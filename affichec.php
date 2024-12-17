<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Hôtels</title>
    <style>
        /* Styles globaux */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f8f8;
            color: #333;
        }

        header {
            
            background-color: #4CAF50;
            color: white;
            text-align: center;
            padding: 10px 0;
            font-size: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        
        }

        /* Conteneur principal */
        .container {
            width: 90%;
            margin: 20px auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            padding: 20px;
        }

        /* Carte de chambre */
        .hotel-card {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
            position: relative;
            z-index: 1;
            padding-bottom: 20px; /* Ajoute de l'espace sous le contenu */
            display: flex;
            flex-direction: column; /* Aligne le contenu en colonne */
            justify-content: space-between; /* Espace entre les blocs de contenu */
            min-height: 300px; /* Fixe une hauteur minimale pour toutes les cartes */

        }

        .hotel-card:hover {
            transform: scale(1.05); /* Agrandit la carte de 5% */
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3); /* Ombre plus marquée */
            z-index: 10;
            }

        /* Image */
        .hotel-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        /* Informations sur la chambre */
        .hotel-info {
            padding: 15px;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            font-weight: bold;
            flex: 1; /* Prend tout l'espace disponible */
            display: flex;
            gap: 10px; /* Espacement uniforme entre les contenus */
            margin: 5px 0; /* Espacement entre chaque ligne */
        }

        .hotel-name {
            font-size: 20px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .hotel-details {
            font-size: 14px;
            color: #666;
            margin-bottom: 10px;
        }

        /* Bouton Réserver */
        .btn-reserve {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            font-size: 16px;
            font-weight: bold;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s, transform 0.2s;
            margin-top: auto; /* Force le bouton à rester en bas */
        }

        .btn-reserve:hover {
            background-color:green;
            transform: scale(1.05);
        }

    </style>
</head>
<body>
    <header>
        <div>
            <h1>Liste des chambres</h1>
        </div>
    </header>

    <div class="container">
        <?php
            // Connexion à la base de données
            $conn = new mysqli('localhost', 'root', '', 'gestionhotel');

            // Vérification de la connexion
            if ($conn->connect_error) {
                die("Connexion échouée : " . $conn->connect_error);
            }

            // Récupération des données
            $sql = "SELECT * FROM chambre";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='hotel-card'>";
                    echo "<img src='" . htmlspecialchars($row['image_path']) . "' alt='Image de la chambre'>";
                    echo "<div class='hotel-info'>";
                    echo "<div class='hotel-name'>Prix : " . htmlspecialchars($row['prix']) . "€</div>";
                    echo "<div class='hotel-address'>Type de Chambre : " . htmlspecialchars($row['type_chambre']) . "</div>";
                    echo "<div class='hotel-contact'>Statut : " . htmlspecialchars($row['statut']) . "</div>";
                    echo "<button class='btn-reserve' data-id='" . $row['num_chambre'] . "' data-price='" . $row['prix'] . "'>Réserver</button>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "<p style='text-align: center; color: #555;'>Aucune chambre trouvée</p>";
            }

            $conn->close();
        ?>
    </div>


    <script>
        // Lorsque le bouton de réservation est cliqué
        document.querySelectorAll('.btn-reserve').forEach(button => {
            button.addEventListener('click', function() {
                // Récupérer l'ID et le prix de la chambre depuis les attributs de données du bouton
                const chambreId = this.getAttribute('data-id');
                const prix = this.getAttribute('data-price');

               // Rediriger vers la page de réservation avec les paramètres dans l'URL
               window.location.href = `reser.php?num_chambre=${chambreId}&prix=${prix}`;
            });
        });
    </script>
</body>
</html>
