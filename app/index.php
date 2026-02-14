<?php
// Créer l'objet $pdo en récupérant les infos de connexion à la BDD dans le docker_compose
$pdo = new \PDO('mysql:host=mysql;dbname=courses;charset=utf8mb4','user','pwd');

// Récupérer dans la BDD tous les produits. Vérifier avec un var_dump($products)
$sql = "SELECT * FROM product ";
$request = $pdo->prepare($sql);
$request->execute();
$products = $request->fetchAll(PDO::FETCH_ASSOC);

//var_dump($products[0]);

// Afficher tous les produits dans le HTML ci-dessous avec un foreach
if (!empty($_GET)){
    $message = $_GET['message'];
    $class = $_GET['class'];
   
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index-style.css">
    <title>Liste de courses</title>
</head>
<body>
    <p class="message <?= (isset($class)) ? $class: '' ?>"><?=  (isset($message)) ? htmlspecialchars($message): '' ?></p>
    <h1>Liste de courses :</h1>
    <form action="src/add.php" method="post">
        <label for="item">Produit : </label>
        <input type="text" name="item">
        <input type="submit" value="Ajouter">
    </form>
    <ul>
        <? foreach ($products as $product ) {?> 
        <li>
            <div class="product-name"><?php echo htmlspecialchars($product['name']) ?></div>
            <a href="src/delete.php" onclick="
                return confirm('êtes vous sûr de supprimer le produit <?= htmlspecialchars($product['name']) ?>');
            ">❌</a>      
            <a href="src/update.php?id=<?= $product['id'] ?>">✏️</a>
        </li>
        <?php } ?>
    </ul>

    <script>
        
    </script>
</body>
</html>