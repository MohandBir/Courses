<?php
// dans index.php mettre un lien sur ❌ qui redirige ici (src/update.php) en envoyant l'id du produit à supprimer
// Récupérer l'id du produit à supprimer
// Supprimer la saisie dans la BDD
// Rediriger vers la index.php


if (!empty($_GET)) {
    $id = $_GET['id'];
    $pdo = new \PDO('mysql:host=mysql;dbname=courses;charset=utf8mb4','user','pwd');
    $sql = "DELETE FROM product WHERE id=:id";
    $request = $pdo->prepare($sql);
    $request->execute(['id' => $id]);
    $message = 'Le Produit est supprimé avec succé';
    $class = 'success';
    header("location: /index.php?message=$message&class=success");
}
?>
