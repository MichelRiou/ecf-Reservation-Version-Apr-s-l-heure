<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Reservation;

use DateTime;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('index.html.twig', [

        ]);
    }

    /**
     * @Route("searchRoom",name="search_room_dispo")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function searchRoomsDispoAction(Request $request)
    {
        //$tag = $request->query->get('tag');
        $tag = $request->request->all();
        $start_date = $tag["startDate"];
        $nbOfPersons = $tag["nbPersons"];
        $end_date = $tag["endDate"];

        $roomRepository = $this->getDoctrine()->getRepository("AppBundle:Room");
        $roomsOff = $roomRepository->getRoomsDispo($start_date, $end_date)->getArrayResult();
        $rooms = $roomRepository->findAll();
        if (count($rooms) < 1) {
            $msg = 'Aucunes réservations';
        } else {
            $msg = 'Sélections des réservations';
        }
        $newRooms = [];


        foreach ($rooms as $key => $value) {
            // if (! array_search($value->getId(),$roomsOff)) {
            //     array_push($newRooms, $value);
            // }
            $x = true;
            foreach ($roomsOff as $k => $v) {
                if ($value->getId() == $v["id"]) {
                    $x = false;
                }
            }
            if ($x) array_push($newRooms, $value);

        }
        return $this->render("reservation_periode.html.twig", [
            "start" => $start_date,
            "end" => $end_date,
            "nb" => $nbOfPersons,
            "message" => $msg,
            "roomsOff" => $roomsOff,
            "roomsList" => $rooms,
            "roomsDispo" => $newRooms
        ]);
    }

    /**
     * @Route("/reservation/{id}/{d1}/{d2}", name="register_reservation", requirements={"id":"\d+"})
     * @param $id
     * @param $d1
     * @param $d2
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function registerReservation($id, $d1, $d2, Request $request)
    {
        $roomRepository = $this->getDoctrine()->getRepository("AppBundle:Room");

        $room = $roomRepository->find($id);
        $reservation = new Reservation();
        $reservation->setStartDate(DateTime::createFromFormat('Y-m-d', $d1))
            ->setEnddate(DateTime::createFromFormat('Y-m-d', $d2))
            ->setEmail("toto@email.fr")
            ->setRoom($room);

        $em = $this->getDoctrine()->getManager();
        $em->persist($reservation);
        $em->flush();
        return $this->redirectToRoute("homepage");
        /*

            // Création du formulaire
            $post = new Post();
            $post->setTheme($theme)
                ->setCreatedAt(new \DateTime())
                //->setAuthor($authorrepository->findOneByName("Hugo"))
                ->setAuthor($this->getUser());



            $form = $this->createForm(PostType::class, $post, [
                'attr' => ['novalidate' => 'novalidate']
            ]);
            // TRAITEMENT DU FORMULAIRE
            $form->handleRequest($request);

            //Sauvegarde et persistence

            if ($form->isSubmitted() && $form->isValid()) {
                dump($post->getImage());
                $em = $this->getDoctrine()->getManager();
                $em->persist($post);


                if ($post->getImage() instanceof UploadedFile) {
                    $uploadManager = $this->get('stof_doctrine_extensions.uploadable.manager');
                    $uploadManager->markEntityToUpload($post, $post->getImage());
                }
                $em->flush();
                //Redirection pour eviter de rester en post
                return $this->redirectToRoute('theme_details', ["id" => $id]);

            }

            $formView = $form->createView();
        } else {
            $formView = null;
        }
        return $this->render('default/theme.html.twig', [
            "theme" => $theme,
            "postList" => $theme->getPosts(),
            "all" => $allThemes,
            "newPostForm" => $formView
        ]);

    */
    }
}
