<?php

namespace App\Controller\Admin;


use App\Entity\Property;
use App\Form\PropertyType;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminPropertyController extends AbstractController
{
    /**
     * @var PropertyRepository
     */
    private $repository;
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(PropertyRepository $repository, EntityManagerInterface $entityManager)
    {
        $this->repository = $repository;
        $this->em = $entityManager;
    }

    /**
     * @return Response
     * @Route("/", name="admin.property.index")
     */
    public function index()
    {
        $properties = $this->repository->findAll();               // compact — Crée un tableau à partir de variables et de leur valeur
        return $this->render('admin/property/index.html.twig', compact('properties'));
    }

    /**
     * @Route("/property/create", name="admin.new")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function new(Request $request)
    {
        $property = new Property();
        $form = $this->createForm(PropertyType::class, $property);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $this->em->persist($property);
                $this->em->flush();
                $this->addFlash('success', 'Nouveau bien enregistré');
                return $this->redirectToRoute('admin.property.index');
            }
        }
        return $this->render('admin/property/new.html.twig',
            [
                'property' => $property,
                'form' => $form->createView()
            ]);
    }

    /**
     * @Route("/property/{id}", name="admin.property.edit", methods="GET|POST")
     * @param Property $property
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function edit(Property $property, Request $request)
    {
        $form = $this->createForm(PropertyType::class, $property);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $this->em->flush();
                $this->addFlash('success', 'Modification réussie');
                return $this->redirectToRoute('admin.property.index');
            }
        }
        return $this->render('admin/property/edit.html.twig',
            [
                'property' => $property,
                'form' => $form->createView()
            ]);
    }

    /**
     * @param Property $property
     * @param Request $request
     * @Route("/property/{id}", name="admin.property.delete", methods="DELETE")
     * @return RedirectResponse
     */
    public function delete(Property $property, Request $request)
    {
        if ($this->isCsrfTokenValid('delete' . $property->getId(), $request->get('_token'))) {
            $this->em->remove($property);
            $this->em->flush();
            $this->addFlash('success', 'Bien supprimé');
        }
        return $this->redirectToRoute('admin.property.index');
    }
}