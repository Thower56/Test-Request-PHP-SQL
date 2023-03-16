<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <?php
        #On peut creer des variables pour faciliter le reste
        $servername = "localhost";
        $username = "root";
        $password = "";

        try
        {   #PDO est la class pour faire une request mySQL
            #PDO("Type de sql":host="nom du seveur";dbname="Nom de la BD a travailler", user, mot de passe)
            $conn = new PDO("mysql:host=$servername;dbname=tp1_partie1",$username,$password);

            echo "Connection reussi!"."<br>";
            #Juste pour voir si la connection marche
        }
        catch(PDOException $e){
            #Message d'error de l'evenement
            echo "Connection failed: ". $e->getMessage();
        }

        #Tu peux mettre ta demande dans une variable
        $requestSQL =
        "select a.id_artiste, a.nom_artiste, a.id_role, a.pht_artiste, v.nom_ville
         from artiste as a
         left join ville as v
         on v.id_ville = a.id_ville";

        #Mettre le resultat de la request dans une variable, elle va se travailler comme un Json
        $resultat = $conn->query($requestSQL);
        ?>
        <div class="container">
            <div class="row border border-dark">
            <?php
                #Le reste est une question de formater pour le site
                echo "<h2 class='text-center'>Artiste</h2>";
                echo "<table class='table'>";
                echo "<tr> <th scope='col'>ID</th> <th scope='col'>Nom</th> <th scope='col'>Role</th> <th scope='col'>Pht Artiste</th> <th scope='col'>Ville</th> </tr>";

                foreach($resultat as $res){     
                                #id_artiste       nom_artiste     id_role      pht_artiste       id_ville
                    echo "<tr><td>$res[0]</td><td>$res[1]</td><td>$res[2]</td><td>$res[3]</td><td>$res[4]</td></tr>";
                }
                echo "</table>";
            ?>
            </div>
        </div>
        
</body>
</html>