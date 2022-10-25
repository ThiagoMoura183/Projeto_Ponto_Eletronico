<?php

require_once(dirname(__FILE__, 2) . '/src/config/config.php');
require_once(dirname(__FILE__, 2) . '/src/models/User.php');

$user = new User(['name' => 'Thiago', 'email' => 'thiago@teste.com']);

print_r(User::get(['name' => 'Chaves'], 'id, name, email'));
echo '<br>';

print_r(User::get([], 'id, name'));
echo '<br>';

foreach (User::get([], 'id, name') as $user) {
    echo $user->name;
    echo '<br>';
}
