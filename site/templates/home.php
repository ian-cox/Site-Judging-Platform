<?php snippet('header');?>

<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
  <header class="mdl-layout__header">
    <div class="mdl-layout__header-row">
      <!-- Title -->
      <span class="mdl-layout-title"><?php echo $site->title()?></span>
      <!-- Navigation. We hide it in small screens. -->
    </div>
  </header>

  <main class="mdl-layout__content">
    <div class="page-content"><!-- Your content goes here -->
      <div class="information">
        <div class="mdl-card mdl-shadow--2dp">
            <div class="card-content">
            <h2>Select an Event</h2>
            <?php if(count($pages->visible()) > 0):?>
            <ul>
              <?php foreach($pages->visible() as $item): ?>
              <li><a href="<?php echo $item->url() ?>"><?php echo html($item->title()) ?></a></li>
              <?php endforeach ?>
            </ul>
          <?php else: ?>
            <p>Please make sure you've added an event and the event is visible.</p>
            <a class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" href="<?php echo $site->url()."/panel"?>">Login</a>
          <?php endif ?>
          </div>
        </div>
      </div>
    </div>
  </main>
</div>


<?php snippet('footer') ?>