<?php

// Get user
use models\User;

$app->get('/users', function () use ($app) {
	$model = new User ();
	$users = $model->getUsers();
    $app->render('users.html', array('users' => $users));
});

//Create user
$app->post('/users', function () use ($app) {
	//var_dump($app->request()->post('data'));
	$user = $app->request()->post();
	$model = new User ();
	$model->insertUser($user);

	$app->redirect('/users');
});

// LOGIN GET user by email and passwordS
$app->post('/login', function () use ($app) {
	//var_dump($app->request()->post('data'));
	$data = json_decode($app->request()->post('data'), true);
	
	//echo $data['password'];
	$email = $data['email'];
	$pass = hash("sha1", $data['password']);
	//echo "  despues: ".$pass. "   ";

	$oUser = new User();
	
	echo json_encode($oUser->getUserByLogin($email, $pass), true);
});

// PUT route
$app->put('/user', function () {
	echo 'This is a PUT route';
});

// DELETE route
$app->delete('/user', function () {
    echo 'This is a DELETE route';
});