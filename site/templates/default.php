<?php snippet('header');

function allowEmbed($url) {
    $header = @get_headers($url, 1);
    if (!$header) return false;
    elseif (isset($header['X-Frame-Options'])) {
      return false;}
    return true;
}

if(param()):
  
  $data = $page->sites()->toStructure()->toArray();
  if(param('before')):
    $sitetitle = param('before');
  else:
    $sitetitle = param('site');
  endif;
  
  //Get key value for current, next and previous
  $i = 0;
  foreach($data as $submission){  
    $i++;
    if($sitetitle == $submission->sitetitle->value){
      $prev_key = $i - 2 ;
      $current_key = $i - 1;
      $next_key = $i ;
    }
  }
  
  //Build URL's
  $before_url = $page->url()."/before:".urlencode ($data[$current_key]->sitetitle->value);
  $current_url = $page->url()."/site:".urlencode ($data[$current_key]->sitetitle->value);
  if ($current_key > 0 ){
    $prev_url = $page->url()."/site:".urlencode ($data[$prev_key]->sitetitle->value);
  }
  if($current_key < count($data)-1){
    $next_url = $page->url()."/site:".urlencode ($data[$next_key]->sitetitle->value);
  }

  //Build Before and After Switch
  if(param('before')):
    $iframe_src = $data[$current_key]->before->value;
    $toggle_url = $current_url;
  else:
    $iframe_src = $data[$current_key]->after->value;
    $toggle_url = $before_url;
  endif;

endif;


//Set Title Vars
if(isset($current_key)):
  $team = $data[$current_key]->team->value;
  $sitetitle = $data[$current_key]->sitetitle->value;
else:
  $team = $site->title()->html();
  $sitetitle = $page->title()->html();
endif;
?>
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">

      <header class="mdl-layout__header">
        <div class="mdl-layout__header-row">
        
        <?php if($page->sites()->exists()): ?>
          <div disabled aria-expanded="false" role="button" tabindex="0" class="mdl-layout__drawer-button js-toggleNav"><i class="material-icons">menu</i></div>
        <?php endif ?>

        <div class="mdl-layout__obfuscator js-toggleNav"></div>
          <!-- Title -->
          <span class="mdl-layout-title"><?php echo $team." — ".$sitetitle?>
            <?php if(param('before')){echo "(BEFORE)";}?>
          </span>
          <!-- Add spacer, to align navigation to the right -->
          <div class="mdl-layout-spacer"></div>
          <!-- Navigation. We hide it in small screens. -->
          <nav class="mdl-navigation mdl-layout--large-screen-only">

          <?php if(param()): ?>

              <?php if(!empty($data[$current_key]->before->value)):?>
                <a class="mdl-button" href="<?php echo $toggle_url?>">Compare</a>
              <?php endif ?>
  
              <?php if(isset($prev_url)): ?>
                <a class="mdl-button mdl-button--icon" href="<?php echo $prev_url?>"><i class="material-icons"> arrow_back</i>  </a>
              <?php else: ?>
                <a class="mdl-button mdl-button--icon" href="<?php echo $page->url()?>"><i class="material-icons">arrow_back</i></a>
              <?php endif?>
    
              <?php if(isset($next_url)): ?>
                <a class="mdl-button mdl-button--icon" href="<?php echo $next_url?>"><i class="material-icons"> arrow_forward </i></a>
              <?php else: ?>
                <a disabled class="mdl-button mdl-button--icon"><i class="material-icons">arrow_forward</i></a>
              <?php endif?>
          
          <?php else: ?>
            <a disabled class="mdl-button mdl-button--icon"><i class="material-icons">arrow_back</i></a>

            <?php if(!$page->sites()->isEmpty()): ?>
              <a class="mdl-button mdl-button--icon" href="<?php echo $page->url()."/site:".urlencode($page->sites()->toStructure()->first()->sitetitle())?>"><i class="material-icons"> arrow_forward</i></a>
            <?php else: ?>
              <a disabled class="mdl-button mdl-button--icon"><i class="material-icons">arrow_forwards</i></a>  
            <?php endif ?>
            
          <?php endif?>
          
          </nav>
        </div>
      </header>


      <div class="mdl-layout__drawer js-toggleNav">
        <a class="mdl-layout-title" href="<?php echo $page->url()?>">48in48</a>
        <nav class="mdl-navigation">
          <?php foreach($page->sites()->toStructure() as $submission): ?>
            <a class="mdl-navigation__link" href="<?php echo $page->url()."/site:".urlencode ($submission->sitetitle())?>">
              <strong><?php echo $submission->team()->html() ?></strong><br><?php echo $submission->sitetitle()->html() ?>
            </a>
          <?php endforeach ?>
        </nav>
      </div>

      <main class="mdl-layout__content">
        <div class="page-content"><!-- Your content goes here -->
          <?php if(param()):
            if(allowEmbed($iframe_src)):?>
              <iframe src="<?php echo $iframe_src?>" frameborder="0" allowfullscreen></iframe>
            <?php else: ?>
              <div class="information">
                <div class="mdl-card mdl-shadow--2dp">
                  <div class="card-content">
                    <h2>The <?php echo $sitetitle ?> site could not be embeded.</h2>
                    <a class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" target="_blank" href="<?php echo $iframe_src?>">Open in new window<i class="material-icons">open_in_new</i>
                    </a>
                  </div>
              </div>  
            <?php endif ?>
          
          <?php else: ?>

          <div class="information">
            <div class="mdl-card mdl-shadow--2dp">
                <div class="card-content">
                <h2><?php echo $page->title()->html() ?></h2>
                <?php if(!$page->sites()->isEmpty()): ?>
                <p>
                Use the navigation arrows on the right to view each site. Alternatively, jump to a specific site by selecting it from the menu on the left. Click compare to toggle between the old and new site design.
                </p>
                  <a class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" href="<?php echo $page->url()."/site:".urlencode($page->sites()->toStructure()->first()->sitetitle())?>">Get Started</a>
                <?php else: ?>
                <p>No websites have been added to the judging platform yet.</p>
                  <a class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" href="<?php echo $site->url()."/panel"?>">Login</a>
                <?php endif ?>
              </div>
            </div>
          </div>

          <?php endif; ?>

        </div>
      </main>
</div>


<?php snippet('footer') ?>