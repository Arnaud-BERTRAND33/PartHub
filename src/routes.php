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
    'dashboard' => ['DashboardController', 'dashboard',],
    'party' => ['PartyController', 'party',],
    'shopping-list' => ['ListController', 'list',],
    'guests' => ['GuestsController', 'guests',],
    'budget' => ['BudgetController', 'budget',],
    'comments' => ['CommentsController', 'comments',],

];
