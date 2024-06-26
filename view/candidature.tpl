<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Candidature</title>
    {include file='components/head.tpl'}
</head>
<body>
{include file='components/header.tpl'}
<main>
    {if $offre_exists}
    <section class="offre-resume">
        <div class="liste-info">
            <h1 class=><a class="titre-link" href="/description-entreprise?entrepriseId={$entreprise->getId()}">{$entreprise->getNom()}</a></h1>
            <div>
                <img src="/assets/star.svg" class="star-bullet-point" alt="small star">
                <span class="soustitre-liste">Titre du Poste</span> <span>{$offre->getName()}</span>
            </div>
            <div>
                <img src="/assets/star.svg" class="star-bullet-point" alt="small star">
                <span class="soustitre-liste">Niveau demandé</span> <span>A{$offre->getLevel()}</span>
            </div>
            <div>
                <img src="/assets/star.svg" class="star-bullet-point" alt="small star">
                <span class="soustitre-liste">Domaine</span>  <span>{$secteur->getNom()}</span>
            </div>
        </div>
        <form method="post" id="form_inscription" action="/api/candidatures" enctype="multipart/form-data">
            <div class="form__file">
                <div>
                    <label for="file">CV</label>
                    <input type="file" name="cv" accept=".docx,.pdf" required>
                </div>
                <div>
                    <label for="file">Lettre de motivation</label>
                    <input type="file" name="motivation" accept=".docx,.pdf" required>
                </div>
                <input name="IdOffre" id="IdOffre" type="hidden" value="{$offre->getId()}">
            </div>
            <div class="center">
                <input class="submit" type="submit" value="Candidater">
            </div>
        </form>
    </section>
    {else}
        <h1>L'offre n'existe pas :/</h1>
    {/if}
</main>
{include file='components/footer.tpl'}
</body>
<script type="module" src="/scripts/descriptions.js"></script>
<script type="module" src="/scripts/candidature.js"></script>
</html>
