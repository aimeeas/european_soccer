<?php
// pour le mettre en ligne 
// Activer l'affichage des erreurs pour le développement
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Paramètres de connexion à la base de données
$servername = "localhost";
$username   = "root";
$password   = "root";
$dbname     = "European_Soccer"; // assurez-vous que le nom de la base correspond

// Créer la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

// Vérifier que le champ de recherche est renseigné
if (isset($_GET['playerName']) && !empty($_GET['playerName'])) {
    // Nettoyer la saisie pour éviter les injections SQL
    $playerName = $conn->real_escape_string($_GET['playerName']);

    // Requête SQL pour récupérer les informations du joueur et son agent
    // N'oubliez pas d'utiliser des backticks pour les colonnes avec espaces
    $sql = "SELECT p.`id_player`, p.`PlayerName`, p.`Jersey`, p.`Birth Date`, p.`Age`, p.`Height meters`, 
                   p.`Citizenship`, p.`Position`,
                   a.`Agent`, a.`e-mail` AS email, a.`phone_1`, a.`phone_2`, a.`country`
            FROM `player` p
            JOIN `agent` a ON p.`id_agent` = a.`id_agent`
            WHERE p.`PlayerName` LIKE '%$playerName%'";

    $result = $conn->query($sql);
} else {
    $result = false;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Résultats de la recherche - European Soccer</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <h1>Résultats de la Recherche</h1>
    <?php if (isset($playerName) && !empty($playerName)): ?>
      <p>Vous avez recherché : <strong><?php echo htmlspecialchars($playerName); ?></strong></p>
      <?php if ($result && $result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
          <div class="result">
            <h2><?php echo htmlspecialchars($row['PlayerName']); ?></h2>
            <p><strong>Numéro de maillot :</strong> <?php echo htmlspecialchars($row['Jersey']); ?></p>
            <p><strong>Date de naissance :</strong> <?php echo htmlspecialchars($row['Birth Date']); ?></p>
            <p><strong>Âge :</strong> <?php echo htmlspecialchars($row['Age']); ?></p>
            <p><strong>Taille (mètres) :</strong> <?php echo htmlspecialchars($row['Height meters']); ?></p>
            <p><strong>Nationalité :</strong> <?php echo htmlspecialchars($row['Citizenship']); ?></p>
            <p><strong>Position :</strong> <?php echo htmlspecialchars($row['Position']); ?></p>
            <hr>
            <h3>Détails de l'Agent</h3>
            <p><strong>Nom de l'agent :</strong> <?php echo htmlspecialchars($row['Agent']); ?></p>
            <p><strong>Email :</strong> <?php echo htmlspecialchars($row['email']); ?></p>
            <p><strong>Téléphone 1 :</strong> <?php echo htmlspecialchars($row['phone_1']); ?></p>
            <p><strong>Téléphone 2 :</strong> <?php echo htmlspecialchars($row['phone_2']); ?></p>
            <p><strong>Pays :</strong> <?php echo htmlspecialchars($row['country']); ?></p>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <p>Aucun joueur trouvé correspondant à la recherche.</p>
      <?php endif; ?>
    <?php else: ?>
      <p>Veuillez entrer un nom de joueur pour effectuer la recherche.</p>
    <?php endif; ?>
    <a href="search.html" class="back-button">Retour à la recherche</a>
  </div>
  <?php $conn->close(); ?>
</body>
</html>
