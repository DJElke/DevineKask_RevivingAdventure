<header class="header_profile">
  <a href="index.php?page=home">
    <span class="close">&#10005;</span>
  </a>
  <div class="profile_name"> 
    <img src="assets/user-icons/icon-watermelon.svg">
    <h1> Welcome back, <span class="purple">Elke</span>!</h1>
  </div>
  <div class="profile--buttons">
    <p class="profile--change-info--button">Change personal info<p>
    <p class="profile--logOut">Log out<p>
  </div>
</header>
<div class="profile--custimize-info">
  <div>
        <p class="customize-info-title">Change icon</p>
          <div class="color--options">
            <div><input type="radio"  id="lemon" name="ptAvatar" value="lemon"><label for="lemon" ><img src="assets/user-icons/icon-citrus.svg"></label></div>
            <div><input type="radio"  id="cocktail" name="ptAvatar" value="cocktail"><label for="cocktail" ><img src="assets/user-icons/icon-cocktail.svg"></label></div>
            <div><input type="radio"  id="backpack" name="ptAvatar" value="backpack"><label for="backpack" ><img src="assets/user-icons/icon-backpack.svg"></label></div>
            <div><input type="radio"  id="melon" name="ptAvatar" value="melon" checked=true><label for="melon" ><img src="assets/user-icons/icon-watermelon.svg"></label></div>
          </div>
      </div>

  <div>
    <p class="customize-info-title">Change color</p>
    <div class="color--options">
      <div>
      <input type="radio" class="color--option-blue" id="blue" name="blue" value="blue">
        <label for="blue" >
        <span class="blue--dot">
          <p>blue</p>
        </label>
      </div>
      <div><input type="radio" class="color--option" id="purple" name="purple" value="purple"><label for="purple" ><span class="purple--dot"><p>purple</p></label></div>
      <div><input type="radio" checked=true class="color--option" id="orange" name="orange" value="orange"><label for="orange" ><span class="orange--dot"><p>orange</p></label></div>
    </div>
  </div>

  <!-- <div>
    <p class="customize-info-title">Invite someone</p>
      <div class="invite--options">
        <div><input type="radio"><label for="text" ><img src="assets/icons/text.svg"></label></div>
        <div><input type="radio"><label for="mail" ><img src="assets/icons/mail.svg"></label></div>
        <div><input type="radio"><label for="messenger" ><img src="assets/icons/messenger.svg"></label></div>
      </div>
  </div> -->

  <div>
    <p class="customize-info-title">Previous card games</p>
    <div class="previous-cardgames">
      <a href="" class="previous-cardgame chernobyl">Chernobyl - Ukraine</a>
      <a href="" class="previous-cardgame surat">Surat - India</a>
      <a href="" class="previous-cardgame colombo">Colombo - Sri Lanka</a>
      <a href="" class="previous-cardgame ushkuduk">Ushkuduk - Oezbekistan</a>
    </div>
  </div>
</div>

<div class="profile--personal-info hide">
  <div>
    <label>Name:</label>
    <input type="text" value="Elke"></input>
  </div>

  <div>
    <label>Last name:</label>
    <input type="text" value="De Jonckere"></input>
  </div>

  <div>
    <label>Email:</label>
    <input type="email" value="elke@mail.com"></input>
  </div>

  <div>
    <label>Old password:</label>
    <input type="password"></input>
  </div>

  <div>
    <label>New password:</label>
    <input type="password"></input>
  </div>

  <div>
    <label>Re-type new password:</label>
    <input type="password"></input>
  </div>

  <div>
    <a class="profile--save">SAVE</a>
  </div>
</div>