<?php

namespace App\Controller;

use ApiPlatform\Core\Hal\Serializer\ObjectNormalizer;
use ApiPlatform\Core\Serializer\JsonEncoder;
use App\Repository\PersonRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\XmlEncoder;

class PersonController extends AbstractController
{

    /**
     * @Route(
     *     name="find_name",
     *     path="api/people/{name}/findName",
     *     methods={"GET"}
     *   )
     */
    public function findNamePersons($name,PersonRepository $personRepository) {

        $persons = $personRepository->findByName($name);

        if (! $persons) {
            return new JsonResponse();
        }

        $functAnonymous = function ($item)
        {
            return [$item->getId(), $item->getNombre()];
        };
        $data = array_map($functAnonymous, $persons);

        return new JsonResponse([$data]);
    }
}
