<? 

    namespace App\Controllers;

    // Recursos do Framework
    use DHF\Controller\Action;
    use DHF\Model\Container;

    class AuthController extends Action{
        public function autenticar(){
            $usuario = Container::getModel('Usuario');
            $usuario->__set('email', $_POST['email']);
            $usuario->__set('senha', $_POST['senha']);

            $usuario->autenticar();
            if(!empty($usuario->__get('id')) AND !empty($usuario->__get('nome'))){
                echo "Autenticado";

                session_start();
                $_SESSION['id'] = $usuario->__get('id');
                $_SESSION['nome'] = $usuario->__get('nome');

                header('Location: /timeline');
            }else{
                header('Location: /?login=erro');
            }
        }
    }
?>