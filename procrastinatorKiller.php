<?php
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//                                 on récupère les 4 dates et on les mets au format : du jour | de naissance | échéance        /////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$dateNaissance = $_POST["dateNaissance"]== "" ? "27/05/1978" : transformDate($_POST["dateNaissance"]);
$dateRetraite = $_POST["dateFin"]== "" ? "31/12/2042" : transformDate($_POST["dateFin"]);

$dateJour = getdate();
$dateJour = $dateJour['mday']."/".$dateJour['mon']."/".$dateJour['year'];
$debutInterrogation = DateTime::createFromFormat('d/m/Y', $dateJour);
 
$dateFinAnnee=new DateTime('last day of december');
$dateFinAnnee = $dateFinAnnee->format("d/m/Y");
$dateFinAnnee = DateTime::createFromFormat('d/m/Y', $dateFinAnnee);

$semainesDepuisNaissance = DateTime::createFromFormat('d/m/Y', $dateNaissance);

$dateFin = DateTime::createFromFormat('d/m/Y', $dateRetraite);


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//on calcule en nombre de semaines les temps : écoulé depuis naissance | restant à partir d'aujourd'hui | total de la naissance à échéance    //
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$tempsEcoulé = floor($semainesDepuisNaissance->diff($debutInterrogation)->days/7);
$tempsRestantAnnee = floor($debutInterrogation->diff($dateFinAnnee)->days/7);
$tempsRestant = floor($debutInterrogation->diff($dateFin)->days/7);
$tempsTotal = $tempsEcoulé + $tempsRestant;

$pourcentageEcoulé = number_format((($tempsEcoulé / $tempsTotal)*100),2);


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//On calcule pour faire des lignes de 52 semaines pour qu'une ligne corresponde à une année donc 52 carrés par lignes
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$nombreLignesTotal = ceil($tempsTotal / 52); // Nbr Total d'années
$nombreCarreNoirs = ceil($tempsEcoulé / 52); // Total temps passé
$nombreCarresVides = ceil($tempsRestant / 52)-1; // Total temps restant


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//On définit la fonction qui va dessiner notre schéma avec nos jolis carrés
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function dessinerCarres($nbCarres, $couleur){
    for ($i = 0; $i < $nbCarres; $i++) {
        $ligne = "";
        for($x=0;$x<52;$x++){ 
                $ligne .= '<div class="'.$couleur.'" ></div>';
        }
        echo '<div >'.$ligne.'<br/></div>';
    }
}

function anneEnCours($tempsRestantAnnee){
        $ligne = "";
        $restantVide = 52 - $tempsRestantAnnee;
        for($x=0;$x<$tempsRestantAnnee;$x++){ 
            $ligne .= '<div class="vide" ></div>';
        }
        for($x=0;$x<$restantVide;$x++){ 
                $ligne .= '<div class="plein" ></div>';
        }
        
        echo '<div >'.$ligne.'<br/></div>';
}

function transformDate($date){
    $dateTransforme = explode("-",$date);
    $dateTransforme = $date[2] . '/' . $date[1] . '/' . $date[0];
    return $dateTransforme;
}