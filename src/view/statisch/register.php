<div class="loginRegister">
  <div>
    <p class="title_register">Hello <b>stranger</b>!</p>
    <p class="subtitle_register">Let's go on an adventure ...</p>
  </div>

  <div class="loginandregister_button">
    <a class="register--button">REGISTER</a>
    <a class="login--button">LOGIN</a>
  </div>
</div>

<div class="hide personaliseAccount">
  <div>
    <p class="title_register">Hello <b>stranger!</b></p>
    <p class="subtitle_register">Let's go on an adventure</p>
  </div>

    <div class="register--name">
      <label for="ptName">What's your name good-looking?</p>
      <input class="input_register" placeholder="e.g. Handsome Harry" id="ptName" name="ptName">
    </div>

    <div class="register--color">
      <p>What's your favorite color</p>
      <div class="color--options">
        <div><input type="radio" class="color--option" id="blue" name="coloroption" value="blue"><label for="blue" ><span class="blue--dot"><p class="namecolor_register">blue</p></label></div>
        <div><input type="radio" class="color--option" id="purple" name="coloroption" value="purple"><label for="purple" ><span class="purple--dot"><p class="namecolor_register">purple</p></label></div>
        <div><input type="radio" class="color--option" id="orange" name="coloroption" value="orange"><label for="orange" ><span class="orange--dot"><p  class="namecolor_register">orange</p></label></div>
      </div>
    </div>

  <div class="register--avatar">
      <p >Choose your avatar</p>
        <div class="color--options">
          <div><input type="radio"  id="lemon" name="ptAvatar" value="lemon"><label for="lemon" ><img src="assets/user-icons/icon-citrus.svg"></label></div>
          <div><input type="radio"  id="cocktail" name="ptAvatar" value="cocktail"><label for="cocktail" ><img src="assets/user-icons/icon-cocktail.svg"></label></div>
          <div><input type="radio"  id="backpack" name="ptAvatar" value="backpack"><label for="backpack" ><img src="assets/user-icons/icon-backpack.svg"></label></div>
          <div><input type="radio"  id="melon" name="ptAvatar" value="melon"><label for="melon" ><img src="assets/user-icons/icon-watermelon.svg"></label></div>
        </div>
    </div>
    <div class="register--nextbotton">
    <a class="personaliseAccount--button">NEXT</a>
  </div>
</div>

<div class=" hide personalData">
  <p class="title_register">Hello <b><span class="blue">Elke!</span></b><p>
  <p class="subtitle_register">Let's set up your account<p>
  <div class="register--final--input">
    <label for="ptEmail">E-mail:<br></label>
    <input class="input_register" type=email placeholder="e.g. harry@handsome.org" name="ptEmail">
  </div>
  <div class="register--final--input">
    <label for="ptPassword">Strong password:<br></label>
    <input class="input_register" type=password placeholder="iamsohandsome321" name="ptPassword">
  </div>
  <div class="register--final--input">
    <label for="ptPasswordRe">Re-type password:<br></label>
    <input class="input_register" type=password placeholder="iamsohandsome321" name="ptPasswordRe">
  </div>
  <div class="register--finishedbotton">
    <a class="registerFinished--button" href="index.php?page=home">REGISTER</a>
  </div>
</div>

<div class="hide login" >
  <h1 class="title_register">Welcome back!</h1>

  <div class="register--final--input">
    <label>E-mail:</label>
    <input class="input_register" type=email placeholder="e.g. harry@handsome.org">
  </div>
  <div class="register--final--input">
    <label>Password:</label>
    <input class="input_register" type=password placeholder="iamsohandsome321">
    <p class="login--forgotPassword">Forgot your password?</p>
  </div>
  <div class="loginImage">
    <img class="login--image" src="assets/illustrations/plane-gray.svg">
  </div>
  <div class="loginFinished">
    <a class="loginFinished--button" href="index.php?page=home">LOGIN</a>
  </div>
  <div class="nologin">
    <a class="nologin--button" href="index.php?page=register">I have no account yet</a>
  </div>
</div>