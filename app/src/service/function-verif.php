<?php
function nameVerif($productName){
    if (empty($productName)){
        return 'la saisi est vide';
    }
    if (strlen($productName) > 50){
        return 'Le nom de produit ne doit pas dépasser 50 caractères';
    }

}
