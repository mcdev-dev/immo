<?php


namespace App\Controller;



use App\Entity\Property;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PropertyController extends AbstractController
{

    /**
     * @var PropertyRepository
     */
    private $repository;
//    /**
//     * @var EntityManager
//     */
//    private $entityManager;

    public function __construct(PropertyRepository $repository, EntityManagerInterface $entityManager)
    {
        $this->repository = $repository;
        $this->entityManager = $entityManager;
    }

    /**
     * @return Response
     * @Route("/biens", name="property.index")
     */
    public function index(): Response
    {
       // $property = $this->repository->findAllVisible();
//        $property[0]->setSold(true);
//        $this->entityManager->flush();
        return $this->render('property/index.html.twig',
            [
                'current_menu' => 'properties'
            ]
        );

//        $property = new Property();
//        $property
//            ->setTitle('Mon premier bien')
//            ->setPrice(200000)
//            ->setRooms(4)
//            ->setBedrooms(3)
//            ->setDescription("Une petite description")
//            ->setSurface(60)
//            ->setFloor(4)
//            ->setHeat(1)
//            ->setCity("Montpellier")
//            ->setAddress("15 boulevard gambetta")
//            ->setPostalCode(34000);
//        // Je peux utiliser EntityManager dans les parametres de la méthode plutot que d'utiliser  getDoctrine-> etc...
//       $em = $this->getDoctrine()->getManager();
//       $em->persist($property);
//       $em->flush();

    }
    /**
     * @param Property $property
     * @param string $slug
     * @return Response
     * @Route("/biens/{slug}-{id}", name="property.show", requirements={"slug": "[a-z0-9\-]*"})
     */
    public function show(Property $property, string $slug): Response
    {
        if ($property->getSlug() !== $slug) {
            return $this->redirectToRoute('property.show',
                [
                    'id' => $property->getId(),
                    'slug' => $property->getSlug()
                ], 301
            );
        }

        return $this->render('property/show.html.twig',
            [
                'property' => $property,
                'current_menu' => 'properties'
            ]);
    }
}