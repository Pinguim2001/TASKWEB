<?php
require_once("vendor/conexao.php");
@session_start();

$email = $_POST['email'];
$senha = $_POST['senha'];

$query = $pdo->prepare("SELECT * FROM usuarios where email = :email and senha = :senha ");

$query->bindValue(":senha", $senha);
$query->bindValue(":email", $email);
$query->execute();

$res = $query->fetchAll(PDO::FETCH_ASSOC);

$total_reg = @count($res);
if($total_reg > 0){

  $_SESSION['id_usuario'] = $res[0]['id'];
  $_SESSION['nome_usuario'] = $res[0]['nome'];
  $_SESSION['cpf_usuario'] = $res[0]['cpf'];
  $_SESSION['nivel_usuario'] = $res[0]['nivel'];

  $nivel = $res[0]['nivel'];

  if ($nivel == 'admin') {
    echo "<script language='javascript'> window.location='painel_adm' </script>";
  }
  if ($nivel == 'marketing') {
    echo "<script language='javascript'> window.location='painel_marketing' </script>";
  }
  if ($nivel == 'financeiro') {
    echo "<script language='javascript'> window.location='painel_financeiro' </script>";
  }
  if ($nivel == 'ecommerce') {
    echo "<script language='javascript'> window.location='painel_ecommerce' </script>";
  }

}else {
echo "<script language='javascript'>
window.alert('USUÁRIO OU SENHA INCORRETOS, VERIFIQUE E TENTE NOVAMENTE ')
</script>";
echo "<script language='javascript'>
 window.location='index.php'
 </script>";

}

 ?>
