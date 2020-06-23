<section class="editorIndex__grid">
<?php if($status == 0){ ?> 
  <article class="editorStationTitle">
    <h1 class="blue">Station one
      <a href="index.php?page=home">
        <span class="close">&#10005;</span>
      </a>
    </h1>
  </article>
  <img class="editorStationImg" src='assets/illustrations/passport.svg'/>
  <p class="editorStationText red">Character cards! Edit your friend's pictures and give them a fun description.</p>
  </br>
<?php } ?> 
<?php if($status == 1){ ?> 
  <article class="editorStationTitle">
    <h1 class="blue">Station two
      <a href="index.php?page=home">
        <span class="close">&#10005;</span>
      </a>
    </h1>
  </article>
  <img class="editorStationImg" src='assets/illustrations/backpack.svg'>
  <p class="editorStationText red">Adventure cards! Edit the picture and give your most memorable adventures a nice title and description.</p>
  </br>
<?php } ?> 

<?php if($status == 2){ ?> 
  <h1 class="blue">Station cards</h1>
  <img src='assets/illustrations/plane.svg'>
  <p class="red">Item cards! Edit the picture and give the items from your vacation a fun title and description!</p>
  </br>
<?php } ?> 

<a href="index.php?page=photoEditor&amp;id=<?php echo $vacation['id'];?>" class="editorStationButton secondaryButton">START</a>
</section>

