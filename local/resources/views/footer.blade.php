<?php 
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;
$ncurrentPath= Route::getFacadeRoot()->current()->uri();
$url = URL::to("/");
$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
$users = DB::select('select * from users where id = ?',[$setid]);	


$aid=1;
		$admindetails = DB::table('users')
		 ->where('id', '=', $aid)
		 ->first();
		
		$admin_email = $admindetails->email;
		
$colname = "footer-menu";
	$pages_cnt = DB::table('pages')
				->whereRaw('FIND_IN_SET(?,menu_position)', [$colname])
                ->orderBy('menu_order','asc')
				->count();

$user_list_count = DB::table('users')
		           ->where('id', '!=', 1)
				   ->where('delete_status', '=', '')
		           ->count();	

$sett_meta_well_two = DB::table('settings_meta')
		        ->where('sett_meta_id', '=' , 2)
				->where('sett_meta_key', '=' , "site_back_to_top")
		        
				->count();
				
			if(!empty($sett_meta_well_two))
			{	
		   $sett_meta_two =  DB::table('settings_meta')
		        ->where('sett_meta_id', '=' , 2)
				->where('sett_meta_key', '=' , "site_back_to_top")
		        
				->get();
			$site_back_to_top = $sett_meta_two[0]->sett_meta_value;
			}
			else
			{
			$site_back_to_top = "";
			}

$default = DB::table('avig_language')
	              ->where('lang_default','=',1)
		           ->get();


$default_cnt = DB::table('avig_language')
	              ->where('lang_default','=',1)
		           ->count();
if(!empty(Cookie::get('lang'))){ $lang = Cookie::get('lang'); } else { if(!empty($default_cnt)){ $lang = $default[0]->lang_code; } else { $lang = "en"; } }	
function foot_translate($id,$lang) 
{					
	if($lang == "en")
	{
	$translate = DB::table('avig_translate')
		            
					->where('lang_code', '=', $lang)
					->where('id', '=', $id)
					->get();
					
		$translate_cnt = DB::table('avig_translate')
		            
					->where('lang_code', '=', $lang)
					->where('id', '=', $id)
					->count();			
	}
	else
	{
	$translate = DB::table('avig_translate')
		            
					->where('lang_code', '=', $lang)
					->where('parent', '=', $id)
					->get();
					
		$translate_cnt = DB::table('avig_translate')
		            
					->where('lang_code', '=', $lang)
					->where('parent', '=', $id)
					->count();			
	}				
	if(!empty($translate_cnt))
	{
					return $translate[0]->name;
	}
	else
	{
	  return "";
	}
}



$sett_meta_cookie = DB::table('settings_meta')
		        ->where('sett_meta_id', '=' , 75)
				->where('sett_meta_key', '=' , "site_cookie")
		        
				->count();
				
			if(!empty($sett_meta_cookie))
			{	
		   $sett_meta_two =  DB::table('settings_meta')
		        ->where('sett_meta_id', '=' , 75)
				->where('sett_meta_key', '=' , "site_cookie")
		        
				->get();
			$site_cookie = $sett_meta_two[0]->sett_meta_value;
			}
			else
			{
			$site_cookie = "";
			}


$sett_meta_cookie_position = DB::table('settings_meta')
		        ->where('sett_meta_id', '=' , 76)
				->where('sett_meta_key', '=' , "site_cookie_position")
		        
				->count();
				
			if(!empty($sett_meta_cookie_position))
			{	
		   $sett_meta_two =  DB::table('settings_meta')
		        ->where('sett_meta_id', '=' , 76)
				->where('sett_meta_key', '=' , "site_cookie_position")
		        
				->get();
			$site_cookie_position = $sett_meta_two[0]->sett_meta_value;
			}
			else
			{
			$site_cookie_position = "";
			}								   												
?>


 
     
     
<footer class="footer-area">
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 col-sm-4">
                        <div class="footer-widget">
                            <h3 class="footer-title"><?php echo foot_translate( 178, $lang);?></h3>
                            <ul class="product-list">
                                
                                <?php
					$cate_cnts = DB::table('category')
								 ->where('delete_status','=','')
								 ->where('lang_code','=',$lang)
								 ->where('cat_type','=','default')
								 ->where('status','=',1)
								 ->orderBy('id','desc')
								 ->take(5)
								 ->count();
					if(!empty($cate_cnts))
					{
					
					$views_category = DB::table('category')
								 ->where('delete_status','=','')
								 ->where('status','=',1)
								 ->where('lang_code','=',$lang)
								 ->where('cat_type','=','default')
								 ->orderBy('id','desc')
								 ->take(5)
								 ->get();	
					foreach($views_category as $views){	
					
					if($lang == "en")
											  {
												$catt_id = $views->id; 
											  }
											  else
											  {
												 $catt_id = $views->parent;
											  }			 		 
					?>
                                <li><a href="<?php echo $url;?>/search/search/<?php echo $catt_id;?>_cat/<?php echo $views->post_slug;?>"><?php echo $views->cat_name;?></a>
                                </li>
                               <?php } } ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-4">
                        <div class="footer-widget support-pd">
                            <h3 class="footer-title"><?php echo foot_translate( 490, $lang);?></h3>
                            <ul class="our-support">
                            <?php if(!empty($pages_cnt)){
									 $colname = "footer-menu";
									 $pages = DB::table('pages')
									          ->where('lang_code','=',$lang)
									          ->whereRaw('FIND_IN_SET(?,menu_position)', [$colname])
                                              ->orderBy('menu_order','asc')
					                          ->get();
									 ?>
                                 <?php foreach($pages as $page){
								if($page->page_id==4){ $pagerurl = $url.'/'.'contact-us'; }
								
								else { $pagerurl = $url.'/page/'.$page->post_slug; }
								?> 
                               <li><a href="<?php echo $pagerurl; ?>"><?php echo $page->page_title;?></a></li>
                                 <?php } ?>
                            </ul>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-md-2 col-md-offset-1 col-sm-4">
                        <div class="footer-widget">
                            <h3 class="footer-title"><?php echo foot_translate( 493, $lang);?></h3>
                            <div class="social">
           
          <?php if(!empty($setts[0]->site_facebook)){?><a href="<?php echo $setts[0]->site_facebook;?>" target="_blank"><i class="fa fa-facebook"></i></a><?php } ?>
                                    
                                    <?php if(!empty($setts[0]->site_twitter)){?><a href="<?php echo $setts[0]->site_twitter;?>" target="_blank"><i class="fa fa-twitter"></i></a><?php } ?>
                                    <?php if(!empty($setts[0]->site_gplus)){?><a href="<?php echo $setts[0]->site_gplus;?>" target="_blank"><i class="fa fa-google-plus"></i></a><?php } ?>
									<?php if(!empty($setts[0]->site_pinterest)){?><a href="<?php echo $setts[0]->site_pinterest;?>" target="_blank"><i class="fa fa-pinterest"></i></a><?php } ?>
									<?php if(!empty($setts[0]->site_instagram)){?><a href="<?php echo $setts[0]->site_instagram;?>" target="_blank"><i class="fa fa-instagram"></i></a><?php } ?>
       
          </div>
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-9">
                        <div class="footer-widget">
                            <h3 class="footer-title"><?php echo foot_translate( 496, $lang);?></h3>
                            <p><?php echo foot_translate( 37, $lang);?></p>
                            
                            @if(Session::has('nletter_success'))

	    <div class="alert alert-success custom_alert">

	      {{ Session::get('nletter_success') }}

	    </div>

	@endif


	
	
        @if(Session::has('nletter_error'))

	    <div class="alert alert-danger custom_alert">

	      {{ Session::get('nletter_error') }}

	    </div>

	@endif
                            
                            
                            <form class="subscribe-form" method="POST" action="{{ route('newsletter') }}" id="formIDZero" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <?php if(!empty($setts[0]->site_logo)){
							 
							?>
						
						<input type="hidden" name="site_logo" value="<?php echo $url.'/local/images/media/settings/'.$setts[0]->site_logo;?>">
					
						<?php } else { ?>
						
						<input type="hidden" name="site_logo" value="">
						
						<?php } ?>
                        
                        <input type="hidden" id="activated" name="activated" value="0">
                        
                        <input type="hidden" name="site_url" value="<?php echo $url;?>">
						
						<input type="hidden" id="admin_email" name="admin_email" value="<?php echo $admin_email;?>">
						<input type="hidden" name="site_name" value="<?php echo $setts[0]->site_name;?>">
          
                            
                                <input type="email" class="validate[required,custom[email]]" name="email" placeholder="<?php echo foot_translate( 949, $lang);?>">
                                <button type="submit"><?php echo foot_translate( 499, $lang);?></button>
                            </form>
                            <span class="community-count"><strong><?php echo $user_list_count;?></strong><?php echo foot_translate( 502, $lang);?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-buttom">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-xs-12 text-center">
                        <div class="copy-right">
                            <p><?php echo foot_translate( 28, $lang);?> </p>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </footer>
<?php if($site_cookie == "on") {?>    
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.js"></script>
<script>
window.addEventListener("load", function(){
window.cookieconsent.initialise({
  "palette": {
    "popup": {
      "background": "#000"
    },
    "button": {
      "background": "#f1d600"
    }
  },
  "showLink": false,
  "position": "<?php echo $site_cookie_position;?>",
  "content": {
    "message": "<?php echo foot_translate( 1212, $lang);?>",
    "dismiss": "<?php echo foot_translate( 1215, $lang);?>"
  }
})});
</script>
<?php } ?>
<!--<div class="footer-social">
                            <ul>
                                <li class="fb"><a href="#"><i class="fa fa-facebook-square"></i>facebook</a>
                                </li>
                                <li class="gp"><a href="#"><i class="fa fa-google-plus"></i>Google+</a>
                                </li>
                                <li class="be"><a href="#"><i class="fa fa-behance"></i>behance</a>
                                </li>
                                <li class="tw"><a href="#"><i class="fa fa-twitter"></i>twitter</a>
                                </li>
                            </ul>
                        </div>-->


    <script src="<?php echo $url;?>/local/resources/views/theme/js/bootstrap.min.js"></script>
    <?php $mobilelogo = "mobilelogo"; if(!empty($setts[0]->site_logo)){  $bge = "<a href=".$url."><img src=".$url."/local/images/media/settings/".$setts[0]->site_logo." border=0 class=".$mobilelogo."></a>"; } else { $bge = $setts[0]->site_name; } ?>
    <script type="text/javascript">
	(function ($) {
	"use strict";
		$.fn.meanmenu = function (options) {
				var defaults = {
						meanMenuTarget: jQuery(this), // Target the current HTML markup you wish to replace
						meanMenuContainer: 'body', // Choose where meanmenu will be placed within the HTML
						meanMenuClose: "X", // single character you want to represent the close menu button
						meanMenuCloseSize: "18px", // set font size of close button
						meanMenuOpen: "<span /><span /><span />", // text/markup you want when menu is closed
						meanRevealPosition: "right", // left right or center positions
						meanRevealPositionDistance: "0", // Tweak the position of the menu
						meanRevealColour: "", // override CSS colours for the reveal background
						meanScreenWidth: "767", // set the screen width you want meanmenu to kick in at
						meanNavPush: "", // set a height here in px, em or % if you want to budge your layout now the navigation is missing.
						meanShowChildren: true, // true to show children in the menu, false to hide them
						meanExpandableChildren: true, // true to allow expand/collapse children
						meanExpand: "+", // single character you want to represent the expand for ULs
						meanContract: "-", // single character you want to represent the contract for ULs
						meanRemoveAttrs: false, // true to remove classes and IDs, false to keep them
						onePage: false, // set to true for one page sites
						meanDisplay: "block", // override display method for table cell based layouts e.g. table-cell
						removeElements: "" // set to hide page elements
				};
				options = $.extend(defaults, options);

				// get browser width
				var currentWidth = window.innerWidth || document.documentElement.clientWidth;

				return this.each(function () {
						var meanMenu = options.meanMenuTarget;
						var meanContainer = options.meanMenuContainer;
						var meanMenuClose = options.meanMenuClose;
						var meanMenuCloseSize = options.meanMenuCloseSize;
						var meanMenuOpen = options.meanMenuOpen;
						var meanRevealPosition = options.meanRevealPosition;
						var meanRevealPositionDistance = options.meanRevealPositionDistance;
						var meanRevealColour = options.meanRevealColour;
						var meanScreenWidth = options.meanScreenWidth;
						var meanNavPush = options.meanNavPush;
						var meanRevealClass = ".meanmenu-reveal";
						var meanShowChildren = options.meanShowChildren;
						var meanExpandableChildren = options.meanExpandableChildren;
						var meanExpand = options.meanExpand;
						var meanContract = options.meanContract;
						var meanRemoveAttrs = options.meanRemoveAttrs;
						var onePage = options.onePage;
						var meanDisplay = options.meanDisplay;
						var removeElements = options.removeElements;

						//detect known mobile/tablet usage
						var isMobile = false;
						if ( (navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i)) || (navigator.userAgent.match(/iPad/i)) || (navigator.userAgent.match(/Android/i)) || (navigator.userAgent.match(/Blackberry/i)) || (navigator.userAgent.match(/Windows Phone/i)) ) {
								isMobile = true;
						}

						if ( (navigator.userAgent.match(/MSIE 8/i)) || (navigator.userAgent.match(/MSIE 7/i)) ) {
							// add scrollbar for IE7 & 8 to stop breaking resize function on small content sites
								jQuery('html').css("overflow-y" , "scroll");
						}

						var meanRevealPos = "";
						var meanCentered = function() {
							if (meanRevealPosition === "center") {
								var newWidth = window.innerWidth || document.documentElement.clientWidth;
								var meanCenter = ( (newWidth/2)-22 )+"px";
								meanRevealPos = "left:" + meanCenter + ";right:auto;";

								if (!isMobile) {
									jQuery('.meanmenu-reveal').css("left",meanCenter);
								} else {
									jQuery('.meanmenu-reveal').animate({
											left: meanCenter
									});
								}
							}
						};

						var menuOn = false;
						var meanMenuExist = false;


						if (meanRevealPosition === "right") {
								meanRevealPos = "right:" + meanRevealPositionDistance + ";left:auto;";
						}
						if (meanRevealPosition === "left") {
								meanRevealPos = "left:" + meanRevealPositionDistance + ";right:auto;";
						}
						// run center function
						meanCentered();

						// set all styles for mean-reveal
						var $navreveal = "";

						var meanInner = function() {
								// get last class name
								if (jQuery($navreveal).is(".meanmenu-reveal.meanclose")) {
										$navreveal.html(meanMenuClose);
								} else {
										$navreveal.html(meanMenuOpen);
								}
						};

						// re-instate original nav (and call this on window.width functions)
						var meanOriginal = function() {
							jQuery('.mean-bar,.mean-push').remove();
							jQuery(meanContainer).removeClass("mean-container");
							jQuery(meanMenu).css('display', meanDisplay);
							menuOn = false;
							meanMenuExist = false;
							jQuery(removeElements).removeClass('mean-remove');
						};

						// navigation reveal
						var showMeanMenu = function() {
								var meanStyles = "background:"+meanRevealColour+";color:"+meanRevealColour+";"+meanRevealPos;
								if (currentWidth <= meanScreenWidth) {
								jQuery(removeElements).addClass('mean-remove');
									meanMenuExist = true;
									// add class to body so we don't need to worry about media queries here, all CSS is wrapped in '.mean-container'
									jQuery(meanContainer).addClass("mean-container");
									jQuery('.mean-container').prepend('<div style="position:absolute; z-index:9999999; margin-left:5px; margin-top:10px;" class="hidedesk"><?php echo $bge;?></div><div class="mean-bar col-md-2"><a href="#nav" class="meanmenu-reveal" style="'+meanStyles+'">Show Navigation</a><nav class="mean-nav"></nav></div>');

									//push meanMenu navigation into .mean-nav
									var meanMenuContents = jQuery(meanMenu).html();
									jQuery('.mean-nav').html(meanMenuContents);

									// remove all classes from EVERYTHING inside meanmenu nav
									if(meanRemoveAttrs) {
										jQuery('nav.mean-nav ul, nav.mean-nav ul *').each(function() {
											// First check if this has mean-remove class
											if (jQuery(this).is('.mean-remove')) {
												jQuery(this).attr('class', 'mean-remove');
											} else {
												jQuery(this).removeAttr("class");
											}
											jQuery(this).removeAttr("id");
										});
									}

									// push in a holder div (this can be used if removal of nav is causing layout issues)
									jQuery(meanMenu).before('<div class="mean-push" />');
									jQuery('.mean-push').css("margin-top",meanNavPush);

									// hide current navigation and reveal mean nav link
									jQuery(meanMenu).hide();
									jQuery(".meanmenu-reveal").show();

									// turn 'X' on or off
									jQuery(meanRevealClass).html(meanMenuOpen);
									$navreveal = jQuery(meanRevealClass);

									//hide mean-nav ul
									jQuery('.mean-nav ul').hide();

									// hide sub nav
									if(meanShowChildren) {
											// allow expandable sub nav(s)
											if(meanExpandableChildren){
												jQuery('.mean-nav ul ul').each(function() {
														if(jQuery(this).children().length){
																jQuery(this,'li:first').parent().append('<a class="mean-expand" href="#" style="font-size: '+ meanMenuCloseSize +'">'+ meanExpand +'</a>');
														}
												});
												jQuery('.mean-expand').on("click",function(e){
														e.preventDefault();
															if (jQuery(this).hasClass("mean-clicked")) {
																	jQuery(this).text(meanExpand);
																jQuery(this).prev('ul').slideUp(300, function(){});
														} else {
																jQuery(this).text(meanContract);
																jQuery(this).prev('ul').slideDown(300, function(){});
														}
														jQuery(this).toggleClass("mean-clicked");
												});
											} else {
													jQuery('.mean-nav ul ul').show();
											}
									} else {
											jQuery('.mean-nav ul ul').hide();
									}

									// add last class to tidy up borders
									jQuery('.mean-nav ul li').last().addClass('mean-last');
									$navreveal.removeClass("meanclose");
									jQuery($navreveal).click(function(e){
										e.preventDefault();
								if( menuOn === false ) {
												$navreveal.css("text-align", "center");
												$navreveal.css("text-indent", "0");
												$navreveal.css("font-size", meanMenuCloseSize);
												jQuery('.mean-nav ul:first').slideDown();
												menuOn = true;
										} else {
											jQuery('.mean-nav ul:first').slideUp();
											menuOn = false;
										}
											$navreveal.toggleClass("meanclose");
											meanInner();
											jQuery(removeElements).addClass('mean-remove');
									});

									// for one page websites, reset all variables...
									if ( onePage ) {
										jQuery('.mean-nav ul > li > a:first-child').on( "click" , function () {
											jQuery('.mean-nav ul:first').slideUp();
											menuOn = false;
											jQuery($navreveal).toggleClass("meanclose").html(meanMenuOpen);
										});
									}
							} else {
								meanOriginal();
							}
						};

						if (!isMobile) {
								// reset menu on resize above meanScreenWidth
								jQuery(window).resize(function () {
										currentWidth = window.innerWidth || document.documentElement.clientWidth;
										if (currentWidth > meanScreenWidth) {
												meanOriginal();
										} else {
											meanOriginal();
										}
										if (currentWidth <= meanScreenWidth) {
												showMeanMenu();
												meanCentered();
										} else {
											meanOriginal();
										}
								});
						}

					jQuery(window).resize(function () {
								// get browser width
								currentWidth = window.innerWidth || document.documentElement.clientWidth;

								if (!isMobile) {
										meanOriginal();
										if (currentWidth <= meanScreenWidth) {
												showMeanMenu();
												meanCentered();
										}
								} else {
										meanCentered();
										if (currentWidth <= meanScreenWidth) {
												if (meanMenuExist === false) {
														showMeanMenu();
												}
										} else {
												meanOriginal();
										}
								}
						});

					// run main menuMenu function on load
					showMeanMenu();
				});
		};
})(jQuery);

	
	</script>
    <script src="<?php echo $url;?>/local/resources/views/theme/js/avigher.min.js"></script>
    <script src="<?php echo $url;?>/local/resources/views/theme/js/jquery.settings.min.js"></script>
    <script src="<?php echo $url;?>/local/resources/views/theme/js/jquery.newfyler.js"></script>
    <script src="<?php echo $url;?>/local/resources/views/theme/js/jquery.timer.min.js"></script>
    <script src="<?php echo $url;?>/local/resources/views/theme/js/owl.carousel.min.js"></script>
    <script src="<?php echo $url;?>/local/resources/views/theme/js/main.js"></script>

<?php
$sett_meta_chat = DB::table('settings_meta')
		        ->where('sett_meta_id', '=' , 15)
				->where('sett_meta_key', '=' , "site_live_chat")
		        
				->count();
				
			if(!empty($sett_meta_chat))
			{	
		   $sett_meta =  DB::table('settings_meta')
		        ->where('sett_meta_id', '=' , 15)
				->where('sett_meta_key', '=' , "site_live_chat")
		        
				->get();
			$sett_meta_chat = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$sett_meta_chat = "";
			}
if(!empty($sett_meta_chat))
{
//echo html_entity_decode($sett_meta_chat);
}
?>




<script src="<?php echo $url;?>/local/resources/views/theme/js/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8">
	</script>
	<script src="<?php echo $url;?>/local/resources/views/theme/js/jquery.validationEngine.js" type="text/javascript" charset="utf-8">
	</script>
	<script>
		jQuery(document).ready(function(){
			
			jQuery("#formID").validationEngine('attach', { promptPosition: "topLeft" });
			jQuery("#formID_n1").validationEngine('attach', { promptPosition: "topLeft" });
			jQuery("#formID_n2").validationEngine('attach', { promptPosition: "topLeft" });
			
			jQuery("#formIfooter").validationEngine('attach', { promptPosition: "topLeft" });
			jQuery("#formwithdraw").validationEngine('attach', { promptPosition: "topLeft" });
			jQuery("#formIDZero").validationEngine('attach', { promptPosition: "topLeft" });
			jQuery("#formIDreport").validationEngine('attach', { promptPosition: "topLeft" });
			
		});
		
		
		function withdraw_checking(str)
    {	

        document.getElementById("localbank").style.display="none";
		document.getElementById("paypal").style.display="none";
		document.getElementById("stripe").style.display="none";
		document.getElementById("paytm").style.display="none";
		document.getElementById("perfectmoney").style.display="none";
		
	if(str=="paypal")
	{	
		document.getElementById("localbank").style.display="none";
		document.getElementById("paypal").style.display="block";
		document.getElementById("stripe").style.display="none";
		document.getElementById("paytm").style.display="none";
		
	}
	else if(str=="localbank")
	{
		document.getElementById("paypal").style.display="none";
		document.getElementById("localbank").style.display="block";
		document.getElementById("stripe").style.display="none";
		document.getElementById("paytm").style.display="none";
		
	}
	else if(str=="stripe")
	{
		document.getElementById("paypal").style.display="none";
		document.getElementById("localbank").style.display="none";
		document.getElementById("stripe").style.display="block";
		document.getElementById("paytm").style.display="none";
		
	}
	else if(str=="paytm")
	{
		document.getElementById("paypal").style.display="none";
		document.getElementById("localbank").style.display="none";
		document.getElementById("stripe").style.display="none";
		document.getElementById("paytm").style.display="block";
	}
	else if(str=="perfectmoney")
	{
		document.getElementById("paypal").style.display="none";
		document.getElementById("localbank").style.display="none";
		document.getElementById("stripe").style.display="none";
		document.getElementById("paytm").style.display="none";
		document.getElementById("perfectmoney").style.display="block";
	}
	
	
	
   }
   
   
   
   
    </script>
    
    <?php /* scroll top */ ?>
		
		
<?php /* end scroll top */?>
    
    
    
    
    
    <?php /* mp3 */?>
    <script src="<?php echo $url;?>/local/resources/views/theme/js/mp3.js"></script>

<script>
    $(document).ready(function () {
        $('.mediPlayer').mediaPlayer();
    });
</script>

<?php /* end mp3 */?>

<?php /* ?>
<script type="text/javascript" src="<?php echo $url;?>/local/resources/views/theme/js/jquery.simplePagination.min.js"></script>
            <script type="text/javascript">
		$(function(){
			var perPage = <?php echo $setts[0]->site_post_per;?>;
			var opened = 1;
			var onClass = 'on';
			var paginationSelector = '.pagess';
			$('.bloglist').simplePagination(perPage, opened, onClass, paginationSelector);
		});
	
	</script>
    <?php */?>
    
 <script type="text/javascript">
 $('ul.nav li.dropdown').hover(function() {
  $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
}, function() {
  $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
});	

</script>
 
<?php /********** POPUP GALLERY ********/?>

 @include('chat')

<?php /* top to scroller */?>
<?php if($site_back_to_top=="on"){?>

<div id="gotop"></div>
<script type="text/javascript">
(function($){
    'use strict';
    
    var defaults = {
        background : '<?php echo $setts[0]->site_button_color;?>', // Background color
        color: '#fff', // Icon color
        rounded: true, // if true make the button rounded
        width: '45px',
        height: '45px',
        bottom : '25px', // Button bottom position
        right : '25px', // Button right position
        windowScrollShow: 400, // Window height after which show the button
        speed: 800,
        customHtml: '', // Set custom html for icon
        mobileOnly: false // Show button only on mobile device
    }
    
    // ----------------------------------
    
    $.fn.gotop = function( options ){
        
        var opts = $.extend(true, {}, defaults, options)
        ,   isMobile = $.fn.gotop.isMobile()
        ,   $el = this;
        

        return this.each(function(){
            // Hide the element
            $el.hide();

            // ----------------------------------

            // Make the button rounded
            if(opts.rounded == true) {
                $el.css('border-radius', '50%');
            }

            // ----------------------------------

            // CSS 
            $el.css({
                cursor: 'pointer',
                position: 'fixed',
                'align-items': 'center',
                'justify-content': 'center',
                background: opts.background,
                color: opts.color,
                width: opts.width,
                height: opts.height,
                bottom: opts.bottom, 
                right: opts.right
            });

            // ----------------------------------

            // Set default icon if customHtml option is empty
            if(opts.customHtml != '') {
                $el.append(opts.customHtml);            
            } else {
                $el.append('&uarr;');
            }

            // ----------------------------------
            
            // Back to top
            $el.click(function (e) {
              e.preventDefault();
              $('html, body').animate({scrollTop: 0}, opts.speed);
            });
            
            // ----------------------------------
            
            // Show the scroll to top button only on mobile devices
            if (opts.mobileOnly == true) {
                if(isMobile) {
                    $(window).scroll(function() {
                        $.fn.gotop.showButton($el, opts.windowScrollShow);
                    });                    
                } else {
                    return false;
                }
            }
            else
            {
                // Show the scroll to top button on all devices
                $(window).scroll(function() {
                    $.fn.gotop.showButton($el, opts.windowScrollShow);
                }); 
            }            
            
            // ----------------------------------
            
        });
    };
    
    // --------------------------------------------------------------------------
    
    $.fn.gotop.isMobile = function() { 
        return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent); 
    }
    
    // --------------------------------------------------------------------------
    
    $.fn.gotop.showButton = function(element, windowScrollHeight) {
        
        if( $(window).scrollTop() > windowScrollHeight ) {
            element.fadeIn(400)
                .css('display', 'flex');
        } else {
            element.fadeOut(400);
        }
    }
    
    // --------------------------------------------------------------------------
    
}(jQuery));


</script>
<?php if(!empty($sett_meta_chat)){ $moberor = "5em"; } else { $moberor = "2em"; } ?>

<script>
$('#gotop').gotop({
  customHtml: '<i class="fa fa-angle-up fa-2x"></i>',
  bottom: '<?php echo $moberor;?>',
  right: '2em'
});
</script>

<?php } ?>
<?php /* top to scroller */ ?>

<?php /* feature item */?>
<script src='<?php echo $url;?>/local/resources/views/theme/carousel/feature_slider.js'></script>

  

    <script type="text/javascript">
    $('.owl-carousel').owlCarousel({
  
  loop: true,
  nav: true,
  dots: true,
  margin: 10,
  autoplay: true,
  autoplayTimeout: 2500
 
  
});
    </script>
<?php /* feature item */?>    

