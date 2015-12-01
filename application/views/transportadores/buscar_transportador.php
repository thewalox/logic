	<section class="main container">
		<div class="row">
			<section class="posts col-md-12">
				<div class="miga-de-pan">
					<ol class="breadcrumb">
						<li><a href="<?php echo base_url(); ?>">Inicio</a></li>
						<li><a href="#">Transportadores</a></li>
						<li class="active">Buscar Transportador</li>
					</ol>
				</div>
				
				<div class="row">
					<div class="container">
						<div class="input-group">
							<input type="text" name="filtro" id="filtro" class="form-control" placeholder="Buscar por.....">
							<span class="input-group-btn">
					        	<input type="button" name="aceptar" id="aceptar" value="Aceptar" class="btn btn-primary">
					        	<input type="button" name="cancelar" id="cancelar" value="Cancelar" class="btn btn-success" onclick="javascript:location.href = '<?php echo base_url().'transportadores/form_buscar'; ?>';">
      						</span>
    					</div>
					</div>
				</div>
				<div class="form-group" id="content">
					<form name="form">
						<table class="table table-striped table-condensed table-hover">
							<thead>
								<tr>
									<th>Codigo</th>
									<th>Descripcion Transportador</th>
									<th></th>
									<th></th>
								</tr>
							</thead>
							<?php
								foreach ($transportador as $transp) {
									# code...
							?>
							<tr>
								<td><?php echo $transp["cod_transp"]; ?></td>
								<td><?php echo $transp["desc_transp"]; ?></td>
								<td><a href="<?php echo base_url('transportadores/form_editar/'. $transp["cod_transp"]); ?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
								<td><a href="<?php echo base_url('transportadores/eliminar_transportador/'. $transp["cod_transp"]); ?>"><span class="glyphicon glyphicon-trash"></span></a></td>
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
			    	url:"<?php echo base_url('transportadores/get_transportadores_criterio'); ?>",
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
						html += "<th>Codigo</th>";
						html += "<th>Descripcion Transportador</th>";
						html += "<th></th>";
						html += "<th></th>";
						html += "</tr>";
						html += "</thead>";
						
							for(datos in json){
								html += "<tr>";
								html +=	"<td>" + json[datos].cod_transp + "</td>";
								html +=	"<td>" + json[datos].desc_transp + "</td>";
								html +=	"<td><a href='<?php echo base_url('tarifas/form_editar/" + json[datos].cod_transp  + "'); ?>'><span class='glyphicon glyphicon-pencil'></span></a></td>";
								html +=	"<td><a href='<?php echo base_url('tarifas/eliminar_tarifa/" + json[datos].cod_transp  + "'); ?>'><span class='glyphicon glyphicon-trash'></span></a></td>";
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