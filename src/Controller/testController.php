<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Challenges;
use Doctrine\ORM\EntityManagerInterface;

class testController extends AbstractController
{
    #[Route("/test", name:"test")]          //Affichage du fichier sur la route site/test
    public function test()
    {
        $response = "";                      //Création du string avec la réponse
        if (($handle = fopen("C:/Users/Nilsd/OneDrive/Bureau/Cours L2/2023-09-25 Symfony/Symfony_Bleu/ecogeste.csv", "r")) !== FALSE) {  //vérifie que le fichier CSV est correct   
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {               //Lis l'ensemble des lignes du fichier
                //$num = count($data);                                                //Création de num avec le nombre de colonne du CSV                
                if ($data[1] !== ""){                                               //Vérifie que la colonne titre ne soit pas vide
                    /*for ($c=1; $c < $num; $c++) {                                       //Répeter pour chaque lire chaque colonne sauf la première
                    $response = $response . $data[$c] . "<br />\n";                 //Ajout les information dans la réponse 
                    }*/
                    $titre = $data[1]."<br>";
                    $categorie = $data[2]."<br>";
                    $description = $data[4]."<br>".$data[5]."<br>".$data[6]."<br>";
                    $response = $response.$titre.$categorie.$description."___________________________________________________<br>";                    
                }
            }
            return new Response($response);                                         //Renvoie l'ensemble des informations
        }
    }
}