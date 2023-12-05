<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\ProgramRepository;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController
{
    #[Route('/category/', name: 'category_index')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        $category = $categoryRepository->findAll();

        return $this->render('category/index.html.twig', [
            'category' => $category,
        ]);
    }

 /**
 * The controller for the category add form
 * Display the form or deal with it
 */
#[Route('/category/new', name: 'new')]
public function new(Request $request, EntityManagerInterface $entityManager) : Response
{
    $category = new Category();
    $form = $this->createForm(CategoryType::class, $category);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager->persist($category);
        $entityManager->flush();            

        $this->addFlash('success', 'The new category has been created');

        // Redirect to categories list
        return $this->redirectToRoute('category_index');
    }

    // Render the form
    return $this->render('category/new.html.twig', [
        'form' => $form,
    ]);
}

    #[Route('/category/{categoryId}', name: 'category_show')]
    public function show(string $categoryId, CategoryRepository $categoryRepository, ProgramRepository $programRepository): Response
    {
        $categories = $categoryRepository->findOneBy(['id' => $categoryId]);
        if (!$categories)
        {
            throw $this->createNotFoundException(
                'No program with id : found in program\'s table.'
            );
        }
        
        $programes = $programRepository->findBy(['category' => $categories->getId()], ['id' => 'DESC'], 3);
        if (!$programes)
        {
            throw $this->createNotFoundException(
                'No program with id : found in program\'s table.'
            );
        }

        return $this->render('category/show.html.twig', [
            'programs' => $programes,
            'category' => $categories,
        ]);
    }
}
