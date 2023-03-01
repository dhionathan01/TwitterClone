<? 
    namespace App\Models;

    use DHF\Model\Model;


class Usuario extends Model{
    private $id;
    private $nome;
    private $email;
    private $senha;

    public function __get($atributo){
        return $this->$atributo;
    }

    public function __set($atributo, $valor){
        $this->$atributo = $valor;
    }

    // Salvar
    public function salvar(){
        $sql = "INSERT INTO usuarios(
                    nome,
                    email,
                    senha)
                VALUES(
                    :nome,
                    :email,
                    :senha
                )";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':nome', $this->__get('nome'));
            $stmt->bindValue(':email', $this->__get('email'));
            $stmt->bindValue(':senha', $this->__get('senha')); // converter para md5() -> hash 32 caracteres
            $stmt->execute();

            return $this;
    }

    public function validarCadastro(){
        $valido = true;
        if(strlen($this->__get('nome') < 3)){
            $valido = false;
        }
        if(strlen($this->__get('email') < 3)){
            $valido = false;
        }
        if(strlen($this->__get('senha') < 3)){
            $valido = false;
        }
        return $valido;
    }

    public function getUsuarioPorEmail(){
        $sql = "SELECT 
                    nome,
                    email
                FROM
                    usuarios
                WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':email', $this->__get('email'));
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
?>