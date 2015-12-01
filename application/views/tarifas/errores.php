<div class="alert alert-danger alert-dismissible text-center" role="alert">
  <strong>Error al importar este archivo: </strong><?php echo $error; ?>
</div>
<div align="center"><input type="button" name="cancelar" id="cancelar" value="Regresar" class="btn btn-success" onclick="javascript:location.href = '<?php echo base_url().'tarifas/form_importar_lote'; ?>';"></div>