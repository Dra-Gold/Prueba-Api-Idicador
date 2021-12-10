
<?= $this->extend('template/template') ?>

<?= $this->section('content') ?>

<div class="container">
    <select id="valor" name="select" class="form-select">
		<option value="value1">Elija una Opcion</option>
	</select>
</div>

	<br><br><br><br>
	<div id="columnchart_material" style="width: 800px; height: 500px;"></div>

<script
  src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>

$(document).ready(function() {

obtener();
});

// obtiene los paramatros de api para llenar el select
function obtener()
{
	var post_url = "https://mindicador.cl/api";

$.ajax({
    type: "GET",
    dataType: "json",
    url: post_url,
    success: function(Datos) {

        //console.log(Datos);
		var select = document.getElementById("valor");
         var NombrePropiedades = Object.getOwnPropertyNames(Datos);

		 //console.log(NombrePropiedades);

		for(var i = 3; i< NombrePropiedades.length; i++ )
		{
			$('#valor').append("<option value="+NombrePropiedades[i]+">"+NombrePropiedades[i]+"</option>")
			
			//console.log(NombrePropiedades[i]);
		}
		 
    }
});


}

$("#valor").change(function(){



var valor=$(this).val();
var arrayDatos= [];
var post_url = "https://mindicador.cl/api/"+valor;

$.ajax({
    type: "GET",
    dataType: "json",
    url: post_url,
    success: function(Datos) {

	 arrayDatos=[['Fecha', Datos.codigo]];
	 for(var i=0; i< Datos.serie.length;i++ )
	 {
    var date= new Date(Datos.serie[i].fecha);
    var datePaarse= date.getFullYear()+'-' + (date.getMonth()+1) + '-'+date.getDate();
		arrayDatos.push([datePaarse ,Datos.serie[i].valor] );
		
	 }

     grafico(Datos,arrayDatos);
    }
});


});

function grafico(valor,arrayDatos)
{
	google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable(arrayDatos);

        var options = {
			width: 1500,
          chart: {
            title: 'Grafico '+ valor.nombre,
          },
          vAxis: {
          title: 'Precio'
        }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
};


</script>


<?= $this->endSection() ?>