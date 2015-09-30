      <div class="modal fade" id="modal-cadastro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-sm" role="document">
          <div class="modal-content">
            <form id="form" action="funcoes.php?event=salvarMembro&view=membros" method="POST">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Cadastro de membros</h4>
              </div>
              <div class="modal-body">
                  <input type="hidden" id="id" name="id">
                  <div class="form-group">
                    <label for="nome">Nome do membros</label>
                    <input type="text" class="form-control" id="nome" name="nome">
                  </div>
                  <div class="form-group">
                    <label for="tecnico">Selecione a equipe</label>
                    <select name="equipe" id="equipe" class="form-control">
                      <?php
                      $equipes = listar("equipe");
                      foreach ($equipes as $equipe){
                         echo "<option value='{$equipe->id}'>{$equipe->nome}</option>";
                      }
                      ?>
                        
                    </select>
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default " data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary ">Salvar</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-xs-12">
          <h3 class="page-header">
            Membros
            <span class="pull-right">
              <a class="btn btn-success" href="#" onclick="add()" role="button" data-toggle="modal" data-target="#modal-cadastro">
                Novo membro
              </a>
            </span>
          </h3>
          <p class="lead">Nesta página devem ser cadastradas os membros das equipes da maratona</p>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <table class="table table-bordered table-hover">
            <caption>Lista de membros</caption>
            <thead>
              <tr>
                <th class="identificador">#</th>
                <th>Nome</th>
                <th>Equipe</th>
                <th class="action">Editar</th>
                <th class="action">Excluir</th>
              </tr>
            </thead>
            <tbody>
            <?php
            $membros = listar("membros");
            foreach ($membros as $membro):
            ?>
              <tr>
                <th class="identificador" scope="row">
                  <?=$membro->id?>
                  <input type="hidden" class="id" value="<?=$membro->id?>">
                </th>
                <td>
                  <?=$membro->nome?>
                  <input type="hidden" class="nome" value="<?=$membro->nome?>">
                </td>
                <td>
                  <?php
                  $equipe = getRegistro("equipe",$membro->equipe);
                  echo $equipe->nome;?>
                  <input type="hidden" class="equipe" value="<?=$membro->equipe?>">
                </td>
                <td class="action">
                  <a href="#" onclick="editar(this)" data-toggle="modal" data-target="#modal-cadastro">
                    <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                  </a>
                </td>
                <td class="action">
                  <a href="funcoes.php?event=excluirMembro&id=<?=$membro->id?>&view=membros">
                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                  </a>
                </td>
              </tr>
            <?php
            endforeach;?>
            </tbody>
          </table>
        </div>
      </div>
      <script>

        var editar = function(obj){
          $('#id').val($(obj).closest('tr').find('.id').val());
          $('#nome').val($(obj).closest('tr').find('.nome').val()); 
          $('#equipe').val($(obj).closest('tr').find('.equipe').val());
        }

        var add = function(){
          $('#id').val('');
          $('#nome').val(''); 
          $('#equipe').val('');
      }



      </script>
      