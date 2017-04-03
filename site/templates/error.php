<?php snippet('header');?>

<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
  <header class="mdl-layout__header">
    <div class="mdl-layout__header-row">
      <!-- Title -->
      <span class="mdl-layout-title">Error</span>
      <!-- Navigation. We hide it in small screens. -->
    </div>
  </header>

  <main class="mdl-layout__content">
    <div class="page-content"><!-- Your content goes here -->
      <div class="information">
        <div class="mdl-card mdl-shadow--2dp">
            <div class="card-content">
            <h2>Error</h2>
            <p>Page could not be found</p>
              <a class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" href="<?php echo $site->url()?>">Go home</a>
          </div>
        </div>
      </div>
    </div>
  </main>
</div>


<?php snippet('footer') ?>