      <div class="modal fade" id="modal-cadastro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-sm" role="document">
          <div class="modal-content">
            <form id="form" action="funcoes.php?event=salvarEquipe&view=equipes" method="POST">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Cadastro de equipes</h4>
              </div>
              <div class="modal-body">
                  <input type="hidden" id="id" name="id">
                  <div class="form-group">
                    <label for="nome">Nome da equipe</label>
                    <input type="text" class="form-control" id="nome" name="nome">
                  </div>
                  <div class="form-group">
                    <label for="tecnico">Técnico da equipe</label>
                    <input type="text" class="form-control" id="tecnico" name="tecnico">
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
            Equipes
            <span class="pull-right">
              <a class="btn btn-success" href="#" onclick="add()" role="button" data-toggle="modal" data-target="#modal-cadastro">
                Nova equipe
              </a>
            </span>
          </h3>
          <p class="lead">Nesta página devem ser cadastradas as equipes que irão participar da Maratona</p>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <table class="table table-bordered table-hover">
            <caption>Lista de equipes</caption>
            <thead>
              <tr>
                <th class="identificador">#</th>
                <th>Nome</th>
                <th>Técnico</th>
                <th class="action">Editar</th>
                <th class="action">Excluir</th>
              </tr>
            </thead>
            <tbody>
            <?php
            $equipes = listar("equipe");
            foreach ($equipes as $equipe):
            ?>
              <tr data-codigo="<?=$equipe->id?>" data-nome="<?=$equipe->nome?>" data-tecnico="<?=$equipe->tecnico?>">
                <th class="identificador" scope="row">
                  <?=$equipe->id?>
                </th>
                <td>
                  <?=$equipe->nome?>
                </td>
                <td>
                  <?=$equipe->tecnico?>
                </td>
                <td class="action">
                  <a href="#" onclick="editar(this)" data-toggle="modal" data-target="#modal-cadastro">
                    <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                  </a>
                </td>
                <td class="action">
                  <a href="funcoes.php?event=excluirEquipe&id=<?=$equipe->id?>&view=equipes">
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
          $('#id').val($(obj).closest('tr').data("codigo"));
          $('#nome').val($(obj).closest('tr').data("nome")); 
          $('#tecnico').val($(obj).closest('tr').data("tecnico"));
        }

        var add = function(){
          $('#id').val('');
          $('#nome').val(''); 
          $('#tecnico').val('');
      }



      </script>
      