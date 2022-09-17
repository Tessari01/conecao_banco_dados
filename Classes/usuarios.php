<?

class usuario
{
private $pdo;
public $msgErro=""; // vazio pq deu certo


    public function conectar($nome,$host,$usuario,$senha)
    {
        global $pdo;
        global $msgErro;
        try{
            $pdo =new PDO("mysql:dbname=".$nome.";host=".$host,$usuario,$senha);
        } catch (PDOException $e){
            $msg=$e->getMessage();
        }     

    }

    public function cadastrar($nome, $telefone, $email, $senha)
     {
        global $pdo;       
        //verificar se ja existe o email cadastrado
        $sql=$pdo->prepare("SELECT id_usuario FROM usuarios WHERE email=:e");
        $sql->bidValue(":e",$email);
        $sql->execute();
        if ($sql-> rowCount()>0)
        {
            return false; //ja esta cadastrada
        }
        else{
             //caso nao, cadastrar
             $sql=$pdo->prepare("INSERT INTO usuarios(nome,telefone, email,senha) VALUES (:n,:t,:e,:s)");
             $sql->bidValue(":n",$nome);
             $sql->bidValue(":t",$telefone);
             $sql->bidValue(":e",$email);
             $sql->bidValue(":s",md5($senha));
             $sql->execute();
             return true;// cadastrado com sucesso
        }
                
        //caso nao, cadastrar
    }

    public function logar( $email, $senha)
    {
        global $pdo;        
        // verificar se o email e senha estao cadastrado, se sim
        $sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email=:e AND senha = :s");
         $sql->bidValue(":e",$email);
         $sql->bidValue(":s",md5($senha));
         $sql->execute();
         if ($sql-> rowCount() >0){
            //entrar no sistema(sessao)
            $dado=$sql->apc_fetch();
            session_start();
            $_SESSION['id_usuario'] = $dado['id_usuario'];
            return true; // logado com sucesso
         }
         else {
            return false ;// login negado
         }   
    }
}


?>