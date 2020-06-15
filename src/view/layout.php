<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" content="width=device-width, user-scalable=no">
    <title><?php echo $title; ?></title>
    <?php /* NEW */ ?>
    <?php echo $css;?>
  </head>
  <body>
    <main>
      <!-- <header><h1><?php echo $title; ?></h1></header> -->
      <?php echo $content;?>
    </main>
    <?php echo $js; ?>
  </body>
</html>
