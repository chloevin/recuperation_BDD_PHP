
<?php



    $serveur = "localhost";
    $dbname = "formulaires";
    $user = "root";
    $pass = "root";
    
    $prenom = $_POST["prenom"];
    $nom = $_POST["nom"];
    $mail = $_POST["mail"];
    $messages = $_POST["messages"];
    $id = $_POST["id"];

 
    try{
        //On se connecte à la BDD
        $dbco = new PDO("mysql:host=$serveur;dbname=$dbname",$user,$pass);
        $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //On insère les données reçues
        $sth = $dbco->prepare("
            INSERT INTO form(id, nom, prenom, mail, messages)
            VALUES(:id, :nom, :prenom, :mail, :messages)");
        $sth->bindParam(':prenom',$prenom);
        $sth->bindParam(':nom',$nom);
        $sth->bindParam(':mail',$mail);
        $sth->bindParam(':messages',$messages);
        $sth->bindParam(':id',$id);


 
        $sth->execute();
     
        //On renvoie l'utilisateur vers la page de remerciement
        header("Location:form-merci.html");
    }
    catch(PDOException $e){
        echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
    }
?>