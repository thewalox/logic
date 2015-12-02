	<section class="main container">
		<div class="row">
			<section class="posts col-md-12">
				<div class="miga-de-pan">
					<ol class="breadcrumb">
						<li><a href="<?php echo base_url(); ?>">Inicio</a></li>
						<li><a href="#">Tarifas</a></li>
						<li class="active">Buscar Tarifa</li>
					</ol>
				</div>
				
				<div class="row">
					<div class="container">
						<div class="input-group">
							<input type="text" name="filtro" id="filtro" class="form-control" placeholder="Buscar por.....">
							<span class="input-group-btn">
					        	<input type="button" name="aceptar" id="aceptar" value="Aceptar" class="btn btn-primary">
					        	<input type="button" name="cancelar" id="cancelar" value="Cancelar" class="btn btn-success" onclick="javascript:location.href = '<?php echo base_url().'tarifas/form_buscar'; ?>';">
      						</span>
    					</div>
					</div>
				</div>
				<div class="form-group" id="content">
					<form name="form">
						<table class="table table-striped table-condensed table-hover">
							<thead>
								<tr>
									<th>Tarifa</th>
									<th>Transportador</th>
									<th>Destino</th>
									<th>Unidad Medida</th>
									<th>Valor</th>
									<th></th>
									<th></th>
								</tr>
							</thead>
							<?php
								foreach ($tarifas as $tar) {
									# code...
							?>
							<tr>
								<td><?php echo $tar["cod_tarifa"]; ?></td>
								<td><?php echo $tar["desc_transp"]; ?></td>
								<td><?php echo $tar["destino"]; ?></td>
								<td><?php echo $tar["desc_unidad"]; ?></td>
								<td><?php echo number_format($tar["valor"],2,".",","); ?></td>
								<td><a href="<?php echo base_url('tarifas/form_editar/'. $tar["cod_tarifa"]); ?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
								<td><a href="<?php echo base_url('tarifas/eliminar_tarifa/'. $tar["cod_tarifa"]); ?>"><span class="glyphicon glyphicon-trash"></span></a></td>
							</tr>
							<?php
								}
							?>
						</table>
					</form>
					<div class="row">
						<div class="container">
							<ul class="pagination">
				            <?php
				              /* Se imprimen los números de página */           
				              echo $this->pagination->create_links();
				            ?>
		            		</ul>
						</div>
					</div>		
				</div>
			</section>

		</div>
	</section>

	<script>
		$(document).ready(function(){

			$('#aceptar').on('click',function(){
				var filtro = $("#filtro").val();
				//alert("ok");
			    $.ajax({
			    	type:"GET",
			    	url:"<?php echo base_url('tarifas/get_tarifas_criterio'); ?>",
			    	data:{
			    		'filtro'	: 	filtro
			    	},
			    	success:function(data){
			    		console.log(data);
			    		var json = JSON.parse(data);
			    		//alert(json.mensaje);
			    		var html = "";
						html += "<table class='table table-striped table-condensed table-hover'>";
						html += "<thead>";
						html += "<tr>";
						html += "<th>Tarifa</th>";
						html += "<th>Transportador</th>";
						html += "<th>Destino</th>";
						html += "<th>Unidad Medida</th>";
						html += "<th></th>";
						html += "<th></th>";
						html += "</tr>";
						html += "</thead>";
						
							for(datos in json){
								html += "<tr>";
								html +=	"<td>" + json[datos].cod_tarifa + "</td>";
								html +=	"<td>" + json[datos].desc_transp + "</td>";
								html +=	"<td>" + json[datos].destino + "</td>";
								html +=	"<td>" + json[datos].desc_unidad + "</td>";
								html +=	"<td><a href='<?php echo base_url('tarifas/form_editar/" + json[datos].cod_tarifa  + "'); ?>'><span class='glyphicon glyphicon-pencil'></span></a></td>";
								html +=	"<td><a href='<?php echo base_url('tarifas/eliminar_tarifa/" + json[datos].cod_tarifa  + "'); ?>'><span class='glyphicon glyphicon-trash'></span></a></td>";
								html += "</tr>";
						
							}
						
						html += "</table>";
						
						$("#content").html(html);

			    	},
			    	error:function(jqXHR, textStatus, errorThrown){
			    		console.log('Error: '+ errorThrown);
			    	}
			    });

			});
				
		});
	</script>	