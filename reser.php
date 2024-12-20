<?php

    // Informations de connexion à la base de données
    $host = 'localhost';      // Hôte
    $user = 'root';           // Nom d'utilisateur
    $password = '';           // Mot de passe
    $database = 'gestionhotel'; // Nom de la base de données
    
    // Connexion à la base de données
    $conn = mysqli_connect($host, $user, $password, $database);
    
    // Vérification de la connexion
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Récupérer l'ID de la chambre et le prix depuis l'URL
    $num_chambre = isset($_GET['num_chambre']) ? $_GET['num_chambre'] : '';
    $prix = isset($_GET['prix']) ? $_GET['prix'] : '';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation de Chambre</title>
    <script src="https://www.paypal.com/sdk/js?client-id=ARWRqfTAIqnYRJo6aC-008Yi4vwvfTgQ3LlsUIwqDteTF6jm8UeNYoVtuoW_IubqVfISU_RZPWutptVw&currency=EUR"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Styles généraux */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background:rgb(226, 226, 236);
            display: flex;
            flex-direction: column;
            height: 100vh;
        }

        /* En-tête */
        header {
            background-color: #4CAF50;
            color: white;
            text-align: center;
            padding: 10px 0;
            font-size: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        /* Formulaire flottant */
        .form-container {
            width: 90%;
            max-width: 500px;
            background-color:  #4CAF50 ;
            margin: 40px auto; /* Espacement entre header et formulaire */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: box-shadow 0.3s ease-in-out;
        }

        .form-container:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        }

        h2 {
            text-align: center;
            color:rgb(242, 248, 242);
            margin-bottom: 20px;
        }

        /* Champs du formulaire */
        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
            color: #333;
        }

        input[type="text"], 
        input[type="email"], 
        input[type="number"], 
        input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }

        input:focus {
            border-color: #4CAF50;
            outline: none;
        }

        /* Bouton de soumission */
        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #45a049;
        }

        /* Pour les petits écrans */
        @media (max-width: 600px) {
            .form-container {
                width: 95%;
                padding: 15px;
            }
        }

        /* Style pour le conteneur PayPal */
        #paypal-button-container {
    
            width: 100%; /* Occupe toute la largeur disponible */
            max-width: 500px; /* Largeur maximale pour éviter un étirement excessif */
            margin: 15px auto; /* Espacement auto autour du conteneur */
            padding: 30px; /* Plus d'espace à l'intérieur pour le confort visuel */
            text-align: center;
            border-radius: 25px; /* Angles arrondis plus marqués pour un look moderne */
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3); /* Ombre plus prononcée pour un effet attrayant */
            background-color: #e9f5ff; /* Couleur de fond plus douce et aérée */
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            font-size: 18px; /* Taille du texte plus grande pour un visuel amélioré */
        }

        /* Effet au survol du conteneur */
        #paypal-button-container:hover {
            transform: scale(1.08); /* Agrandit légèrement le bouton */
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
        }

        /* Style supplémentaire pour le bouton PayPal intégré */
        .paypal-button {
            background-color: #0070ba !important; /* Bleu officiel de PayPal */
            color: #ffffff !important;
            font-weight: bold;
            border: none; /* Retire toute bordure */
            border-radius: 30px;  /* Angles très arrondis */
            padding: 20px 40px;   /* Plus d'espace autour du texte */
            font-size: 18px;   /* Texte plus grand */
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        /* Effet au survol du bouton PayPal */
        .paypal-button:hover {
            background-color: #45a049!important;
            transform: scale(1.05); /* Légère animation d'agrandissement */
        }
    </style>
</head>
<body>

    <!-- En-tête -->
    <header>
        <div>
            <h1>Réservation de Chambre</h1>
        </div>
    </header>

    <!-- Formulaire -->
    <div class="form-container">
        <h2>Formulaire de Réservation</h2>
        <form id="reservation-form">
            <!-- Informations personnelles -->
            <label for="name">Nom :</label>
            <input type="text" id="name" name="name" required placeholder="Entrez votre nom">

            <label for="firstname">Prénom :</label>
            <input type="text" id="firstname" name="firstname" required placeholder="Entrez votre prénom">

            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required placeholder="Entrez votre email">

            <label for="phone">Numéro de téléphone :</label>
            <input type="text" id="phone" name="phone" required placeholder="Entrez votre numéro de téléphone">

            <!-- Détails de la réservation -->
            <label for="checkin">Date d'arrivée :</label>
            <input type="date" id="checkin" name="checkin" required>

            <label for="checkout">Date de départ :</label>
            <input type="date" id="checkout" name="checkout" required>

            <label for="montant">Montant (en €) :</label>
            <input type="text" id="montant" name="montant" value="<?php echo htmlspecialchars($prix); ?>" readonly>

        </form>       
              
    </div>

    <script>
        // Récupération des champs date
        const checkin = document.getElementById('checkin');
        const checkout = document.getElementById('checkout');
        const form = document.getElementById('reservation-form');

        // Fonction pour vérifier les dates
        function validateDates() {
            const checkinDate = new Date(checkin.value);
            const checkoutDate = new Date(checkout.value);

            // Vérifier si la date de départ est inférieure ou égale à la date d'arrivée
            if (checkoutDate <= checkinDate) {
                checkout.setCustomValidity("La date de départ doit être après la date d'arrivée.");
            } else {
                checkout.setCustomValidity(""); // Enlève le message si tout est OK
            }
        }

        // Ajouter des écouteurs d'événements pour valider dynamiquement
        checkin.addEventListener('change', validateDates);
        checkout.addEventListener('change', validateDates);

        // Validation finale lors de la soumission du formulaire
        form.addEventListener('submit', function (e) {
            validateDates(); // Vérifie une dernière fois les dates
            if (!form.checkValidity()) {
                e.preventDefault(); // Empêche la soumission si les dates ne sont pas valides
                alert("Veuillez corriger les erreurs avant de soumettre le formulaire.");
            }
        });
    </script>

    <div id="paypal-button-container"></div> <!-- Conteneur du bouton PayPal -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Récupérer dynamiquement le montant depuis le formulaire
            const montant = document.getElementById('montant').value || "10.00"; // Montant par défaut si vide

            // Configuration du bouton PayPal
            paypal.Buttons({
                createOrder: function(data, actions) {
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: montant // Montant à payer
                            }
                        }]
                    });
                },
                onApprove: function(data, actions) {
                    return actions.order.capture().then(function(details) {
                        alert('Paiement effectué avec succès par ' + details.payer.name.given_name);
                        // Redirection ou traitement serveur après paiement
                        window.location.href = "confirmation.php"; // Page de confirmation
                    });
                },
                onError: function(err) {
                    console.error("Erreur de paiement :", err);
                    alert('Une erreur est survenue lors du paiement. Veuillez réessayer.');
                }
            }).render('#paypal-button-container');
        });
    </script>

</body>
</html>
