<?php

namespace App\Controller;

use App\Error\LoginRequiredException;
use App\Model\CommentsManager;
use App\Model\FoodManager;
use App\Model\AlcoolManager;

class ShoppingListController extends AbstractController
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->user) {
            throw new LoginRequiredException();
        }
    }


    public function shoppingList(int $partyId)

    {
        $shoppingManager = new FoodManager();
        $foods = $shoppingManager->getFoods($partyId);

        $shoppingManager = new AlcoolManager();
        $alcools = $shoppingManager->getAlcools($partyId);

        $error = array();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['food'])) {
                if (!isset($_POST['food']) || $_POST['food'] === '') {
                    $error['food'] = 'Veuillez renseigner un aliment';
                }

                if (!$error) {
                    $food = array_map('trim', $_POST);

                    $food['party_id'] = $_GET['party_id'];
                    $food['user_id'] = $this->user['id'];
                    $food['item'] = $_POST['food'];

                    $shoppingManager = new FoodManager();
                    $shoppingManager->insertFood($food);
                    header('Location: /party/shopping-list?party_id=' . $partyId);
                    return '';
                }
            }
            if (isset($_POST['alcool'])) {
            }

            if (isset($_POST['alcool'])) {
                if (!isset($_POST['alcool']) || $_POST['alcool'] === '') {
                    $error['food'] = 'Veuillez renseigner un alcool';
                }

                if (!$error) {
                    $alcool = array_map('trim', $_POST);

                    $alcool['party_id'] = $_GET['party_id'];
                    $alcool['user_id'] = $this->user['id'];
                    $alcool['item'] = $_POST['alcool'];

                    $shoppingManager = new AlcoolManager();
                    $shoppingManager->insertAlcool($alcool);
                    header('Location: /party/shopping-list?party_id=' . $partyId);
                    return '';
                }
            }
        }

        return $this->twig->render('List/list.html.twig', [
            //'error' => $error,
            'foods' => $foods,
            'alcools' => $alcools,
        ]);
    }
}
