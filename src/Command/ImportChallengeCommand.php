<?php
// src/Command/CreateUserCommand.php
namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use App\Entity\Challenges;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// the name of the command is what users type after "php bin/console"
#[AsCommand(name: 'app:import-challenges')]
class ImportChallengeCommand extends Command
{

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        parent::__construct();
    }
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // ... put here the code to create the user
        $response = "";                      //Création du string avec la réponse

        
        if (($handle = fopen("./ecogeste.csv", "r")) !== FALSE) {  //vérifie que le fichier CSV est correct   
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {               //Lis l'ensemble des lignes du fichier
                //$num = count($data);                                                //Création de num avec le nombre de colonne du CSV                
                if ($data[1] !== ""){                                               //Vérifie que la colonne titre ne soit pas vide
                    /*for ($c=1; $c < $num; $c++) {                                       //Répeter pour chaque lire chaque colonne sauf la première
                    $response = $response . $data[$c] . "<br />\n";                 //Ajout les information dans la réponse 
                    }*/
                    ########## Affichage dans CMD ###########
                    /*
                    $titre = $data[1]."<br>\n";
                    $categorie = $data[2]."<br>\n";
                    $description = $data[4]."<br>\n".$data[5]."<br>\n".$data[6]."<br>\n";
                    $response = $response.$titre.$categorie.$description."___________________________________________________<br>\n";
                    */
                    ########## Ajout dans BDD ###########
                    $challenge = new Challenges(); // initialise l'entité
                    $challenge->setTitle($data[1]); // on set les différents champs
                    $challenge->setCategories($data[2]);
                    $challenge->setDescription($data[4]." ".$data[5]." ".$data[6]);
                    $challenge->setPoints(0);
                    $this->em->persist( $challenge ); // on déclare une modification de type persist et la génération des différents liens entre entité
                    $this->em->flush(); // on effectue les différentes modifications sur la base de données
                }
            }          
            echo $response; //Renvoie l'ensemble des informations
        }

        // return this if there was no problem running the command
        // (it's equivalent to returning int(0))
        return Command::SUCCESS;

        // or return this if some error happened during the execution
        // (it's equivalent to returning int(1))
        // return Command::FAILURE;

        // or return this to indicate incorrect command usage; e.g. invalid options
        // or missing arguments (it's equivalent to returning int(2))
        // return Command::INVALID
    }
}