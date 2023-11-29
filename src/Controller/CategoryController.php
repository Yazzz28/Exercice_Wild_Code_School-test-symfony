<?php

namespace App\Controller;

use App\Repository\ProgramRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoryRepository;

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

    #[Route('/category/{categoryName}', name: 'category_show')]
    public function show(string $categoryName, CategoryRepository $categoryRepository, ProgramRepository $programRepository): Response
    {
        $categories = $categoryRepository->findOneBy(['name' => $categoryName]);
        if (!$categories)
        {
            throw $this->createNotFoundException(
                'No program with id : found in program\'s table.'
            );
        }
        
        $programes = $programRepository->findBy(['category' => $categories->getId()], ['id' => 'DESC'], 3);


        return $this->render('category/show.html.twig', [
            'programs' => $programes,
            'category' => $categories,
        ]);
    }
}
