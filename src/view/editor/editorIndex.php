<?php if($status == 0){ ?> 
  <h1 class="blue">Station one</h1>
  <p class="red">Character cards! Edit your friend's pictures and give them a fun description.</p>
  </br>
<?php } ?> 
<?php if($status == 1){ ?> 
  <h1 class="blue">Station two</h1>
  <p class="red">Adventure cards! Give your most memorable adventures a nice title and description.</p>
  </br>
<?php } ?> 

<a href="index.php?page=photoEditor&amp;id=<?php echo $vacation['id'];?>" class="secondaryButton">START</a>
