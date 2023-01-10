<?php

namespace App\Controller;

use App\Entity\CasinoGameTable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Config\FileLocator;



class HomepageController extends AbstractController
{
    public array $casinoGames = array();

    #[Route('/', name: 'homepage')]
    public function index(): Response
    {
//        $casinoGames = $this->getDoctrine()
//            ->getRepository(CasinoGameTable::class)
//            ->findAll();

        $this->casinoGames = $this->getData();
// TODO define new view for single game and create a render for it on search
        return $this->render('homepage/index.html.twig', [
            'casino_games' => $this->casinoGames,
        ]);
    }
// w param @Route("/search/{key}")
    /**
     * @Route("/search", name="games_filter", methods={"GET", "HEAD"})
     */
    public function search(Request $request): Response
    {
        // GET DATA AND SEARCH KEY
        $this->casinoGames = $this->getData();
//        $em = $this->getDoctrine()->getManager();
        $requestString =  $request->get('q');

        // FILTER GAMES LIST BY NAME
        $posts = array_filter($this->casinoGames, function($obj) use ($requestString){
                if(str_contains(strtolower($obj->name), strtolower($requestString)))
                    return true;
                else
                    return false;
        });
        // $posts = $em->getRepository(CasinoGameTable::class)->findEntitiesByString($requestString);

        if(!$posts) {
            $result['posts']['error']="Post not found.";
        }
        else {
            $result['posts'] = $posts;
        }
        return new Response(json_encode($result)); // TODO atomize the game card, render it here, then job for JS
    }

    // I Could use fixtures instead
    public function getData() {
        // GET TEST DATA FILE
        $fileDir = [$this->getParameter('kernel.project_dir').'\testData'];
        $fileLocator = new FileLocator($fileDir);
        $fileToRead = $fileLocator->locate('data.json', null, false);
        $fileData = file_get_contents($fileToRead[0]);

        return json_decode($fileData);
    }
}
