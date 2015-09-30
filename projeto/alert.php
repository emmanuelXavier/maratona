    <?php
    if ($_GET["id"] == 202):?>
      <div class='alert alert-success alert-dismissible' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
          <span class="glyphicon glyphicon-" aria-hidden="true"></span> Operação realizada com sucesso.
      </div>
    <?php
    endif;

    if ($_GET["id"] == 404):?>
      <div class='alert alert-danger alert-dismissible' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
          <span class="glyphicon glyphicon-" aria-hidden="true"></span> Falha ao realizar essa operação.
      </div>
    <?php
    endif;?>