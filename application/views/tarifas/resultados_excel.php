<div class="alert alert-success alert-dismissible text-center" role="alert">
  <div><strong>Archivo importado correctamente</strong></div>
  <div>Registros Agregados: <?php echo $add; ?></div>
  <div>Registros Actualizados: <?php echo $edit; ?></div>
</div>
<div align="center"><input type="button" name="cancelar" id="cancelar" value="Regresar" class="btn btn-success" onclick="javascript:location.href = '<?php echo base_url().'tarifas/form_importar_lote'; ?>';"></div>