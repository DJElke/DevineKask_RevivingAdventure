<header class="bg--red">
  <a href="index.php?page=home">
    <span class="close">&#10005;</span>
  </a>
  <h1> Welcome to <?php echo $vacation['name'] ?>!</h1>
  <wrapper class="participant__list">
    <?php foreach($participants as $participant): ?>
        <div class= "participant">
          <?php if($participant['description'] == 'Owner'): ?>
            <p> <?php echo $participant['description'] ?> </p>
          <?php else: ?>
            <p> &nbsp; </p>
          <?php endif; ?>
          <img class="user--icon" src='<?php echo $participant['icon'] ?>'/>
            <p> <?php echo $participant['name'] ?> </p>
          </a>
        </div>
    <?php endforeach; ?>
    <div class="participant">
      <input type="image" src="assets/icons/plus-icon.svg" class="user--icon" >
    </div>
  </wrapper>
  <div>
    <p><?php echo $status*11 ?>%</p>
  </div>
</header>
<section>
  <div <?php if($status >= 0): ?>
    class="unlocked" 
    <?php else: ?>
      class="locked" 
      <?php endif; ?>>
    <a class="station__link" <?php if($status == 0): ?> href="index.php?page=ownerStation1&amp;id=<?php echo $vacation['id'];?>" <?php endif; ?>>
      <p>Station one</p>
    </a>
    <?php if($status >= 1): ?><input type='checkbox' disabled='disabled' checked="true"><label>Playercards 4/4</label><?php else: ?><input type='checkbox' disabled='disabled'><label>Playercards 0/4</label><?php endif;?>
  </div> 

  <div <?php if($status >= 1): ?> class="unlocked" <?php else: ?> class="locked" <?php endif; ?>>
    <a class="station__link" <?php if($status == 1): ?> href="index.php?page=ownerStation2&amp;id=<?php echo $vacation['id'];?>" <?php endif; ?>>
      <p>Station two</p>
    </a>
    <?php if($status >= 2): ?><input type='checkbox' disabled='disabled' checked='true'><label>Item cards 26/26</label><?php else: ?><input type='checkbox' disabled='disabled'><label>Item cards 0/26</label><?php endif;?>
  </div> 

  <div <?php if($status >= 2): ?>class="unlocked" <?php else: ?>class="locked" <?php endif; ?>>
    <a class="station__link" <?php if($status == 2): ?> href="index.php?page=ownerStation3&amp;id=<?php echo $vacation['id'];?>" <?php endif; ?>>
      <p>Station three</p>
    </a>
    <?php if($status >= 3): ?><input type='checkbox' disabled='disabled' checked='true'><label>Adventure cards 27/27</label><?php else: ?><input type='checkbox' disabled='disabled'>Adventure cards 0/27</label><?php endif;?>
  </div> 

  <div <?php if($status >= 3): ?>class="unlocked" <?php else: ?> class="locked" <?php endif; ?>>
    <a class="station__link" <?php if($status == 3): ?> href="index.php?page=station4&amp;id=<?php echo $vacation['id'];?>" <?php endif; ?>>
      <p>Station four</p>
    </a>
    <?php if($status >= 4): ?><input type='checkbox' disabled='disabled' checked='true'><?php else: ?><input type='checkbox' disabled='disabled'><?php endif;?><label>Style vote</label>
  </div> 

    <div class="<?php if($status >= 4): ?>unlocked <?php else: ?>locked" <?php endif; ?>>
      <a class="station__link" <?php if($status == 4): ?> href="index.php?page=station5" <?php endif; ?>>
        <p>Station five</p>
      </a>
      <?php if($status >= 5): ?><input type='checkbox' disabled='disabled' checked='true'><label>Character cards revieuw 4/4</label><?php else: ?><input type='checkbox' disabled='disabled'><label>Character cards 0/4</label><?php endif;?>
    </div> 

    <div class="<?php if($status >= 5): ?>unlocked <?php else: ?>locked" <?php endif; ?>>
      <a class="station__link" <?php if($status == 5): ?>href="index.php?page=station6" <?php endif; ?>>
        <p>Station six</p>
      </a>
      <?php if($status >= 6): ?><input type='checkbox' disabled='disabled' checked='true'><label>Item cards revieuw 26/26</label><?php else: ?><input type='checkbox' disabled='disabled'><label>Item cards 0/26</label><?php endif;?>
    </div> 

    <div class="<?php if($status >= 6): ?>unlocked <?php else: ?>locked" <?php endif; ?>>
      <a class="station__link" <?php if($status == 6): ?>href="index.php?page=station7" <?php endif; ?>>
        <p>Station seven</p>
      </a>
      <?php if($status >= 7): ?><input type='checkbox' disabled='disabled' checked='true'><label>Adventure cards revieuw 27/27</label><?php else: ?><input type='checkbox' disabled='disabled'><label>Item cards 0/27</label><?php endif;?>
    </div> 

    <div class="<?php if($status >= 7): ?>unlocked <?php else: ?>locked" <?php endif; ?>>
      <a class="station__link" <?php if($status == 7): ?>href="index.php?page=station8" <?php endif; ?>>
        <p>station eight</p>
      </a>
      <?php if($status >= 8): ?><input type='checkbox' disabled='disabled' checked='true'><?php else: ?><input type='checkbox' disabled='disabled'><?php endif;?><label>Definitive style</label>
    </div> 

    <div class="<?php if($status >= 8): ?>unlocked <?php else: ?>locked" <?php endif; ?>>
      <a class="station__link" <?php if($status == 8): ?>href="index.php?page=order" <?php endif; ?>>
        <p>ORDER</p>
      </a>
      <?php if($status >= 8): ?><input type='checkbox' disabled='disabled' checked='true'><?php else: ?><input type='checkbox' disabled='disabled'><?php endif;?><label>Play IRL</label>
    </div> 

</section>