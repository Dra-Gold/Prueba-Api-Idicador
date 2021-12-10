<?= $this->extend('template/template') ?>

<?= $this->section('content') ?>


    <div class="container mt-5">
    <div class="form-row">
        <div class="form-group col-12 text-center">
            <h5>Indicador Historico de Uf</h5>
        </div>
    </div>
    <div>
        <div class="form-row text-center">
            <div class="form-group col-12 text-left">
                <button id="crear" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary"  >Crear Inficador de  Uf</button>
                <hr>
            </div>
        </div>


        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Crear UF</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-6">
                            <label>Fecha</label>
                        <input type="date" id="FECHA" class="form-control" name="UF_FECHA">
                        </div>
                        <div class="form-group col-6">
                            <label>Valor</label>
                        <input type="text" id="VALOR"  class="form-control" name="UF_VALOR">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-12">
                            <button id="CrearFor" type="submit" class="btn btn-secondary btn-lg btn-block" >Enviar Formulario</button>
                        </div>
                    </div>
                </div>
               
                </div>
            </div>
        </div>


        <div class="modal fade" id="editarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar UF</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-6">
                            <label>Fecha</label>
                            <input type="hidden"  id="ID_UF" >
                        <input type="date" id="FECHA_UF" class="form-control" name="UF_FECHA_EDITAR">
                        </div>
                        <div class="form-group col-6">
                            <label>Valor</label>
                        <input type="text" id="VALOR_UF"  class="form-control" name="UF_VALOR_EDITAR">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-12">
                            <button id="EditarFor" type="submit" class="btn btn-secondary btn-lg btn-block" >Enviar Formulario</button>
                        </div>
                    </div>
                </div>
               
                </div>
            </div>
        </div>












    </div>


    <div class="table-responsive">
        <table class="table table-hover" id="tablaUf">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Fecha</th>
                    <th>Valor</th>
                    <th class="text-right">Eliminar</th>
                    <th>Editar</th>
                </tr>
            </thead>
            <tbody>
            </tbody>   
        </table>
    </div>
  </div>


  <script
  src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


<script>


        
    $(document).ready(function() {

        
        index();
        
        function eliminar()
        {
            var valor=$(this).val();
            console.log(valor);

            var post_url = "<?php echo site_url('uf/delete/')?>"+valor;
            $.ajax({
                type: "POST",
                dataType: "json",
                url: post_url,
                success: function(Datos) {
                    index();

                }
            });

       
        }

        function editar()
        {
            var valor=$(this).val();
            console.log(valor);
            $('#editarModal').modal('show');

            var post_url = "<?php echo site_url('uf/editarUf/')?>"+valor;
                $.ajax({
                type: "GET",
                dataType: "json",
                url: post_url,
                success: function(Datos) {
                   $("#ID_UF").val(Datos.status.UF_ID);
                   $("#FECHA_UF").val(Datos.status.UF_FECHA);
                   $("#VALOR_UF").val(Datos.status.UF_VALOR);
                }
            });

           
        }

        function editarFo()
        {
            
            var id = $("#ID_UF").val();
            var fecha = $("#FECHA_UF").val();
            var valor = $("#VALOR_UF").val();
            
            var post_url = "<?php echo site_url('uf/update/')?>";
                $.ajax({
                type: "POST",
                dataType: "json",
                url: post_url,
                data: { UF_ID: id,UF_FECHA: fecha, UF_VALOR: valor},
                success: function(Datos) {
                    $('#editarModal').modal('hide');
                   index();

                }
            });
        }

        function crear()
        {
            var fecha=$("#FECHA").val();
            var valor=$("#VALOR").val();
           
            if(!!fecha && !!valor)
            {
               

                var post_url = "<?php echo site_url('uf/store/')?>";
                $.ajax({
                type: "POST",
                dataType: "json",
                url: post_url,
                data: { UF_FECHA: fecha, UF_VALOR: valor},
                success: function(Datos) {
                    $('#exampleModal').modal('hide');
                   index();

                }
            });





            }else{
                alert("Los Valores No Pueden Estar Vacios");
            }
        }

        function index()
        {
            var post_url = "<?php echo site_url('uf/ufTodo/')?>";
                $.ajax({
                type: "GET",
                dataType: "json",
                url: post_url,
                success: function(Datos) {
                    
                    if(Datos){
                        removeTable();
                        for(var i=0; i < Datos.status.length ;i++)
                    {
                        $('#tablaUf').append('<tr> <th scope="row">'+Datos.status[i].UF_ID+'</th> <td>'+
                        '<td>'+Datos.status[i].UF_FECHA+'</td><td>'+Datos.status[i].UF_VALOR+'</td>'+
                        '<td class="text-right"> <button id="eliminar'+Datos.status[i].UF_ID+'" class="btn btn-danger" value="'+Datos.status[i].UF_ID+'" >Delete</button>'+
                        '</td><td> <button id="editar'+Datos.status[i].UF_ID+'" class="btn btn-info" value="'+Datos.status[i].UF_ID+'"  >Editar</button></td>'+
                        '</tr>');
                    var elimi = document.getElementById("eliminar"+Datos.status[i].UF_ID);
                    if(elimi)
                    {
                        document.getElementById("eliminar"+Datos.status[i].UF_ID).addEventListener("click", eliminar, false);
                    }
                    
                    var edit = document.getElementById("editar"+Datos.status[i].UF_ID);
                    if(edit)
                    {
                        document.getElementById("editar"+Datos.status[i].UF_ID).addEventListener("click", editar, false);
                    }
                    var crea = document.getElementById("CrearFor");
                    if(crea)
                    {
                        document.getElementById("CrearFor").addEventListener("click", crear, false);
                    }

                    var edifor = document.getElementById("EditarFor");
                    if(edifor)
                    {
                        document.getElementById("EditarFor").addEventListener("click", editarFo, false);
                    }
                    }
                    
                    

                    }else{
                        $('#tablaUf').append('<tr><td class="h3 text-center font-italic" colspan="5">No Hay Indicadores UF Por Mostrar</td></tr>');
                    }
                    
                    
                }});
        }

        function removeTable()
        {
            $("#tablaUf").find("tr:not(:first)").remove();
        }

});


</script>


  <?= $this->endSection() ?>

  
    