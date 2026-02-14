<?php
// dans index.php mettre un lien sur ✏️ qui redirige ici (src/update.php) en envoyant l'id du produit à updater
// Récupérer l'id du produit à updater
// Récupérer ce produit dans la BDD
// Injecter la nom du produit dans le formulaire

// Si le formulaire est soumis, récupérer la saisie de l'utilisateur
// updater la saisie dans la BDD
// Rediriger vers la index.php

require 'service/function-verif.php';

$pdo = new \PDO('mysql:host=mysql;dbname=courses;charset=utf8mb4','user','pwd');

if (!empty($_GET)){
    $id = $_GET['id'];

    $sql = "SELECT * FROM product WHERE id=:id";
    $request = $pdo->prepare($sql);
    $request->execute(['id' => $id]);
    $product = $request->fetch(PDO::FETCH_ASSOC);

}

if (!empty($_POST)) {
    $productName = (trim($_POST['item']));

    $class = 'error';
    $message = nameVerif($productName);

    if (!$message) {
        $sql = "UPDATE product SET name=:name WHERE id=:id";
        $request = $pdo->prepare($sql);
        $request->execute(['name' => $productName, 'id' => $product['id'] ]);

        $message = 'Le produit: '.$product['name'].' est Modifié en '.$productName.' avec succé';
        $class = 'success';

        header("location: ../index.php?message=$message&class=$class");
        exit;
    }
 
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/index-style.css">
    <title>Modifier</title>
</head>
<body>
    <p class="message <?= (isset($class)) ? $class: '' ?>"><?=  (isset($message)) ? htmlspecialchars($message): '' ?></p>
    <h1>Modifier le produit</h1>
    <form action="update.php?id=<?= htmlspecialchars($product['id'])?>" method="post">            <!-- Il faut ici renseigner dynamiquement id -->
        <label for="item">Produit : </label>
        <input type="text" name="item" value="<?= $product['name']?>">
        <input type="submit" value="Modifier">
    </form>
    <a href="../index.php">Retour à l'accueil</a>
</body>
</html>