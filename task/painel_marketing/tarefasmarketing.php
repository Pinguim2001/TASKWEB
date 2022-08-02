<?php
$pag = "tarefasmarketing";
require_once __DIR__ . '/../vendor/conexao.php';

@session_start();
//verificar se o usuário está autenticado
if(@$_SESSION['id_usuario'] == null || @$_SESSION['nivel_usuario'] != 'marketing'){
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
        $query = $pdo->query("SELECT * FROM tarefas WHERE nivel = 'Marketing'");
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
                ?>
                <h5 class="modal-title" id="exampleModalLabel"><?php echo $titulo ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form id="form" method="POST">
                <div class="modal-body">

                  <div class="form-group">
                    <label >DATA</label>
                    <input value="<?php echo @$data ?>" type="date" class="form-control" id="data" name="data" placeholder="DATA">
                  </div>

                  <div class="row">
                    <div class="col-md-6">

                      <div class="form-group">
                        <label >TEXTO</label>
                        <input value="<?php echo @$texto ?>" type="text" class="form-control" id="texto" name="texto" placeholder="TEXTO">

                      </div>

                      <div class="form-group">
                        <label >NÍVEL</label>
                        <select value="<?php echo @$nivel ?>" class="form-control" id="nivel" name="nivel" placeholder="NÍVEL">
                          <option value="Marketing">MARKETING</option>
                          <option value="Ecommerce">E-COMMERCE</option>
                          <option value="Financeiro">FINANCEIRO</option>
                        </select>
                      </div>

                      <small>
                        <div id="mensagem">

                        </div>
                      </small>

                    </div>

                      <button type="button" id="btn-fechar" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                      <button type="submit" name="btn-salvar" id="btn-salvar" class="btn btn-primary">Salvar</button>

                  </form>
                </div>
              </div>
            </div>


            <?php
            if (@$_GET["funcao"] != null && @$_GET["funcao"] == "editar") {
              echo "<script>$('#modalDados').modal('show');</script>";
            }

             ?>

               <!--AJAX PARA INSERÇÃO E EDIÇÃO DOS DADOS COM IMAGEM -->
             <script type="text/javascript">
             $("#form").submit(function () {
               var pag = "<?=$pag?>";
               event.preventDefault();
               var formData = new FormData(this);

               $.AJAX({
                 url:  pag + "/relatorios.php",
                 type: 'POST',
                 data: formData,

                 success: function (mensagem) {

                   $('#mensagem').removeClass()

                   if (mensagem.trim() == "Salvo com Sucesso!") {
                     //caso de cadastro múltiplo tirar as duas linhas abaixo!!!!!
                     window.location = "index.php?pag="+pag;

                   } else {

                     $('#mensagem').addClass('text-danger')
                   }

                   $('#mensagem').text(mensagem)

                 },

                 cache: false,
                 contentType: false,
                 processData: false,
                 xhr: function () {  // Custom XMLHttpRequest
                   var myXhr = $.ajaxSettings.xhr();
                   if (myXhr.upload) { // Avalia se tem suporte a propriedade upload
                     myXhr.upload.addEventListener('progress', function () {
                       /* faz alguma coisa durante o progresso do upload */
                     }, false);
                   }
                   return myXhr;
                 }
               });
             });
             </script>



               })
               </script>
