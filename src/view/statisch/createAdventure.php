<div class="emptyHomeScreen">
  <div class="dashboard__grid">
    <header class="dashboardIntro bg--red white">
      <h1> Welcome back, <span class="blue">Elke</span>!</h1>
      <p>Choose your adventure</p>
    </header>

    <wrapper class="dashboardTabs bg--red"> 
      <div id="owned" class="containerItem--left blue dashboardTab"><p>My own adventures</p></div>
      <div id="involved" class="containerItem--right blue dashboardTab"><p>Involved adventures</p></div>
    </wrapper>

  <section class="dashboardList">
    <div class="ownedVac">
      <div class="empty">
        <p>You have no adventures  yet!</p>
        <img src="assets/illustrations/plane-orange.svg">
        <a class="takeOff--button btn-takeOff">Take off now</a>
      </div>
    </div>

    <div class="involvedVac">
    <div class="empty">
      <p>If your friends invite you to a game it will be displayed here...</p>
      <img src="assets/illustrations/wine-orange.svg">
      <p> Make your own game</p> 
      <img class="img-arrow" src="assets/illustrations/arrow-orange.svg">
    </div>
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
  <h1 class="header--new-game">Create a new game</h1>
  <div class="create--crumble">
    <div>
      <span class="line"></span>
      <span class="createGame-dot"></span>
      <p>Personalize</p>
    </div>
    <div>
      <span class="line-dotted"></span>
      <span class="createGame-open-dot"></span>
      <p>Invite</p>
    </div>
    <div>
      <span class="line-dotted"></span>
      <span class="createGame-open-dot"></span>
      <p>Take-off</p>
    </div>
  </div>

  <!-- <div>
    <p>personalize</p>
    <p>invite</p>
    <p>take-off</p>
  </div> -->
  <div class="create-new-label">
    <label>
      <p class="create-new-title">What's your destination?</p>
    <div class="destination-input">
      <img src="assets/icons/place-icon.svg">
      <input type=text placeholder="e.g. Disneyland Paris">
    </div>
    </label>
  </div>

  <div class="create-new-label">
      <p class="create-new-title">What was the vacation feeling</p>
        <div class="color--options-new">
            <input type="radio" id="spring">
            <label for="spring">
              <img src="assets/icons/spring-vanilla-breeze.svg">
              <p>Spring vanilla breeze</p>
            </label>
            <input type="radio" id="freezing">
            <label for="freezing" >
              <img src="assets/icons/freezing-adrenaline.svg">
              <p>Freezing adrenaline</p>
            </label>
            <input type="radio" id="coffee">
            <label for="coffee" >
              <img src="assets/icons/crowded-coffee-shop.svg">
              <p>Crowded coffee shop</p>
            </label>
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
  <h1 class="header--new-game">Create a new game</h1>
  <div class="create--crumble">
    <div>
      <span class="line"></span>
      <span class="createGame-dot"></span>
      <p>Personalize</p>
    </div>
    <div>
      <span class="line"></span>
      <span class="createGame-dot"></span>
      <p>Invite</p>
    </div>
    <div>
      <span class="line-dotted"></span>
      <span class="createGame-open-dot"></span>
      <p>Take-off</p>
    </div>
  </div>

  <div>
    <p class="create-new-title">Invite your fellow travelers</p>
    <p class="create-new-subText">Invite everyone who has been on the vacation with you.</p>
    <div class="destination-input">
      <img src="assets/icons/friend.svg">
      <input type=text placeholder="e.g. Mary mary">
    </div>
  </div>

  <div class="added-friends">
    <p class="create-new-title">Added friends:</p>
    <p class="counting-friends">1</p>
  </div>
  <div class="invited-friend">
    <img src="assets/user-icons/icon-cocktail.svg" alt="">
    <p>Camille Buyle</p>
  </div>
  <div>
    <p class="create-new-title">Other invite options</p>
    <div class="invite--options">
        <div><input type="radio"><label for="text" ><img src="assets/icons/text.svg">text</label></div>
        <div><input type="radio"><label for="mail" ><img src="assets/icons/mail.svg">mail</label></div>
        <div><input type="radio"><label for="messenger" ><img src="assets/icons/messenger.svg">messenger</label></div>
      </div>
  </div>

  <div>
    <a class="invite--button" href="index.php?page=home">NEXT</a>
  </div>
</div>

<div class="overlay">

  <div class="warning-quit">
    <p>If you quit now your progress will be lost. </p>
    <a href="index.php?page=home">OK</a>
  </div>

</div>
