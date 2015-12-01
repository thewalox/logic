	<section class="main container">
		<div class="row">
			<section class="posts col-md-12">
				<div class="miga-de-pan">
					<ol class="breadcrumb">
						<li><a href="<?php echo base_url(); ?>">Inicio</a></li>
						<li><a href="#">Gestion</a></li>
						<li class="active">Editar Factura</li>
					</ol>
				</div>
				<div>
					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#info">Informacion de Factura</a></li>
					</ul>
				</div>
				

				<div class="tab-content">
				  <div id="info" class="tab-pane fade in active">
				  </br>
				    <form name="form" class="">
				    	<div class="row">
				    		<div class="col-md-2">
				    			<ul class="list-group">
									<li class="list-group-item active text-center">Facturas Seleccionadas</li>
				    		<?php
								foreach ($lote as $lote) {
							?>
									<li class="list-group-item text-center"><?php echo $lote; ?></li>
									<input type="hidden" name="lote[]" id="<?php echo $lote; ?>" value="<?php echo $lote; ?>">
							<?php
								}
							?>
								</ul>
							</div>

				    		<div class="col-md-8">
				    			<div class="panel panel-primary">
									<div class="panel-heading">Datos de Cargue</div>
									<div class="panel-body">
										<div class="col-md-6">
											<label for="transportador">Transportador</label>
											<select class="form-control input-sm" name="transportador" id="transportador">
												<option value="0">...</option>
												<?php 
													foreach($transportadores as $trp){
												?>
					                				<option value="<?php echo $trp['cod_transp']; ?>"><?php echo $trp['desc_transp']; ?></option>
					            				<?php 
					            					}
					            				?>
											</select>
										</div>

										<div class="form-group col-md-6">
											<label for="fecenvio">Fecha de Envio</label>
											<div class='input-group date' id='datetimepicker2'>
							                    <input type='text' class="form-control input-sm" name="fecenvio" id="fecenvio"/>
							                    <span class="input-group-addon">
							                        <span class="glyphicon glyphicon-calendar"></span>
							                    </span>
							            	</div>
										</div>

								    	<div class="form-group col-md-6">
											<label for="horaenvio">Hora de Envio</label>
											<div class='input-group date' id='datetimepicker3'>
							                    <input type='text' class="form-control input-sm" name="horaenvio" id="horaenvio" />
							                    <span class="input-group-addon">
							                        <span class="glyphicon glyphicon-time"></span>
							                    </span>
							            	</div>
										</div>
										<div class="form-group col-md-6">
											<label for="planilla">Planilla</label>
											<input type="text" placeholder="Planilla" id="planilla" name="planilla" class="form-control input-sm">
										</div>

										<div class="form-group col-md-6">
											<label for="guia">Guia Transportador</label>
											<input type="text" placeholder="Guia Transportador" id="guia" name="guia" class="form-control input-sm">
										</div>
										<div class="form-group col-md-6">
											<label for="placa">Placa</label>
											<input type="text" placeholder="Placa" id="placa" name="placa" class="form-control input-sm">
										</div>

										<div class="form-group col-md-6">
											<label for="seguro">Valor Seguro</label>
											<input type="text" placeholder="Valor Seguro" id="seguro" name="seguro" class="form-control input-sm">
										</div>
										<div class="form-group col-md-6">
											<label for="gastos">Otros Gastos</label>
											<input type="text" placeholder="Otros Gastos" id="gastos" name="gastos" class="form-control input-sm">
										</div>

										<div class="col-md-6">
											<label for="servicio">Tipo de Servicio</label>
											<select class="form-control input-sm" name="servicio" id="servicio">
												<option value="0">...</option>
												<?php 
													foreach($servicios as $ser){
												?>
					                				<option value="<?php echo $ser['cod_servicio']; ?>"><?php echo $ser['desc_servicio']; ?></option>
					            				<?php 
					            					}
					            				?>
											</select>
										</div>
										<div class="form-group col-md-6">
											<label for="estadofac">Estado</label>
											<select class="form-control input-sm" name="estadofac" id="estadofac">
												<option value="0">...</option>
												<option value="P">Pendiente</option>
												<option value="OK">Ok</option>
											</select>
										</div>

										<div class="form-group col-md-12">
											<label for="obs">Observaciones</label>
											<textarea class="form-control input-sm" rows="3" id="obs" name="obs"></textarea>
										</div>

										<div class="form-group col-md-12" id="content"></div>

										<div class="col-md-12" align="center">
							    			<input type="button" name="aceptar" id="aceptar" value="Aceptar" class="btn btn-primary">
							    			<input type="button" name="cancelar" id="cancelar" value="Regresar" class="btn btn-success" onclick="javascript:location.href = '<?php echo base_url().'gestion/form_buscar'; ?>';">
							    		</div>
									</div>
								</div>
				    		</div>
					    	<div class="col-md-2"></div>
				    	</div>

				    </form>
				  </div>
					
			</section>
		</div>
	</section>

	<script>
		$(document).ready(function(){


			$('#aceptar').on('click',function(){
				var lote = $('input[name="lote[]"]').serializeArray()
				var transportador = $("#transportador").val();
				var fecenvio = $("#fecenvio").val();
				var horaenvio = $("#horaenvio").val();
				var planilla = $("#planilla").val();
				var guia = $("#guia").val();
				var placa = $("#placa").val();
				var seguro = $("#seguro").val();
				var gastos = $("#gastos").val();
				var servicio = $("#servicio").val();
				var estadofac = $("#estadofac").val();
				var obs = $("#obs").val();
				
			    $.ajax({
			    	type:"POST",
			    	url:"<?php echo base_url('gestion/editar_facturas_lote'); ?>",
			    	data:{
			    		'lote'			: 	lote,
			    		'transp'		: 	transportador,
			    		'fecenvio'		: 	fecenvio,
			    		'horaenvio'		: 	horaenvio,
			    		'planilla'		: 	planilla,
			    		'guia'			: 	guia,
			    		'placa'			: 	placa,
			    		'seguro'		: 	seguro,
			    		'gastos'		: 	gastos,
			    		'servicio'		: 	servicio,
			    		'estadofac'		: 	estadofac,
			    		'obs'			: 	obs
			    	},
			    	success:function(data){
			    		console.log(data);
			    		var json = JSON.parse(data);
			    		//alert(json.mensaje);
						var html = "";
						
						for(datos in json){
							if (json.mensaje == 2) {
								html += "<div class='alert alert-success' role='alert'>Facturas Modificadas Exitosamente!!!!!</div>";
							}else if(json.mensaje == 3){
									html += "<div class='alert alert-danger' role='alert'>Ah ocurrido un error al modificar estas facturas. Por favor revise la informacion o comuniquese con el administrador del sistema</div>";
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