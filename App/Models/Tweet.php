<? 
    namespace App\Models;

    use DHF\Model\Model;


class Tweet extends Model{
    private $id;
    private $id_usuario;
    private $tweet;
    private $data;

    public function __get($atributo){
        return $this->$atributo;
    }

    public function __set($atributo, $valor){
        $this->$atributo = $valor;
    }

    public function salvar(){
        $sql = "INSERT INTO 
                    tweets
                    (
                        id_usuario,
                        tweet
                    )values
                    (
                        :id_usuario,
                        :tweet
                        )";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
        $stmt->bindValue(':tweet', $this->__get('tweet'));
        $stmt->execute();


    }

    // recuperar


}

?>