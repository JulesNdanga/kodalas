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

class CurrencyController extends Controller
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
		
	  
	
        $currency = DB::table('currency')->orderBy('currency_id','desc')->get();
        $settings = DB::select('select * from settings where id = ?',[1]);
        return view('admin.currency', ['currency' => $currency, 'settings' => $settings, 'cany_check_value' => $cany_check_value]);
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
      $currency = DB::select('select * from currency where currency_id = ?',[$id]);
      return view('admin.edit-currency',['currency'=>$currency]);
   }
   
   public function formview()

    {

        return view('admin.add-currency');

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

        		'currency_code' => 'required'

        		
				
				

        	]);
         
		 
				
		$input['currency_code'] = Input::get('currency_code');
		
       
		
		$rules = array(
		
		
		'currency_code' => [
                'required',
                'max:3',
                Rule::unique('currency')->where(function($query) {
                  $query->where('currency_code', '=', '');
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

			
		$currency_code=$data['currency_code'];
		
		
		
		
		
		
		
		
		DB::insert('insert into currency (currency_code) values (?)', [$currency_code]);
		
		
			return back()->with('success', 'Code has been created');
        
		
		
		}
		
         
		 
		 
		 
	}
	
	
	
   
   
   protected function pagedata(Request $request)
    {
       
		
		
		
		$this->validate($request, [

        		'currency_code' => 'required'

        		
				
				

        	]);
         $data = $request->all();
		 $id = $data['currency_id'];
				
		$input['currency_code'] = Input::get('currency_code');
		
       
		
		$rules = array(
		
		
		'currency_code' => [
                'required',
                'max:3',
                Rule::unique('currency')->ignore($id, 'currency_id')->where(function($query) {
                  $query->where('currency_code', '=', '');
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
		
		
		
		 
		   
		 
		 
		
		
		
		  

			
		$currency_code=$data['currency_code'];
		$currency_id = $data['currency_id'];
		
		
		
		
		DB::update('update currency set currency_code="'.$currency_code.'" where currency_id = ?', [$currency_id]);
		
		
		
		
			return back()->with('success', 'Code has been updated');
        
		
		
		}
		
		
		
		
		
		
		
    }
   
   
   
   public function deleted($id) 
   {
	
	    $idd = base64_decode($id);
		
		$settings = DB::select('select * from settings where id = ?',[1]);
		  
		  $current_symbol = $settings[0]->site_currency;
		
      DB::delete('delete from currency where currency_code!="'.$current_symbol.'" and currency_id = ?',[$idd]);
	   
      return back();
      
   }
   
   
   
   
   
   protected function delete_all(Request $request)
    {
		
		
	   $data = $request->all();
	   $currencyid = $data['currency_id'];
	   
	   foreach($currencyid as $pid)
	   {
   
   
		  $settings = DB::select('select * from settings where id = ?',[1]);
		  
		  $current_symbol = $settings[0]->site_currency;
		  
		  DB::delete('delete from currency where currency_code!="'.$current_symbol.'" and currency_id = ?',[$pid]);
		   
		  
      
        }
   return back();
   }
   
   
   
   
   
   
   
	
	
	
}