<?php

// list of accessible routes of your application, add every new route here
// key : route to match
// values : 1. controller name
//          2. method name
//          3. (optional) array of query string keys to send as parameter to the method
// e.g route '/item/edit?id=1' will execute $itemController->edit(1)
return [
    '' => ['HomeController', 'index',],
    'login' => ['ConnexionController', 'login',],
    'login/inscription' => ['ConnexionController', 'inscription',],
    'contact' => ['HomeController', 'contact',],
    'thanks' => ['HomeController', 'thanks',],
    'dashboard' => ['DashboardController', 'dashboard',],
    'party/dashboard' => ['PartyDashboardController', 'dashboard', ['party_id']],
    'party/view' => ['PartyViewController', 'view', ['party_id']],
    'party/shopping-list' => ['ShoppingListController', 'list', ['party_id']],
    'party/guests' => ['GuestsController', 'guests', ['party_id']],
    'party/budget' => ['BudgetController', 'budget', ['party_id']],
    'party/comments' => ['CommentsController', 'comments', ['party_id']],

];
