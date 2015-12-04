<div class="modal fade" id="modal-cadastro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <form id="form" action="funcoes.php?event=salvarDificuldade&view=dificuldades" method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Cadastro de dificuldades</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    <div class="form-group">
                        <label for="descricao">Descrição</label>
                        <input type="text" class="form-control" id="descricao" name="descricao">
                    </div>
                    <div class="form-group">
                        <label for="peso">Peso</label>
                        <input type="number" class="form-control" id="peso" name="peso">
                    </div>
                    <div class="form-group">
                        <label for="cor">Cor</label>
                        <select name="cor" id="cor" class="form-control">
                            <option value="green">verde</option>
                            <option value="yellow">amarelo</option>
                            <option value="red">vermelho</option>
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
            Dificuldades
            <span class="pull-right">
              <a class="btn btn-success" href="#" onclick="add()" role="button" data-toggle="modal" data-target="#modal-cadastro">
                  Nova dificuldade
              </a>
            </span>
        </h3>
        <p class="lead">Nesta página devem ser cadastradas as dificuldades</p>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <table class="table table-bordered table-hover">
            <caption>Lista de dificuldades</caption>
            <thead>
            <tr>
                <th class="identificador">#</th>
                <th>Descrição</th>
                <th>Peso</th>
                <th>Cor</th>
                <th class="action">Editar</th>
                <th class="action">Excluir</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $dificuldades = listar("dificuldade");
            foreach ($dificuldades as $dificuldade):
                if($dificuldade->cor == 'green'){
                    $soverte = 'green';
                }elseif($dificuldade->cor == 'yellow'){
                    $soverte = 'yellow';
                }else{
                    $soverte = 'red';
                }
                ?>
                <tr>
                    <th class="identificador" scope="row">
                        <?=$dificuldade->id?>
                        <input type="hidden" class="id" value="<?=$dificuldade->id?>">
                    </th>
                    <td>
                        <?=$dificuldade->descricao?>
                        <input type="hidden" class="descricao" value="<?=$dificuldade->descricao?>">
                    </td>
                    <td>
                        <?=$dificuldade->peso?>
                        <input type="hidden" class="peso" value="<?=$dificuldade->peso?>">
                    </td>
                    <td class="baloes <?=$soverte?>">
                        <?=$dificuldade->cor?>
                        <input type="hidden" class="cor" value="<?=$dificuldade->cor?>">
                    </td>
                    <td class="action">
                        <a href="#" onclick="editar(this)" data-toggle="modal" data-target="#modal-cadastro">
                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                        </a>
                    </td>
                    <td class="action">
                        <a href="funcoes.php?event=excluirDificuldade&id=<?=$dificuldade->id?>&view=dificuldades">
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
        $('#descricao').val($(obj).closest('tr').find('.descricao').val());
        $('#peso').val($(obj).closest('tr').find('.peso').val());
        $('#cor').val($(obj).closest('tr').find('.cor').val());
    }

    var add = function(){
        $('#id').val('');
        $('#descricao').val('');
        $('#peso').val('');
        $('#cor').val('');
    }



</script>
