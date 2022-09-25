<?php
use Illuminate\Support\Facades\Route;
$currentPaths= Route::getFacadeRoot()->current()->uri();	
$url = URL::to("/");
$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
$default = DB::table('avig_language')
	              ->where('lang_default','=',1)
		           ->get();


$default_cnt = DB::table('avig_language')
	              ->where('lang_default','=',1)
		           ->count();
if(!empty(Cookie::get('lang'))){ $lang = Cookie::get('lang'); } else { if(!empty($default_cnt)){ $lang = $default[0]->lang_code; } else { $lang = "en"; } }			
?>
<!DOCTYPE html>
<html lang="en">
<head>

    

   @include('style')
	<title><?php echo translate( 25, $lang);?> - <?php echo translate( 517, $lang);?></title>




</head>
<body class="index">

    

    <!-- fixed navigation bar -->
    @include('header')

    
    <div class="promo-area" style="background-image: url(<?php echo $url;?>/local/images/media/settings/<?php echo $setts[0]->site_banner;?>)">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="promo-text">
                        <h2 class="avigher-title bolder fontsize30"><?php echo translate( 517, $lang);?></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>



 <div class="about-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo $url;?>"><?php echo translate( 40, $lang);?></a>
                        </li>
                        <li class="breadcrumb-item active"><?php echo translate( 517, $lang);?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    

	<main class="checkout-area main-content">
<div class="clearfix height20"></div>
        <div class="container">

<div class="row">
@if(Session::has('success'))

	    <div class="alert alert-success">

	      {{ Session::get('success') }}

	    </div>

	@endif


	
	
 	@if(Session::has('error'))

	    <div class="alert alert-danger">

	      {{ Session::get('error') }}

	    </div>

	@endif


</div>



    <div class="row">
	
	
	
	
	 <div class="container">
    <div class="fb-profile">
    <?php if($user[0]->profile_banner!=""){?>
        <img align="left" class="fb-image-lg" src="<?php echo $url;?>/local/images/media/userphoto/<?php echo $user[0]->profile_banner;?>" alt="<?php echo $user[0]->name;?>"/>
        <?php } else { ?>
        <img align="left" class="fb-image-lg" src="<?php echo $url;?>/local/images/no-image-big.jpg" alt="<?php echo $user[0]->name;?>"/>
        <?php } ?>
        <?php if($user[0]->photo!=""){?>
        <img align="left" class="fb-image-profile thumbnail" src="<?php echo $url;?>/local/images/media/userphoto/<?php echo $user[0]->photo;?>" alt="<?php echo $user[0]->name;?>"/>
        <?php } else { ?>
        <img align="left" class="fb-image-profile thumbnail" src="<?php echo $url;?>/local/images/nophoto.jpg" alt="<?php echo $user[0]->name;?>"/>
        <?php } ?>
        <div class="fb-profile-text">
       <?php $datter = $user[0]->created_at;
	   $yeear = date('Y', strtotime($datter));
       $moonth = date('F', strtotime($datter));
	   $from_date = strtotime($datter);
	   $today_date = strtotime(date("Y-m-d H:i:s"));
	   $diff = abs($today_date - $from_date);
	   $get_years = floor($diff / (365*60*60*24));
	   if($get_years == 1) { $year_badges = "1.png"; $member_year = translate( 1140, $lang); }
	   else if($get_years == 2) { $year_badges = "2.png"; $member_year = translate( 1143, $lang); }
	   else if($get_years == 3) { $year_badges = "3.png"; $member_year = translate( 1143, $lang); }
	   else if($get_years == 4) { $year_badges = "4.png"; $member_year = translate( 1143, $lang); }
	   else if($get_years == 5) { $year_badges = "5.png"; $member_year = translate( 1143, $lang); }
	   else if($get_years == 6) { $year_badges = "6.png";  $member_year = translate( 1143, $lang); }
	   else if($get_years == 7) { $year_badges = "7.png"; $member_year = translate( 1143, $lang); }
	   else if($get_years == 8) { $year_badges = "8.png"; $member_year = translate( 1143, $lang); }
	   else if($get_years == 9) { $year_badges = "9.png"; $member_year = translate( 1143, $lang); }
	   else if($get_years == 10) { $year_badges = "10.png"; $member_year = translate( 1143, $lang); }
	   else if($get_years > 10) { $year_badges = "10_plus.png"; $member_year = translate( 1143, $lang); }
	   else {$year_badges = ""; $member_year = ""; }
	   ?>
            <h3 class="myprofile_heading profile_headers"><?php echo $user[0]->name;?></h3>
            <div class="height10"></div>
            <div class="flag col-md-3">
            <?php if($profile_badges=="on"){?>
							<?php if(!empty($country_view)){?>
                            <img src="<?php echo $url;?>/local/images/media/flag/<?php echo $country_view;?>" width="30" border="0" alt="<?php echo translate( 1134, $lang);?> <?php echo $country_text;?>" title="<?php echo translate( 1134, $lang);?> <?php echo $country_text;?>" style="width:28px; height:28px;">
                            
							<?php } ?>
							<?php } ?>
                 <?php if(!empty($datter)) { if(!empty($get_years)){?>
                  <img src="<?php echo $url;?>/local/images/badges/<?php echo $year_badges;?>" width="30" border="0" alt="<?php echo $get_years;?> <?php echo $member_year;?>" title="<?php echo $get_years;?> <?php echo $member_year;?>">
                  <?php } } ?> 
                  
                  <?php if($minimum_sells < $proders_details){?>
                  
                    <img src="<?php echo $url;?>/local/images/badges/exclusive.png" width="30" border="0" alt="<?php echo translate( 1146, $lang);?>" title="<?php echo translate( 1146, $lang);?>">
                       <?php } ?>
                       
                       
                       <?php if(!empty($trends_details)){?>
                        <img src="<?php echo $url;?>/local/images/badges/trends.png" width="30" border="0" alt="<?php echo translate( 1149, $lang);?>" title="<?php echo translate( 1149, $lang);?>">
                         <?php } ?> 
                         
                         
                          <?php if($sold_price >= $author_level_one && $author_level_two >= $sold_price){ $sold_badges = "sold1.png"; $level_no = 1; $level_price = $author_level_one; } 
						 else if($sold_price >= $author_level_two && $author_level_three >= $sold_price){ $sold_badges = "sold2.png"; $level_no = 2; $level_price = $author_level_two; }
						 else if($sold_price >= $author_level_three && $author_level_four >= $sold_price){ $sold_badges = "sold3.png"; $level_no = 3; $level_price = $author_level_three;}
						 else if($sold_price >= $author_level_four && $author_level_five >= $sold_price){ $sold_badges = "sold4.png"; $level_no = 4; $level_price = $author_level_four;}
						 else if($sold_price >= $author_level_five && $author_level_six >= $sold_price){ $sold_badges = "sold5.png"; $level_no = 5; $level_price = $author_level_five;}
						 else if($sold_price >= $author_level_six){ $sold_badges = "sold6.png"; $level_no = 6; $level_price = $author_level_six;}
						 else { $sold_badges = ""; $level_no = 0; $level_price = 0;}
						 ?>
                         
                          <?php  if(!empty($sold_price)){ if(!empty($sold_badges)){ ?>
                        <img src="<?php echo $url;?>/local/images/badges/<?php echo $sold_badges;?>" width="30" border="0" alt="<?php echo translate( 1155, $lang);?> <?php echo $level_no.' : ';?> <?php echo translate( 1158, $lang);?> <?php echo $site_setting[0]->site_currency;?> <?php echo $level_price.'+';?> <?php echo translate( 454, $lang);?> <?php echo translate( 25, $lang);?>" title="<?php echo translate( 1155, $lang);?> <?php echo $level_no.' : ';?> <?php echo translate( 1158, $lang);?> <?php echo $site_setting[0]->site_currency;?> <?php echo $level_price.'+';?> <?php echo translate( 454, $lang);?> <?php echo translate( 25, $lang);?>" style="border-radius:0px;">
                         <?php } } ?>
                         
                         <?php if($sold_price >= $author_level_six){?>
                         <img src="<?php echo $url;?>/local/images/badges/elite.png" width="30" border="0" alt="<?php echo translate( 1152, $lang);?>" title="<?php echo translate( 1152, $lang);?>" class="elite_cls">
                         
                         <?php } ?>
                         
                         
                         <?php if($collector_details >= $collector_level_one && $collector_level_two >= $collector_details){ $sc_badges = "sc1.png"; $clevel_no = 1; $clevel_price = $collector_level_one; } 
						 else if($collector_details >= $collector_level_two && $collector_level_three >= $collector_details){ $sc_badges = "sc2.png"; $clevel_no = 2; $clevel_price = $collector_level_two; }
						 else if($collector_details >= $collector_level_three && $collector_level_four >= $collector_details){ $sc_badges = "sc3.png"; $clevel_no = 3; $clevel_price = $collector_level_three;}
						 else if($collector_details >= $collector_level_four && $collector_level_five >= $collector_details){ $sc_badges = "sc4.png"; $clevel_no = 4; $clevel_price = $collector_level_four;}
						 else if($collector_details >= $collector_level_five && $collector_level_six >= $collector_details){ $sc_badges = "sc5.png"; $clevel_no = 5; $clevel_price = $collector_level_five;}
						 else if($collector_details >= $collector_level_six){ $sc_badges = "sc6.png"; $clevel_no = 6; $clevel_price = $collector_level_five;}
						 else { $sc_badges = ""; $clevel_no = 0; $clevel_price = 0;}
						 ?>
                         
                          <?php if(!empty($collector_details)){ if(!empty($sc_badges)){ ?>
                        <img src="<?php echo $url;?>/local/images/badges/<?php echo $sc_badges;?>" width="30" border="0" alt="<?php echo translate( 1179, $lang);?> <?php echo $clevel_no.' : ';?> <?php echo translate( 1161, $lang);?> <?php echo $clevel_price.'+';?> <?php echo translate( 454, $lang);?> <?php echo translate( 25, $lang);?>" title="<?php echo translate( 1179, $lang);?> <?php echo $clevel_no.' : ';?> <?php echo translate( 1161, $lang);?> <?php echo $clevel_price.'+';?> <?php echo translate( 454, $lang);?> <?php echo translate( 25, $lang);?>" style="border-radius:0px;">
                         <?php } } ?>
                                 
                                 
                           <?php if($referred_details >= $referred_level_one && $referred_level_two >= $referred_details){ $ref_badges = "ref1.png"; $rlevel_no = 1; $rlevel_price = $referred_level_one; } 
						 else if($referred_details >= $referred_level_two && $referred_level_three >= $referred_details){ $ref_badges = "ref2.png"; $rlevel_no = 2; $rlevel_price = $referred_level_two; }
						 else if($referred_details >= $referred_level_three && $referred_level_four >= $referred_details){ $ref_badges = "ref3.png"; $rlevel_no = 3; $rlevel_price = $referred_level_three;}
						 else if($referred_details >= $referred_level_four && $referred_level_five >= $referred_details){ $ref_badges = "ref4.png"; $rlevel_no = 4; $rlevel_price = $referred_level_four;}
						 else if($referred_details >= $referred_level_five && $referred_level_six >= $referred_details){ $ref_badges = "ref5.png"; $rlevel_no = 5; $rlevel_price = $referred_level_five;}
						 else if($referred_details >= $referred_level_six){ $ref_badges = "ref6.png"; $rlevel_no = 6; $rlevel_price = $referred_level_six;}
						 else { $ref_badges = ""; $rlevel_no = 0; $rlevel_price = 0;}
						 ?>
                         
                         <?php if(!empty($referred_details)){ if(!empty($ref_badges)){ ?>
                        <img src="<?php echo $url;?>/local/images/badges/<?php echo $ref_badges;?>" width="30" border="0" alt="<?php echo translate( 1170, $lang);?> <?php echo $rlevel_no.' : ';?> <?php echo translate( 1173, $lang);?> <?php echo $rlevel_price.'+';?> <?php echo translate( 1176, $lang);?>" title="<?php echo translate( 1170, $lang);?> <?php echo $rlevel_no.' : ';?> <?php echo translate( 1173, $lang);?> <?php echo $rlevel_price.'+';?> <?php echo translate( 1176, $lang);?>" style="border-radius:0px;">
                         <?php } } ?>       
                                 
                            
                            
           </div>
           <div class="height10"></div>
           <?php if(!empty($datter)){?><p><?php echo translate( 1137, $lang);?> <?php echo $moonth;?> <?php echo $yeear;?></p><?php } ?>
            
           
        </div>
    </div>
    
    
    
    
    
    
    <div class="height50 clearfix"></div>
    
   
    <div class="row">
		<div class="col-md-12">
			

			<div class="tabbable-panel">
				<div class="tabbable-line">
					<ul class="nav nav-tabs ">
						<li class="active">
							<a href="#tab_about" data-toggle="tab">
							<?php echo translate( 448, $lang);?> </a>
						</li>
						<li>
							<a href="#tab_items" data-toggle="tab">
							<?php echo translate( 859, $lang);?> </a>
						</li>
                        <?php 
						if(Auth::check()) {
						if($user[0]->id !=Auth::user()->id){?>
						<li>
							<a href="#tab_contact" data-toggle="tab">
							<?php echo translate( 862, $lang);?> </a>
						</li>
                        <?php } } else { ?>
                        <li>
							<a href="#tab_contact" data-toggle="tab">
							<?php echo translate( 862, $lang);?> </a>
						</li>
                        <?php } ?>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="tab_about" style="padding:20px;">
                        <div class="height20"></div>
							<p>
								<?php echo $user[0]->about;?>
							</p>
							
						</div>
						<div class="tab-pane" id="tab_items" style="padding:20px;">
							<div class="height20"></div>
                            <div class="row">
                <?php if(!empty($items_count)){
				
				$items = DB::table('products')
				->where('delete_status', '=', '')
				->where('item_status', '=', 1)
				->where('lang_code','=',$lang)
				->where('user_id','=',$uu)
				->orderBy('item_id', 'desc')
				->get();	
				foreach($items as $views){
				
				$user_count = DB::table('users')
						 ->where('id', '=', $views->user_id)
						 ->count();	
				if(!empty($user_count))
				{
				   $user_details = DB::table('users')
						 ->where('id', '=', $views->user_id)
						 ->get();
					$user_name = $user_details[0]->name;
					$user_slug = $user_details[0]->user_slug;
					$user_photo = $user_details[0]->photo;	 	
				}
				else
				{
				  $user_name = "";
				  $user_slug = "";
				   $user_photo = "";
				}
				
				
				if($lang == "en")
				{
				  $texter = $views->item_id;
				}
				else
				{
				  $texter = $views->parent;
				}
				
				$review_count_03 = DB::table('product_rating')
				->where('item_id', '=', $texter)
				->count();
				
				if(!empty($review_count_03))
				{
				$review_value_03 = DB::table('product_rating')
				               ->where('item_id', '=', $texter)
				               ->get();
				
				
				$over_03 = 0;
		        $fine_value_03 = 0;
				foreach($review_value_03 as $review){
				if($review->rating==1){$value1 = $review->rating*1;} else { $value1 = 0; }
		if($review->rating==2){$value2 = $review->rating*2;} else { $value2 = 0; }
		if($review->rating==3){$value3 = $review->rating*3;} else { $value3 = 0; }
		if($review->rating==4){$value4 = $review->rating*4;} else { $value4 = 0; }
		if($review->rating==5){$value5 = $review->rating*5;} else { $value5 = 0; }
		
		$fine_value_03 += $value1 + $value2 + $value3 + $value4 + $value5;
		

      $over_03 +=$review->rating;
	  
	  
	  
				}
				if(!empty(round($fine_value_03/$over_03))){ $roundeding_03 = round($fine_value_03/$over_03); } else {
		  $roundeding_03 = 0; }	
				
				
				}
				
				if(!empty($review_count_03))
				                               {
	                                           if(!empty($roundeding_03)){
	
	                                           if($roundeding_03==1){ $rateus_new_03 ='
                                                <p class="review-icon">
                                                   
                                                    <i class="fa fa-star my_yellow" aria-hidden="true"></i>
                                                    
                                                    
													<i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i> ('.$review_count_03.')
                                                </p>';
												}
												if($roundeding_03==2){ $rateus_new_03 ='
                                                <p class="review-icon">
                                                   
                                                    <i class="fa fa-star my_yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star my_yellow" aria-hidden="true"></i>
                                                   
													
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i> ('.$review_count_03.')
                                                </p>';
												}
												
												if($roundeding_03==3){ $rateus_new_03 ='
                                                <p class="review-icon">
                                                   
                                                    <i class="fa fa-star my_yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star my_yellow" aria-hidden="true"></i>
													<i class="fa fa-star my_yellow" aria-hidden="true"></i>
                                                   
													
                                                    
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i> ('.$review_count_03.')
                                                </p>';
												}
												
												if($roundeding_03==4){ $rateus_new_03 ='
                                                <p class="review-icon">
                                                    
                                                    <i class="fa fa-star my_yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star my_yellow" aria-hidden="true"></i>
													<i class="fa fa-star my_yellow" aria-hidden="true"></i>
													<i class="fa fa-star my_yellow" aria-hidden="true"></i> 
                                                    
											                                                
                                                    
                                                    <i class="fa fa-star" aria-hidden="true"></i> ('.$review_count_03.')
                                                </p>';
												}
												
												if($roundeding_03==5){ $rateus_new_03 ='
                                                <p class="review-icon">
                                                    
                                                    <i class="fa fa-star my_yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star my_yellow" aria-hidden="true"></i>
													<i class="fa fa-star my_yellow" aria-hidden="true"></i>
													<i class="fa fa-star my_yellow" aria-hidden="true"></i>
													 <i class="fa fa-star my_yellow" aria-hidden="true"></i> ('.$review_count_03.')
                                                    
											    </p>';
												}
												
												
												}
											    else if(empty($roundeding_03)){  $rateus_new_03 = '
												<p class="review-icon">
                                                    
													<i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													 <i class="fa fa-star" aria-hidden="true"></i> ('.$review_count_03.')
											    </p>';
												}
												
												}
												
												
												
												$rateus_empty_03 = '
												<p class="review-icon">
                                                    
													<i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													 <i class="fa fa-star" aria-hidden="true"></i> ('.$review_count_03.')
											    </p>';
												
					 
				?>
                <div class="col-md-4 col-sm-4">
                    <div class="item-demo">
                        <figure>
                            
                            <?php if(!empty($views->preview_image)){?>
                            <img src="<?php echo $url;?>/local/images/media/preview/<?php echo $views->preview_image;?>" alt="">
                            <?php } else { ?>
                             <img src="<?php echo $url;?>/local/images/noimage.jpg" alt="">
                             <?php } ?>
                            
                            <div class="product-caption">
                                <div class="caption-cel">
                                    <div class="product-link">
                                        <div>
                                            <div>
                                                <a href="<?php echo $url;?>/item/<?php echo $texter;?>/<?php echo $views->item_slug;?>" class="radiusoff"><?php echo translate( 223, $lang);?> <span><i class="fa fa-eye"></i></span></a>
                                            </div>
                                            <?php /*?><div>
                                                <a href="<?php echo $url;?>/cart" class="radiusoff">Add to Cart<span><i class="fa fa-shopping-cart"></i></span></a>
                                            </div><?php */?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </figure>
                        <div class="product-info">
                            <div class="product-header">
                                <h3 class="product-name custom_tittle col-md-8 paddingoff homenew"><a href="<?php echo $url;?>/item/<?php echo $texter;?>/<?php echo $views->item_slug;?>"><?php echo $views->item_title;?></a> </h3><span class="alink col-md-4 paddingoff text-right"><?php echo $views->regular_price_six_month;?> <?php echo $site_setting[0]->site_currency;?></span>
                                <span class="p-author">
                                    <a href="<?php echo $url;?>/user/<?php echo $user_slug;?>" class="auth_texter"><?php if(!empty($user_photo)){?><img src="<?php echo $url;?>/local/images/media/userphoto/<?php echo $user_photo;?>" alt="<?php echo $user_name;?>" border="0" class="roundshape" style="width:30px; border-radius:50px;" /><?php } else { ?><img src="<?php echo $url;?>/local/images/nophoto.jpg" alt="<?php echo $user_name;?>" border="0" class="roundshape" style="width:30px; border-radius:50px;" /><?php } ?> <?php echo $user_name;?></a>
                                </span>
                            </div>
                            <div class="product-meta">
                                <span class="meta-download">
                                    <i class="fa fa-cloud-download"></i><?php echo $views->downloaded;?>
                                </span>
                                <span class="meta-love">
                                    <i class="fa fa-heart"></i><?php echo $views->liked;?>
                                </span>
                                <span class="meta-rating">
                                    <?php if(!empty($review_count_03)){ echo $rateus_new_03; } else { echo $rateus_empty_03; }?> 
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                <?php } } ?>
            </div>
                            
                            
							
						</div>
						<div class="tab-pane" id="tab_contact" style="padding:20px;">
                        
							<div class="row">
                            <div class="col-md-6">
                            <aside class="sidebar">
                            <div class="single contact-info">
                            <h3 class="side-title"><?php echo translate( 865, $lang);?></h3>
                            <ul class="list-unstyled">
                            <?php if(!empty($user[0]->address)){?>
                            <li>
                            <div class="icon"><i class="fa fa-map-marker"></i></div>
                            <div class="info"><p><?php echo $user[0]->address;?></p>
                            <p><?php echo $user[0]->country;?></p>
                            </div>
                            </li>
                            <?php } ?>
                            
                            <?php if($profile_status=="on"){?>
                            <?php if(!empty($user[0]->phone)){?>
                            <li>
                            <div class="icon"><i class="fa fa-phone"></i></div>
                            <div class="info"><p><?php echo $user[0]->phone;?></p></div>
                            </li>
                            <?php } ?>
                            <?php if(!empty($user[0]->email)){?>
                            <li>
                            <div class="icon"><i class="fa fa-envelope"></i></div>
                            <div class="info"><p><?php echo $user[0]->email;?></p></div>
                            </li>
                            <?php } ?>
                            <?php } ?>
                            </ul>
                            </div>
                            </aside>
                            </div>
                            
                            
                            
                            
                            <div class="col-md-6">
                            <div class="height50"></div>
                            <form method="post" action="{{ route('user') }}" class="form" role="form" id="formID">
                            {{ csrf_field() }}
                            <div class="row">
                            <input type="hidden" id="vendor_id" name="vendor_id" placeholder="" class="input-xlarge" value="<?php echo $user[0]->id;?>">
                            <div class="col-xs-6 col-md-6 form-group">
                            <input class="form-control validate[required]" id="name" name="name" placeholder="<?php echo translate( 244, $lang);?>" type="text" autofocus />
                            </div>
                            <div class="col-xs-6 col-md-6 form-group">
                            <input class="form-control validate[required,custom[email]]" value="<?php if(Auth::check()) { echo Auth::user()->email; }?>" id="email" name="email" placeholder="<?php echo translate( 247, $lang);?>" type="email"/>
                            </div>
                            </div>
                            
                            <div class="col-xs-12 col-md-12 form-group paddingoff">
                            <input class="form-control validate[required]" id="phone" name="phone" placeholder="<?php echo translate( 340, $lang);?>" type="text" />
                            </div>
                            <textarea class="form-control validate[required]" id="msg" name="msg" placeholder="<?php echo translate( 250, $lang);?>" rows="5"></textarea>
                            <br />
                            <div class="row">
                            <div class="col-xs-12 col-md-12 form-group">
                            <button class="btn btn-primary pull-right" type="submit"><?php echo translate( 214, $lang);?></button>
                            </form>
                            </div>
                            
                            
                            
                            </div>
							
						</div>
					</div>
				</div>
			</div>
			</div>
			</div>
		
       

    
    
    
    
    
    
    
    
    
</div> <!-- /container -->  
     
     
     </div>
	
	
	
	
	
	
	
	</div>
</div>
<div class="clearfix"></div>
</main>
	

	
	
      @include('footer')
</body>
</html>