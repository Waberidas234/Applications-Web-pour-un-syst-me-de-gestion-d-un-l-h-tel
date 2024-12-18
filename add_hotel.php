<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Hôtel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        form {
            max-width: 600px;
            margin: auto;
        }
        label {
            display: block;
            margin-top: 10px;
        }
        input, textarea, button {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Ajouter un Hôtel</h1>
    <form action="processe_hotel.php" method="POST" enctype="multipart/form-data">
        <label for="nom_hotel">Nom de l'Hôtel :</label>
        <input type="text" name="nom_hotel" id="nom_hotel" required>

        <label for="adresse_hotel">Adresse :</label>
        <input type="text" name="adresse_hotel" id="adresse_hotel" required>

        <label for="contact">Contact :</label>
        <input type="text" name="contact" id="contact" required>

        <label for="description">Description :</label>
        <textarea name="description" id="description" rows="5" required></textarea>

        <label for="image">Image :</label>
        <input type="file" name="image" id="image" accept="image/*" required>

        <button type="submit">Ajouter</button>
    </form>
</body>
</html>