<!-- VUE DE LA PAGE D'ACCUEIL -->
<main style="width: 80%; margin: auto; text-align: center;">
    <h1>Accueil</h1>
    <h2>Inscription d'un joueur</h2>
    <form action="" method="post">
        <input type="text" name="pseudo" placeholder="Votre Pseudo" required>
        <input type="email" name="email" placeholder="Votre Email" required>
        <input type="text" name="score" placeholder="Votre Score" required>
        <input type="password" name="password" placeholder="Votre Mot de Passe" required>
        <br>
        <input type="submit" name="submit">
    </form>
    <p><?= $message ?></p>
    <section  style="margin-top: 50px">
        <h2>Liste des joueurs</h2>
        <?= $userList ?>
    </section>
</main>