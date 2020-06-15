<header>
  <h1> Welcome back, <?php echo $user ?></h1>
  <h2>Choose your adventure</h2>
</header>
<wrapper class="tabs"> 
  <div>My own adventures</div>
  <div>Involved adventures</div>
 </wrapper>
 <section class="vacation__list">

    <?php if ($vacations): ?>
        <?php foreach($vacations as $vacation): ?>
        <div class= "vacation">
          <a class="vacation__link" href="index.php?page=ownedVacation&amp;id=<?php echo $vacation['id'];?>">
            <p> <?php echo $vacation['name'] ?> </p>
            <p> <?php echo $vacation['status']*11 ?>% complete </p>
          </a>
        </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p>you have no adventures yet !</p>
        <img>
        <button>take off now</button>
      <?php endif; ?>

          


  </section>

 </section>

 <div class="navigation">
  <div>Home</div>
  <div>Rules</div>
  <div>+</div>
  <div>Guide</div>
  <div>Profile</div>
</div>
