      <div class="modal fade" id="modal-cadastro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-sm" role="document">
          <div class="modal-content">
            <form id="form" action="funcoes.php?event=salvarAvaliacao&view=avaliacao" method="POST">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Avaliação</h4>
              </div>
              <div class="modal-body">
                  <div class="form-group">
                    <label for="equipe">Selecione a equipe</label>
                    <select name="equipe" id="equipe" class="form-control">
                      <?php
                      $equipes = listar("equipe");
                      foreach ($equipes as $equipe){
                         echo "<option value='{$equipe->id}'>{$equipe->nome}</option>";
                      }
                      ?>
                        
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="questao">Selecione o problema</label>
                    <select name="questao" id="questao" class="form-control">
                      <?php
                      $questoes = listar("questoes");
                      foreach ($questoes as $questao){
                         echo "<option value='{$questao->id}'>{$questao->titulo}</option>";
                      }
                      ?>
                        
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="avaliacao">Avaliação</label><br>
                    <label for="avaliacao"><input type="radio" name="avaliacao" value="A"> Solução certa</label>
                    <label for="avaliacao"><input type="radio"  name="avaliacao" value="E"> Solução errada</label>
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
            Submissões: 172.16.31.120/maratona
            <span class="pull-right">
              <a class="btn btn-success" href="#" onclick="add()" role="button" data-toggle="modal" data-target="#modal-cadastro">
                Avaliação
              </a>
            </span>
          </h3>
          <p class="lead">Nesta página devem ser avaliados as submissões, bem como acompanhado o resultado da maratona</p>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <table class="table table-bordered table-hover acompanhamento">
            <caption>Colocações</caption>
            <thead>
              <tr>
                <th class="identificador">#</th>
                <th>Equipe</th>
                <th class="quant">Submissões</th>
                <th class="quant">Acertos</th>
                <th class="quant">Pontuação</th>
              </tr>
            </thead>
            <tbody>
            <?php
            $equipes = listar("vresultado");
            foreach ($equipes as $equipe):
            ?>
              <tr>
                <th class="identificador" scope="row">
                  <?=$equipe->id?>
                </th>
                <td>
                  <?=$equipe->nome?>
                  <div style="position:relative">
                  <?php
                  $acertos = getAcertos($equipe->id);
                  foreach ($acertos as $acerto){
                      echo "<div class='baloes {$acerto->cor}'></div>";
                  }
                  ?>
                  </div>
                </td>
                <td class="quant">
                  <?=$equipe->submissoes?>
                </td>
                <td class="quant">
                  <?=$equipe->acertos?>
                </td>
                <td class="quant">
                  <?=$equipe->pontuacao?>
                </td>
              </tr>
            <?php
            endforeach;?>
            </tbody>
          </table>
        </div>
      </div>