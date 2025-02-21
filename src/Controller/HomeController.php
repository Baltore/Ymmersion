<?php

namespace App\Controller;

use App\Repository\RecetteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Recette;
use App\Entity\User;
use App\Form\RecetteType;
use App\Repository\IngredientRepository;
use App\Entity\RecetteIngredient;



class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function home(RecetteRepository $recetteRepository): Response
    {
        $user = $this->getUser();
        
        if ($user instanceof User) {
            $recettes = $recetteRepository->findLikedRecettesWithIngredients($user);
        } else {
            $recettes = $recetteRepository->findMostLikedRecipes();
        }

        return $this->render('home.html.twig', [
            'user' => $user,
            'recettes' => $recettes ?? [],
        ]);
    }

    #[Route('/recette/{id}/like', name: 'recette_like', methods: ['POST'])]
    public function like(Recette $recette, EntityManagerInterface $entityManager): JsonResponse
    {
        $user = $this->getUser();

        if (!$user) {
            return new JsonResponse(['message' => 'Non autorisé'], Response::HTTP_UNAUTHORIZED);
        }

        if ($user->getLikedRecettes()->contains($recette)) {
            $user->removeLike($recette);
            $liked = false;
        } else {
            $user->addLike($recette);
            $liked = true;
        }

        $entityManager->persist($user);
        $entityManager->flush();

        return new JsonResponse(['liked' => $liked]);
    }


    #[Route('/mes-recettes', name: 'mes_recettes')]
    public function mesRecettes(RecetteRepository $recetteRepository): Response
    {
        $user = $this->getUser();

        if (!$user instanceof User) {
            return $this->redirectToRoute('app_login'); 
        }

        $recettes = $recetteRepository->findBy(['auteur' => $user]);

        return $this->render('recette/mes_recettes.html.twig', [
            'user' => $user,
            'recettes' => $recettes,
        ]);
    }

    #[Route('/mes-recettes/ajouter', name: 'ajouter_recette')]
    public function ajouterRecette(Request $request, EntityManagerInterface $entityManager, IngredientRepository $ingredientRepository): Response
    {
        $user = $this->getUser();

        if (!$user instanceof User) {
            return $this->redirectToRoute('app_login');
        }

        $recette = new Recette();
        $form = $this->createForm(RecetteType::class, $recette);
        $form->handleRequest($request);

        // Récupération des ingrédients depuis la base de données
        $ingredients = $ingredientRepository->findBy([], ['nom' => 'ASC']); // Trié par nom

        if ($form->isSubmitted() && $form->isValid()) {
            $recette->setAuteur($user);
            $entityManager->persist($recette);
            $entityManager->flush();

            // Gestion des ingrédients associés à la recette
            $ingredientIds = $request->request->get('ingredients', []);
            $quantites = $request->request->get('quantites', []);

            foreach ($ingredientIds as $key => $ingredientId) {
                $ingredient = $ingredientRepository->find($ingredientId);
                if ($ingredient) {
                    $recetteIngredient = new RecetteIngredient();
                    $recetteIngredient->setRecette($recette);
                    $recetteIngredient->setIngredient($ingredient);
                    $recetteIngredient->setQuantite($quantites[$key] ?? 1);
                    $entityManager->persist($recetteIngredient);
                }
            }

            $entityManager->flush();

            return $this->redirectToRoute('mes_recettes');
        }

        return $this->render('recette/ajouter_recette.html.twig', [
            'form' => $form->createView(),
            'ingredients' => $ingredients 
        ]);
        
    }


    #[Route('/recherche', name: 'recherche_recette')]
    public function rechercheRecette(Request $request, RecetteRepository $recetteRepository): Response
    {
        $query = $request->query->get('query'); 

        if (!$query) {
            return $this->redirectToRoute('home'); 
        }

        // Recherche des recettes correspondant au titre
        $recettes = $recetteRepository->createQueryBuilder('r')
            ->where('r.titre LIKE :query')
            ->setParameter('query', '%' . $query . '%')
            ->getQuery()
            ->getResult();

        return $this->render('recette/recherche.html.twig', [
            'query' => $query,
            'recettes' => $recettes
        ]);
    }

    #[Route('/recette/{id}', name: 'recette_detail')]
    public function detailRecette(Recette $recette): Response
    {
        return $this->render('recette/detail.html.twig', [
            'recette' => $recette
        ]);
    }

    #[Route('/filtrer', name: 'filtrer_recettes')]
    public function filtrer(Request $request, RecetteRepository $recetteRepository, IngredientRepository $ingredientRepository): Response
    {
        // Récupérer tous les ingrédients pour les afficher dans le formulaire de filtre
        $ingredients = $ingredientRepository->findAllSorted();

        // Récupérer les valeurs des filtres
        $tempsPreparation = $request->query->get('temps_preparation');
        $selectedIngredients = $request->query->all('ingredients');

        // Construire la requête pour filtrer les recettes
        $queryBuilder = $recetteRepository->createQueryBuilder('r');

        if ($tempsPreparation) {
            $queryBuilder->andWhere('r.tempsPreparation <= :temps')
                        ->setParameter('temps', $tempsPreparation);
        }

        if (!empty($selectedIngredients)) {
            $queryBuilder->join('r.ingredients', 'ri')
                        ->andWhere('ri.ingredient IN (:ingredients)')
                        ->setParameter('ingredients', $selectedIngredients);
        }

        $recettes = $queryBuilder->getQuery()->getResult();

        return $this->render('recette/filtrer.html.twig', [
            'recettes' => $recettes,
            'ingredients' => $ingredients, // Liste complète des ingrédients pour le filtre
            'tempsPreparation' => $tempsPreparation,
            'selectedIngredients' => $selectedIngredients,
        ]);
    }

    #[Route('/filtrer/resultats', name: 'resultats_filtrer')]
    public function resultatFiltrer(Request $request, RecetteRepository $recetteRepository): Response
    {
        $ingredientIds = $request->query->get('ingredients', []);
        $tempsPreparation = $request->query->get('temps_preparation');

        $queryBuilder = $recetteRepository->createQueryBuilder('r')
            ->leftJoin('r.ingredients', 'ri') // Jointure avec les ingrédients
            ->leftJoin('ri.ingredient', 'i') // Jointure avec l'entité des ingrédients
            ->addSelect('ri', 'i'); // Sélectionne aussi les ingrédients pour éviter les erreurs lazy loading

        if (!empty($ingredientIds)) {
            $queryBuilder->andWhere('i.id IN (:ingredients)')
                ->setParameter('ingredients', $ingredientIds);
        }

        if (!empty($tempsPreparation)) {
            $queryBuilder->andWhere('r.tempsPreparation <= :temps')
                ->setParameter('temps', $tempsPreparation);
        }

        $recettes = $queryBuilder->getQuery()->getResult();

        return $this->render('recette/resultats_filtrer.html.twig', [
            'recettes' => $recettes,
        ]);
    }



}
