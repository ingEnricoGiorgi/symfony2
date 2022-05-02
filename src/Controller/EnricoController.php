<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Dipendenti;
use App\Entity\Timbrature;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EnricoController extends AbstractController
{
    /**
     * @Route("/lucky/number/{max}", name="app_lucky_number")
     */
    public function number(int $max): Response
    {
        $number = random_int(0, $max);

        return new Response(
            '<html><body>Lucky number: '.$number.'</body></html>'
        );
   }

 
   /**
   * @Route("/nuovo/dipendente/{nome}", name="app_nuovo_dipendenti")
   */
	
    public function creaDipendenti(string $nome, ManagerRegistry $doctrine):Response
    {
       //$doctrine = new ManagerRegistry();
	$entityManager = $doctrine->getManager();
	$dipendente=new Dipendenti();
	$dipendente-> setNome("Tizio");
	$dipendente->setEmail("tizio.123@gmail.com");
	$entityManager->persist($dipendente);
	$entityManager->flush();
      return new Response('Nuovo dipendente salvato con id:'.$dipendente->getId());

    }

/**
   * @Route("/timbra/dipendente/{id}", name="app_timbra_dipendenti")
   */

    public function timbra(ManagerRegistry $doctrine, int $id): Response
    {
        //echo gettype($data);
      $entityManager = $doctrine->getManager();
      $timbra=new Timbrature();
      $timbra-> setIdDipendente($id);
      //$dataora= date_default_timezone_get();
      $dataora = date('Y-m-d H:i:s');
      $timbra-> setDataora($dataora);
      $codice= ("cod".$id);
      $timbra-> setCodice($codice);
      $entityManager->persist($timbra);
      $entityManager->flush();//esegue comando al db
        return new Response('Nuova timbratura codice Dip: '.$timbra->getCodice().' - timestamp: '.$timbra->getDataora()." - id: ".$timbra->getIdDipendente());
      }
  
    


/**
   * @Route("/mostra/dipendente/{id}", name="app_mostra_dipendenti")
   */


    public function show(ManagerRegistry $doctrine, int $id): Response
    {
        $dipendente = $doctrine->getRepository(Dipendenti::class)->find($id);

        if (!$dipendente) {
            throw $this->createNotFoundException(
                'No employer found for id '.$id
            );
        }

    //   return new Response('Check out this great product: '.$dipendente->getNome());

        // or render a template
        // in the template, print things with {{ product.name }}
      return $this->render('dipendente/show.html.twig', ['bicchiere' => $dipendente]);
    }
    
    /**
    * @Route("/mostra/alldip", name="app_mostra__tutti_dipendenti")
    */
    public function showAll(ManagerRegistry $doctrine): Response
    {
            
        $dipendenti = $doctrine->getRepository(Dipendenti::class)->provajoin();

       // print_r($dipendenti);
        //exit;

        if (!$dipendenti) {
            throw $this->createNotFoundException(
                'Nessun dipendente con ID '.$id
            );
        }

        //return new Response('Ecco qui ' . $dipendente->getNome());

         // or render a template
        // in the template, print things with {{ product.name }}
        return $this->render('dipendente/show.html.twig', ['bicchiere' => $dipendenti]);

    }
/**
    * @Route("/mostra/alldipjoin", name="app_join_dipendenti")
    */
    public function showAllJoin(ManagerRegistry $doctrine): Response
    {
            
        $dipendenti = $doctrine->getRepository(Dipendenti::class)->provajoin();

         // or render a template
        // in the template, print things with {{ product.name }}
        return $this->render('dipendente/show.html.twig', ['bicchiere' => $dipendenti]);

    }
     






}

 
?>
