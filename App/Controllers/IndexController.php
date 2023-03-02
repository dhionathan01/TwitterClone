<?

    namespace App\Controllers;

    // Recursos do Framework
    use DHF\Controller\Action;
    use DHF\Model\Container;

class IndexController extends Action{

            public function index() {
                $this->view->login = isset($_GET['login']) ? $_GET['login'] : '';
                $this->render('index');
            }

            public function inscreverse(){
                $this->view->usuario = array(
                    'nome' => '',
                    'email' => '',
                    'senha' => ''

                );
                $this->view->erroCadastro = false;
                $this->render('inscreverse');
            }

            public function registrar(){
                foreach ($_POST as $key => $value) {
                    $$key = $value;
                }

                $usuario = Container::getModel('Usuario');

                $usuario->__set('nome', $nome);
                $usuario->__set('email', $email);
                $usuario->__set('senha', md5($senha));

                if($usuario->validarCadastro() AND count($usuario->getUsuarioPorEmail()) == 0){
                        $usuario->salvar();
                        $this->render('cadastro');

                }else{
                    $this->view->usuario = array(
                        'nome' => $_POST['nome'],
                        'email' => $_POST['email'],
                        'senha' => $_POST['senha']

                    );

                    $this->view->erroCadastro = true;
                    $this->render('inscreverse');
                }

                //sucesso

                //erro
            }

        }
?>