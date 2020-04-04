<?php

namespace App\Controller;

use App\Entity\Member as Member;
use App\Entity\Campaign as Campaign;
// use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/main", name="main")
     */
    public function index()
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }


    public function registerUser (Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $member = new Member();

        $member->setName($request->request->get('name'));
        $member->setPhone($request->request->get('phone'));
        $member->setEmail($request->request->get('email'));
        $member->setCreatedAt(new \DateTime('now'));

        $entityManager->persist($member);

        $entityManager->flush();

    }

    public function registerCampaign (Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $campaign = new Campaign();

        $uid = $request->request->get('UID');
        $compare = $this->getDoctrine()
            ->getRepository(Member::class)
            ->find($uid)
            ->getId();

        $campaign->setName($request->request->get('name'));
        $campaign->setMembersId($compare);
        $campaign->setCreatedAt(new \DateTime('now'));

        $entityManager->persist($campaign);

        $entityManager->flush();

    }

    public function campaignData($id)
    {
        $campaign = $this->getDoctrine()->getRepository(Campaign::class);

        $name = $campaign->find($id)->getName();
        $message = $campaign->find($id)->getMessageEnd();

        return new Response($name.', '.$message);
    }

    public function campaignEdit(Request $request)
    {
        $id = $request->request->get('id');
        
        $currentCampaign = $this->getDoctrine()
        ->getRepository(Campaign::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();

        $currentCampaign->setName($request->request->get('name'));

        $currentCampaign->setMessageEnd($request->request->get('message_end'));

        $entityManager->flush();

    }

    public function memberDelete($id)
    {
        $currentMember = $this->getDoctrine()
        ->getRepository(Member::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->remove($currentMember);

        $entityManager->flush();
    }

    public function campaignDelete($id)
    {
        $currentCampaign = $this->getDoctrine()
        ->getRepository(Campaign::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->remove($currentCampaign);

        $entityManager->flush();
    }


}
