	<section class="main container">
		<div class="row">
			<section class="posts col-md-12">
				<div class="miga-de-pan">
					<ol class="breadcrumb">
						<li><a href="<?php echo base_url(); ?>">Inicio</a></li>
						<li><a href="#">Servicios</a></li>
						<li class="active">Editar Servicio</li>
					</ol>
				</div>
				
				<form name="form">
					<div class="form-group" id="content">
					
					</div>
					
					<div class="form-group">
						<label for="codigo">Codigo Transportador</label>
						<input type="text" placeholder="Codigo" id="codigo" name="codigo" value="<?php echo $servicio->cod_servicio; ?>" class="form-control" disabled>
					</div>
					<div class="form-group">
						<label for="destino">Descripcion</label>
						<input type="text" placeholder="Descripcion" id="descripcion" name="descripcion" value="<?php echo $servicio->desc_servicio; ?>" class="form-control">
					</div>
										
					<input type="button" name="aceptar" id="aceptar" value="Aceptar" class="btn btn-primary">
					<input type="button" name="regresar" value="Regresar" class="btn btn-success" onclick="javascript:location.href = '<?php echo base_url().'servicios/form_buscar'; ?>';">
					<input type="hidden" name="id" id="id" value="<?php echo $servicio->cod_servicio; ?>">
				</form>
				
				
			</section>

		</div>
	</section>

	<script>
		$(document).ready(function(){

			$('#aceptar').on('click',function(){
				var codigo = $("#codigo").val();
				var descripcion = $("#descripcion").val();

			    $.ajax({
			    	type:"POST",
			    	url:"<?php echo base_url('servicios/editar_servicio'); ?>",
			    	data:{
			    		'codigo'		: 	codigo,
			    		'descripcion'	: 	descripcion
			    	},
			    	success:function(data){
			    		console.log(data);
			    		var json = JSON.parse(data);
			    		//alert(json.mensaje);
						var html = "";
						
						
						if (json.mensaje == 2) {
							html += "<div class='alert alert-success' role='alert'>Servicio Modificado Exitosamente!!!!!</div>";
						}else if(json.mensaje == 3){
								html += "<div class='alert alert-danger' role='alert'>Ah ocurrido un error al intentar modificar este servicio. Por favor revise la informacion o comuniquese con el administrador del sistema</div>";
						}else{
								html += "<div class='alert alert-danger' role='alert'>" + json.mensaje + "</div>";
						}
						

						$("#content").html(html);

			    	},
			    	error:function(jqXHR, textStatus, errorThrown){
			    		console.log('Error: '+ errorThrown);
			    	}
			    });

			});
				
		});
	</script>