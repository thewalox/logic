	<section class="main container">
		<div class="row">
			<section class="posts col-md-12">
				<div class="miga-de-pan">
					<ol class="breadcrumb">
						<li><a href="<?php echo base_url(); ?>">Inicio</a></li>
						<li><a href="#">Gestion</a></li>
						<li class="active">Generacion de Fletes</li>
					</ol>
				</div>
				
				<form name="form">
					<div class="form-group" id="content">
					
					</div>
					<div class="panel panel-primary">
						<div class="panel-heading">Generar Calculo de Fletes</div>
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
					<div align="center"><input type="button" name="generar" id="generar" value="Generar" class="btn btn-primary" data-loading-text="Generando..." autocomplete="off"></div>
					
				</form>
				<div class="form-group" id="content2"></div>
			</section>

		</div>
	</section>

	<script>
		$(document).ready(function(){           

			$('#generar').on('click',function(){
				
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
				    	url:"<?php echo base_url('gestion/generar_fletes'); ?>",
				    	data:{
				    		'fecini'	: 	fecini,
				    		'fecfin'	: 	fecfin
				    	},
				    	success:function(data){
				    		console.log(data);
				    		var json = JSON.parse(data);
				    		//alert(json.mensaje);
							for(datos in json){
								html += "<br>"
								html += "<div class='alert alert-success text-center' role='alert'>Proceso terminado correctamente. Cantidad de documentos afectados: "+ json.cant  +"</div>";																								
							}

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