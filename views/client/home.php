<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil - Mon Entreprise</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        header {
            background-color: #0057a3;
            color: white;
            padding: 20px;
            text-align: center;
        }

        nav {
            background-color: #003f73;
            padding: 10px;
            text-align: center;
        }

        nav a {
            color: white;
            margin: 0 15px;
            text-decoration: none;
            font-weight: bold;
        }

        main {
            padding: 40px 20px;
            max-width: 1000px;
            margin: auto;
        }

        section {
            margin-bottom: 40px;
        }

        footer {
            background-color: #eee;
            text-align: center;
            padding: 20px;
            font-size: 0.9em;
        }
    </style>
</head>
<body>

<header>
    <h1>Bienvenue chez Mon Entreprise</h1>
    <p>Votre partenaire de confiance pour la formation professionnelle</p>
</header>

<nav>
    <a href="home.php">Accueil</a>
    <a href="formations/list.php">Formations</a>
    <a href="contact.php">Contact</a>
    <a href="../public/login.php">Connexion</a>
</nav>

<main>
    <section>
        <h2>À propos de nous</h2>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla ut facilisis lorem, nec mattis lorem.
            Vivamus vitae orci in libero finibus tincidunt. Curabitur non neque vitae nulla tincidunt laoreet.
            Suspendisse at sem nec erat vulputate efficitur.
        </p>
    </section>

    <section>
        <h2>Nos Services</h2>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus commodo neque id sapien posuere,
            ut convallis ex elementum. Integer volutpat, nisi sed fermentum lacinia, ligula metus accumsan turpis,
            sed varius tortor lorem vel massa.
        </p>
    </section>

    <section>
        <h2>Pourquoi nous choisir ?</h2>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean condimentum purus nec facilisis luctus.
            Donec dapibus, metus ac fermentum sagittis, turpis justo iaculis arcu, vitae consequat sem risus et diam.
        </p>
    </section>
</main>

<footer>
    &copy; <?= date('Y') ?> Mon Entreprise. Tous droits réservés.
</footer>

</body>
</html>
