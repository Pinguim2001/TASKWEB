<?php
require_once("../vendor/conexao.php");

$nome = $_POST['nome_usu'];
$cpf = $_POST['cpf_usu'];
$email = $_POST['email_usu'];
$senha = $_POST['senha_usu'];

$antigo = $_POST['antigo'];
$id = $_POST['txtid2'];

if($nome == ""){
	echo 'O nome é Obrigatório!';
	exit();
}

if($email == ""){
	echo 'O email é Obrigatório!';
	exit();
}

if($cpf == ""){
	echo 'O CPF é Obrigatório!';
	exit();
}


//VERIFICAR SE O REGISTRO JÁ EXISTE NO BANCO
if($antigo != $cpf){
	$query = $pdo->query("SELECT * FROM usuarios where cpf = '$cpf' ");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = @count($res);
	if($total_reg > 0){
		echo 'O CPF já está Cadastrado!';
		exit();
	}
}


$res2 = $pdo->prepare("UPDATE usuarios SET nome = :nome, cpf = :cpf, email = :email, senha = :senha WHERE id = '$id' AND
	 UPDATE ecommerce SET nome = :nome, cpf = :cpf, email = :email, senha = :senha WHERE cpf = $antigo");
$res2->bindValue(":nome", $nome);
$res2->bindValue(":cpf", $cpf);
$res2->bindValue(":email", $email);
$res2->bindValue(":senha", $senha);
$res2->execute();

echo 'Salvo com Sucesso!';

?>
