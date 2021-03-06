<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">

<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>MyWeddingConnector - Dallas/Ft. Worth</title>
  
  <script src="/js/jquery.js"></script>
  <script src="/js/jquery-ui.js"></script>
  <script src="/js/countdown.js"></script>
  <script src="/shadowbox/shadowbox.js"></script>
  <script src="/API/js/leadcarrier-info_page.js" type="text/javascript"></script>
  
  <LINK REL=StyleSheet HREF="/shadowbox/shadowbox.css" TYPE="text/css" MEDIA=screen>
  <?php echo $html->css('blueprint/screen'); ?>
  <?php echo $html->css('blueprint/print'); ?>
  <?php echo $html->css('custom'); ?>
  <!--[if lt IE 8]>
    <?php echo $html->css('blueprint/ie'); ?>
  <![endif]-->
  
  <script type="text/javascript">
  Shadowbox.init({
    skipSetup: true
  });
  
  $(document).ready(function() {
    $("#priv").click(function() {
      var ff = '<div class="shdiv"><h3><b>MyWeddingConnector.com</b><br/><br/>Privacy Policy</h3><?php echo file_get_contents('docs/privacypolicy.html'); ?></div>';
      // open a welcome message as soon as the window loads
      Shadowbox.open({
          content:    ff,
          player:     "html",
          title:      "Privacy Policy",
          height:     900,
          width:      800
      });
    });
    
    $(".oterms").click(function() {
      var ff = '<div class="shdiv"><h3><b>MyWeddingConnector.com</b><br/><br/>Terms of Use</h3><?php echo file_get_contents('docs/termsofuse.html'); ?></div>';
      // open a welcome message as soon as the window loads
      Shadowbox.open({
          content:    ff,
          player:     "html",
          title:      "Terms of Use",
          height:     900,
          width:      800
      });
    });
  });
  
   jQuery(function() {
	jQuery.support.placeholder = false;
	test = document.createElement('input');
	if('placeholder' in test) jQuery.support.placeholder = true;
   });
  
   $(function() {
	if(!$.support.placeholder) { 
		var active = document.activeElement;
		$(':text').focus(function () {
			if ($(this).attr('placeholder') != '' && $(this).val() == $(this).attr('placeholder')) {
				$(this).val('').removeClass('hasPlaceholder');
			}
		}).blur(function () {
			if ($(this).attr('placeholder') != '' && ($(this).val() == '' || $(this).val() == $(this).attr('placeholder'))) {
				$(this).val($(this).attr('placeholder')).addClass('hasPlaceholder');
			}
		});
		$(':text').blur();
		$(active).focus();
		$('form').submit(function () {
			$(this).find('.hasPlaceholder').each(function() { $(this).val(''); });
		});
	}
   });
  </script>
  
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-26105305-1']);
  _gaq.push(['_setDomainName', 'myweddingconnector.com']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
  
  </head>
  <body>
    <?php //echo file_get_contents('docs/termsofuse.html'); ?>
    <div style="width:100%;height:90px;background-image:url('/img/headerback.png');background-repeat:repeat-x;">
      
        <?php echo $content_for_layout; ?>
      
      <!----footer--->
      <div class="foot">    
          <div class="container">    
              <div class="span-24">
                  <p style="float:left;margin-left:45px;">&copy; 2012 My Wedding Connector. All rights reserved.</p>
                  
                  <p style="float:right;margin-right:45px;"><a href="#" id="priv">Privacy Policy</a> | <a href="#" class="oterms">Terms of Use</a></p>
              </div>
          </div>
      </div>      
  </body>
</html>