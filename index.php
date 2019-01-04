<?php
//si le fichier source existe alors:
if (file_exists('source.xml')) {
    $xml = simplexml_load_file('source.xml');
// j'initialise ma var ID
    $id = 0;
// Si 'page' est passé en parametre d'URL , je défini $id à -1 pour faire en sorte 
// de récupérer le bon index de mon tableau 
    if (isset($_GET['page'])) {
        $id = (int) htmlspecialchars($_GET['page']) - 1;
    }
// Si aucune page n'est passée en parametre d'URL je récupère 
// le premier index de mon tableau (page par defaut) en l'occurence la 
// valeur 0 pour l'accueil
    if (!isset($_GET['page'])) {
        $id = 0;
    }
    ?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <link href="assets/bootstrap/bootstrap.min.css" rel="stylesheet"/>
            <link href="assets/css/style.css" rel="stylesheet"/>
<!-- Chargement du titre de chaque page depuis xml grace a PHP-->
            <title><?= $xml->page[$id]->title ?></title>
        </head>
        <body>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <a class="navbar-brand" href="page1.html">Maçonnerie Ocordo</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <?php
                        // Boucle permettant de récupérer tous les éléments de navigation
                        // id de l'élément passé en parametre d'URL et menu pour l'affichage du menu
                        foreach ($xml as $element) {
                            echo '<li class="nav-item active"><a class="nav-link"  href="page' . $element['id'] . '.html">' . $element->menu . '</a></li>';
                        }
                        ?>
                    </ul>
                </div>
            </nav>
            <div >
                <img class="logo" src="assets/img/ocordo.png" alt="logo">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-10 offset-md-1 mt-5">
                        <div class='fond'>
                            <?php
// Permet de récupérer tous le contenu de mon tableau $xml
// je cible la balise <page> et ensuite je lui passe en parametre l'id de la page
// et ensuite j'affiche le contenu de mes différentes page.
                            echo $xml->page[$id]->content;
                            ?>
                        </div>
                    </div>                    
                </div>
                <?php
            } else {
                echo 'le fichier XML n\'existe pas';
            }
            ?>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="assets/bootstrap/bootstrap.min.js"></script>
    </body>
</html>