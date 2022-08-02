  <?php
  require_once("../../vendor/conexao.php");

  $data =  $_POST['data'];
  $texto =  $_POST['texto'];
  $nivel = $_POST["nivel"];

  $antigo =  $_POST['antigo'];
  $antigo2 =  $_POST['antigo2'];
  $id =  $_POST['txtid2'];

  if($data == ""){
    echo "Campo DATA obrigatório";
    exit();
  }
  if($texto == ""){
    echo "Campo TEXTO obrigatório";
    exit();
  }


  if($id == ""){


  $res = $pdo->prepare("INSERT INTO tarefas SET data = :data, texto = :texto, nivel = :nivel");

  }else{

    $res = $pdo->prepare("UPDATE tarefas SET data = :data, texto = :texto, nivel = :nivel WHERE id = $id");

  }
  $res->bindValue(":data", $data);
  $res->bindValue(":texto", $texto);
  $res->bindValue(":nivel", $nivel);


  $res->execute();

  echo 'Salvo com Sucesso!';

   ?>
