<?php
//CONTROLER DE LA PAGE D'ACCUEIL
include './utils/utils.php';
include './model/model_players.php';
include './manager/manager_player.php';

$message = "";
$userList = "";

//!Affichage de la liste des joueurs avec la fonction getPlayers()
$managerPlayer = new ManagerPlayer();
$data = $managerPlayer->getPlayers();

foreach($data as $player){
    $userList = $userList."<section>
                                <h3 style ='text-align: center;'>{$player['pseudo']}</h3>
                                <p style ='text-align: center;'>{$player['email']}</p>
                                <p style ='text-align: center;'>{$player["score"]} points</p>
                            </section>
                            <hr>";
}

//!Inscription d'un joueur avec la fonctions addPlayer()
// 1) Vérifier que le formulaire est submit
if(isset($_POST['submit'])){

    // 2) Vérifier que les champs ne soient pas vides
    if(
    isset($_POST['pseudo']) && !empty($_POST['pseudo']) &&
    isset($_POST['email']) && !empty($_POST['email']) &&
    isset($_POST['score']) && !empty($_POST['score']) &&
    isset($_POST['password']) && !empty($_POST['password'])){

        // 3) Vérifier format des données
        if(
        filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) &&
        filter_var($_POST['score'], FILTER_VALIDATE_INT)){

            // 4) Nettoyage des données avec la fonction dans utils
            $pseudo = sanitize($_POST['pseudo']);
            $email = sanitize($_POST['email']);
            $score = sanitize($_POST['score']);
            $password = sanitize($_POST['password']);

            // 5) Hasher MDP
            $password = password_hash($password, PASSWORD_BCRYPT);

            // 6) Vérifier si mail est déjà en BDD
            $manager = new ManagerPlayer();
            $data = $manager->setEmail($email)->getPlayerByMail();

            // 7) Confirmation
            if(empty($data)){
                $message = "<p style= 'color: green; font-weight: bold;'>" .$manager->setPseudo($pseudo)->setScore($score)->setPassword($password)->addPlayer(). "</p>";
            }else{
                $message = "<p style= 'color: red; font-weight: bold;'>L'email est déjà utilisé.</p>";
            }
        }else{
            $message = "<p style= 'color: red; font-weight: bold;'>L'email ou le score est invalide.</p>";
        }
    }else{
        $message = "<p style= 'color: red; font-weight: bold;'>Veuillez remplir les champs pour vous inscrire.</p>";
    }
}
include './view/header.php';
include './view/view_accueil.php';
include './view/footer.php';

?>