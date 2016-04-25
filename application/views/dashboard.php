<div class="container">
	<div class="row">
		<div class="col-md-3">
			<div class="panel panel-primary">
				<div class="panel-heading text-center">TRM DEL DIA</div>
				<div class="panel-body">
					<ul class="list-group">
						<li class="list-group-item list-group-item-info text-center"><?php echo date("d-m-Y", strtotime($trm[0]["RateDate"])); ?></li>
					<?php
					foreach ($trm as $t) {
						//echo $t["Currency"];
					?>
					 	<li class="list-group-item active"><span class="badge"><?php echo number_format($t["Rate"],2,".",","); ?></span><?php echo $t["Currency"]; ?></li>
					<?php
					}
					?>	
					</ul>				
				</div>
			</div>
		</div>

		<div class="col-md-3">
			<div class="panel panel-primary">
				<div class="panel-heading text-center">ESTADO</div>
				<div class="panel-body">
					<ul class="list-group">
					<?php
					foreach ($estado as $est) {
						//echo $t["Currency"];
					?>
					 	<li class="list-group-item active"><span class="badge"><?php echo number_format($est["cantidad"],0,".",","); ?></span><?php echo $est["estado"]; ?></li>
					<?php
					}
					?>	
					</ul>				
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="panel panel-primary">
				<div class="panel-heading text-center">RESUMEN MENSUAL</div>
				<div class="panel-body">
					<ul class="list-group">
						<table class="table table-striped table-condensed">
							<thead>
								<tr>
									<th class="text-center">Periodo</th>
									<th class="text-center">Total Docs.</th>
									<th class="text-center">Total Docs. Despachados</th>
									<th class="text-center">Total Unds. Despachadas</th>
									<th class="text-center">Total Venta</th>
									<th class="text-center">Total Flete</th>
									<th class="text-center">% Cumplimiento</th>
								</tr>
							</thead>
							<tr>
								<td class="text-center"><?php echo $info->periodo; ?></th>
								<td class="text-center"><?php echo number_format($total->total,0,".",","); ?></th>
								<td class="text-center"><?php echo number_format($info->total_doc,0,".",","); ?></th>
								<td class="text-center"><?php echo number_format($info->total_unid,2,".",","); ?></th>
								<td class="text-center"><?php echo number_format($info->total_fact,2,".",","); ?></th>
								<td class="text-center"><?php echo number_format($info->total_flete,2,".",","); ?></th>
								<td class="text-center"><?php echo number_format(($info->total_doc / $total->total) * 100,2,".",","); ?></th>
							</tr>
						</table>	
					</ul>				
				</div>
		</div>
	</div>
</div>