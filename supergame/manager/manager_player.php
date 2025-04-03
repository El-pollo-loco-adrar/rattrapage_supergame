<?php

class ManagerPlayer extends ModelPlayer{
    //Method
    public function addPlayer():string{ //Fonction qui ajoute un joueur en BDD
        //! 1)Je récupère les données 
        $pseudo = $this->getPseudo();
        $email = $this->getEmail();
        $score = $this->getScore();
        $password = $this->getPassword();

        //! 2)Je fais le try catch
        try{
            //! 3)Requête préparée
            $req = $this->getBdd()->prepare('INSERT INTO players(pseudo, email, score, psswrd) VALUES (?,?,?,?)');

            //! 4)Binding paramètre
            $req->bindParam(1,$pseudo,PDO::PARAM_STR);
            $req->bindParam(2,$email, PDO::PARAM_STR);
            $req->bindParam(3,$score, PDO::PARAM_INT);
            $req->bindParam(4, $password, PDO::PARAM_STR);

            //! 5)Execute la requête
            $req->execute();

            //! 6)Retourne message de confirmation
            return "$pseudo a été enregistré en BDD!";

        }catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function getPlayers():array | string{ //Fonction qui récupère les données utilisateur
        try{
            //! 1)Requête préparée
            $req = $this->getBdd()->prepare('SELECT pseudo, email, score FROM players');

            //! 2) Execute la requête
            $req->execute();

            //! 3)Je récupère la réponse (sous forme d'un tableau)
            $tab = $req->fetchAll(PDO::FETCH_ASSOC);

            //! 4) Je renvoie les données
            return $tab;

        }catch(Exception $e){
            return $e->getMessage();
        }
    }

    public function getPlayerByMail():array | string{ //Fonction qui récupère les données utilisateur par le mail
        try{
            //! 1)Requête préparée (Vérifie si mail est déjà présent dans BDD)
            $req = $this->getBdd()->prepare('SELECT pseudo, email, score, psswrd FROM players WHERE email = ?');

            //! 2)Je récupère l'email de l'utilisateur
            //$email = $this->getEmail();

            //! 3)Binding paramètre
            $req->bindParam(1,$email, PDO::PARAM_STR);

            //! 4)Execute la requête
            $req->execute();

            //! 5)Je récupère la réponse (sous forme d'un tableau)
            $tab = $req->fetchAll(PDO::FETCH_ASSOC);

            //! 6)Je renvoie les données
            return $tab;

        }catch(Exception $e){
            return $e->getMessage();
        }
    }
}

?>