<?php
//--------- Mesmas coisas ---------//
// require_once(realpath(MODEL_PATH . '/User.php'));
loadModel('User');
//---------------------------------//

class Login extends Model {

    public function checkLogin() {
        $user = User::getOne(['email' => $this->email]);
        if ($user) {
            if ($user->end_date) {
                throw new AppException('Usuário está desativado da empresa.');
            }
            if (password_verify($this->password, $user->password)) {
                return $user;
            }
        }
        throw new AppException('Usuário/Senha inválido');
    }

}