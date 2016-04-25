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
			<?php
			if (!empty($factura)) {
			?>
				
				<div>
					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#info">Informacion de Factura</a></li>
						<li><a data-toggle="tab" href="#items">Items</a></li>
						<li><a data-toggle="tab" href="#fletes">Fletes</a></li>
					</ul>
				</div>
				
				<div class="tab-content">
				  <div id="info" class="tab-pane fade in active">
				  </br>
				    <form name="form" class="">
				    	<div class="row">
				    		<div class="col-md-2"></div>
				    		<div class="form-group col-md-4">
								<label for="factura"><?php if ($factura[0]["tipodoc"] == 'F'){ echo 'Factura'; }else{ echo 'Entrega'; }; ?> Nº</label>
								<input type="text" id="factura" name="factura" value="<?php echo $factura[0]["docnum"]; ?>" class="form-control input-sm" disabled>
							</div>
							<div class="form-group col-md-4">
								<label for="fechafac">Fecha</label>
								<input type="text" id="fechafac" name="fechafac" value="<?php echo $factura[0]["docdate"]; ?>" class="form-control input-sm" disabled>
							</div>
							<div class="col-md-2"></div>
				    	</div>

				    	<div class="row">
				    		<div class="col-md-2"></div>
				    		<div class="form-group col-md-2">
								<label for="codsap">Codigo SAP</label>
								<input type="text" id="codsap" name="codsap" value="<?php echo $factura[0]["cardcode"]; ?>" class="form-control input-sm" disabled>
							</div>
							<div class="form-group col-md-6">
								<label for="razon">Razon Social</label>
								<input type="text" id="razon" name="razon" value="<?php echo $factura[0]["cardname"]; ?>" class="form-control input-sm" disabled>
							</div>
							<div class="col-md-2"></div>
				    	</div>

				    	<div class="row">
				    		<div class="col-md-2"></div>
				    		<div class="form-group col-md-6">
								<label for="direccion">Direccion</label>
								<input type="text" id="direccion" name="direccion" value="<?php echo $factura[0]["address2"]; ?>" class="form-control input-sm" disabled>
							</div>
							<div class="form-group col-md-2">
								<label for="ciudad">Ciudad</label>
								<input type="text" id="ciudad" name="ciudad" value="<?php echo $factura[0]["city"]; ?>" class="form-control input-sm" disabled>
							</div>
							<div class="col-md-2"></div>
				    	</div>

				    	<div class="row">
				    		<div class="col-md-2"></div>
				    		<div class="form-group col-md-8">
								<label for="asesor">Asesor</label>
								<input type="text" id="asesor" name="asesor" value="<?php echo $factura[0]["slpname"]; ?>" class="form-control input-sm" disabled>
							</div>
							<div class="col-md-2"></div>
				    	</div>

				    	<div class="row">
				    		<div class="col-md-2"></div>
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
					                				<option value="<?php echo $trp['cod_transp']; ?>" <?php if($trp["cod_transp"] == $factura[0]["transportador"]){ ?> selected="selected" <?php } ?>><?php echo $trp['desc_transp']; ?></option>
					            				<?php 
					            					}
					            				?>
											</select>
										</div>

										<div class="form-group col-md-6">
											<label for="fecenvio">Fecha de Envio</label>
											<div class='input-group date' id='datetimepicker2'>
							                    <input type='text' class="form-control input-sm" name="fecenvio" id="fecenvio" value="<?php echo $factura[0]["fecha_envio"]; ?>" />
							                    <span class="input-group-addon">
							                        <span class="glyphicon glyphicon-calendar"></span>
							                    </span>
							            	</div>
										</div>

								    	<div class="form-group col-md-6">
											<label for="horaenvio">Hora de Envio</label>
											<div class='input-group date' id='datetimepicker3'>
							                    <input type='text' class="form-control input-sm" name="horaenvio" id="horaenvio" value="<?php echo $factura[0]["hora_envio"]; ?>" />
							                    <span class="input-group-addon">
							                        <span class="glyphicon glyphicon-time"></span>
							                    </span>
							            	</div>
										</div>
										<div class="form-group col-md-6">
											<label for="planilla">Planilla</label>
											<input type="text" placeholder="Planilla" id="planilla" name="planilla" value="<?php echo $factura[0]["planilla"]; ?>" class="form-control input-sm">
										</div>

										<div class="form-group col-md-6">
											<label for="guia">Guia Transportador</label>
											<input type="text" placeholder="Guia Transportador" id="guia" name="guia" value="<?php echo $factura[0]["guia"]; ?>" class="form-control input-sm">
										</div>
										<div class="form-group col-md-6">
											<label for="placa">Placa</label>
											<input type="text" placeholder="Placa" id="placa" name="placa" value="<?php echo $factura[0]["placa"]; ?>" class="form-control input-sm">
										</div>

										<div class="form-group col-md-6">
											<label for="seguro">Valor Seguro</label>
											<input type="text" placeholder="Valor Seguro" id="seguro" name="seguro" value="<?php echo $factura[0]["valor_seguro"]; ?>" class="form-control input-sm">
										</div>
										<div class="form-group col-md-6">
											<label for="gastos">Otros Gastos</label>
											<input type="text" placeholder="Otros Gastos" id="gastos" name="gastos" value="<?php echo $factura[0]["otros_gastos"]; ?>" class="form-control input-sm">
										</div>

										<div class="col-md-6">
											<label for="servicio">Tipo de Servicio</label>
											<select class="form-control input-sm" name="servicio" id="servicio">
												<option value="0">...</option>
												<?php 
													foreach($servicios as $ser){
												?>
					                				<option value="<?php echo $ser['cod_servicio']; ?>" <?php if($ser["cod_servicio"] == $factura[0]["tipo_servicio"]){ ?> selected="selected" <?php } ?>><?php echo $ser['desc_servicio']; ?></option>
					            				<?php 
					            					}
					            				?>
											</select>
										</div>
										<div class="form-group col-md-6">
											<label for="estadofac">Estado</label>
											<select class="form-control input-sm" name="estadofac" id="estadofac">
												<option value="0">...</option>
												<option value="P" <?php if($factura[0]["estado_factura"] == "P"){ ?> selected="selected" <?php } ?>>Pendiente</option>
												<option value="OK" <?php if($factura[0]["estado_factura"] == "OK"){ ?> selected="selected" <?php } ?>>Ok</option>
											</select>
										</div>

										<div class="form-group col-md-12">
											<label for="obs">Observaciones</label>
											<textarea class="form-control input-sm" rows="3" id="obs" name="obs"><?php echo $factura[0]["observacion"]; ?></textarea>
										</div>
									</div>
								</div>
				    		</div>
					    	<div class="col-md-2"></div>
				    	</div>
				    	
				    	<div class="row">
				    		<div class="col-md-2"></div>
				    		<div class="col-md-8">
				    			<div class="panel panel-primary">
									<div class="panel-heading">Seguimiento</div>
									<div class="panel-body">								
										<div class="form-group col-md-6">
											<label for="recibido">Recibido Por</label>
											<input type="text" placeholder="Recibido Por" id="recibido" name="recibido" value="<?php echo $factura[0]["recibido_por"]; ?>" class="form-control input-sm">
										</div>
										<div class="form-group col-md-6">
											<label for="fecrecibo">Fecha de Recibido</label>
											<div class='input-group date' id='datetimepicker1'>
							                    <input type='text' class="form-control input-sm" name="fecrecibo" id="fecrecibo" value="<?php echo $factura[0]["fecha_recibido"]; ?>" />
							                    <span class="input-group-addon">
							                        <span class="glyphicon glyphicon-calendar"></span>
							                    </span>
							            	</div>
										</div>
										<div class="form-group col-md-6">
											<label for="dev">Valor Devolucion</label>
											<input type="text" placeholder="Devolucion" id="dev" name="dev" value="<?php echo $factura[0]["devolucion"]; ?>" class="form-control input-sm">
										</div>
									</div>
								</div>
				    		</div>
					    	<div class="col-md-2"></div>
				    	</div>
				    </form>
				  </div>
				  <div id="items" class="tab-pane fade">
				  	<div class="container">
				  		<form name="form">
				  			<table class="table table-striped table-condensed">
							<thead>
								<tr>
									<th>Codigo</th>
									<th>Descripcion</th>
									<th>U.M</th>
									<th>Bodega</th>
									<th>Cantidad</th>
									<th>Valor Bruto</th>
									<th>Iva</th>
									<th>Total Linea</th>
									<th>Cant Real</th>
								</tr>
							</thead>
							<?php
								foreach ($factura as $fac) {
									# code...
							?>
							<tr>
								<td><?php echo $fac["itemcode"]; ?></td>
								<td><?php echo $fac["itemdesc"]; ?></td>
								<td><?php echo $fac["um"]; ?></td>
								<td><?php echo $fac["whscode"]; ?></td>
								<td align="center"><?php echo number_format($fac["quantity"]); ?></td>
								<td align="right"><?php echo number_format($fac["subtotal"],2,".",","); ?></td>
								<td align="right"><?php echo number_format($fac["iva"],2,".",","); ?></td>
								<td align="right"><?php echo number_format($fac["total_neto"],2,".",","); ?></td>
								<td><div class="col-xs-5"><input type='text' class="form-control input-sm" name="cantreal[]" id="<?php echo $fac["itemcode"]; ?>" value="<?php echo number_format($fac["cantidad_real"]); ?>" linea="<?php echo $fac["linenum"]; ?>" <?php if ($valida_flete->flete > 0) {?> disabled <?php } ?> /></div></td>
							</tr>
							<?php
								}
							?>
							</table>
				  		</form>	
				  	</div>		
				  </div>

				  <div id="fletes" class="tab-pane fade">
				  	<div class="container">
				  		<form name="form">
				  			<br>
				  		<?php
				  			if ($valida_flete->flete == 0) {
				  		?>
				  			<div class='alert alert-danger text-center' role='alert'>El proceso de calculo del flete aun no ha sido generado para este documento</div>
				  			
				  		<?php
				  			}else{
				  		?>
				  			<table class="table table-striped table-condensed">
							<thead>
								<tr>
									<th>Codigo</th>
									<th>Descripcion</th>
									<th>U.M 2</th>
									<th>Volumen M3</th>
									<th>Codigo Tarifa</th>
									<th>Val. Tarifa</th>
									<th>Cant. Real</th>
									<th class="text-right">SubTotal</th>
								</tr>
							</thead>
							<?php
								foreach ($factura as $fac) {
							?>
							<tr>
								<td><?php echo $fac["itemcode"]; ?></td>
								<td><?php echo $fac["itemdesc"]; ?></td>
								<td><?php echo $fac["um2"]; ?></td>
								<td align="center"><?php echo number_format($fac["volumen_m3"],2,".",","); ?></td>
								<td><?php echo $fac["cod_tarifa"]; ?></td>
								<td><?php echo number_format($fac["valor_flete"] / $fac["cantidad_real"],2,".",","); ?></td>
								<td align="center"><?php echo number_format($fac["cantidad_real"],0,".",","); ?></td>
								<td align="right"><?php echo number_format($fac["valor_flete"],2,".",","); ?></td>
							</tr>
							<?php
								}
							?>
							<tr>
								<td colspan="6"></td>
								<td colspan="2" align="right">
									<button class='btn btn-primary' type='button'>
										Total Flete: <span class='badge'><?php echo number_format($valida_flete->flete,2,".",","); ?></span>
									</button>
								</td>
							</tr>
							</table>
							
						<?php
							}
						?>
							
				  		</form>	
						
				  		<div id="flete"></div>
				  	</div>	
				  </div>

				  <div class="row">
				  	<div class="form-group" id="content"></div>
				  	<div class="col-md-2"></div>
				    	<div class="col-md-8" align="center">
				    		<input type="button" name="aceptar" id="aceptar" value="Aceptar" class="btn btn-primary">
				    		<input type="button" name="cancelar" id="cancelar" value="Regresar" class="btn btn-success" onclick="javascript:location.href = '<?php echo base_url().'gestion/form_buscar'; ?>';">
				    	</div>
				    <div class="col-md-2"></div>
				    </div>
				</div>

			<?php
			}else{
			?>	
				<div class='alert alert-danger text-center' role='alert'>No existe Documento con este criterio de busqueda</div>
			<?php
			}
			?>	
				
					
			</section>
		</div>
	</section>

	<script>
		$(document).ready(function(){

			$('a[href=#info]').on('click',function(){
				$("#content").hide("fast");
			});

			$('a[href=#items]').on('click',function(){
				$("#content").hide("fast");
			});

			$('a[href=#fletes]').on('click',function(){
				$("#content").hide("fast");
			});

			$('#aceptar').on('click',function(){
				var i = 0;
				var j= 0;

				var factura = $("#factura").val();
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
				var dev = $("#dev").val();
				var recibido = $("#recibido").val();
				var fecrecibo = $("#fecrecibo").val();
				
				var items = new Array(2); // crea un array de longitud 2 para almacenar codigo y valor
				var fletes = new Array(2); // crea un array de longitud 2 para almacenar codigo y valor

				$('input[name="cantreal[]"]').each(function(){
				   	items[i] = new Object();

					items[i]["itemcode"] = $(this).attr("id"); //item
					items[i]["linea"] = $(this).attr("linea"); //Linea
					items[i]["cantidad"] = $(this).val(); //valor
					
				   	i++;
				});

				/*$('input[name="valflete[]"]').each(function(){
				   	fletes[j] = new Object();

					fletes[j]["itemcode"] = $(this).attr("id"); //item
					fletes[j]["valor_flete"] = $(this).val(); //valor
					fletes[j]["cod_tarifa"] = $(this).attr("cod"); //codigo tarifa
					//alert($(this).attr("cod"));
				   	j++;
				});*/
				
			    $.ajax({
			    	type:"POST",
			    	url:"<?php echo base_url('gestion/editar_factura'); ?>",
			    	data:{
			    		'factura'		: 	factura,
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
			    		'obs'			: 	obs,
			    		'dev'			: 	dev,
			    		'recibido'		: 	recibido,
			    		'fecrecibo'		: 	fecrecibo,
			    		'items'			: 	items
			    		//'fletes'		: 	fletes
			    	},
			    	success:function(data){
			    		console.log(data);
			    		var json = JSON.parse(data);
			    		//alert(json.mensaje);
						var html = "";
						
						for(datos in json){
							if (json.mensaje == 2) {
								html += "<div class='alert alert-success text-center' role='alert'>Factura Modificada Exitosamente!!!!!</div>";
							}else if(json.mensaje == 3){
									html += "<div class='alert alert-danger' role='alert'>Ah ocurrido un error al modificar esta factura. Por favor revise la informacion o comuniquese con el administrador del sistema</div>";
							}else{
									html += "<div class='alert alert-danger' role='alert'>" + json.mensaje + "</div>";
							}
						}

						$("#content").show("fast");
						$("#content").html(html);

			    	},
			    	error:function(jqXHR, textStatus, errorThrown){
			    		console.log('Error: '+ errorThrown);
			    	}
			    });

			});

				
		});
	</script>