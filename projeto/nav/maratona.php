<div class="modal fade" id="modal-cadastro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <form id="form" action="funcoes.php?event=salvarMaratona&view=maratona" method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Cadastro de Maratona</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    <div class="form-group">
                        <label for="nome">Nome da Maratona</label>
                        <input type="text" class="form-control" id="nome" name="nome">
                    </div>
                    <div class="form-group">
                        <label for="juiz">Juiz</label>
                        <input type="text" class="form-control" id="juiz" name="juiz">
                    </div>
                    <div class="form-group">
                        <label for="datainicio">Data Inicio</label>
                        <input type="datetime-local" class="form-control" id="datainicio" name="datainicio">
                    </div>
                    <div class="form-group">
                        <label for="datafim">Data Fim</label>
                        <input type="datetime-local" class="form-control" id="datafim" name="datafim">
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
            Maratonas
            <span class="pull-right">
              <a class="btn btn-success" href="#" onclick="add()" role="button" data-toggle="modal" data-target="#modal-cadastro">
                  Nova Maratona
              </a>
            </span>
        </h3>
        <p class="lead">Nesta página devem ser cadastradas as Maratona</p>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <table class="table table-bordered table-hover">
            <caption>Lista de Maratonas</caption>
            <thead>
            <tr>
                <th class="identificador">#</th>
                <th>Nome</th>
                <th>Juiz</th>
                <th>Data Inicio</th>
                <th>Data Fim</th>
                <th class="action">Editar</th>
                <th class="action">Excluir</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $maratona = listar("maratona");
            foreach ($maratona as $maratonas):
                ?>
                <tr>
                    <th class="identificador" scope="row">
                        <?=$maratonas->id?>
                        <input type="hidden" class="id" value="<?=$maratonas->id?>">
                    </th>
                    <td>
                        <?=$maratonas->nome?>
                        <input type="hidden" class="nome" value="<?=$maratonas->nome?>">
                    </td>
                    <td>
                        <?=$maratonas->juiz?>
                        <input type="hidden" class="juiz" value="<?=$maratonas->juiz?>">
                    </td>
                    <td>
                        <?=$maratonas->datainicio?>
                        <input type="hidden" class="datainicio" value="<?=$maratonas->datainicio?>">
                    </td>
                    <td>
                        <?=$maratonas->datafim?>
                        <input type="hidden" class="datafim" value="<?=$maratonas->datafim?>">
                    </td>
                    <td class="action">
                        <a href="" onclick="editar(this)" data-toggle="modal" data-target="#modal-cadastro">
                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                        </a>
                    </td>
                    <td class="action">
                        <a href="funcoes.php?event=excluirMaratona&id=<?=$maratonas->id?>&view=maratona">
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
        $('#juiz').val($(obj).closest('tr').find('.juiz').val());
        $('#datainicio').val($(obj).closest('tr').find('.datainicio').val());
        $('#datafim').val($(obj).closest('tr').find('.datafim').val());
    }

    var add = function(){
        $('#id').val('');
        $('#nome').val('');
        $('#juiz').val('');
        $('#datainicio').val('');
        $('#datafim').val('');
    }



</script>
