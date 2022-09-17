<?
require_once('Classes/usuarios.php');
$u= new usuario;

//-------------acesso ao banco-----
$nome1 ="projeto_login";
$host1 = "localhost";
$usuario1 = "root";
$senha1 = "";


echo $nome1;

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projeto login</title>
    <link rel="stylesheet" type="text/css" href="CSS/estilo.css">
</head>
<body id="corpo-form">
    <div>
        <h1>Cadastrar</h1>
        <form method="POST">
                <input type="text" name=" nome" placeholder="Nome Completo" maxlength="30">
                <input type="text"  name=" telefone"  placeholder="Telefone" maxlength="30">
                <input type="email"  name=" email"  placeholder="usuario" maxlength="40">
                <input type="password"  name=" senha"   placeholder="senha" maxlength="15">
                <input type="password"  name=" confsenha"  placeholder="Confirmar senha" maxlength="15">
                <input type="submit" placeholder="cadastrar" value="Cadastrar">              
        </form>
    </div>
<?php
   // verificar se clicou no botao
  
  if (isset($_POST['nome']))
     {
        $nome = addslashes($_POST['nome']);
        $telefone = addslashes($_POST['telefone']);
        $email= addslashes($_POST['email']);
        $senha= addslashes($_POST['senha']);
        $confsenha= addslashes($_POST['confsenha']);

       
            // veridificar se esta preenchido
        if (!empty($nome) && !empty($telefone) && !empty($email) && !empty($senha) && !empty($confsenha))
        {   
            $u->conectar("projeto_login","localhost","root","");
            if($u->$msgErro=="")//se esta tudo OK
                {
                        if($senha==$confsenha)
                        {
                        if($u->cadastrar($nome,$telefone,$email,$senha)){
                            echo "Cadastrado com sucesso! Acesse para entrar!";
                        }else{
                            echo "Email já cadastrado!";
                        }
                        }else{
                        echo "Senha e Confirmar senha nao corresponde";
                        }                   
                }else{
                    echo "Erro: ".$u->$msgErro;
                }
        }else{
            echo"Preenha todos os campos";
        }
     
     }   
   

?>

</body>
</html>