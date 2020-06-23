<header class="reviewpage">
  <a href="index.php?page=home">
    <span class="close">&#10005;</span>
  </a>
  <?php if($status == 4): ?>
    <h1 class="blue">Station five </h1>
    <p class="text--medium red text--margintop">Review the player cards for each player</p>
  <?php elseif($status == 5): ?>
    <h1 class="blue">Station six </h1>
    <p class="text--medium red text--margintop">Review the item cards for each player</p>
  <?php else: ?>
    <h1 class="blue">Station seven </h1>
    <p class="text--medium red text--margintop">Review the adventure cards for each player</p>
  <?php endif; ?>
</header>

<img class="startimage--review" src='assets/illustrations/quizmaster.svg'>
<p class="stationOneIntro__text text--medium">Your friends edited the photo's you've uploaded. They also added some titles and descriptions. It's your turn to choose the best title  and description for them!<p>
<p class="stationOneIntro__text text--medium">Swipe trough the titles and descriptions until you find a MATCH.</p>
<div class="startreview-button"><a href="index.php?page=review&amp;id=<?php echo $_GET['id'];?>" class="reviewpage1--intro">START</a></div>

