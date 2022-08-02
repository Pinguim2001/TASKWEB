<?php
$pag = "tarefasecommerce";
require_once __DIR__ . '/../vendor/conexao.php';

@session_start();
//verificar se o usuário está autenticado
if(@$_SESSION['id_usuario'] == null || @$_SESSION['nivel_usuario'] != 'ecommerce'){
  echo "<script language='javascript'> window.location='../index.php' </script>";

}
?>
<div class="card shadow mb-2">

  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>

          <th>DATA</th>
          <th>TEXTO</th>
          <th>NÍVEL</th>
          <th>FINALIZADO</th>
        </tr>
      </thead>

      <tbody>

        <?php
        $query1 = $pdo->query("SELECT * FROM tarefas order by id desc");
        $query = $pdo->query("SELECT * FROM tarefas WHERE nivel = 'Ecommerce'");
        $res = $query->fetchAll(PDO::FETCH_ASSOC);

        for ($i=0; $i < count($res); $i++) {
          foreach ($res[$i] as $key => $value) {
          }

          $data = $res[$i]['data'];
          $texto = $res[$i]['texto'];
          $nivel = $res[$i]['nivel'];
          $id = $res[$i]['id'];


          ?>


          <tr>
            <td><?php echo $data ?></td>
            <td><?php echo $texto ?></td>
            <td><?php echo $nivel ?></td>


            <td>
              <a href="index.php?pag=<?php echo $pag ?>&funcao=concluido&id=<?php echo $id ?>" class='text-primary mr-1' title='Enviar'><i class="fas fa-paper-plane"></i></a>
            </td>
          </tr>

<?php } ?>


        </tbody>
      </table>
    </div>
  </div>
</div>

<div class="modal fade" id="modalDados" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <?php
              if (@$_GET['funcao'] == 'concluido') {
                  $titulo = "Enviar Registro";
                }
