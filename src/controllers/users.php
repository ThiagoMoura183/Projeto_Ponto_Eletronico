<?php

session_start();
requireValidSession();


$exception = null;
if (isset($_GET['delete'])) {
    try {
        User::deleteById($_GET['delete']);
        addSuccessMsg('Usuário removido com sucesso!');
    } catch (Exception $e) {
        if(stripos($e->getMessage(),'FOREING KEY')) {
            addErrorMsg('Usuário não pode ser removido pois já existem apontamentos de ponto.');
        }
        $exception = $e;
    }
}

$users = User::get();
foreach ($users as $user) {
    $user->start_date = (new DateTime($user->start_date))->format('d/m/Y');
    if ($user->end_date) {
        $user->end_date = (new DateTime($user->end_date))->format('d/m/Y');
    }
}

loadTemplateView('users', [
    'users' => $users,
    'exception' => $exception 
]);
