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

class FrameworkController extends Controller
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
		
		
		$category = DB::table('category')
		            ->where('delete_status','=','')
					->where('cat_type','=','framework')
					->where('parent', '=', 0)
		             ->orderBy('id','desc')
					->get();

        return view('admin.framework_category', ['category' => $category, 'cany_check_value' => $cany_check_value]);
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
    
	
	
	protected function delete_all(Request $request)
    {
		
		
	   $data = $request->all();
	   $cat_id = $data['cat_id'];
	   
	   foreach($cat_id as $sid)
	   {
		   
		
		
		/*$image1 = DB::table('subcategory')->where('cat_id', $sid)->first();
		$image1_cnt = DB::table('subcategory')->where('cat_id', $sid)->count();
		if(!empty($image1_cnt))
		{
		$orginalfile1=$image1->subimage;
		$userphoto1="/media/";
       $path1 = base_path('images'.$userphoto1.$orginalfile1);
	  File::delete($path1);
	  DB::delete('delete from subcategory where cat_id = ?',[$sid]);
		  }
		  
		  $image = DB::table('category')->where('id', $sid)->first();
		$orginalfile=$image->image;
		$userphoto="/media/";
       $path = base_path('images'.$userphoto.$orginalfile);
	  File::delete($path);*/
	  
	  
	  
	  
	  DB::update('update subcategory set delete_status="deleted",status="0" where parent = ?',[$sid]);
	  DB::update('update subcategory set delete_status="deleted",status="0" where cat_id = ?',[$sid]);
	  DB::update('update category set delete_status="deleted",status="0" where parent = ?',[$sid]);
	  DB::update('update category set delete_status="deleted",status="0" where id = ?',[$sid]);
		  
		   
	   }
	   
      return back();
		
	}
	
	
	
	public function destroy($id) {
	
	    /*$image1 = DB::table('subservices')->where('service', $id)->first();
		$image1_cnt = DB::table('subservices')->where('service', $id)->count();
		if(!empty($image1_cnt)){
		$orginalfile1=$image1->subimage;
		$userphoto1="/media/";
       $path1 = base_path('images'.$userphoto1.$orginalfile1);
	  File::delete($path1);
	  DB::delete('delete from subservices where service = ?',[$id]);
	  }
		
		$image = DB::table('services')->where('id', $id)->first();
		$orginalfile=$image->image;
		$userphoto="/media/";
       $path = base_path('images'.$userphoto.$orginalfile);
	  File::delete($path);*/
	  DB::update('update subcategory set delete_status="deleted",status="0" where parent = ?',[$id]);
	  DB::update('update subcategory set delete_status="deleted",status="0" where cat_id = ?',[$id]);
	  DB::update('update category set delete_status="deleted",status="0" where parent = ?',[$id]);
	  DB::update('update category set delete_status="deleted",status="0" where id = ?',[$id]);
	  
	  
      
	  
	   
      return back();
      
   }
	
}