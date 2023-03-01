<?php 

    namespace App\Controllers;

    // Recursos do Framework
    use DHF\Controller\Action;
    use DHF\Model\Container;

class IndexController extends Action{

            public function index() {
                $this->render('index');
            }

            public function inscreverse(){
                $this->render('inscreverse');
            }

            public function registrar(){
                exibirArray($_POST);

                foreach ($_POST as $key => $value) {
                    $$key = $value;
                }

                $usuario = Container::getModel('Usuario');

                $usuario->__set('nome', $nome);
                $usuario->__set('email', $email);
                $usuario->__set('senha', $senha);

                exibirArray($usuario);

                $usuario->salvar();
                //sucesso

                //erro
            }

        }
?>