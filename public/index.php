<?php

require_once(dirname(__FILE__, 2) . '/src/config/config.php');
// require_once(dirname(__FILE__, 2) . '/src/models/User.php');

//--------- Mesmas coisas ---------//
// require_once(dirname(__FILE__, 2) . '/src/views/login.php'); // O '2' serve para acessar a 2º pasta superior sobre o arquivo que estamos.
require_once(CONTROLLER_PATH . '/login.php');
//---------------------------------//

//--------- Teste para saber se o login está sendo validado ---------//
// require_once(MODEL_PATH . '/Login.php');

// $login = new Login(['email' => 'admin@cod3r.com.br', 'password' => 'a']);

// try {
//     $login->checkLogin();
//     echo "Usuário logado com sucesso";
// } catch (Exception $e) {
//     echo "Problema no Login!";
// }
//-------------------------------------------------------------------//