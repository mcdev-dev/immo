<?php

namespace App\Controller;


use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/")
     * @param PropertyRepository $repository
     * @return Response
     */
    public function index(PropertyRepository $repository)
    {
        $properties = $repository->findLatest();
        return $this->render('home/index.html.twig',
            [
                'properties' => $properties,
            ]);
    }

//    /**
//     * @param Property $property
//     * @param string $slug
//     * @return Response
//     * @Route("/biens/{slug}-{id}", name="property.show", requirements={"slug": "[a-z0-9\-]*"})
//     */
//    public function show(Property $property, string $slug): Response
//    {
//        if ($property->getSlug() !== $slug) {
//            return $this->redirectToRoute('property.show',
//                [
//                    'id' => $property->getId(),
//                    'slug' => $property->getSlug()
//                ], 301
//            );
//        }
//
//        return $this->render('property/show.html.twig',
//            [
//                'property' => $property,
//                'current_menu' => 'properties'
//            ]);
//    }

}


