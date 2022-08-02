<?php
require_once("../../vendor/conexao.php");

$id =  $_POST['id'];


$query = $pdo->query("SELECT * FROM tarefas where id = '$id' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);

$pdo->query("DELETE FROM tarefas WHERE id = '$id'");
echo "Excluído com Sucesso!!";

 ?>
