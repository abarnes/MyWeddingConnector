<script type="text/javascript">
$(document).ready(function(){
		$(".checkboxall").click(function(){
		  var checked_status = this.checked;
                    $("input[class=checkal]").each(function()
                    {
                     this.checked = true;
                    });
		 });
	       
});
$(document).ready(function() {
                $.get('/API/form_select.php', function(data) {
                    $('#LeadCarrierSelectForm').html(data);
                    $('#id-replace').val(getURLParameter('id'));
                });
});
            
function getURLParameter(name) {
                return decodeURI(
                    (RegExp(name + '=' + '(.+?)(&|$)').exec(location.search)||[,null])[1]
                );
}
</script>

<div class="container">
              <div class="span-24">
                  <a name="top"></a>
             <!-----------top bar---->
                      <div style="float:left;">
                          <img src="/img/logo.png" style="height:90px;position:relative;right:50px;"/>
                      </div>
                      
                      <div style="float:right;margin-right:30px;margin-top:36px;">
                          <a href="http://www.facebook.com/pages/My-Wedding-Connector/255185641182379" target="_blank"><img src="/img/fb.png" style='float:left;width:50px;margin-right:8px;'/></a>
                          <a href="http://twitter.com/mywedconnector" target="_blank"><img src="/img/twitter.png" style='float:left;width:50px;margin-right:8px;'/></a>
                          <img src="/img/phonenumber.png" style="width:230px;float:left;"/>
                      </div>
                  
                  <div class="top2" style="height:30px;">      
                  </div>
                  
              </div>
          </div>
      </div>        
    <!----end top bar---->

<div style="background-color:#E0EFF7;">
    <div class="container"> 
        <div class="span-24" style="height:642px;">
            <img src="/img/selecttext.png" style="width:950px;margin-top:-30px;position:relative;z-index:20;"/>

            <img src="/img/select-box.png" style="width:900px;margin-left:25px;margin-top:-30px;position:relative;z-index:21;height:520px;"/>
                    
        
            <div class="sel-form" style="margin-top:-420px;">
                
            <div style="float:left;">    
                <div class="sel-checkall">
                    <a class="checkboxall"><img src="/img/sel-checkbox.png" style="margin-top:4px;"/></a>
                    <a class="checkboxall"><img src="/img/sel-checkall.png" style="float:right;"/></a>
                    <br/><br/>
                </div>

                        <div id="LeadCarrierSelectForm"></div>

            </div>
                
            <img src="/img/sel-pic.png" class="sel-img"/>
            
            </div>
            
	    </form>
        </div>
    </div>
    <br/><br/>
    
</div>

<script type="text/javascript">
 
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-26105305-1']);
  _gaq.push(['_trackPageview']);
 
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
 
</script>