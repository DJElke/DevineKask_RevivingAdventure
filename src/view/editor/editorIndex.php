<?php if($status == 0){ ?> 
  <h1 class="blue">Station one</h1>
  <p class="red">Character cards! Edit your friend's pictures and give them a fun description.</p>
  </br>
<?php } ?> 
<?php if($status == 1){ ?> 
  <h1 class="blue">Station two</h1>
  <p class="red">Adventure cards! Edit the picture and give your most memorable adventures a nice title and description.</p>
  </br>
<?php } ?> 

<?php if($status == 2){ ?> 
  <h1 class="blue">Station cards</h1>
  <p class="red">Item cards! Edit the picture and give the items from your vacation a fun title and description!</p>
  </br>
<?php } ?> 

<a href="index.php?page=photoEditor&amp;id=<?php echo $vacation['id'];?>" class="secondaryButton">START</a>
