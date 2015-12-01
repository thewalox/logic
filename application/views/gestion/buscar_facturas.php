	<section class="main container">
		<div class="row">
			<section class="posts col-md-12">
				<div class="miga-de-pan">
					<ol class="breadcrumb">
						<li><a href="<?php echo base_url(); ?>">Inicio</a></li>
						<li><a href="#">Gestion</a></li>
						<li class="active">Registro de Facturas y Entregas</li>
					</ol>
				</div>
				
				<div class="row">
					<div class="form-group col-md-12" id="respuesta"></div>
					<div class="container">
						<div class="input-group">
							<input type="text" name="filtro" id="filtro" class="form-control" placeholder="Buscar por.....">
							<span class="input-group-btn">
					        	<input type="button" name="aceptar" id="aceptar" value="Aceptar" class="btn btn-primary">
					        	<input type="button" name="cancelar" id="cancelar" value="Cancelar" class="btn btn-success" onclick="javascript:location.href = '<?php echo base_url().'gestion/form_buscar'; ?>';">
      						</span>
    					</div>
					</div>
				</div>
				<div class="form-group" id="content">
					<form name="form" method="post">
						<table class="table table-striped table-condensed table-hover">
							<thead>
								<tr>
									<th>Fecha</th>
									<th>Tipo Doc</th>
									<th>Documento</th>
									<th>Cliente</th>
									<th>Socio de Negocio</th>
									<th><a href="#" title="Editar Lote de facturas seleccionadas" id="lote"><span class="glyphicon glyphicon-duplicate"></span></a></th>
									<th></th>
									<th></th>
								</tr>
							</thead>
							<?php
								foreach ($facturas as $fac) {
									# code...
							?>
							<tr id="delete<?php echo $fac["docnum"]; ?>">
								<td><?php echo $fac["docdate"]; ?></td>
								<td><?php echo $fac["tipodoc"]; ?></td>
								<td><?php echo $fac["docnum"]; ?></td>
								<td><?php echo $fac["cardcode"]; ?></td>
								<td><?php echo $fac["cardname"]; ?></td>
								<td><input type="checkbox" name="FacMasivas[]" id="<?php echo $fac["docnum"]; ?>" value="<?php echo $fac["docnum"]; ?>"></td>
								<td><a href="<?php echo base_url('gestion/form_editar/'. $fac["docnum"]); ?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
								<td><a href="javascript:void(0);" class="delete" id="delete<?php echo $fac["docnum"]; ?>" data="<?php echo $fac["docnum"]; ?>"><span class="glyphicon glyphicon-trash"></span></a></td>
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
			//ejecuta la actualizacion en lote de las facturas
			$(document).on('click','#lote',function(){
				var num = 0;
				$('input:checkbox:checked').each(
				    function() {
				        num = num + 1;
				    }
				);

				if(num > 1){
					document.form.submit();
				}else{
					alert("Para actualizar documentos en lote debe seleccionar mas de una factura.");
				}
				
			});

			//elimina la factura seleccionada
			$(document).on('click','.delete',function(){
				
				if (confirm("Esta seguro de eliminar el documento " + $(this).attr('data'))){ 
					var parent = $(this).parent().parent().attr('id');
					var id = $(this).attr('data');
					//alert(parent);
					$.ajax({
			            type: "POST",
			            url: "<?php echo base_url('gestion/eliminar_factura'); ?>",
			            data:{
			    			'id'	: 	id
			    		},
			            success: function(data) { 
			            	console.log(data);
			    			var json = JSON.parse(data);

			    			for(datos in json){
								if (json.mensaje == 2) {
									$('#respuesta').empty();
			                		$('#respuesta').append("<div class='alert alert-success' role='alert'>Documento " + id + " Eliminado Exitosamente</div>").fadeIn("slow");
			                		$('#'+parent).remove();
								}else{
									$('#respuesta').empty();
									$('#respuesta').append("<div class='alert alert-danger' role='alert'>Ah ocurrido un error al eliminar este documento. Por favor revise la informacion o comuniquese con el administrador del sistema</div>").fadeIn("slow");
								}
							}
			            },
				    	error:function(jqXHR, textStatus, errorThrown){
				    		console.log('Error: '+ errorThrown);
				    	}
        			});
				}else{ 
					return false;
				}
			});
			
			//realiza la busqueda por medio del criterio de busqueda
			$('#aceptar').on('click',function(){
				var filtro = $("#filtro").val();
				//alert("ok");
			    $.ajax({
			    	type:"GET",
			    	url:"<?php echo base_url('gestion/get_facturas_criterio'); ?>",
			    	data:{
			    		'filtro'	: 	filtro
			    	},
			    	success:function(data){
			    		console.log(data);
			    		var json = JSON.parse(data);
			    		//alert(json.mensaje);
			    		var html = "";
			    		html += "<form name='form' method='post'>";
						html += "<table class='table table-striped table-condensed table-hover'>";
						html += "<thead>";
						html += "<tr>";
						html += "<th>Fecha</th>";
						html += "<th>Tipo Doc</th>";
						html += "<th>Documento</th>";
						html += "<th>Cliente</th>";
						html += "<th>Socio de Negocio</th>";
						html += "<th><a href='#' title='Editar Lote de facturas seleccionadas' id='lote'><span class='glyphicon glyphicon-duplicate'></span></a></th>";
						html += "<th></th>";
						html += "<th></th>";
						html += "</tr>";
						html += "</thead>";
						
							for(datos in json){
								html += "<tr id='" + json[datos].docnum + "'>";
								html +=	"<td>" + json[datos].docdate + "</td>";
								html +=	"<td>" + json[datos].tipodoc + "</td>";
								html +=	"<td>" + json[datos].docnum + "</td>";
								html +=	"<td>" + json[datos].cardcode + "</td>";
								html +=	"<td>" + json[datos].cardname + "</td>";
								html +=	"<td><input type='checkbox' name='FacMasivas[]' id='" + json[datos].docnum  + "' value='" + json[datos].docnum  + "'></td>";
								html +=	"<td><a href='<?php echo base_url('gestion/form_editar/" + json[datos].docnum  + "'); ?>'><span class='glyphicon glyphicon-pencil'></span></a></td>";
								html +=	"<td><a href='javascript:void(0);' class='delete' id='delete" + json[datos].docnum  + "' data='" + json[datos].docnum  + "'><span class='glyphicon glyphicon-trash'></span></a></td>";
								html += "</tr>";
						
							}
						
						html += "</table>";
						html += "</form>";
						
						$("#content").html(html);

			    	},
			    	error:function(jqXHR, textStatus, errorThrown){
			    		console.log('Error: '+ errorThrown);
			    	}
			    });

			});

		});
	</script>	