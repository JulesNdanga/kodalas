<?php
namespace Responsive\Http\Controllers\Admin;
use File;
use Image;
use Responsive\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use Responsive\Http\Requests;
use Illuminate\Http\Request;
use Responsive\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CountryController extends Controller
{
    /**
     * Show a list of all of the application's users.
     *
     * @return Response
     */
    public function index()
    {
	
	    /* new */		 
				 
		$check_sett_code = DB::table('settings_meta')
		        ->where('sett_meta_id', '=' , 73)
				->where('sett_meta_key', '=' , "cc_token")
		        
				->count();
		if(!empty($check_sett_code))
		{
		   
		    $sett_meta_well_four = DB::table('settings_meta')
		        ->where('sett_meta_id', '=' , 73)
				->where('sett_meta_key', '=' , "cc_token")
		        
				->count();
				
			if(!empty($sett_meta_well_four))
			{	
		   $sett_meta_four =  DB::table('settings_meta')
		        ->where('sett_meta_id', '=' , 73)
				->where('sett_meta_key', '=' , "cc_token")
		        
				->get();
			$code_feedback = $sett_meta_four[0]->sett_meta_value;
			}
			else
			{
			$code_feedback = "";
			}	
		}
		else
		{
		  $code_feedback = "";
		}
		
		
		
		$check_sett_byname = DB::table('settings_meta')
		        ->where('sett_meta_id', '=' , 74)
				->where('sett_meta_key', '=' , "cc_byname")
		        
				->count();
		if(!empty($check_sett_byname))
		{
		   
		    $sett_meta_well_four = DB::table('settings_meta')
		        ->where('sett_meta_id', '=' , 74)
				->where('sett_meta_key', '=' , "cc_byname")
		        
				->count();
				
			if(!empty($sett_meta_well_four))
			{	
		   $sett_meta_four =  DB::table('settings_meta')
		        ->where('sett_meta_id', '=' , 74)
				->where('sett_meta_key', '=' , "cc_byname")
		        
				->get();
			$cc_byname = $sett_meta_four[0]->sett_meta_value;
			}
			else
			{
			$cc_byname = "";
			}	
		}
		else
		{
		  $cc_byname = "";
		}
		
		
		
		$cany_check_value = 1;
		/* new */		 
		
        $country = DB::table('country')->orderBy('country_name','asc')->get();
        $settings = DB::select('select * from settings where id = ?',[1]);
        return view('admin.country', ['country' => $country, 'settings' => $settings, 'cany_check_value' => $cany_check_value]);
    }
	
	
	/* new */
	
	public function getPurchaseData( $code ) {
	
	$bearer = "M0yOfwFBnujwQt4KgVNuHiLDn7si9ExH";
      
      
      $bearer   = 'bearer ' . $bearer;
      $header   = array();
      $header[] = 'Content-length: 0';
      $header[] = 'Content-type: application/json; charset=utf-8';
      $header[] = 'Authorization: ' . $bearer;
      
      $verify_url = 'https://api.envato.com/v1/market/private/user/verify-purchase:'.$code.'.json';
      $ch_verify = curl_init( $verify_url . '?code=' . $code );
      
      curl_setopt( $ch_verify, CURLOPT_HTTPHEADER, $header );
      curl_setopt( $ch_verify, CURLOPT_SSL_VERIFYPEER, false );
      curl_setopt( $ch_verify, CURLOPT_RETURNTRANSFER, 1 );
      curl_setopt( $ch_verify, CURLOPT_CONNECTTIMEOUT, 5 );
      curl_setopt( $ch_verify, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
      
      $cinit_verify_data = curl_exec( $ch_verify );
      curl_close( $ch_verify );
      
      if ($cinit_verify_data != "")    
        return json_decode($cinit_verify_data);  
      else
        return false;
        
    }
    
    public function verifyPurchase( $code ) {
      $verify_obj = self::getPurchaseData($code); 
      
      
      if ( 
          (false === $verify_obj) || 
          !is_object($verify_obj) ||
          !isset($verify_obj->{"verify-purchase"}) ||
          !isset($verify_obj->{"verify-purchase"}->item_name)
      )
        return -1;

      
      if (
        $verify_obj->{"verify-purchase"}->supported_until == "" ||
        $verify_obj->{"verify-purchase"}->supported_until != null
      )
        return $verify_obj->{"verify-purchase"};  
      
      
      return 0;
      
    }
	
	/* new */
    	
	
	
	
	public function showform($id) {
	$settings = DB::select('select * from settings where id = ?',[1]);
      $country = DB::select('select * from country where country_id = ?',[$id]);
      return view('admin.edit-country',['country'=>$country, 'settings' => $settings]);
   }
   
   public function formview()

    {

        return view('admin.add-country');

    }
	
	
	
	public function avigher_contact()
	{
	
	  $contact_count = DB::table('contact_us')
		                  ->orderBy('cont_id','desc')
					      ->count();
	   
	   
	    $contact_view = DB::table('contact_us')
		                 ->orderBy('cont_id','desc')
					     ->get();
					   
		$set_id=1;
		$site_setting = DB::table('settings')->where('id', $set_id)->get();			   

        return view('admin.contact', ['contact_count' => $contact_count, 'contact_view' => $contact_view, 'site_setting' => $site_setting]);
	
	
	}
	
	
	
	public function avigher_contact_delete($id)
	{
	
	
	DB::delete('delete from contact_us where cont_id = ?',[$id]);
	   
      return back();
	
	
	}
	
	
	
	
	
	
	public function clean($string) 
	{
    
     $string = preg_replace("/[^\p{L}\/_|+ -]/ui","",$string);

    
    $string = preg_replace("/[\/_|+ -]+/", '-', $string);

    
    $string =  trim($string,'-');

    return mb_strtolower($string);
	}
	
	
	
	
	
	
	protected function addpagedata(Request $request)
    {
       
		
		
		$this->validate($request, [

        		'country_name' => 'required'

        		
				
				

        	]);
         
		 
				
		$input['country_name'] = Input::get('country_name');
		
       
		
		$rules = array(
		
		
		'country_name' => [
                'required',
                
                Rule::unique('country')->where(function($query) {
                  $query->where('country_name', '=', '');
               })
               ]
		
		
		
		
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
		
		
		 

		
		
		  $data = $request->all();

			
		$country_name=$data['country_name'];
		
		
		$image = Input::file('country_badges');
        if($image!="")
		{	
            $settingphoto="/media/flag/";
			
			$filename  = time() . '.' . $image->getClientOriginalExtension();
            
            $path = base_path('images'.$settingphoto.$filename);
			$destinationPath=base_path('images'.$settingphoto);
      
                /*Image::make($image->getRealPath())->resize(200, 200)->save($path);*/
				
				Input::file('country_badges')->move($destinationPath, $filename);
				$savefname=$filename;
		}
        else
		{
			$savefname="";
		}
		
		
		
		
		
		DB::insert('insert into country (country_name,country_badges) values (?,?)', [$country_name,$savefname]);
		
		
			return back()->with('success', 'Record has been created');
        
		
		
		}
		
         
		 
		 
		 
	}
	
	
	
   
   
   protected function pagedata(Request $request)
    {
       
		
		
		
		$this->validate($request, [

        		'country_name' => 'required'

        		
				
				

        	]);
         $data = $request->all();
		 $id = $data['country_id'];
				
		$input['country_name'] = Input::get('country_name');
		
       
		
		$rules = array(
		
		
		'country_name' => [
                'required',
                
                Rule::unique('country')->ignore($id, 'country_id')->where(function($query) {
                  $query->where('country_name', '=', '');
               })
               ]
		
		
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
		
		
		
		 
		   
		 
		 
		
		
		
		  

			
		$country_name=$data['country_name'];
		$country_id = $data['country_id'];
		
		$current_photo = $data['current_photo'];
		
		$image = Input::file('country_badges');
        if($image!="")
		{	
            $settingphoto="/media/flag/";
			$delpathes = base_path('images'.$settingphoto.$current_photo);
			File::delete($delpathes);
			$filename  = time() . '.' . $image->getClientOriginalExtension();
            
            $path = base_path('images'.$settingphoto.$filename);
			$destinationPath=base_path('images'.$settingphoto);
      
                /*Image::make($image->getRealPath())->resize(200, 200)->save($path);*/
				
				Input::file('country_badges')->move($destinationPath, $filename);
				$savefname=$filename;
		}
        else
		{
			$savefname=$current_photo;
		}
		
		
		DB::update('update country set country_name="'.$country_name.'",country_badges="'.$savefname.'" where country_id = ?', [$country_id]);
		
		
		
		
			return back()->with('success', 'Record has been updated');
        
		
		
		}
		
		
		
		
		
		
		
    }
   
   
   
   public function deleted($id) 
   {
	
	    $idd = base64_decode($id);
		
		$check_country = DB::table('country')
		        ->where('country_id', '=' , $idd)
				->count();
		if(!empty($check_country))
		{
		$country = DB::select('select * from country where country_id = ?',[$idd]);
		
		$loadphotos="/media/flag/";
			$delpathee = base_path('images'.$loadphotos.$country[0]->country_badges);
			File::delete($delpathee);
		}
		$settings = DB::select('select * from settings where id = ?',[1]);
		  
		  
		
      DB::delete('delete from country where country_id = ?',[$idd]);
	   
      return back();
      
   }
   
   
   
   
   
   protected function delete_all(Request $request)
    {
		
		
	   $data = $request->all();
	   $countryid = $data['country_id'];
	   
	   foreach($countryid as $pid)
	   {
   
   
		  $settings = DB::select('select * from settings where id = ?',[1]);
		  
		  
		  $check_country = DB::table('country')
		        ->where('country_id', '=' , $pid)
				->count();
		if(!empty($check_country))
		{
		$country = DB::select('select * from country where country_id = ?',[$pid]);
		
		$loadphotos="/media/flag/";
			$delpathee = base_path('images'.$loadphotos.$country[0]->country_badges);
			File::delete($delpathee);
		}
		 
		  
		  DB::delete('delete from country where country_id = ?',[$pid]);
		   
		  
      
        }
   return back();
   }
   
   
   
   
   
   
   
	
	
	
}