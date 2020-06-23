<div class="dashboard__grid">
  <header class="dashboardIntro bg--red white profile_name">
    <div class="home--welcome">
      <h1> Welcome back, <span class="blue"><?php echo $user ?></span>!</h1>
      <p>Choose your adventure</p>
    </div>
  </header>

  <wrapper class="dashboardTabs bg--red"> 
    <div id="owned" class="containerItem--left blue dashboardTab">My own adventures</div>
    <div id="involved" class="containerItem--right blue dashboardTab">Involved adventures</div>
 </wrapper>

 <section class="dashboardList">
   <div class="ownedVac">
    <?php if ($ownedVacations): ?>
      <?php foreach($ownedVacations as $vacation): ?>
      <div class= "vacation">
        <a class="vacation__link" href="index.php?page=ownedVacation&amp;id=<?php echo $vacation['id'];?>">
          <p> <?php echo $vacation['name'] ?> </p>
          <div class="vacation--people">
            <img src="assets/icons/icon-people.svg">
            <p>4</p>
          </div>
          <div class="progressbar__border--thick">
            <p class="progressbar"> <?php echo $vacation['status']*11 ?>% complete </p>
          </div>
        </a>
      </div>
      <?php endforeach; ?>
      <?php else: ?>
        <p>you have no adventures yet !</p>
        <img>
        <button>take off now</button>
      <?php endif; ?>
   </div>

   <div class="involvedVac">
    <?php if ($involvedVacations): ?>
      <?php foreach($involvedVacations as $vacation): ?>
      <div class= "vacation">
        <a class="vacation__link" href="index.php?page=involvedVacation&amp;id=<?php echo $vacation['id'];?>">
          <p> <?php echo $vacation['name'] ?> </p>
          <div class="vacation--people">
            <img src="assets/icons/icon-people.svg">
            <p>5</p>
          </div>
          <div class="progressbar__border--thick">
            <p class="progressbar"> <?php echo $vacation['status']*11 ?>% complete </p>
          </div>
        </a>
      </div>
      <?php endforeach; ?>
      <?php else: ?>
        <p>If your friends invite you to a game </p></br> <p>it will be displayed here...</p>
        <img>
      <?php endif; ?>
   </div>
  </section>

  <div class="navigation bg--red white">
    <div class="navHome bold blue">Home</div>
    <div class="navRules white"><a href="index.php?page=rules">Rules</a></div>
    <div class="navAdd bg--blue text--big"><a href="index.php?page=createAdventure">+</a></div>
    <div class="navGuide white"><a href="index.php?page=guide">Guide</a></div>
    <div class="navProfile"><a href="index.php?page=profile">Profile</a></div>
  </div>
</div>

