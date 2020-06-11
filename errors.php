<!--Ako su izbrojani errori veći od nule -->
<?php  if (count($errors) > 0) : ?>
  
  <div class="error">
  	<?php foreach ($errors as $error) : ?>
  	  <p><?php echo $error ?></p>
	  <?php endforeach ?>
  </div>
  
  <!--kraj if the end of if-->
<?php  endif ?>