<?php
	use Illuminate\Support\Facades\Route;
$currentPaths= Route::getFacadeRoot()->current()->uri();	
$url = URL::to("/");
$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
		$headertype = $setts[0]->header_type;
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
   
   <meta charset="utf-8" />
		

   @include('style')
   <title><?php echo translate( 25, $lang);?> - <?php if(!empty($blog_count)){?><?php echo translate( 226, $lang);?><?php } ?><?php if(!empty($post_count)){?><?php echo $post[0]->post_title; ?><?php } ?></title>


<?php if(!empty($post_count)){?>
<meta property="og:type" content="article">
<meta property="og:title" content="<?php echo $post[0]->post_title;?>">
<meta property="og:description" content="<?php echo substr($post[0]->post_desc,0,280).'...';?>">
<meta property="og:url" content="<?php echo $url;?>/blog/<?php echo $post[0]->post_slug;?>">
<meta property="og:site_name" content="<?php echo $setts[0]->site_name;?>">
<?php if(!empty($post[0]->post_image)){ ?>
<meta property="og:image" content="<?php echo $url.'/local/images/media/blog/'.$post[0]->post_image;?>">
<?php } else { ?>
<meta property="og:image" content="<?php echo $url;?>/local/images/noimage.jpg">
<?php } ?>
<meta property="og:image:width" content="400">
<meta property="og:image:height" content="300">
<?php } ?>



<script type="text/javascript">
    $(document).ready(function() {
       
		$(".listShow1").cPager({
            pageSize: <?php echo $setts[0]->site_blog_per;?>, 
            pageid: "welpager1", 
            itemClass: "li-item1",
			pageIndex: 1

        });
		
		
		
		
		
    });
    </script>
</head>
<body class="index">

    
    @if($cany_check_value == 1)
    <!-- fixed navigation bar -->
    @include('header')

    
     
    
 <?php if($setts[0]->site_blog_visible=="yes"){?>
	
    
    
    <div class="promo-area" style="background-image: url(<?php echo $url;?>/local/images/media/settings/<?php echo $setts[0]->site_banner;?>)">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="promo-text">
                   <?php if(!empty($blog_count)){?>
                        <h2 class="avigher-title bolder fontsize30"><?php echo translate( 226, $lang);?></h2>
                        <?php } ?>
                        <?php if(!empty($post_count)){?>
                        <h2 class="avigher-title bolder fontsize30 bloglineheight"><?php echo $post[0]->post_title; ?></h2>
                        <?php } ?>
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
                        <?php if(!empty($blog_count)){?>
                        <li class="breadcrumb-item active"><?php echo translate( 226, $lang);?></li>
                        <?php } ?>
                         <?php if(!empty($post_count)){?>
                          <li class="breadcrumb-item"><a href="<?php echo $url;?>/blog"><?php echo translate( 226, $lang);?></a></li>
                           <li class="breadcrumb-item active"><?php echo $post[0]->post_title; ?></li>
                          <?php } ?> 
                    </ol>
                </div>
            </div>
        </div>
    </div> 
	
	
	
	
    
    
    
    
    
    <main class="main-wrapper-inner blog-wrapper" id="container">

            	<div class="container">
                
                <div class="row">
                     <div class="col-md-12 col-sm-12">
                    @if(Session::has('success'))

	    <p class="alert alert-success">

	      {{ Session::get('success') }}

	    </p>

	@endif


	
	
 	@if(Session::has('error'))

	    <p class="alert alert-danger">

	      {{ Session::get('error') }}

	    </p>

	@endif
    
    
    
            
    </div>
    </div>

                	<div class="wrapper-inner">

                    <?php if(!empty($blog_count)){?>
                    
                    
                    <div class="col-md-4">
                    
                    <div class="borderbottom">
                        <h3 class="h4 heading black blogsidebar">
                        <?php echo translate( 229, $lang);?>
                        </h3>
                       
                    </div>
                     <div class="height20"></div>
                    
                    <?php foreach($popular_blog as $popular){
	
	?>
    
    <div class="clearfix">
   
        <div class="col-md-4 paddingoff">
         
        <?php if($popular->post_media_type=="image"){ ?>
    				<?php if(!empty($popular->post_image)){ ?>
          			<a href="<?php echo $url;?>/blog/<?php echo $popular->post_slug;?>" title="<?php echo $popular->post_title;?>"><img src="<?php echo $url.'/local/images/media/blog/'.$popular->post_image;?>" class="img-responsive blogpost"></a>
        			<?php } else {?>
       				<a href="<?php echo $url;?>/blog/<?php echo $popular->post_slug;?>" title="<?php echo $popular->post_title;?>"><img src="<?php echo $url;?>/local/images/noimage.jpg" class="img-responsive blogpost"></a>
        			<?php } ?>
                    <?php } ?>
                    
                    <?php if($popular->post_media_type=="mp3"){ ?>
                    <a href="<?php echo $url;?>/blog/<?php echo $popular->post_slug;?>" title="<?php echo $popular->post_title;?>"><img src="<?php echo $url;?>/local/images/blogaudio.png" class="img-responsive blogpost"></a>
                   
                    <?php } ?>
                    <?php if($popular->post_media_type=="video"){?>
                    <a href="<?php echo $url;?>/blog/<?php echo $popular->post_slug;?>" title="<?php echo $popular->post_title;?>"><img src="<?php echo $url;?>/local/images/blogvideo.png" class="img-responsive blogpost"></a>
                    <?php } ?>
                    
        </div>
        <div class="col-md-8 paddingleft10rightoff">
        <div class="black para poptitle ellipsis"><a href="<?php echo $url;?>/blog/<?php echo $popular->post_slug;?>" title="<?php echo $popular->post_title;?>" class="black decorationoff hoveroff"><?php echo $popular->post_title;?></a></div>
        <div class="ash fontsize12"><?php echo date("d M Y h:i:s a",strtotime($popular->post_date));?></div>
        </div>
    
    </div>
    <div class="clearfix height20"></div>
    <?php } ?>
	
            </div>        
                    
                    
                  <div class="col-md-8">  
                    <div class="bloglist listShow1">
                     <?php foreach($blogs as $blog){
						$date = $blog->post_date;
						
						$old_date = strtotime($date);
						$dateonly = date('d M Y', $old_date);
						
						?>
                    	<article id="post" class="post li-item1">

                        	

                        		

                        	
                            
                            <?php if($blog->post_media_type=="image"){ ?>
                            <figure>
    				<?php if(!empty($blog->post_image)){ ?>
          			<a href="<?php echo $url;?>/blog/<?php echo $blog->post_slug;?>" title="<?php echo $blog->post_title;?>"><img src="<?php echo $url.'/local/images/media/blog/'.$blog->post_image;?>" class="img-responsive" alt="<?php echo $blog->post_title;?>"></a>
        			<?php } else {?>
       				<a href="<?php echo $url;?>/blog/<?php echo $blog->post_slug;?>" title="<?php echo $blog->post_title;?>"><img src="<?php echo $url;?>/local/images/noimage.jpg" class="img-responsive" alt="<?php echo $blog->post_title;?>"></a>
        			<?php } ?>
                    </figure>
                    <?php } ?>
                            
                             <?php if($blog->post_media_type=="mp3"){ ?>
                              <figure>
                    <div class="text-center mp3_boxer">
                    <div class="height40"></div>
                     <div class="mediPlayer">
    				<audio class="listen" preload="none" data-size="250" src="<?php echo $url;?>/local/images/media/blog/<?php echo $blog->post_audio;?>"></audio>
					</div>
                    <div class="height40"></div>
                    </div>
                    </figure>
                    <?php } ?>
                    
                    <div>
                    <figure>
                    <?php 
					if($blog->post_media_type=="video"){
					if (strpos($blog->post_video, 'youtube') > 0) {
					 $vurl = $blog->post_video;
						preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $vurl, $matches);
						$id = $matches[1];
						
						$height = '420px';
					?>
                    
                    <iframe id="ytplayer" type="text/html" width="100%" height="<?php echo $height ?>" src="https://www.youtube.com/embed/<?php echo $id ?>?rel=0&showinfo=0&color=white&iv_load_policy=3" frameborder="0" allowfullscreen></iframe>
                    
                    <?php } 
					if (strpos($blog->post_video, 'vimeo') > 0) {
					$vimeo = $blog->post_video;
					?>
                    <div class='embed-container'>
                    <iframe src="https://player.vimeo.com/video/<?php echo (int) substr(parse_url($vimeo, PHP_URL_PATH), 1);?>" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                    </div>
					<?php }
					} ?>
                    </figure>
                    </div>
                     <?php
					$post_comment = DB::table('post')
							 ->where('post_parent', '=', $blog->post_id)
							 ->where('post_comment_type', '=', 'blog')
							 ->where('post_type', '=', 'comment')
							 ->where('post_status', '=', '1')
							 ->count();
					?>
                            

                            <section class="inner-right">

                            	<header>
                                    <div class="height20"></div>
                            		<h3><a href="<?php echo $url;?>/blog/<?php echo $blog->post_slug;?>" title="<?php echo $blog->post_title;?>" class="btitles"><?php echo $blog->post_title;?></a></h3>
                                    
                                     <div class="height5"></div>
                                    <span class="blogerdate"><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo $dateonly;?></span>
                                    <div class="height5"></div>
                                </header>

                            	<p><?php echo html_entity_decode(substr($blog->post_desc,0,300)).'...';?></p>
                                
                            </section>
                             <div class="clearfix"></div>
                             <div class="float-left">
<div class="text-left"><a href="<?php echo $url;?>/blog/<?php echo $blog->post_slug;?>" class="custom-btn"><?php echo translate( 232, $lang);?></a></div>
                             </div>
                             <div class="float-right">
                             <i class="fa fa-comment-o" aria-hidden="true"></i> <?php echo $post_comment;?> <?php echo translate( 235, $lang);?>
                             </div>


                            <div class="clearfix height50"></div>

                        </article>
                         <?php } ?>
                         </div>
                         
                           <div class="turn-page" id="welpager1"></div>
                          
                          </div>
                          
                          
                          
                          
                          
                          
                         <?php } ?>

                        
                        

                       



                        

                    </div>

                </div>

           

    
    
    
    
    
    
    
    
    
    
	

            	<div class="container">

                	
                    
                   
                     <?php if(!empty($post_count)){?>
                     <div class="col-md-4">
                     
                    <div class="borderbottom">
                        <h3 class="h4 heading black blogsidebar">
                        <?php echo translate( 229, $lang);?>
                        </h3>
                       
                    </div>
                     <div class="height20"></div>
                    
                    <?php foreach($popular_blog as $popular){
	
	?>
    
    <div class="clearfix">
   
        <div class="col-md-4 paddingoff">
         
        <?php if($popular->post_media_type=="image"){ ?>
    				<?php if(!empty($popular->post_image)){ ?>
          			<a href="<?php echo $url;?>/blog/<?php echo $popular->post_slug;?>" title="<?php echo $popular->post_title;?>"><img src="<?php echo $url.'/local/images/media/blog/'.$popular->post_image;?>" class="img-responsive blogpost"></a>
        			<?php } else {?>
       				<a href="<?php echo $url;?>/blog/<?php echo $popular->post_slug;?>" title="<?php echo $popular->post_title;?>"><img src="<?php echo $url;?>/local/images/noimage.jpg" class="img-responsive blogpost"></a>
        			<?php } ?>
                    <?php } ?>
                    
                    <?php if($popular->post_media_type=="mp3"){ ?>
                    <a href="<?php echo $url;?>/blog/<?php echo $popular->post_slug;?>" title="<?php echo $popular->post_title;?>"><img src="<?php echo $url;?>/local/images/blogaudio.png" class="img-responsive blogpost"></a>
                   
                    <?php } ?>
                    <?php if($popular->post_media_type=="video"){?>
                    <a href="<?php echo $url;?>/blog/<?php echo $popular->post_slug;?>" title="<?php echo $popular->post_title;?>"><img src="<?php echo $url;?>/local/images/blogvideo.png" class="img-responsive blogpost"></a>
                    <?php } ?>
                    
        </div>
        <div class="col-md-8 paddingleft10rightoff">
        <div class="black para poptitle ellipsis"><a href="<?php echo $url;?>/blog/<?php echo $popular->post_slug;?>" title="<?php echo $popular->post_title;?>" class="black decorationoff hoveroff"><?php echo $popular->post_title;?></a></div>
        <div class="ash fontsize12"><?php echo date("d M Y h:i:s a",strtotime($popular->post_date));?></div>
        </div>
    
    </div>
    <div class="clearfix height20"></div>
    <?php } ?>
	
    
    </div>
     <?php } ?>               
                    
                    
                    
                    
                    
                    
                    <?php if(!empty($post_count)){
	
					$date = $post[0]->post_date;
					
					$old_date = strtotime($date);
					$dateonly = date('d F Y', $old_date);
					
					?>
                     <div class="col-md-8">
                    
                    <?php if($post[0]->post_media_type=="image"){ ?>
                    <div class="text-center">
                    
    				<?php if(!empty($post[0]->post_image)){ ?>
          			<img src="<?php echo $url.'/local/images/media/blog/'.$post[0]->post_image;?>" class="img-responsive" title="<?php echo $post[0]->post_title;?>">
        			<?php } else {?>
       				<img src="<?php echo $url;?>/local/images/noimage.jpg" class="img-responsive" title="<?php echo $post[0]->post_title;?>">
        			<?php } ?>
                     </div>
                    <?php } ?>
                   
                    
                    <?php if($post[0]->post_media_type=="mp3"){ ?>
                    <div class="text-center mp3_boxer">
                    <div class="height20"></div>
                     <div class="mediPlayer">
    				<audio class="listen" preload="none" data-size="200" src="<?php echo $url;?>/local/images/media/blog/<?php echo $post[0]->post_audio;?>"></audio>
					</div>
                    <div class="height20"></div>
                    </div>
                    <?php } ?>
                    
                    
                    <?php 
					if($post[0]->post_media_type=="video"){?>
                    <div>
                    <?php
					if (strpos($post[0]->post_video, 'youtube') > 0) {
					 $vurl = $post[0]->post_video;
						preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $vurl, $matches);
						$id = $matches[1];
						
						$height = '420px';
					?>
                    <iframe id="ytplayer" type="text/html" width="100%" height="<?php echo $height ?>" src="https://www.youtube.com/embed/<?php echo $id ?>?rel=0&showinfo=0&color=white&iv_load_policy=3" frameborder="0" allowfullscreen></iframe>
                    
                    <?php } 
					if (strpos($post[0]->post_video, 'vimeo') > 0) {
					$vimeo = $post[0]->post_video;
					?>
                    <iframe src="https://player.vimeo.com/video/<?php echo (int) substr(parse_url($vimeo, PHP_URL_PATH), 1);?>" width="100%" height="420" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
					<?php }?>
                    </div>
					<?php } ?>
                    
                    
                    
                    
                    <div class="blogbody">
                   
                    <div class="h3 black"><?php echo $post[0]->post_title;?></div>
                    
                    <p><i class="fa fa-calendar-o" aria-hidden="true"></i> <?php echo $dateonly;?></p>
                    <div class="clearfix"></div>
                    <div class="cpara black"><?php echo html_entity_decode($post[0]->post_desc);?></div>
                    <div class="clearfix height40"></div>
                    
                    
                    
                    
                    
                    
			
            <div class="socialshare text-left">
        	<?php 
			if(!empty($post[0]->post_image)){  $imgurls = $url.'/local/images/media/blog/'.$post[0]->post_image; } 
			else { $imgurls = $url.'/local/images/noimage.jpg'; }
			
			?>
            
        		<span class="bold black"><i class="fa fa-share-alt" aria-hidden="true"></i> <?php echo translate( 238, $lang);?> :</span>
        		<span>
        			<a class="share-button" data-share-url="<?php echo $url;?>/blog/<?php echo $post[0]->post_slug;?>" data-share-network="facebook" data-share-text="<?php echo substr($post[0]->post_desc,0,80);?>" data-share-title="<?php echo $post[0]->post_title;?>" data-share-via="<?php echo $setts[0]->site_name;?>" data-share-tags="" data-share-media="<?php echo $imgurls;?>" href="javascript:void(0);"><img src="<?php echo $url;?>/local/images/social/facebook.png" border="0" /></a>
        		
        			 <a class="share-button" data-share-url="<?php echo $url;?>/blog/<?php echo $post[0]->post_slug;?>" data-share-network="twitter" data-share-text="<?php echo substr($post[0]->post_desc,0,80);?>" data-share-title="<?php echo $post[0]->post_title;?>" data-share-via="<?php echo $setts[0]->site_name;?>" data-share-tags="" data-share-media="<?php echo $imgurls;?>" href="javascript:void(0);"><img src="<?php echo $url;?>/local/images/social/twitter.png" border="0" /></a>
        		
        			<a class="share-button" data-share-url="<?php echo $url;?>/blog/<?php echo $post[0]->post_slug;?>" data-share-network="linkedin" data-share-text="<?php echo substr($post[0]->post_desc,0,80);?>" data-share-title="<?php echo $post[0]->post_title;?>" data-share-via="<?php echo $setts[0]->site_name;?>" data-share-tags="" data-share-media="<?php echo $imgurls;?>" href="javascript:void(0);"><img src="<?php echo $url;?>/local/images/social/linkedin.png" border="0" /></a>
        		
        			<a class="share-button" data-share-url="<?php echo $url;?>/blog/<?php echo $post[0]->post_slug;?>" data-share-network="googleplus" data-share-text="<?php echo substr($post[0]->post_desc,0,80);?>" data-share-title="<?php echo $post[0]->post_title;?>" data-share-via="<?php echo $setts[0]->site_name;?>" data-share-tags="" data-share-media="<?php echo $imgurls;?>" href="javascript:void(0);"><img src="<?php echo $url;?>/local/images/social/gplus.png" border="0" /></a>
        		
					<a class="share-button" data-share-url="<?php echo $url;?>/blog/<?php echo $post[0]->post_slug;?>" data-share-network="pinterest" data-share-text="<?php echo substr($post[0]->post_desc,0,80);?>" data-share-title="<?php echo $post[0]->post_title;?>" data-share-via="<?php echo $setts[0]->site_name;?>" data-share-tags="" data-share-media="<?php echo $imgurls;?>" href="javascript:void(0);"><img src="<?php echo $url;?>/local/images/social/pinterest.png" border="0" /></a>
				
                
                <a  class="share-button" data-share-url="<?php echo $url;?>/blog/<?php echo $post[0]->post_slug;?>" data-share-network="reddit" data-share-text="<?php echo substr($post[0]->post_desc,0,80);?>" data-share-via="<?php echo $setts[0]->site_name;?>" data-share-tags="" data-share-media="<?php echo $imgurls;?>" href="javascript:void(0);"><img src="<?php echo $url;?>/local/images/social/reddit.png" border="0" /></a>
                </span>
                
            </div>
       
                <div class="clearfix height20"></div>     
                    <div class="text-left">
                    <span class="bold black"><i class="fa fa-tags" aria-hidden="true"></i> <?php echo translate( 205, $lang);?> :</span>
                    
                    <span>
                    <?php 
					$post_tags = explode(',',$post[0]->post_tags);
					
					foreach($post_tags as $tags)
                    {
					$tag =strtolower(str_replace(" ","-",$tags)); 
					if(!empty($tags))
					{
					?>
                    <a href="<?php echo $url;?>/tag/blog/<?php echo $tag;?>" class="white gcolorbg"><?php echo $tags;?></a>
                    <?php
					}
					}
					?>
                    </span>
                    
                    </div>
                    
                    
                    
                   <div class="clearfix height50"></div>
       
         <?php /*?><div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 paddingoff">
          <?php if(!empty($previous)){
		
		?>
         <div class="float-left"><a href="<?php echo $url;?>/blog/<?php echo $previous_link[0]->post_slug;?>" class="custom-btn"><i class="fa fa-chevron-left" aria-hidden="true"></i> <?php echo 'previous';?></a></div>
         <?php } ?>
         
         
         
         <?php if(!empty($next)){
		
		 ?>
         <div class="float-right"><a href="<?php echo $url;?>/blog/<?php echo $next_link[0]->post_slug;?>" class="custom-btn"><?php echo 'next';?> <i class="fa fa-chevron-right" aria-hidden="true"></i></a></div>
          <?php } ?>
         </div><?php */?>
         
         
        
        
          <div class="clearfix height50"></div>
          
          
          <div class="col-md-12 paddingoff">
        <div class="h3 black blogsidebar"><?php echo translate( 241, $lang);?></div>
        <div class="clear height20"></div>
        <?php if(Auth::check()) { ?>
        <div>
        <form class="form-horizontal" role="form" method="POST" action="{{ route('blog') }}" id="formID" enctype="multipart/form-data">
                        {{ csrf_field() }}
	
	<div class="paddingoff">
    
	
          <div class="col-lg-12 col-md-12 col-sm-12 paddingoff">
            <label class="ash"><?php echo translate( 244, $lang);?><span class="star">*</span></label>
            <input type="text" value=""  class="form-control validate[required] text-input radiusoff" id="name" name="name" >
          </div>
         <div class="clearfix height10"></div>
          <div class="col-lg-12 col-md-12 col-sm-12 paddingoff">
            <label class="ash"><?php echo translate( 247, $lang);?><span class="star">*</span> </label>
            <input type="text" value="<?php echo Auth::user()->email;?>"  class="form-control validate[required,custom[email]] text-input radiusoff" id="email" name="email" readonly>
          </div>
		  
          <div class="clearfix height10"></div>
          <div class="col-lg-12 col-md-12 col-sm-12 paddingoff">
            <label class="ash"><?php echo translate( 250, $lang);?><span class="star">*</span> </label>
            <textarea value=""   class="form-control validate[required] text-input radiusoff height150" id="msg" name="msg"></textarea>
          </div>
          
          <input type="hidden" name="post_comment_type" value="blog">
          
           <input type="hidden" name="post_type" value="comment">
           
           <input type="hidden" name="post_user_id" value="<?php echo Auth::user()->id;?>">
           
           <?php if($lang == "en") { $newy = $post[0]->post_id; } else { $newy = $post[0]->parent; } ?>
          
          <input type="hidden" name="post_parent" value="<?php echo $newy;?>">
          
		  <div class="clearfix height20"></div>
          <div class="paddingoff">
            <input type="submit" class="custom-btn customwidth" value="<?php echo translate( 253, $lang);?>">
          </div>
		  <div class="clearfix height50"></div>
		 </div> 
        </form>
        </div>
        
		
		<?php
		if($lang == "en")
		{
		   $texter = $post[0]->post_id;
		}
		else
		{
		   $texter = $post[0]->parent;
		}
		
		$pcomment = DB::table('post')
							 ->where('post_parent', '=', $texter)
							 ->where('post_comment_type', '=', 'blog')
							 ->where('post_type', '=', 'comment')
							 ->where('post_status', '=', '1')
							 ->orderBy('post_id', 'DESC')
							 ->get();
							 $pcnt = DB::table('post')
							 ->where('post_parent', '=', $texter)
							 ->where('post_comment_type', '=', 'blog')
							 ->where('post_type', '=', 'comment')
							 ->where('post_status', '=', '1')
							 ->count();
						 
			if(!empty($pcnt)){				 ?>
        <div class="clearfix height20"></div>
         <div class="h3 black"><?php echo translate( 256, $lang);?></div>
         <div class="clearfix height30"></div>
         
         <?php 
		 
							 foreach($pcomment as $viwcomment){
							 $user = DB::table('users')
							         ->where('id', '=', $viwcomment->post_user_id)
									 ->get();
		?>					 
         <div class="col-lg-2 col-md-2 col-sm-2">
         <?php 
					   $userphoto="/media/userphoto/";
						$path ='/local/images'.$userphoto.$user[0]->photo;
						if($user[0]->photo!=""){
						?>
						 <img src="<?php echo $url.$path;?>" class="thumb round" width="70" style="padding:0px !important;">
						 <?php } else { ?>
						  <img src="<?php echo $url.'/local/images/nophoto.jpg';?>" class="thumb round" width="70" style="padding:0px !important;">
						 <?php } ?>
         </div>
         <div class="col-lg-10 col-md-10 col-sm-10 paddingoff">
         <div class="h4 black"><?php echo $viwcomment->post_title;?></div>
         <div class="height5"></div>
         <div class="para"><?php echo $viwcomment->post_desc;?></div>
         <div class="height5"></div>
         <div class="fontsize12 gold italic"><?php echo date('d M Y h:i:s a',strtotime($viwcomment->post_date));?></div>
         </div>
         <div class="clearfix borderbottom paddingtopbottom10"></div>
         <div class="height20"></div>
         <?php } } ?>
         
        
        <?php } else {?>
        <div class="para black"><?php echo translate( 259, $lang);?> <a href="<?php echo $url;?>/login" class="blacker bold"><?php echo translate( 262, $lang);?></a> <?php echo translate( 265, $lang);?></div>
        <div class="height100"></div>
        <?php } ?>
        </div>
          
          
          
          
                   
              </div>      
                    
                    
                    <?php } ?>
                    
                    </div>
                    
                    
                    
                    </div>
                    
                  
                   
	
	
	 </main>
	
	
	 
    
	<?php } else { ?>
    
    
    
    
    <div class="promo-area" style="background-image: url(<?php echo $url;?>/local/images/media/settings/<?php echo $setts[0]->site_banner;?>)">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="promo-text">
                        <h2 class="avigher-title bolder fontsize30"><?php echo translate( 79, $lang);?></h2>
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
                        
                        <li class="breadcrumb-item active"><?php echo translate( 79, $lang);?></li>
                        
                    </ol>
                </div>
            </div>
        </div>
    </div> 
    

	
    
	
	
	
	
	
	
	<main class="checkout-area main-content">
<div class="clearfix height20"></div>
        <div class="container">





    <div class="row">
	
	
	
	
	
	
	
	
	
	
	<div class="">
    <div class="">
     
        <div class="col-md-12 text-center">
        <h3>
            <?php echo translate( 82, $lang);?>
    </h3>
        </div>
         
    </div>
</div>
	
	</div>
</div>
<div class="clearfix"></div>
</main>
	
<?php } ?>
	
	<?php /* share */?>
<script src="<?php echo $url;?>/local/resources/views/theme/js/jquery.simpleSocialShare.min.js"></script>

<script type="text/javascript">

	$(document).ready(function(){

		$('.share-button').simpleSocialShare();

	});

</script>

<?php /* share */ ?>
    

      @include('footer')
      
       @endif
		      @if($cany_check_value == 0)
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  
                  <div class="x_content">
                  <h3 style="color:#FF0000;">Wrong codecanyon purchase details. Go to your <a href="<?php echo $url;?>/login" style="color:#3300FF; text-decoration:underline;">admin panel</a> -> verify purchase code -> update</h3>
                  </div>
                </div>
              </div>
              @endif
     
</body>
</html>