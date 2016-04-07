<section class="main container">
		<div class="row">
			<section class="posts col-md-12">
				<div class="miga-de-pan">
					<ol class="breadcrumb">
						<li><a href="<?php echo base_url(); ?>">Inicio</a></li>
						<li><a href="#">Consultas</a></li>
						<li class="active">Facturas y Entregas</li>
					</ol>
				</div>
				
				<form name="form">
					<div class="panel panel-primary">
						<div class="panel-heading">Seleccione Filtros</div>
					  		<div class="panel-body">
								<div class="form-group col-md-6">
									<label for="fecdocini">Fecha Doc. Inicial</label>
									<div class='input-group date' id='datetimepicker1'>
					                    <input type='text' class="form-control" name="fecini" id="fecini" />
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					            	</div>
								</div>
								<div class="form-group col-md-6">
									<label for="fecdocfin">Fecha Doc. Final</label>
									<div class='input-group date' id='datetimepicker2'>
					                    <input type='text' class="form-control" name="fecfin" id="fecfin" />
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					            	</div>
								</div>
					  	</div>
					</div>
					<div align="center"><input type="button" name="aceptar" id="aceptar" value="Aceptar" class="btn btn-primary" data-loading-text="Buscando..." autocomplete="off"></div>
					
				</form>
				<br>
				<div class="form-group" id="content"></div>
			</section>

		</div>
	</section>

	<script>
		$(document).ready(function(){           

			$('#aceptar').on('click',function(){
				
				var fecini = $("#fecini").val();
				var fecfin = $("#fecfin").val();
				
				var html = "";
				var reg = 0;
				var total_cant = 0;
				var total_kls = 0;
				var total_venta = 0;

				var $btn = $(this).button('loading');

				    $.ajax({
				    	type:"POST",
				    	url:"<?php echo base_url('informes/generar_informe_aseguradora'); ?>",
				    	data:{
				    		'fecini'	: 	fecini,
				    		'fecfin'	: 	fecfin
				    	},
				    	success:function(data){
				    		console.log(data);
				    		var json = JSON.parse(data);
				    		//alert(json.mensaje);
							
							html += "<div><a href='javascript:void(0);' id='excel' title='Exportar a Excel'><img src='<?php echo base_url(); ?>assets/img/excel.png' width='20px' height='20px' /></a></div>";
							html += "<table class='table table-striped table-condensed table-hover' id='resultados'>";
							html += "<thead>";
							html += "<tr>";
							html += "<th>#</th>";
							html += "<th>Transportador</th>";
							html += "<th>Planilla</th>";
							html += "<th>Placa</th>";
							html += "<th class='text-right'>Cant. Transp. Real</th>";
							html += "<th class='text-right'>Kilos Transp.</th>";
							html += "<th class='text-right'>Venta Neta</th>";
							html += "</tr>";
							html += "</thead>";
						
							for(datos in json){
								reg = reg + 1;
								total_cant = parseFloat(total_cant) + parseFloat(json[datos].cantidad_real);
								total_kls = parseFloat(total_kls) + parseFloat(json[datos].total_kilos);
								total_venta = parseFloat(total_venta) + parseFloat(json[datos].total_bruto);

								html += "<tr>";
								html +=	"<td>" + reg + "</td>";
								html +=	"<td>" + json[datos].desc_transp  + "</td>";
								html +=	"<td>" + json[datos].planilla + "</td>";
								html +=	"<td>" + json[datos].placa + "</td>";
								html +=	"<td class='text-right'>" + number_format(json[datos].cantidad_real) + "</td>";
								html +=	"<td class='text-right'>" + number_format(json[datos].total_kilos,2) + "</td>";
								html +=	"<td class='text-right'>" + number_format(json[datos].total_bruto,2) + "</td>";
								html += "</tr>";
						
							}

							html += "<tfoot>";
							html += "<tr>";
							html += "<td></td>";
							html += "<td></td>";
							html += "<td></td>";
							html += "<td></td>";
							html += "<td align='right'>" + number_format(total_cant) + "</td>";
							html += "<td align='right'>" + number_format(total_kls,2) + "</td>";
							html += "<td align='right'>" + number_format(total_venta,2) + "</td>";
							html += "</tr>";
							html += "</tfoot>";
						
							html += "</table>";

							$("#content").html(html);
							$btn.button('reset');

				    	},
				    	error:function(jqXHR, textStatus, errorThrown){
				    		console.log('Error: '+ errorThrown);
				    	}
				    });
				
			});

			$(document).on('click','#excel',function(){
				$("#resultados").table2excel({
				    exclude: ".noExl",
				    name: "Excel Document Name"
				}); 
			});				
				
		});
	</script>