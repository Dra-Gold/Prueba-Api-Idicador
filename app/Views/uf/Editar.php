<?= $this->extend('template/template') ?>

<?= $this->section('content') ?>

    
<div class="container mt-5">
    
    <form  method="POST" action="<?= site_url('uf/update') ?>"  >
    <input type="hidden" name="UF_ID" id="id" value="<?php echo $uf['UF_ID']; ?>">
        <div class="form-row text-center">
            <div class="form-group col-12">
                <h3>Editar Inficador de  Uf</h3>
                <hr>
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group col-6">
                <label>Fecha</label>
               <input type="date"  class="form-control" name="UF_FECHA" value="<?php echo $uf['UF_FECHA']; ?>">
            </div>
            <div class="form-group col-6">
                <label>Valor</label>
               <input type="text"  class="form-control" name="UF_VALOR" value="<?php echo $uf['UF_VALOR']; ?>">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-12">
                <input type="submit" class="btn btn-secondary btn-lg btn-block" name="fileSubmit" value="Enviar Formulario" >
            </div>
        </div>


      </form>  
    </div>

<?= $this->endSection() ?>

    