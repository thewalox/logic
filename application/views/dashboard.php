<div class="container">
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