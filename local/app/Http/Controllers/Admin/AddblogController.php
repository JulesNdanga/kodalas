<?php

namespace Responsive\Http\Controllers\Admin;


use Responsive\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use Responsive\Http\Requests;
use Illuminate\Http\Request;
use Responsive\User;
use File;
use Image;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class AddblogController extends Controller
{
    
   

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function formview()

    {
       $language = DB::table('avig_language')
		            ->where('lang_status', '=', 1)
					->orderBy('id','asc')
					->get();
		$data = array('language' => $language);			
        return view('admin.add-blog')->with($data);

    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
	 
	 /* protected $fillable = ['name', 'email','password','phone']; */
	 
	 
	
	
	
	
	public function clean($string) 
	{
    
     $string = preg_replace("/[^\p{L}\/_|+ -]/ui","",$string);

    
    $string = preg_replace("/[\/_|+ -]+/", '-', $string);

    
    $string =  trim($string,'-');

    return mb_strtolower($string);
	}
	
	 
	 
	 
	 
    protected function addblogdata(Request $request)
    {
        
		
		
		 $this->validate($request, [

        		'post_title' => 'required'

        		
				
				

        	]);
         
		 
				
		$input['post_title'] = Input::get('post_title');
       $settings = DB::select('select * from settings where id = ?',[1]);
	      $imgsize = $settings[0]->image_size;
		  $imgtype = $settings[0]->image_type;	
		  $mp3size = $settings[0]->mp3_size;
		
		$rules = array(
		
		'post_title' => 'unique:post,post_title',
		
		'photo' => 'max:'.$imgsize.'|mimes:'.$imgtype,
		'audio_file' => 'max:'.$mp3size.'|mimes:mpga',
		
		
		);
		
		
		$messages = array(
            
            
			
        );

		$validator = Validator::make(Input::all(), $rules, $messages);
		
		
		 
		 
		if ($validator->fails())
		{
			$failedRules = $validator->failed();
			return back()->withErrors($validator);
		}
		else
		{  
		 

		
	
	
	     $image = Input::file('photo');
		 if($image!="")
		 {
            $filename  = time() . '.' . $image->getClientOriginalExtension();
            $testimonialphoto="/media/blog/";
            $path = base_path('images'.$testimonialphoto.$filename);
			$destinationPath=base_path('images'.$testimonialphoto);
 
        
               Image::make($image->getRealPath())->resize(870, 490)->save($path);
				 /*Input::file('photo')->move($destinationPath, $filename);*/
               /* $user->image = $filename;
                $user->save();*/
				$namef=$filename;
		 }
		 else
		 {
			 $namef="";
		 }
	
	      $music_file = Input::file('audio_file'); 
		 if(isset($music_file))
		 { 
		 $filename = time() . '.' . $music_file->getClientOriginalName();
		
		 $sermonmp3 = base_path('images/media/blog/'); 
		 $music_file->move($sermonmp3,$filename); 
		 $mp3name = $filename; 
		 }
		 else
		 {
		    $mp3name = "";
		 }
	
	
	
	
	
		  $data = $request->all();

			/*User::create([
            'name' => $data['name'],
            'email' => $data['email'],
			'admin' => '0',
            'password' => bcrypt($data['password']),
			'phone' => $data['phone']
			
        ]);*/
		$post_title=$data['post_title'];
		
		if(!empty($data['post_desc']))
		{
		$post_desc=$data['post_desc'];
		}
		else
		{
		$post_desc = "";
		}
		
		$post_type = $data['post_type'];
		$media_type = $data['media_type'];
		
		$video_url=$data['video_url'];
		
		
		
		if(!empty($data['slug']))
		{
		$slug = $data['slug'];
		}
		else
		{
		   $slug = "";
		}
		
		
		
		if(!empty($video_url))
		{
		   $videourl = $video_url;
		}
		else
		{
		   $videourl = "";
		}
		$post_status = 1;
		
		$post_date = date("Y-m-d H:i:s");
		
		if(!empty($data['tags']))
		{
		$post_tags=$data['tags'];
		}
		else
		{
		  $post_tags="";
		}
		
		
		
		
		
		$check_sett_seo = DB::table('settings_meta')
		        ->where('sett_meta_id', '=' , 21)
				->where('sett_meta_key', '=' , "site_seo_slug")
		        
				->count();
		if(!empty($check_sett_seo))
		{
		   
		    $sett_meta_seo = DB::table('settings_meta')
		        ->where('sett_meta_id', '=' , 21)
				->where('sett_meta_key', '=' , "site_seo_slug")
		        
				->count();
				
			if(!empty($sett_meta_seo))
			{	
		   $sett_meta_chat =  DB::table('settings_meta')
		        ->where('sett_meta_id', '=' , 21)
				->where('sett_meta_key', '=' , "site_seo_slug")
		        
				->get();
			$site_seo = $sett_meta_chat[0]->sett_meta_value;
			}
			else
			{
			$site_seo = "";
			}	
		}
		else
		{
		  $site_seo = "";
		}
	   
	   
	   
	   if($site_seo == "no")
	   {
	      $pther = str_replace(" ","-",$slug);
	   }
	   else
	   {
	      $pther = $this->clean($slug);
	   }
		
		
		
		
		$token = $data['token'];
		foreach($data['code'] as $index => $code)
		{
		
		   $postitle=$post_title[$index];
		   $postdesc=$post_desc[$index];
		   
		   
		   
		   if($code=='en')
			   {
				   $parent=0;
			   }
			   else
			   {
			   
			      $post = DB::table('post')
		           	->where('token', '=', $token)
					->where('parent', '=', 0)
					->get();
					
					 $post_cnt = DB::table('post')
		           		->where('token', '=', $token)
					->where('parent', '=', 0)
					->count();
					if($post_cnt==0)
					{
					
                       	$parent = $idd;				
					  
					   
					}
					else
					{
					   $parent=$post[0]->post_id;
					}
			   
		    }
		
		if(!empty($postitle))
		{
		   $postitee = $postitle;
		}
		else
		{
		   $postitee = "";
		}
		
		
		if(!empty($postdesc))
		{
		   $postdesso = $postdesc;
		}
		else
		{
		   $postdesso = "";
		}
		
		
		
		
		
		
		
		
		
		$idd = DB::table('post')-> insertGetId(array(
        'post_title' => $postitee,
		 'post_slug' => $pther,
		  'post_desc' => htmlentities($postdesso),
		   'post_tags' => $post_tags,
		    'post_type' => $post_type,
			 'post_media_type' => $media_type,
			 'post_image' => $namef,
			 'post_audio' => $mp3name,
			 'post_video' => $videourl,
			 'post_date' => $post_date,
			 'post_status' => $post_status,
			 
			 
				'lang_code' => $code,
				'token' => $token,
				'parent' => $parent,
			));
		
		} 
		
		
		
		/* DB::insert('insert into sermons (name, post_slug, post_tags, description , pastor_name, audio_file, video_url, pdf_file, image, submitdate) values (?, ?, ?, ? ,?, ?, ?, ?, ?, ?)', [$name,$post_slug, $post_tags, $desc, $pastor,$mp3name,$videourl,$pdfname,$namef,$datesubmit]); */
		
		
			return back()->with('success', 'Post has been created');
        }
		
		
		
		
		
    }
}
