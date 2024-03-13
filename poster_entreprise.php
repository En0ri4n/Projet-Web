<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Site - Groupe 1</title>
    <link rel="stylesheet" href="/assets/styles/poster_entreprise.css">
</head>
<body>
<?php include 'components/header.php'; ?>
<div class="poster"> Créer une fiche entreprise</div>

<div class="box">
    <div class="box2">
        <div class="box_div"><label>Nom de l'entreprise* </label> <input class="input_box" required></div>
        <div class="box_div"><label>Site Web </label> <input class="input_box"></div>
        <div class="box_div"><label>Adresse principale* </label> <input class="input_box" required></div>
        <div class="box_div"><label>Domaine* </label> <input class="input_box" required></div>
        <div class="box_div"><label>E-Mail </label> <input class="input_box"></div>
        <div class="box_div"><label>Téléphone </label> <input class="input_box"></div>
    </div>
    <div class="box2">
        <label for="entreprise-desc">Description de l'entreprise</label>
        <textarea class="input_box_long" id="entreprise-desc" required=""></textarea>
    </div>
</div>
<p class="marge">*Champs obligatoires</p>
<button type="submit" class="bouton">Poster</button>
<?php include 'components/footer.php'; ?>
</body>
<script type="module" src="/scripts/poster_entreprise.js"></script>
</html>