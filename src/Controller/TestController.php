<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use \Predis\Client as Client;

class TestController extends AbstractController
{

    /**
     * @Route("/test", name="test")
     */
    public function index()
    {
        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }
  

        /**
     * @Route("/redis", name="redis")
     */
    public function redis()
    {
        $redis = new Client();
        $redis->getConnection('redis://vagrant@localhost:6379');

        return new Response(
            '<html><body>Lucky number: <pre>'.$redis->ping().'</pre></body></html>'
        );
    }
}
