<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr"  >
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>
            <?php echo $title ?>
        </title>
        <!-- La feuille de styles "base.css" doit être appelée en premier. -->
        <link rel="stylesheet" type="text/css" href="CSS/base.css" media="all" />
        <link rel="stylesheet" type="text/css" href="CSS/modele04.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="CSS/index.css"/>
        <script type="text/javascript" src="JS/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="JS/index.js"></script>
    </head>

    <body>

        <div id="global">

            <header id="entete">
                <h1>
                    <img alt="<?php echo $srcIMG ?>" src="<?php echo $srcIMG ?>" />
                    <?php echo $titreDePage ?>
                </h1>
                <aside id="menu" class="menu">
                    <ul>
                        <li><a href="index.html" target="_blank">Accueil</a></li>
                        <li><a href="userProfil.html" target="_blank">Profil</a></li>
                        <li><a href="userInfos.html" target="_blank">Mes infos</a></li>
                        <li><a href="config.html" target="_blank">Configuration</a></li>
                        <li><a href="gestLog.html"target="_blank">Connexion</a></li>
                    </ul>
                </aside><!-- #navigation -->
            </header><!-- #entete -->

            <aside id="sous-menu" class="menu">
                <ul>
                    <li><a href="tableau.html" target="_blank">JSON 00</a></li>
                    <li><a href="sem02.html" target="_blank">TP02</a></li>
                    <li><a href="sem03.html" target="_blank">TP03</a></li>
                    <li><a href="sem04.html" target="_blank">TP04</a></li>
                    <li><a href="TPsem05.html" target="_blank">TP05</a></li>
                </ul>
            </aside><!-- #navigation -->

            <main id="contenu">
                <?php echo $bienvenue ?>
            </main><!-- #contenu -->

            <footer id="copyright">
                <span id="auteur">
                    <?php echo $auteur ?>
                </span>
                -
                <span>crédits
                    <span id="credits">
                        Mise en page &copy; 2008
                        <a href="http://www.elephorm.com">Elephorm</a> et
                        <a href="http://www.alsacreations.com">Alsacréations</a>
                    </span>
                </span>
            </footer>

        </div><!-- #global -->

    </body>
</html>

