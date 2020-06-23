<div class="emptyHomeScreen">
  <div class="dashboard__grid">
    <header class="dashboardIntro bg--red white">
      <h1> Welcome back, <span class="blue">Elke</span>!</h1>
      <p>Choose your adventure</p>
    </header>

    <wrapper class="dashboardTabs bg--red"> 
      <div id="owned" class="containerItem--left blue dashboardTab">My own adventures</div>
      <div id="involved" class="containerItem--right blue dashboardTab">Involved adventures</div>
    </wrapper>

  <section class="dashboardList">
    <div class="ownedVac">
      <p>You have no adventures  yet!</p>
      <img src="assets/illustrations/plane-blue.svg">
      <a class="takeOff--button">Take off now</a>
    </div>

    <div class="involvedVac">
      <p>If your friends invite you to a game it will be displayed here...</p>
      <img src="assets/illustrations/wine.svg">
      <p> Make your own game</p> 
      <img src="assets/illustrations/arrow.svg">
  </div>
  </section>

    <div class="navigation bg--red white">
      <div class="navHome bold blue">Home</div>
      <div class="navRules">Rules</div>
      <div class="navAdd bg--blue text--big takeOff--button">+</div>
      <div class="navGuide">Guide</div>
      <div class="navProfile">Profile</div>
    </div>
  </div>
</div>

<div class="personalizeVacation hide">
  <a class="createAdventure--close">
    <span class="close">&#10005;</span>
  </a>
  <h1>Create a new game</h1>
  <div class="shop--crumble">
    <div><span class="createGame-dot"></span><p>Personalize</p></div>
    <div><span class="createGame-open-dot"></span><p>Invite</p></div>
    <div><span class="createGame-open-dot"></span><p>Take-off</p></div>
  </div>

  <div>
    <p>personalize</p>
    <p>invite</p>
    <p>take-off</p>
  </div>
  <div>
    <label><p>What's your destination?</p>
    <img src="assets/icons/place-icon.svg">
    <input type=text placeholder="e.g. Disneyland Paris">
    </label>
  </div>

  <div>
      <p >What was the vacation feeling</p>
        <div class="color--options">
          <div><input type="radio"><label for="spring" ><img src="assets/icons/spring-vanilla-breeze.svg"></label></div>
          <div><input type="radio"><label for="freezing" ><img src="assets/icons/freezing-adrenaline.svg"></label></div>
          <div><input type="radio"><label for="coffee" ><img src="assets/icons/crowded-coffee-shop.svg"></label></div>
        </div>
    </div>

    <div>
    <a class="invite--button">NEXT</a>
  </div>
</div>

<div class="inviteFriends hide">
  <a class="createAdventure--close">
    <span class="close">&#10005;</span>
  </a>
  <h1>Create a new game</h1>
  <div class="shop--crumble">
    <div><span class="createGame-dot"></span><p>Personalize</p></div>
    <div><span class="createGame-dot"></span><p>Invite</p></div>
    <div><span class="createGame-open-dot"></span><p>Take-off</p></div>
  </div>  
  <div>
    <p>personalize</p>
    <p>invite</p>
    <p>take-off</p>
  </div>
  <div>
    <p>Invite your fellow travelers</p>
    <p>Invite everyone who has been on the vacation with you.</p>
    <div>
      <img src="assets/icons/friend.svg">
      <input type=text placeholder="e.g. Mary mary">
    </div>
  </div>

  <div>
    <p>Added friends: </p><p>O</p>
      
  </div>
  <div>
    <p >Other invite options</p>
      <div class="invite--options">
        <div><input type="radio"><label for="text" ><img src="assets/icons/text.svg"></label></div>
        <div><input type="radio"><label for="mail" ><img src="assets/icons/mail.svg"></label></div>
        <div><input type="radio"><label for="messenger" ><img src="assets/icons/messenger.svg"></label></div>
      </div>
  </div>

  <div>
    <a href="index.php?page=home">NEXT</a>
  </div>
</div>

<div class="overlay">

  <div>
    <p>If you quit now your progress will be lost. </p>
    <a href="index.php?page=home">OK</a>
  </div>

</div>
