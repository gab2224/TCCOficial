<?php 

include('../conexao/conexao.php');

if(isset($_POST['email']) || isset($_POST['senha'])){
  if(strlen($_POST['email']) == 0){
    echo "Preencha seu email";
  } else if(strlen($_POST['senha']) == 0){
    echo "Preencha sua senha";
  } else{

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ? AND senha = ?");
    $stmt->execute([$email, $senha]);

    $quantidade = $stmt->rowCount();

    if($quantidade == 1){
      
      $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

      if(!isset($_SESSION)){
        session_start();
      }

      $_SESSION['id'] = $usuario['id'];
      $_SESSION['nome'] = $usuario['nome'];

      header("Location: painel.php");

    } else {
      echo "Falha ao logar: email ou senha incorretos";
    }
   
  }
}
?>