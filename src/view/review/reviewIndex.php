<header>
  <a href="index.php?page=home">
    <span class="close">&#10005;</span>
  </a>
  <?php if($status == 4): ?>
    <h1>Station five </h1>
    <h2>Review the player cards for each player</h2>
  <?php elseif($status == 5): ?>
    <h1>Station six </h1>
    <h2>Review the item cards for each player</h2>
  <?php else: ?>
    <h1>Station seven </h1>
    <h2>Review the adventure cards for each player</h2>
  <?php endif; ?>
</header>

<img src='assets/illustrations/quizmaster.svg'>
<p>Your friends edited the photo's you've uploaded. They also added some titles and descriptions. It's your turn to choose the best title  and description for them!<p>
<p>Swipe trough the titles and descriptions until you find a MATCH.</p>
<a href="index.php?page=review&amp;id=<?php echo $_GET['id'];?>" class="secondaryButton">START</a>
