<div class="dashboard__grid">
  <header class="dashboardIntro bg--red white">
    <h1> Welcome back, <span class="blue"><?php echo $user ?></span>!</h1>
    <p>Choose your adventure</p>
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
          <p> <?php echo $vacation['status']*11 ?>% complete </p>
          <div class="progressbar">
            <!-- ik zat hier -->
            <span class=""></span>
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
          <p> <?php echo $vacation['status']*11 ?>% complete </p>
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
    <div class="navRules">Rules</div>
    <div class="navAdd bg--blue text--big">+</div>
    <div class="navGuide">Guide</div>
    <div class="navProfile">Profile</div>
  </div>
</div>

