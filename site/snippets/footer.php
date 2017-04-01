<?php echo js('https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js'); ?>

<script type="text/javascript">
  


function toggleNav(){
  $('.mdl-layout__drawer-button').toggleClass( "active" );
  $('.mdl-layout__drawer').toggleClass( "is-visible" );
  $('.mdl-layout__obfuscator').toggleClass( "is-visible" );
}

$('.js-toggleNav').click(toggleNav);






</script>

</body>
</html>