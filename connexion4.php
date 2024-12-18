<?php
session_start();
$conn = new mysqli("localhost", "root", "", "gestionhotel");

// Vérifiez si la connexion à la base a échoué
if ($conn->connect_error) {
    die("Erreur de connexion à la base de données : " . $conn->connect_error);
}

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['num_admin']; // Numéro d'administrateur comme mot de passe
    $role = $_POST['role']; // Champ rôle saisi par l'utilisateur

    // Requête pour vérifier les identifiants et le rôle
    $query = $conn->prepare("SELECT * FROM adminstrateur WHERE email = ? AND Motdepasse = ? AND Rolee = ?");
    $query->bind_param("sss", $email, $password, $role); // Paramètres : email (string), num_admin (int), role (string)
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows === 1) {
        $admin = $result->fetch_assoc();

        // Vérification du rôle et redirection
        if ($role === 'superadmin') {
            $_SESSION['admin_id'] = $admin['num_admin'];
            $_SESSION['hotel_id'] = $admin['num_hotel'];
            $_SESSION['admin_name'] = $admin['nom_admin'];
            header("Location: superadmin.php");
            exit();
        } elseif ($role === 'admin') {
            $_SESSION['admin_id'] = $admin['num_admin'];
            $_SESSION['hotel_id'] = $admin['num_hotel'];
            $_SESSION['admin_name'] = $admin['nom_admin'];
            header("Location: admin_dashboard.php");
            exit();
        } else {
            $error = "Rôle incorrect.";
        }
    } else {
        $error = "Identifiants ou rôle incorrects.";
    }
    $query->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Gestion Hôtel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 40%;
            margin: 100px auto;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            font-size: 24px;
            color: #4CAF50;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            margin: 10px 0 5px;
            font-weight: bold;
            color: #333;
        }

        input, select {
            width: 80%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            width: 50%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
            margin-bottom: 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Connexion Administrateur</h1>
        <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
        <form method="POST" action="connexion4.php">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
            <label for="num_admin">Mot de passe :</label>
            <input type="password" name="num_admin" id="num_admin" required>
            <label for="role">Rôle:</label>
            <select name="role" id="role" required>
                <option value="superadmin">superadmin</option>
                <option value="admin">Admin</option>
            </select>
            <button type="submit">Se connecter</button>
        </form>
    </div>
</body>
</html>


