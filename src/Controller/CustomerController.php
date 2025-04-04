<?php
namespace App\Controller;

use App\Repository\CustomerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class CustomerController extends AbstractController
{
    private $customerRepository;

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    //Affichage du template de base avec les 1000 premières entrée de la BDD formatées en tableau
    #[Route('/', name: 'Liste des clients')]
    public function index()
    {
        $customers = $this->customerRepository->findAllCustomers();
        return $this->render('base.html.twig',[
            'csvData' => $customers,
        ]);
    }
}
?>