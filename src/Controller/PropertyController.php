<?php
namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PropertyController extends AbstractController {

    /**
     * @var PropertyRepository
     */

    /**
     * @var EntityManager
     */

    private $repository;
    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(PropertyRepository $repository, ObjectManager $em){
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route ("/biens", name="property.index")
     * @return Response
     */
    public function index () : Response {
        return $this->render('property/index.html.twig', ['current_menu' => 'properties']);
    }

    /**
     * @Route ("/biens/{slug}-{id}", name="property.show")
     * @param Property $property
     * @param $id
     * @return Response
     */

    public function show(Property $property, string $slug): Response{
        if($property->getSlug() !== $slug){
            return $this->redirectToRoute('property.show', ['id' => $property->getId(), 'slug' => $property->getSlug(), 301]);
        }
        return $this->render('property/show.html.twig', ['property' => $property, 'current_menu' => 'properties']);

    }
}