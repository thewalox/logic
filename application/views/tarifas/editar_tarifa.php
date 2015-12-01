	<section class="main container">
		<div class="row">
			<section class="posts col-md-12">
				<div class="miga-de-pan">
					<ol class="breadcrumb">
						<li><a href="<?php echo base_url(); ?>">Inicio</a></li>
						<li><a href="#">Tarifas</a></li>
						<li class="active">Editar Tarifa</li>
					</ol>
				</div>
				
				<form name="form">
					<div class="form-group" id="content">
					
					</div>
					
					<div class="form-group">
						<label for="codigo">Codigo Tarifa</label>
						<input type="text" placeholder="Codigo" id="codigo" name="codigo" value="<?php echo $tarifa->cod_tarifa; ?>" class="form-control" disabled>
					</div>
					<div class="form-group">
						<label for="transportador">Transportador</label>
						<select class="form-control" name="transportador" id="transportador">
							<option value="0">...</option>
							<?php 
								foreach($transportadores as $trp){
							?>
                				<option value="<?php echo $trp['cod_transp']; ?>" <?php if($trp["cod_transp"] == $tarifa->cod_transp){ ?> selected="selected" <?php } ?>><?php echo $trp['desc_transp']; ?></option>
            				<?php 
            					}
            				?>
						</select>
					</div>
					<div class="form-group">
						<label for="destino">Destino</label>
						<input type="text" placeholder="Destino" id="destino" name="destino" value="<?php echo $tarifa->destino; ?>" class="form-control">
					</div>
					<div class="form-group">
						<label for="destino">Unidad de Medida</label>
						<select class="form-control" name="um" id="um">
							<option value="0">...</option>
							<?php 
								foreach($unidades as $um){
							?>
                				<option value="<?php echo $um['cod_unidad']; ?>" <?php if($um["cod_unidad"] == $tarifa->und_transp){ ?> selected="selected" <?php } ?>><?php echo $um['desc_unidad']; ?></option>
            				<?php 
            					}
            				?>
						</select>
					</div>
					<div class="form-group">
						<label for="valor">Valor</label>
						<input type="text" placeholder="Valor" id="valor" name="valor" value="<?php echo $tarifa->valor; ?>" class="form-control">
					</div>
					
					<input type="button" name="aceptar" id="aceptar" value="Aceptar" class="btn btn-primary">
					<input type="button" name="regresar" value="Regresar" class="btn btn-success" onclick="javascript:location.href = '<?php echo base_url().'tarifas/form_buscar'; ?>';">
					<input type="hidden" name="id" id="id" value="<?php echo $tarifa->cod_tarifa; ?>">
				</form>
				
				
			</section>

		</div>
	</section>

	<script>
		$(document).ready(function(){

			$('#aceptar').on('click',function(){
				var codigo = $("#codigo").val();
				var transportador = $("#transportador").val();
				var destino = $("#destino").val();
				var um = $("#um").val();
				var valor = $("#valor").val();

			    $.ajax({
			    	type:"POST",
			    	url:"<?php echo base_url('tarifas/editar_tarifa'); ?>",
			    	data:{
			    		'id'			: 	codigo,
			    		'transportador'	: 	transportador,
			    		'destino'		: 	destino,
			    		'um'			: 	um,
			    		'valor'			: 	valor
			    	},
			    	success:function(data){
			    		console.log(data);
			    		var json = JSON.parse(data);
			    		//alert(json.mensaje);
						var html = "";
						
						for(datos in json){
							if (json.mensaje == 2) {
								html += "<div class='alert alert-success' role='alert'>Tarifa Modificada Exitosamente!!!!!</div>";
							}else if(json.mensaje == 3){
									html += "<div class='alert alert-danger' role='alert'>Ah ocurrido un error al modificar esta tarifa. Por favor revise la informacion o comuniquese con el administrador del sistema</div>";
							}else{
									html += "<div class='alert alert-danger' role='alert'>" + json.mensaje + "</div>";
							}
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