<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Profil {if $user_exists}de {$user->getPrenom()} {$user->getNom()} {else} non trouvé {/if}</title>
    {include file='components/head.tpl'}
</head>
<body>
{include file='components/header.tpl'}
<main>
    {if $user_exists}
        {include file='components/profile.tpl'}
        {if $user_type == 'pilote'}
            <section class="liste-etudiant">
                <form method="post">
                    <h1 id="premiere_section">Vos étudiants </h1>
                    <div class="search-by-name">
                        <input type="search" class="search-bar" placeholder="Rechercher un étudiant">
                        <input type="submit" class="submit-small" value="Rechercher">
                    </div>
                    <div class="list_data">
                        <div class="contener_row">
                            <article class="etudiant">
                                <img src="/assets/profil.png" alt="Etudiant">
                                <div class="c1">
                                    <span class="bold">NomEtudiant1</span>
                                    <span>Domaine1</span>
                                </div>
                                <div class="c2">
                                    <span class="bold">PrénomEtudiant1</span>
                                    <span>AnnéeEtudes1</span>
                                </div>
                            </article>
                        {if $current_user->getId() == $user->getId()}<button class="delete">Supprimer</button>{/if}
                        </div>
                        <div class="contener_row">
                            <article class="etudiant">
                                <img src="/assets/profil.png" alt="Etudiant">
                                <div class="c1">
                                    <span class="bold">NomEtudiant2</span>
                                    <span>Domaine2</span>
                                </div>
                                <div class="c2">
                                    <span class="bold">PrénomEtudiant2</span>
                                    <span>AnnéeEtudes2</span>
                                </div>
                            </article>
                            {if $current_user->getId() == $user->getId()}<button class="delete">Supprimer</button>{/if}
                        </div>
                    </div>
                </form>
            </section>
        {elseif $user_type == 'etudiant'}
            <h1 id="premiere_section">Wishlist</h1>
            <section class="contener_row">
                <article class="offre">
                    <div class="c1">
                        <span class="poste">Poste</span>
                        <span class="entreprise">Entreprise</span>
                        <span class="niveau">Niveau</span>
                    </div>
                    <div class="c2">
                        <span class="domaine">Domaine</span>
                        <span class="dates">Dates</span>
                    </div>
                    <div class="c3">
                        <ul class="competences">Compétences :
                            <li>competence A</li>
                            <li>competence B</li>
                        </ul>
                    </div>
                </article>
                {if $current_user->getId() == $user->getId()}<button class="delete">Supprimer</button>{/if}

                <article class="offre">
                    <div class="c1">
                        <span class="poste">Poste</span>
                        <span class="entreprise">Entreprise</span>
                        <span class="niveau">Niveau</span>
                    </div>
                    <div class="c2">
                        <span class="domaine">Domaine</span>
                        <span class="dates">Dates</span>
                    </div>
                    <div class="c3">
                        <ul class="competences">Compétences :
                            <li>competence A</li>
                            <li>competence B</li>
                        </ul>
                    </div>
                </article>
                {if $current_user->getId() == $user->getId()}<button class="delete">Supprimer</button>{/if}
            </section>
        {/if}
    {else}
        <h1>Cet utilisateur n'existe pas :/</h1>
    {/if}
</main>
<button id="button_back" onclick="scrollToTop()"><img src="../assets/arrow_up.svg" alt="fleche haut"></button>
{include file='components/footer.tpl'}
</body>
</html>