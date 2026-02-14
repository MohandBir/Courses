<?php

$pdo = new \PDO('mysql:host=mysql;dbname=courses;charset=utf8mb4','user','pwd');

if (!empty($_POST)) {
    $productName = ucfirst(trim($_POST['item']));

    $class = 'error';
    $message = nameVerif($productName);

    if (!$message) {
        $sql = "INSERT INTO product(name) VALUES (:name)";
        $request = $pdo->prepare($sql);
        $request->execute(['name' => $productName]);

        $message = 'Le produit est ajouté avec succé';
        $class = 'success';
    }
    
    header("location: ../index.php?message=$message&class=$class");
    exit;
}

function nameVerif($productName){
    if (empty($productName)){
        return 'la saisi est vide';
    }
    if (strlen($productName) > 50){
        return 'Le nom de produit ne doit pas dépasser 50 caractères';
    }

}

