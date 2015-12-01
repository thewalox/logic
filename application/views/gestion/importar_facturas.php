	<section class="main container">
		<div class="row">
			<section class="posts col-md-12">
				<div class="miga-de-pan">
					<ol class="breadcrumb">
						<li><a href="<?php echo base_url(); ?>">Inicio</a></li>
						<li><a href="#">Gestion</a></li>
						<li class="active">Importar Facturacion SAP</li>
					</ol>
				</div>
				
				<form name="form">
					<div class="form-group" id="content">
					
					</div>
					<div class="panel panel-primary">
						<div class="panel-heading">Importar Facturacion SAP</div>
					  		<div class="panel-body">
						    	<div class="form-group col-md-6">
									<label for="codigo">fecha Inicial</label>
									<div class='input-group date' id='datetimepicker1'>
					                    <input type='text' class="form-control" name="fecini" id="fecini" />
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					            	</div>
								</div>
								<div class="form-group col-md-6">
									<label for="codigo">Fecha Final</label>
									<div class='input-group date' id='datetimepicker2'>
					                    <input type='text' class="form-control" name="fecfin" id="fecfin" />
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
					            	</div>
								</div>
					  	</div>
					</div>
					<div align="center"><input type="button" name="importar" id="importar" value="Importar" class="btn btn-primary" data-loading-text="Importando..." autocomplete="off"></div>
					
				</form>
				<div class="form-group" id="content2"></div>
			</section>

		</div>
	</section>

	<script>
		$(document).ready(function(){           

			$('#importar').on('click',function(){
				
				var fecini = $("#fecini").val();
				var fecfin = $("#fecfin").val();
				var html = "";

				if (fecini == 0){
					html += "<div class='alert alert-danger' role='alert'>La fecha Inicial es obligatoria</div>";
		            $("#content").html(html);
		            //return false;
		        }else if (fecfin== 0){
		        	html += "<div class='alert alert-danger' role='alert'>La fecha Final es obligatoria</div>";
		            $("#content").html(html);
		        }else if (fecfin < fecini){
		        	html += "<div class='alert alert-danger' role='alert'>La fecha final no puede ser menor a la fecha inicial</div>";
		            $("#content").html(html);
		    	}else{

		    		var $btn = $(this).button('loading');

				    $.ajax({
				    	type:"POST",
				    	url:"<?php echo base_url('gestion/importar_documentos'); ?>",
				    	data:{
				    		'fecini'	: 	fecini,
				    		'fecfin'	: 	fecfin
				    	},
				    	success:function(data){
				    		console.log(data);
				    		var json = JSON.parse(data);
				    		//alert(json.mensaje);
							
							html += "<table class='table table-striped table-condensed table-hover'>";
							html += "<thead>";
							html += "<tr>";
							html += "<th>Fecha</th>";
							html += "<th>Tipo Doc</th>";
							html += "<th>Documento</th>";
							html += "<th>Linea</th>";
							html += "<th>Item</th>";
							html += "<th>Descripcion</th>";
							html += "<th>Mensaje</th>";
							html += "</tr>";
							html += "</thead>";
						
							for(datos in json){
								html += "<tr class='" + json[datos].estado + "'>";
								html +=	"<td>" + json[datos].docdate + "</td>";
								html +=	"<td>" + json[datos].tipodoc + "</td>";
								html +=	"<td>" + json[datos].docnum + "</td>";
								html +=	"<td>" + json[datos].linenum + "</td>";
								html +=	"<td>" + json[datos].itemcode + "</td>";
								html +=	"<td>" + json[datos].itemdesc + "</td>";
								html +=	"<td>" + json[datos].mensaje + "</td>";
								html += "</tr>";
						
							}
						
							html += "</table>";																			

							$("#content2").html(html);
							$btn.button('reset')

				    	},
				    	error:function(jqXHR, textStatus, errorThrown){
				    		console.log('Error: '+ errorThrown);
				    	}
				    });
				}
			});
				
		});
	</script>