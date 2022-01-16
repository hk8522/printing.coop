<?php
error_reporting("ERROR");
//error_reporting(E_ALL);

defined('BASEPATH') OR exit('No direct script access allowed');

defined('PASSWORD_SECRET_START') OR define('PASSWORD_SECRET_START','####PRINTINGCOOPSECURITYSTART####');
defined('PASSWORD_SECRET_END') OR define('PASSWORD_SECRET_END','####PRINTINGCOOPSECURITYEND####');
defined('BLOCKED_IPS_ACCESS_TIME_IN_MINUTES') OR define('BLOCKED_IPS_ACCESS_TIME_IN_MINUTES',240);
/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);
/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);
/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

defined('WEBSITE_NAME') OR define('WEBSITE_NAME','Printing Coop');
defined('WEBSITE_NAME_FRANCH') OR define('WEBSITE_NAME_FRANCH','Imprimeur.coop');

$DOCUMENT_ROOT=$_SERVER['DOCUMENT_ROOT'];
$HTTP_HOST=$_SERVER['HTTP_HOST'];
$HTTP_X_FORWARDED_PROTO=isset($_SERVER['HTTP_X_FORWARDED_PROTO']) ? $_SERVER['HTTP_X_FORWARDED_PROTO']:'http';

//$FILE_BASE_URL='https://'.$HTTP_HOST.'/';
$FILE_BASE_URL=$HTTP_X_FORWARDED_PROTO.'://'.$HTTP_HOST.'/';
defined('FILE_BASE_URL') OR define('FILE_BASE_URL',$FILE_BASE_URL);
defined('FILE_BASE_PATH') OR define('FILE_BASE_PATH',$DOCUMENT_ROOT.'/');

defined('FILE_UPLOAD_BASE_URL') OR define('FILE_UPLOAD_BASE_URL',FILE_BASE_URL.'uploads/');
defined('FILE_UPLOAD_BASE_PATH') OR define('FILE_UPLOAD_BASE_PATH',FILE_BASE_PATH.'uploads/');

defined('DEFAULT_IMAGE_URL') OR define('DEFAULT_IMAGE_URL',FILE_BASE_URL.'defaults/');

#define Product Image path and base url
defined('PRODUCT_IMAGE_BASE_URL') OR define('PRODUCT_IMAGE_BASE_URL',FILE_UPLOAD_BASE_URL.'products/');
defined('PRODUCT_IMAGE_LARGE_BASE_URL') OR define('PRODUCT_IMAGE_LARGE_BASE_URL',PRODUCT_IMAGE_BASE_URL.'large/');
defined('PRODUCT_IMAGE_MEDIUM_BASE_URL') OR define('PRODUCT_IMAGE_MEDIUM_BASE_URL',PRODUCT_IMAGE_BASE_URL.'medium/');
defined('PRODUCT_IMAGE_SMALL_BASE_URL') OR define('PRODUCT_IMAGE_SMALL_BASE_URL',PRODUCT_IMAGE_BASE_URL.'small/');

defined('PRODUCT_IMAGE_BASE_PATH') OR define('PRODUCT_IMAGE_BASE_PATH',FILE_UPLOAD_BASE_PATH.'products/');

defined('PRODUCT_IMAGE_LARGE_BASE_PATH') OR define('PRODUCT_IMAGE_LARGE_BASE_PATH',PRODUCT_IMAGE_BASE_PATH.'large/');

defined('PRODUCT_IMAGE_MEDIUM_BASE_PATH') OR define('PRODUCT_IMAGE_MEDIUM_BASE_PATH',PRODUCT_IMAGE_BASE_PATH.'medium/');

defined('PRODUCT_IMAGE_SMALL_BASE_PATH') OR define('PRODUCT_IMAGE_SMALL_BASE_PATH',PRODUCT_IMAGE_BASE_PATH.'small/');

defined('PRODUCT_DEFAULT_IMAGE_URL') OR define('PRODUCT_DEFAULT_IMAGE_URL',DEFAULT_IMAGE_URL.'product-no-image.png');

# BANNER Image path and base url
defined('BANNER_IMAGE_BASE_URL') OR define('BANNER_IMAGE_BASE_URL',FILE_UPLOAD_BASE_URL.'banners/');
defined('BANNER_IMAGE_LARGE_BASE_URL') OR define('BANNER_IMAGE_LARGE_BASE_URL',BANNER_IMAGE_BASE_URL.'large/');
defined('BANNER_IMAGE_MEDIUM_BASE_URL') OR define('BANNER_IMAGE_MEDIUM_BASE_URL',BANNER_IMAGE_BASE_URL.'medium/');
defined('BANNER_IMAGE_SMALL_BASE_URL') OR define('BANNER_IMAGE_SMALL_BASE_URL',BANNER_IMAGE_BASE_URL.'small/');

defined('BANNER_IMAGE_BASE_PATH') OR define('BANNER_IMAGE_BASE_PATH',FILE_UPLOAD_BASE_PATH.'banners/');

defined('LOGO_IMAGE_BASE_PATH') OR define('LOGO_IMAGE_BASE_PATH',FILE_UPLOAD_BASE_PATH.'logo/');
defined('LOGO_IMAGE_BASE_URL') OR define('LOGO_IMAGE_BASE_URL',FILE_UPLOAD_BASE_URL.'logo/');

defined('SECTION_IMAGE_BASE_PATH') OR define('SECTION_IMAGE_BASE_PATH',FILE_UPLOAD_BASE_PATH.'section/');
defined('SECTION_IMAGE_BASE_URL') OR define('SECTION_IMAGE_BASE_URL',FILE_UPLOAD_BASE_URL.'section/');

defined('BANNER_IMAGE_LARGE_BASE_PATH') OR define('BANNER_IMAGE_LARGE_BASE_PATH',BANNER_IMAGE_BASE_PATH.'large/');

defined('BANNER_IMAGE_MEDIUM_BASE_PATH') OR define('BANNER_IMAGE_MEDIUM_BASE_PATH',BANNER_IMAGE_BASE_PATH.'medium/');

defined('BANNER_IMAGE_SMALL_BASE_PATH') OR define('BANNER_IMAGE_SMALL_BASE_PATH',BANNER_IMAGE_BASE_PATH.'small/');

defined('BANNER_DEFAULT_IMAGE_URL') OR define('BANNER_DEFAULT_IMAGE_URL',DEFAULT_IMAGE_URL.'banner-no-image.png');

# BRAND Image path and base url
defined('BRAND_IMAGE_BASE_URL') OR define('BRAND_IMAGE_BASE_URL',FILE_UPLOAD_BASE_URL.'brands/');
defined('BRAND_IMAGE_LARGE_BASE_URL') OR define('BRAND_IMAGE_LARGE_BASE_URL',BRAND_IMAGE_BASE_URL.'large/');

defined('BRAND_IMAGE_BASE_PATH') OR define('BRAND_IMAGE_BASE_PATH',FILE_UPLOAD_BASE_PATH.'brands/');

defined('BRAND_IMAGE_LARGE_BASE_PATH') OR define('BRAND_IMAGE_LARGE_BASE_PATH',BRAND_IMAGE_BASE_PATH.'large/');
defined('BRAND_DEFAULT_IMAGE_URL') OR define('BRAND_DEFAULT_IMAGE_URL',DEFAULT_IMAGE_URL.'brand-no-image.png');

//category image and path
defined('CATEGORY_IMAGE_BASE_URL') OR define('CATEGORY_IMAGE_BASE_URL',FILE_UPLOAD_BASE_URL.'category/');
defined('CATEGORY_IMAGE_LARGE_BASE_URL') OR define('CATEGORY_IMAGE_LARGE_BASE_URL',CATEGORY_IMAGE_BASE_URL.'large/');

defined('CATEGORY_IMAGE_BASE_PATH') OR define('CATEGORY_IMAGE_BASE_PATH',FILE_UPLOAD_BASE_PATH.'category/');
defined('CATEGORY_IMAGE_LARGE_BASE_PATH') OR define('CATEGORY_IMAGE_LARGE_BASE_PATH',CATEGORY_IMAGE_BASE_PATH.'large/');

defined('CATEGORY_DEFAULT_IMAGE_URL') OR define('CATEGORY_DEFAULT_IMAGE_URL',DEFAULT_IMAGE_URL.'brand-no-image.png');

defined('BLOG_IMAGE_BASE_PATH') OR define('BLOG_IMAGE_BASE_PATH',FILE_UPLOAD_BASE_PATH.'blogs/');

defined('BLOG_IMAGE_LARGE_BASE_PATH') OR define('BLOG_IMAGE_LARGE_BASE_PATH',BLOG_IMAGE_BASE_PATH.'large/');

defined('BLOG_IMAGE_MEDIUM_BASE_PATH') OR define('BLOG_IMAGE_MEDIUM_BASE_PATH',BLOG_IMAGE_BASE_PATH.'medium/');

defined('BLOG_IMAGE_SMALL_BASE_PATH') OR define('BLOG_IMAGE_SMALL_BASE_PATH',BLOG_IMAGE_BASE_PATH.'small/');

defined('BLOG_IMAGE_BASE_URL') OR define('BLOG_IMAGE_BASE_URL',FILE_UPLOAD_BASE_URL.'blogs/');
defined('BLOG_IMAGE_LARGE_BASE_URL') OR define('BLOG_IMAGE_LARGE_BASE_URL',BLOG_IMAGE_BASE_URL.'large/');
defined('BLOG_IMAGE_MEDIUM_BASE_URL') OR define('BLOG_IMAGE_MEDIUM_BASE_URL',BLOG_IMAGE_BASE_URL.'medium/');
defined('BLOG_IMAGE_SMALL_BASE_URL') OR define('BLOG_IMAGE_SMALL_BASE_URL',BLOG_IMAGE_BASE_URL.'small/');

defined('TEMPLATE_FILE_BASE_PATH') OR define('TEMPLATE_FILE_BASE_PATH',FILE_UPLOAD_BASE_PATH.'templates/');
defined('TEMPLATE_FILE_URL') OR define('TEMPLATE_FILE_URL',FILE_UPLOAD_BASE_URL.'templates/');

defined('TEMPLATE_FILE_ALLOWED_TYPES') OR define('TEMPLATE_FILE_ALLOWED_TYPES','jpg|jpeg|png|gif|pdf|doc|docx|xlsx|xls|csv');
defined('TEMPLATE_FILE_MAX_SIZE') OR define('TEMPLATE_FILE_MAX_SIZE',10240); //in Kb

defined('FILE_ALLOWED_TYPES') OR define('FILE_ALLOWED_TYPES','jpg|jpeg|png|gif');
defined('FILE_MAX_SIZE') OR define('FILE_MAX_SIZE',2048); //in Kb
defined('FILE_MAX_SIZE_JS') OR define('FILE_MAX_SIZE_JS',1024*1024*2); //1048576 bytes
defined('CURREBCY_SYMBOL') OR define('CURREBCY_SYMBOL','CA$ ');
defined('ORDER_ID_PREFIX') OR define('ORDER_ID_PREFIX','PRINTINGCOOP-');
defined('ORDER_ID_PREFIX_FRENCH') OR define('ORDER_ID_PREFIX_FRENCH','IMPRIMEURCOOP-');
defined('CUSTOMER_ID_PREFIX') OR define('CUSTOMER_ID_PREFIX','CUST-0');

//Payumoney
defined('PAYUMONEY_MERCHANT_KEY') OR define('PAYUMONEY_MERCHANT_KEY','pUuv93T5');defined('PAYUMONEY_MERCHANT_SALT') OR define('PAYUMONEY_MERCHANT_SALT','nSAGaIQThL');
defined('PAYUMONEY_CALL_BACK_URL') OR define('PAYUMONEY_CALL_BACK_URL',FILE_BASE_URL.'Checkouts/payumoneyResponse');

//defined('SEND_EMAIL_USERNAME')   OR define('SEND_EMAIL_USERNAME', 'neelu164');
//defined('SEND_EMAIL_PASSWORD')   OR define('SEND_EMAIL_PASSWORD', 'Neelu164@');

defined('SEND_EMAIL_USERNAME')   OR define('SEND_EMAIL_USERNAME', 'info@imprimeur.coop');
defined('SEND_EMAIL_PASSWORD')   OR define('SEND_EMAIL_PASSWORD', 'KharhaKharha.@.1392');
//defined('SEND_EMAIL_API_KEY')   OR define('SEND_EMAIL_API_KEY','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');
defined('SEND_EMAIL_API_KEY')   OR define('SEND_EMAIL_API_KEY','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');

defined('FROM_EMAIL')  OR define('FROM_EMAIL','info@printing.coop');
defined('FROM_EMAIL_FRANCH')  OR define('FROM_EMAIL_FRANCH','info@imprimeur.coop');
defined('ADMIN_EMAIL') OR define('ADMIN_EMAIL','info@printing.coop');
defined('ADMIN_EMAIL1') OR define('ADMIN_EMAIL1','imprimeur.coop@gmail.com');
defined('ADMIN_EMAIL2') OR define('ADMIN_EMAIL2','techbull.in@gmail.com');
defined('ADMIN_MOBILE') OR define('ADMIN_MOBILE','514-544-8043');

defined('SEND_EMAIL_URL') OR define('SEND_EMAIL_URL','https://api.sendgrid.com/');

defined('RECTO_ATTRIBUTE_ID') OR define('RECTO_ATTRIBUTE_ID','20');

defined('RECTO_ATTRIBUTE_ID_VALUE_YES') OR define('RECTO_ATTRIBUTE_ID_VALUE_YES',59);

defined('RECTO_ATTRIBUTE_PERCENTAGE') OR define('RECTO_ATTRIBUTE_PERCENTAGE','35');

defined('SOCKETLAB_SERVER_ID') OR define('SOCKETLAB_SERVER_ID','34629');
defined('SOCKETLAB_API_KEY') OR define('SOCKETLAB_API_KEY','Zi35HzSo24Fkp8R9KxGc');

function pr($array,$debug=false){
	echo "<pre>";
	print_r($array);
	echo "</pre>";
	if($debug){
		die('stop debug mode on');
	}
}

function getProductImage($imageName=null,$type='small'){
	$imageurl='';

    if(!empty($imageName)){
		switch($type){
			case 'small':
			    if(file_exists(PRODUCT_IMAGE_SMALL_BASE_PATH.$imageName))
				   $imageurl=PRODUCT_IMAGE_SMALL_BASE_URL.$imageName;
			       break;
			case 'medium':
			    if(file_exists(PRODUCT_IMAGE_MEDIUM_BASE_PATH.$imageName))
				   $imageurl=PRODUCT_IMAGE_MEDIUM_BASE_URL.$imageName;
                   break;
			case 'large':
			    if(file_exists(PRODUCT_IMAGE_LARGE_BASE_PATH.$imageName))
				   $imageurl=PRODUCT_IMAGE_LARGE_BASE_URL.$imageName;
                   break;
			default:
			if(file_exists(PRODUCT_IMAGE_BASE_PATH.$imageName))
			   $imageurl=PRODUCT_IMAGE_BASE_URL.$imageName;
		}
	}else{
		if(empty($imageurl))
		   $imageurl=PRODUCT_DEFAULT_IMAGE_URL;
	}

	if(empty($imageurl)){
	   if(file_exists(BANNER_IMAGE_BASE_PATH.$imageName))
	      $imageurl=BANNER_IMAGE_BASE_URL.$imageName;
       if(empty($imageurl))
	    $imageurl=PRODUCT_DEFAULT_IMAGE_URL;
	}
    return 	$imageurl;
}

function getBannerImage($imageName=null,$type='small'){
	$imageurl='';

    if(!empty($imageName)){
		switch($type){
			case 'small':
			    if(file_exists(BANNER_IMAGE_SMALL_BASE_PATH.$imageName))
				   $imageurl=BANNER_IMAGE_SMALL_BASE_URL.$imageName;
			       break;
			case 'medium':
			    if(file_exists(BANNER_IMAGE_MEDIUM_BASE_PATH.$imageName))
				   $imageurl=BANNER_IMAGE_MEDIUM_BASE_URL.$imageName;
                   break;
			case 'large':
			    if(file_exists(BANNER_IMAGE_LARGE_BASE_PATH.$imageName))
				   $imageurl=BANNER_IMAGE_LARGE_BASE_URL.$imageName;
                   break;
			default:
			if(file_exists(BANNER_IMAGE_BASE_PATH.$imageName))
			   $imageurl=BANNER_IMAGE_BASE_URL.$imageName;
		}
	}else{
		if(empty($imageurl))
		   $imageurl=BANNER_DEFAULT_IMAGE_URL;
	}

	if(empty($imageurl)){
	   if(file_exists(BANNER_IMAGE_BASE_PATH.$imageName))
	      $imageurl=BANNER_IMAGE_BASE_URL.$imageName;
       if(empty($imageurl))
	    $imageurl=BANNER_DEFAULT_IMAGE_URL;
	}
    return 	$imageurl;
}
function getBrandImage($imageName=null,$type='small'){
	$imageurl='';

    if(!empty($imageName)){
		switch($type){
			case 'large':
			    if(file_exists(BRAND_IMAGE_LARGE_BASE_PATH.$imageName))
				   $imageurl=BRAND_IMAGE_LARGE_BASE_URL.$imageName;
                   break;
			default:
			if(file_exists(BRAND_IMAGE_BASE_PATH.$imageName))
			   $imageurl=BRAND_IMAGE_BASE_URL.$imageName;
		}
	}else{
		if(empty($imageurl))
		   $imageurl=BRAND_DEFAULT_IMAGE_URL;
	}

	if(empty($imageurl)){
	   if(file_exists(BRAND_IMAGE_BASE_PATH.$imageName))
	      $imageurl=BRAND_IMAGE_BASE_URL.$imageName;
       if(empty($imageurl))
	    $imageurl=BRAND_DEFAULT_IMAGE_URL;
	}
    return 	$imageurl;
}
function geCategoryImage($imageName=null,$type='large'){
	$imageurl='';
    if(!empty($imageName)){
		switch($type){
			case 'large':
			    if(file_exists(CATEGORY_IMAGE_LARGE_BASE_PATH.$imageName))
				   $imageurl=CATEGORY_IMAGE_LARGE_BASE_URL.$imageName;
                   break;
			    default:
			   if(file_exists(CATEGORY_IMAGE_BASE_PATH.$imageName))
			   $imageurl=CATEGORY_IMAGE_BASE_URL.$imageName;
		}
	}else{
		if(empty($imageurl))
		   $imageurl=CATEGORY_DEFAULT_IMAGE_URL;
	}

	if(empty($imageurl)){
	   if(file_exists(CATEGORY_IMAGE_BASE_PATH.$imageName))
	      $imageurl=CATEGORY_IMAGE_BASE_URL.$imageName;
       if(empty($imageurl))
	    $imageurl=CATEGORY_DEFAULT_IMAGE_URL;
	}
    return 	$imageurl;
}

function getBlogImage($imageName=null,$type='small'){
		$imageurl='';

	    if(!empty($imageName)){
			switch($type){
				case 'small':
				    if(file_exists(BLOG_IMAGE_SMALL_BASE_PATH.$imageName))
					   $imageurl=BLOG_IMAGE_SMALL_BASE_URL.$imageName;
				       break;
				case 'medium':
				    if(file_exists(BLOG_IMAGE_MEDIUM_BASE_PATH.$imageName))
					   $imageurl=BLOG_IMAGE_MEDIUM_BASE_URL.$imageName;
	                   break;
				case 'large':
				    if(file_exists(BLOG_IMAGE_LARGE_BASE_PATH.$imageName))
					   $imageurl=BLOG_IMAGE_LARGE_BASE_URL.$imageName;
	                   break;
				default:
				if(file_exists(BLOG_IMAGE_BASE_PATH.$imageName))
				   $imageurl=BLOG_IMAGE_BASE_URL.$imageName;
			}
		}else{
			if(empty($imageurl))
			   $imageurl=BANNER_DEFAULT_IMAGE_URL;
		}

		if(empty($imageurl)){
		   if(file_exists(BLOG_IMAGE_BASE_PATH.$imageName))
		      $imageurl=BLOG_IMAGE_BASE_URL.$imageName;
	       if(empty($imageurl))
		    $imageurl=BANNER_DEFAULT_IMAGE_URL;
		}
	    return 	$imageurl;
}

function getSectionImage($imageName = null)
{
		$imageurl = '';

	if (file_exists(SECTION_IMAGE_BASE_PATH.$imageName)) {
			 $imageurl = SECTION_IMAGE_BASE_URL.$imageName;
		}
		return $imageurl;
}

function dateFormate($date,$time=true){
	$newDate='';
	if($date !='' && $date !='0000-00-00 00:00:00' && $date !='0000-00-00' ){
		if($time==false){
			$newDate=date('d M Y',strtotime($date));
		}else{
			$newDate=date('d M Y H:i:s',strtotime($date));
		}
	}
	return $newDate;
}

function getDiscountPrice($price=0,$discount=0,$numberFormate=true){
	$newPrice=0;
   // echo $price;
    //echo $discount;

    if(!empty($discount)){
        $pers=(($price*$discount)/100);
        $newPrice=$price-$pers;
        if($numberFormate)
		$newPrice=number_format($newPrice,2);
		//die();
	}
    return $newPrice;
}

function checkBuyNowProduct($is_stock,$tota_stock){
	$buy=true;
	if(!empty($is_stock)){
		$buy=false;
	}
	/*if(empty($tota_stock)){
		$buy=false;
	}*/
	return $buy;
}

function getRate($rate)
{
		$html = '';

		for ($i = 1; $i <= 5; $i++) {
				$active = '';
			 if ($i <= $rate) {
					$html = $html.'<i class="fas fa-star active" aria-hidden="true"></i>';
			 } else {
					$html = $html.'<i class="fas fa-star" aria-hidden="true"></i>';
			 }
		}

	  return $html;
}
    function getOtp(){
	    $array=range(100000,999999);
	    $k = array_rand($array);
	    return $array[$k];
    }

    function showValue($val){
		$explode=explode(".",$val);
		$newVal='';
		if(empty($val) || $val =='0' || $val =='0.0' || $val =='0.00' || $val =='0.000' || $val =='0.0000'){
			return $newVal;
		}else if(empty($explode[1])  || $explode[1] =='0' || $explode[1] =='00' || $explode[1] =='000' || $explode[1] =='0000'){
			$newVal=$explode[0];
		}else if(!empty($explode[1])){
			$d1=substr($explode[1],0,1);
			$d2=substr($explode[1],1,1);
			$d3=substr($explode[1],2,1);
		    $d4=substr($explode[1],3,1);

			if($d1 !=0 && $d2==0 && $d3==0 && $d4==0){
				$newVal=$explode[0].".".$d1;
			}else if($d1 ==0 && $d2 !=0 && $d3==0 && $d4==0){
				$newVal=$explode[0].".".$d1.$d2;
			}else if($d1 ==0 && $d2 ==0 && $d3 !=0 && $d4==0){
				$newVal=$explode[0].".".$d1.$d2.$d3;
			}else if($d1 ==0 && $d2 ==0 && $d3 ==0 && $d4 !=0){
				$newVal=$explode[0].".".$d1.$d2.$d3.$d4;
			}
			else if($d1 !=0 && $d2 !=0 && $d3 !=0 && $d4!=0){
				$newVal=$val;
			}else if($d1 !=0 && $d2 !=0 && $d3 ==0 && $d4==0){
				$newVal=$explode[0].".".$d1.$d2;
			}else if($d1 ==0 && $d2 !=0 && $d3 !=0 && $d4==0){
				$newVal=$explode[0].".".$d1.$d2.$d3;
			}else if($d1 ==0 && $d2 !=0 && $d3 ==0 && $d4!=0){
				$newVal=$explode[0].".".$d1.$d2.$d3.$d4;
			}
		}
		if(!empty($newVal)){
			return $newVal;
		}else{
			return $val;
		}
	}
	#echo showValue(0.0011);
	function sendSms($numbers,$message){
		$username = "sharma.neelu642@gmail.com";
		$hash = "e991b5738cbcd30c121c43375e1a7a7f572c5a100c412253f2e395a671810a5d";
		// Config variables. Consult http://api.textlocal.in/docs for more info.
		$test = "0"; //test=0 is credit and 1 is Test
		// Data for text message. This is the text message data.
		$sender = "TXTLCL"; // This is who the message appears to be from.
		//$numbers = "7888650943"; // A single number or a comma-seperated list of numbers
		//$message = "This is a test message from the PHP API script.";
		// 612 chars or less
		// A single number or a comma-seperated list of numbers

		$message = urlencode($message);
		$data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
		$ch = curl_init('http://api.textlocal.in/send/?');
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch); // This is the result from the API
		$data=json_decode($result);
		curl_close($ch);

	    if(is_object($data)){
			if($data->status =='success'){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
    }
    function getNCRParts(){
	   $NCRParts=array('2 copies','3 copies','4 copies','2-Part Set (White/Yellow)','3-Part Set (White/Yellow/Pink)','4-Part Set (White/Yellow/Pink/Gold)','No parts only white  paper printer');

       return $NCRParts;
    }
   function getOrderSatus($status=null){
	   $statusData=array(1=>'Incomplete',2=>'New',3=>'Processing',9=>'Ready for pickup',4=>'Shipped',5=>'Delivered',6=>'Cancelled',7=>'Failed',8=>'Complete');

	   if(!empty($status)){
		    return $statusData[$status];
	   }else{
		   return $statusData;
	   }
    }
	function getOrderSatusClass($status=null){
	   $statusData=array(1=>'<button type="button" class="btn btn-sm">Incomplete</button>',2=>'<button type="button" class="btn btn-sm btn-primary">New Order</button>',3=>'<button type="button" class="btn btn-warning btn-sm">Processing</button>',4=>'<button type="button" class="btn btn-sm" style="background-color: #17a2b8; border-color: #17a2b8;">Shipped</button>',5=>'<button type="button" class="btn btn-info btn-sm">Delivered</button>',6=>'<button type="button" class="btn btn-dark btn-sm">Cancelled</button>',7=>'<button type="button" class="btn btn-danger btn-sm">Failed</button>',8=>'<button type="button" class="btn btn-info btn-sm">Complete</button>',9=>'<button type="button" class="btn btn-sm" style="background-color: #17a2b8; border-color: #17a2b8;">Ready for pickup</button>');

	   if(!empty($status)){
		    return $statusData[$status];
	   }else{
		   return $statusData;
	   }
    }

	function getOrderSatusFrench($status=null){
	   $statusData=array(1=>'Incomplète',2=>'Nouvelle commande',3=>'En traitement',4=>'Expédié',5=>'Livré',6=>'Annulé',7=>'Échoué',8=>'Achevée');

	   if(!empty($status)){
		    return $statusData[$status];
	   }else{
		   return $statusData;
	   }
    }

	function getOrderSatusClassFrench($status=null){
	   $statusData=array(1=>'<button type="button" class="btn btn-sm">Incomplète</button>',2=>'<button type="button" class="btn btn-sm btn-primary">Nouvelle commande</button>',3=>'<button type="button" class="btn btn-warning btn-sm">En traitement</button>',4=>'<button type="button" class="btn btn-sm" style="background-color: #17a2b8; border-color: #17a2b8;">Expédié</button>',5=>'<button type="button" class="btn btn-info btn-sm">Livré</button>',6=>'<button type="button" class="btn btn-dark btn-sm">Annulé</button>',7=>'<button type="button" class="btn btn-danger btn-sm">Échoué</button>',8=>'<button type="button" class="btn btn-info btn-sm">Achevée</button>');

	   if(!empty($status)){
		    return $statusData[$status];
	   }else{
		   return $statusData;
	   }
    }

	function getSortByDropdown()
	{
	   $sortByOptions = [
				'name' => [
					'label'=>'Name',
					'label_french'=>'Nom',
					'order_by'=>'name',
					'type'=>'asc'
				],
				'price' => [
					'label'=>'Price',
					'label_french'=>'Prix',
					'order_by'=>'price',
					'type'=>'desc',
				],
		];
        return 	$sortByOptions;
    }

	function pageSlug(){
	    $pageSlugArray=array(
					     'brands'=>array('class'=>'Pages','action'=>'brands'),
					     'support'=>array('class'=>'Pages','action'=>'support'),
						 'contact-us'=>array('class'=>'Pages','action'=>'contactUs'),
						 'preffered-customer'=>array('class'=>'Pages','action'=>'prefferedCustomer'),
						 'estimate'=>array('class'=>'Pages','action'=>'estimate'),
						 'home'=>array('class'=>'Homes','action'=>''),
						 'products'=>array('class'=>'Products','action'=>''),
						 'faq'=>array('class'=>'Pages','action'=>'faq'),
						 'blogs'=>array('class'=>'Blogs','action'=>'')
			     );
	    return $pageSlugArray;
    }

	function afterLogin(){
	    $pageSlugArray=array(
					   'my-account'=>array('class'=>'MyAccounts','action'=>'index'),
					   'order-history'=>array('class'=>'MyOrders','action'=>'index'),
					   'wishlist'=>array('class'=>'Wishlists','action'=>'index'),
					   'support'=>array('class'=>'Tickets','action'=>'index')
        );
	    return $pageSlugArray;
    }

	function getDiscountType(){
	    $discountTypeArray=array('discount_percent'=>'Discount Percent',
		'discount_amount'=>'Discount Amount'
        );
	    return $discountTypeArray;
    }

    function getOrderPaymentMethod($status){
	   $statusData=array('DC'=>'Debit Card','CC'=>'Credit Card','NB'=>'Net Banking');
	    if(isset($statusData[$status])){
	       return $statusData[$status];
	    }
    }

	function PaymentMethod(){
	    $statusData=array('Debit Card','Credit Card','Paypal','Stripe','COD');
	    return $statusData;
    }
    function getOrderPaymentStatus($status=null,$type='list'){
		if($type=='list'){
			$statusData=array(
			   1=>'<button type="button" class="btn btn-sm btn-warning  ">Pending</button>',
			   2=>'<button type="button" class="btn btn-sm btn-info">Success</button>',
			   3=>'<button type="button" class="btn btn-sm btn-danger ">Failed</button>'
		    );
		}else if($type='csv'){
			$statusData=array(
			   1=>'Pending',
			   2=>'Success',
			   3=>'Failed'
		    );
		}
		if(!empty($status)){
	        return $statusData[$status];
	   }else{
		   return $statusData;
	   }
    }

    function getOrderPaymentStatusFrench($status=null,$type='list'){
		if($type=='list'){
			$statusData=array(
			   1=>'<button type="button" class="btn btn-sm btn-warning  ">En attente</button>',
			   2=>'<button type="button" class="btn btn-sm btn-info">Succès</button>',
			   3=>'<button type="button" class="btn btn-sm btn-danger ">Échoué</button>'
		    );
		}else if($type='csv'){
			$statusData=array(
			   1=>'En attente',
			   2=>'Success',
			   3=>'Échoué'
		    );
		}
		if(!empty($status)){
	        return $statusData[$status];
	   }else{
		   return $statusData;
	   }
    }

	function emailTemplate($subject,$body){
		$html ='<div class="top-section" style="width:100%;text-align:center; font-family: Raleway, sans-serif !important;display: flex;justify-content: center;align-items: center;">
		<div class="top-mid-section" style="width:100%; max-width:600px; height:auto; text-align:center; padding:0px 0px 0px 0px; box-shadow: 0px 0px 10px -3px rgba(0,0,0,0.5);background-image: url('.FILE_BASE_URL.'assets/images/bg-vector-img.jpg);">
			<div style="background: rgba(255,255,255,0.9)">
			<div class="top-inner-section" style="background: #fa762b; padding: 3px 0px 1px 0px; box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.5);">
			</div>
			<div style="padding: 20px 0px 10px 0px; text-align: center;"><img src="'.FILE_BASE_URL.'assets/images/printing.coopLogo.png" width="60%"></div>
			<div class="tem-mid-section" style="text-align: center;">
				<div class="tem-visibility" style="z-index: 99; padding: 20px;">
					<div class="top-title" style="font-size: 22px; text-align: center;">
						<span><strong>'.$subject.'</strong></span>
					</div>

					<div class="email-body">
					    '.$body.'
					</div>
					<div style="background-color: #0086ac;margin-top: 20px;">
						<div style="padding: 20px;">
							<span style="color: #fff;line-height: 25px;">We are always here to help. You can also contact us directly on<br>514-544-8043,1-877-384-8043 or email us at info@printing.coop<br>FOLLOW US <br>printing.coop<br>imprimeur.coop<br><br>© Copyright 2019 '.WEBSITE_NAME.'</span>
						</div>
					</div>
				</div>
			</div>
			<div class="tem-bottom" style="font-size: 18px; letter-spacing: 0.5px; line-height: 30px; background: #22a641;; color: #fff; padding: 3px 0px; text-align: center;">
			</div>
		</div>
	</div>
	</div>';
     return $html;
	}

	function emailTemplateFranch($subject,$body){
			$html ='<div class="top-section" style="width:100%;text-align:center; font-family: Raleway, sans-serif !important;display: flex;justify-content: center;align-items: center;">
			<div class="top-mid-section" style="width:100%; max-width:600px; height:auto; text-align:center; padding:0px 0px 0px 0px; box-shadow: 0px 0px 10px -3px rgba(0,0,0,0.5);background-image: url('.FILE_BASE_URL.'assets/images/bg-vector-img.jpg);">
				<div style="background: rgba(255,255,255,0.9)">
				<div class="top-inner-section" style="background: #fa762b; padding: 3px 0px 1px 0px; box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.5);">
				</div>
				<div style="padding: 20px 0px 10px 0px; text-align: center;"><img src="'.FILE_BASE_URL.'uploads/logo/printing_coop_imprimeur_coop_logo2018_FR.png" width="60%"></div>
				<div class="tem-mid-section" style="text-align: center;">
					<div class="tem-visibility" style="z-index: 99; padding: 20px;">
						<div class="top-title" style="font-size: 22px; text-align: center;">
							<span><strong>'.$subject.'</strong></span>
						</div>

						<div class="email-body">
							'.$body.'
						</div>
						<div style="background-color: #0086ac;margin-top: 20px;">
							<div style="padding: 20px;">
								<span style="color: #fff;line-height: 25px;">Nous sommes toujours là pour vous aider. Vous pouvez également nous contacter directement sur<br>514-544-8043,1-877-384-8043 ou écrivez-nous à info@imprimeur.coop<br>FOLLOW US <br>printing.coop<br>imprimeur.coop<br><br>© droits dauteur 2019 '.WEBSITE_NAME_FRANCH.'</span>
							</div>
						</div>
					</div>
				</div>
				<div class="tem-bottom" style="font-size: 18px; letter-spacing: 0.5px; line-height: 30px; background: #22a641;; color: #fff; padding: 3px 0px; text-align: center;">
				</div>
			</div>
		</div>
		</div>';
		 return $html;
	}

    /*function sendEmail($toEmail=null,$sub=null,$body=null,$from=null,$fromname=null,$files=array()){
		$from=!empty($from) ? $from:FROM_EMAIL;
		$fromname=!empty($fromname) ? $fromname:WEBSITE_NAME;
		$params = array(
		'api_user' => SEND_EMAIL_USERNAME,
		'api_key' => SEND_EMAIL_PASSWORD,
		'to' => $toEmail,
		'subject' => $sub,
		'html' => $body,
		'text' => $body,
		'from' => $from,
		'fromname'  =>$fromname
		);

		foreach($files as $fileName=>$path){
			$params['files['.$fileName.']'] = file_get_contents($path);
		}
		//pr($params);
		$request = SEND_EMAIL_URL.'api/mail.send.json';
		$session = curl_init($request);
		curl_setopt ($session, CURLOPT_POST, true);
		curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
		curl_setopt ($session, CURLOPT_HEADER, false);
		curl_setopt ($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
		curl_setopt ($session, CURLOPT_RETURNTRANSFER, true);

		$response = curl_exec($session);
		//pr($response,1);
		curl_close($session);
	}

	function sendEmailFranch($toEmail=null,$sub=null,$body=null,$from=null,$fromname=null,$files=array()){
		$from=!empty($from) ? $from:FROM_EMAIL;
		$fromname=!empty($fromname) ? $fromname:WEBSITE_NAME_FRANCH;
		$params = array(
		'api_user' => SEND_EMAIL_USERNAME,
		'api_key' => SEND_EMAIL_PASSWORD,
		'to' => $toEmail,
		'subject' => $sub,
		'html' => $body,
		'text' => $body,
		'from' => $from,
		'fromname'  =>$fromname
		);

		foreach($files as $fileName=>$path){
			$params['files['.$fileName.']'] = file_get_contents($path);
		}
		//pr($params);
		$request = SEND_EMAIL_URL.'api/mail.send.json';
		$session = curl_init($request);
		curl_setopt ($session, CURLOPT_POST, true);
		curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
		curl_setopt ($session, CURLOPT_HEADER, false);
		curl_setopt ($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
		curl_setopt ($session, CURLOPT_RETURNTRANSFER, true);

		$response = curl_exec($session);
		//pr($response);
		curl_close($session);
	}*/

	#sendEmailFranch('phpsolitaire@gmail.com','Test','<a href="https://www.imprimeur.coop/Logins/emailVerification/1">Testing Mail</a>');

/* org send email functions */
	/*function sendEmail($toEmail=null,$sub=null,$body=null,$from=null,$fromname=null,$files=array()){
		$from=!empty($from) ? $from:FROM_EMAIL;
		$fromname=!empty($fromname) ? $fromname:WEBSITE_NAME;
		$sendgrid_apikey = SEND_EMAIL_API_KEY;
		$params = array(
		'to' => trim($toEmail),
		'subject' => $sub,
		'html' => $body,
		'text' => $body,
		'from' => trim($from),
		'fromname'  =>$fromname
		);

		foreach($files as $fileName=>$path){
			$params['files['.$fileName.']'] = file_get_contents($path);
		}
		#pr($params);
		$request = SEND_EMAIL_URL.'api/mail.send.json';
		$session = curl_init($request);
        curl_setopt($session, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $sendgrid_apikey));
		curl_setopt ($session, CURLOPT_POST, true);
		curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
		curl_setopt ($session, CURLOPT_HEADER, false);
		curl_setopt ($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
		curl_setopt ($session, CURLOPT_RETURNTRANSFER, true);

		$response = curl_exec($session);
		#pr($response,1);
		curl_close($session);
	}

	function sendEmailFranch($toEmail=null,$sub=null,$body=null,$from=null,$fromname=null,$files=array()){
		$from=!empty($from) ? $from:FROM_EMAIL_FRANCH;
		$fromname=!empty($fromname) ? $fromname:WEBSITE_NAME_FRANCH;
		$sendgrid_apikey = SEND_EMAIL_API_KEY;
		$params = array(
		'to' => $toEmail,
		'subject' => $sub,
		'html' => $body,
		'text' => $body,
		'from' => $from,
		'fromname'  =>$fromname
		);
		#pr($params);
		foreach($files as $fileName=>$path){
			$params['files['.$fileName.']'] = file_get_contents($path);
		}
		//pr($params);
		$request = SEND_EMAIL_URL.'api/mail.send.json';
		$session = curl_init($request);
		curl_setopt($session, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $sendgrid_apikey));
		curl_setopt ($session, CURLOPT_POST, true);
		curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
		curl_setopt ($session, CURLOPT_HEADER, false);
		curl_setopt ($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
		curl_setopt ($session, CURLOPT_RETURNTRANSFER, true);

		$response = curl_exec($session);
		#pr($response);
		curl_close($session);
	}*/
/* org send email functions end */

/* socket lab mail functions */
	function sendEmail($toEmail=null,$sub=null,$body=null,$from=null,$fromname=null,$files=array()){
		$from=!empty($from) ? $from:FROM_EMAIL;
		$fromname=!empty($fromname) ? $fromname:WEBSITE_NAME;
		$params = array('to' => trim($toEmail),'subject' => $sub,'html' => $body,'text' => $body,'from' => trim($from),'fromname'  => $fromname);
		include_once (FILE_BASE_PATH."assets/InjectionApi/src/includes.php");
		$client = new \Socketlabs\SocketLabsClient(SOCKETLAB_SERVER_ID,SOCKETLAB_API_KEY);
		$message = new \Socketlabs\Message\BasicMessage();
		$message->subject = $params['subject'];
		$message->htmlBody = $params['html'];
		$message->plainTextBody = $params['text'];

		$message->from = new \Socketlabs\Message\EmailAddress($params['from']);
		$message->replyTo = new Socketlabs\Message\EmailAddress($params['from']);
		foreach($files as $fileName=>$path){
			$message->attachments[] = \Socketlabs\Message\Attachment::createFromPath($path,$fileName);
		}
		$message->addToAddress($params['to']);
		$response = $client->send($message);
	}
	function sendEmailFranch($toEmail=null,$sub=null,$body=null,$from=null,$fromname=null,$files=array()){
		$from=!empty($from) ? $from:FROM_EMAIL_FRANCH;
		$fromname=!empty($fromname) ? $fromname:WEBSITE_NAME_FRANCH;
		$params = array('to' => trim($toEmail),'subject' => $sub,'html' => $body,'text' => $body,'from' => trim($from),'fromname'  => $fromname);
		include_once (FILE_BASE_PATH."assets/InjectionApi/src/includes.php");
		$client = new \Socketlabs\SocketLabsClient(SOCKETLAB_SERVER_ID,SOCKETLAB_API_KEY);
		$message = new \Socketlabs\Message\BasicMessage();
		$message->subject = $params['subject'];
		$message->htmlBody = $params['html'];
		$message->plainTextBody = $params['text'];
		$message->from = new \Socketlabs\Message\EmailAddress($params['from']);
		$message->replyTo = new Socketlabs\Message\EmailAddress($params['from']);
		foreach($files as $fileName=>$path){
			$message->attachments[] = \Socketlabs\Message\Attachment::createFromPath($path,$fileName);
		}
		$message->addToAddress($params['to']);
		$response = $client->send($message);
	}
/* socket lab mail functions end */
	function allLanguages()
	{
			return [
					[
							'name' => 'English',
							'short_code' => 'en',
					],
					[
							'name' => 'French',
							'short_code' => 'fr',

					],
			];
	}

	function allCurrencies()
	{
			return [
					[
						'name' => 'Canadian Dollar',
						'code' => 'CAD',
					],
					[
						'name' => 'British Pound Sterling',
						'code' => 'GBP',
					],
					[
						'name' => 'Euro',
						'code' => 'EUR',
					],
					[
						'name' => 'US Dollar',
						'code' => 'USD',
					],
			];
	}

	function getLogoImages($imageName = null)
	{
			$imageurl = '';

	    if (file_exists(LOGO_IMAGE_BASE_PATH.$imageName)) {
				 $imageurl = LOGO_IMAGE_BASE_URL.$imageName;
			}

			return $imageurl;
	}

	function  upsServiceCode(){
		$ups_service_code   = array(
		'01' => 'UPS Next Day Air',
		'02' => 'UPS 2nd Day Air',
		'03' => 'UPS Ground',
		'07' => 'UPS Worldwide Express',
		'08' => 'UPS Worldwide Expedited',
		'11' => 'UPS Standard',
		'12' => 'UPS 3 Day Select',
		'13' => 'UPS Next Day Air Saver',
		'14' => 'UPS Next Day Air Early A.M.',
		'54' => 'UPS Worldwide Express Plus',
		'59' => 'UPS 2nd Day Air AM',
		'65' => 'UPS World Wide Saver'
		);
	    return $ups_service_code;
	}

 //CanedaPostApigetRate('K1K4T3');

 function CanedaPostApigetRate($postalCode){
	$Rates=array('status'=>'404','msg'=>'postal-code is not a valid','list'=>array());
	$username = '99ee0c797ced5425';
	$password = 'b638d92827ade27061a7ed';
	$mailedBy = '0008736935';

// REST URL
$service_url = 'https://ct.soa-gw.canadapost.ca/rs/ship/price';

// Create GetRates request xml
$originPostalCode = 'H2M1S2';
//$postalCode = 'K1K4T3';
$weight = 1;

$xmlRequest = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<mailing-scenario xmlns="http://www.canadapost.ca/ws/ship/rate-v4">
  <customer-number>{$mailedBy}</customer-number>
  <parcel-characteristics>
	<weight>{$weight}</weight>
  </parcel-characteristics>
  <origin-postal-code>{$originPostalCode}</origin-postal-code>
  <destination>
	<domestic>
	  <postal-code>{$postalCode}</postal-code>
	</domestic>
  </destination>
</mailing-scenario>
XML;

$curl = curl_init($service_url); // Create REST Request
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($curl, CURLOPT_CAINFO, FILE_BASE_PATH.'CPCWS_Rating_PHP_Samples/third-party/cert/cacert.pem');
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $xmlRequest);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($curl, CURLOPT_USERPWD, $username . ':' . $password);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/vnd.cpc.ship.rate-v4+xml', 'Accept: application/vnd.cpc.ship.rate-v4+xml'));
$curl_response = curl_exec($curl); // Execute REST Request
if(curl_errno($curl)){
	//echo 'Curl error: ' . curl_error($curl) . "\n";
}

//echo 'HTTP Response Status: ' . curl_getinfo($curl,CURLINFO_HTTP_CODE) . "\n";
$Rates['status']=curl_getinfo($curl,CURLINFO_HTTP_CODE);

curl_close($curl);

// Example of using SimpleXML to parse xml response
libxml_use_internal_errors(true);
$xml = simplexml_load_string('<root>' . preg_replace('/<\?xml.*\?>/','',$curl_response) . '</root>');
if (!$xml) {
	//echo 'Failed loading XML' . "\n";
	//echo $curl_response . "\n";
	foreach(libxml_get_errors() as $error) {
		//echo "\t" . $error->message;
	}
} else {
		if ($xml->{'price-quotes'} ) {
			$priceQuotes = $xml->{'price-quotes'}->children('http://www.canadapost.ca/ws/ship/rate-v4');
			if ( $priceQuotes->{'price-quote'} ) {
				foreach ( $priceQuotes as $priceQuote ) {
					$array = json_decode(json_encode($priceQuote), TRUE);
                    $service_name=$array['service-name'];
					$list['service_name']=$service_name;
					$price=$array['price-details']['due'];
					$list['price']       =$price;
					$Rates['list'][]=$list;
					$Rates['msg']="";
				}
			}
		}

		if ($xml->{'messages'} ) {
			$messages = $xml->{'messages'}->children('http://www.canadapost.ca/ws/messages');
			foreach ( $messages as $message ) {
				echo 'Error Code: ' . $message->code . "\n";
				echo 'Error Msg: ' . $message->description . "\n\n";
			}
		}
	}
	return $Rates;
    //die('Ok');
}

    function getShipingName($orderData){
		$upsServiceCode=upsServiceCode();
        $str='';
		if($orderData['shipping_method_formate']){
			$shipping_method_formate=explode('-',$orderData['shipping_method_formate']);
			if($shipping_method_formate[0]=="ups"){
				$str=$upsServiceCode[$shipping_method_formate[2]]." (UPS)";
			}else if($shipping_method_formate[0]=="canadapost"){
				$str=$shipping_method_formate[2]." (Canada Post)";
			}else if($shipping_method_formate[0]=="flagship"){
				$codeData=FlagShipServiceCode($shipping_method_formate[2]);
													//pr($codeData);

			   $str=$codeData['courier_name'].'<br>'.$codeData['courier_desc']."</br>(FlagShip)";
			}
		}
		return $str;
	}

	/*function CreatePdf(){
		$html="<H1>Hi</h1>";
		include FILE_BASE_PATH.'dompdf-master/vendor/autoload.php';
		use Dompdf\Dompdf;
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->setPaper('A4', 'landscape');
		/*$file=$product->get_name();
		$file=str_replace(" ","-",$file);
		$file=$file.".pdf";
		$file="test.pdf";
		$dompdf->stream($file);
		exit();
	}*/
	//include('PaytmKit/lib/config_paytm.php');
	//include('PaytmKit/lib/encdec_paytm.php');
	require_once(FILE_BASE_PATH.'google-translate-php-master/vendor/autoload.php');
    use Stichoza\GoogleTranslate\GoogleTranslate;
	function  FRC($str){
		$str=trim($str);
		$tr = new GoogleTranslate('en');
		$tr->setTarget('fr');
		$str=str_replace('&middot;','.',$str);
		$str=str_replace('&nbsp;','.',$str);
		$strNew=$tr->translate($str);
		return $strNew;
	}
	function FRCNew1($text){
		$from_lan='en';
		$to_lan='fr';
		$json = json_decode(file_get_contents('https://ajax.googleapis.com/ajax/services/language/translate?v=1.0&q=' . urlencode($text) . '&langpair=' . $from_lan . '|' . $to_lan));
		$translated_text = $json->responseData->translatedText;
		pr($json->responseData,1);
		return $translated_text;
    }

	function FRCNew2($str){
		$apiKey = 'AIzaSyBiw1CyvkpCPKREwUjWov0cWqkGLMRuKns';
        $str=trim($str);
		$str=str_replace('&middot;','.',$str);
		$str=str_replace('&nbsp;','.',$str);
		$url = 'https://www.googleapis.com/language/translate/v2?key=' . $apiKey . '&q=' . rawurlencode($str) . '&source=en&target=fr';
		$handle = curl_init($url);
		curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($handle);

		$responseDecoded = json_decode($response, true);
		curl_close($handle);
		/*echo 'Source: ' . $str . '<br>';
		echo 'Translation: ' .*/
		return isset($responseDecoded['data']['translations'][0]['translatedText']) ? $responseDecoded['data']['translations'][0]['translatedText']:'';
    }

	require_once(FILE_BASE_PATH.'application/config/flagship-api-sdk-master/vendor/autoload.php');
	use Flagship\Shipping\Flagship;
    use Flagship\Shipping\Exceptions\QuoteException;
	use Flagship\Shipping\Exceptions\ConfirmShipmentException;
    use Flagship\Shipping\Exceptions\GetDhlEcommRatesException;
	use Flagship\Shipping\Exceptions\TrackShipmentException;
	use Flagship\Shipping\Exceptions\CancelShipmentException;
	use Flagship\Shipping\Exceptions\GetShipmentByIdException;
	use Flagship\Shipping\Exceptions\CreateManifestException;
	//getRatesFlagShip();

	defined('FLAGSHIP_MODE')  OR define('FLAGSHIP_MODE','live');
	defined('API_VERSION') OR define('API_VERSION','1.1');
	defined('MY_ACCESS_TOKEN_LIVE') OR define('MY_ACCESS_TOKEN_LIVE','nXiEiZtRLDzJtIzP1JWVBxv_7biNGkoydoAHO1NfFXA');
	defined('MY_ACCESS_TOKEN_TEST') OR define('MY_ACCESS_TOKEN_TEST','y-ew5cE7ZN22doaiunkrK8oXHa9_hcQyw2-Esin-10Y');
	function getRatesFlagShip($ProductOrder,$ProductOrderItems,$CountryData,$stateData,$cityData,$storeData){
			/*
			 * @params
			 * MY_ACCESS_TOKEN : use your Flagship token
			 * For test environment use https://test-api.smartship.io and https://api.smartship.io for a live one
			 * MY_WEBSITE : name of your website
			 * API_VERSION : this is same as the tag number from github. Instead of master branch, download the latest tag. It is something like v1.1.x
			 */
			$API_URL= FLAGSHIP_MODE =='live' ? 'https://api.smartship.io':'https://test-api.smartship.io';
			$MY_ACCESS_TOKEN= FLAGSHIP_MODE == 'live' ? MY_ACCESS_TOKEN_LIVE:MY_ACCESS_TOKEN_TEST;
			$website_name=isset($storeData['website_name']) ? $storeData['website_name'] :'printing.coop';
			$store_name=isset($storeData['name']) ? $storeData['name'] :'printing.coop';
			$store_email=isset($storeData['email']) ? $storeData['email'] :'info@printing.coop';

			$shipping_name=$ProductOrder['shipping_name'];
			$shipping_address=$ProductOrder['shipping_address'];
			$shipping_city=$cityData['name'];
			$shipping_country=$CountryData['iso2'];
			$shipping_state=$stateData['iso2'];
			$shipping_mobile=$ProductOrder['shipping_mobile'];
			$shipping_pin_code=$ProductOrder['shipping_pin_code'];
			$order_id=$ProductOrder['order_id'];
		    #pr($ProductOrder,1);
			$reference=$order_id.' '.$store_name;
			$driver_instructions='';
			$user_email=$ProductOrder['email'];
			$id=$ProductOrder['id'];
			$items=array();
			$total_amount=$ProductOrder['total_amount'];
			foreach($ProductOrderItems as $ProductOrderItem){
				$name=$ProductOrderItem['name'];
				//$description=$ProductOrderItem['name'];
				$shipping_box_length=$ProductOrderItem['shipping_box_length'];
				$shipping_box_width=$ProductOrderItem['shipping_box_width'];
				$shipping_box_height=$ProductOrderItem['shipping_box_height'];
				$shipping_box_weight=$ProductOrderItem['shipping_box_weight'];

				if(empty($shipping_box_length) || $shipping_box_length==0.00){
				    	$shipping_box_length=12;
				}
				if(empty($shipping_box_width) || $shipping_box_width==0.00){
				    	$shipping_box_width=9;
				}
				if(empty($shipping_box_height) || $shipping_box_height==0.00){
				    	$shipping_box_height=3;
				}
				if(empty($shipping_box_weight) || $shipping_box_weight==0.00){
				    	$shipping_box_weight=3;
				}
				$shipping_box_width=ceil($shipping_box_width);
				$shipping_box_height=ceil($shipping_box_height);
				$shipping_box_length=ceil($shipping_box_length);
				$shipping_box_weight=ceil($shipping_box_weight);
				$items[]=[
							"width"  => $shipping_box_width,
							"height" => $shipping_box_height,
							"length" => $shipping_box_length,
							"weight" => $shipping_box_weight,
							"description"=> $name
			   ];

			   //pr($items,1);
			}

			$flagship = new Flagship($MY_ACCESS_TOKEN, $API_URL,$website_name,API_VERSION);
			$payload = [
				'from' =>[
					"name"=> "printing coop",
					"attn"=> "Mehdi Afzali",
					"address"=> "9166 rue Lajeunesse",
					"suite"=> "",
					"city"=> "MONTREAL",
					"country"=> "CA",
					"state"=> "QC",
					"postal_code"=> "H2M1S2",
					"phone"=> "5143848043",
					"ext"=> "",
					"department"=> "",
					"is_commercial"=> true
				],
				"to" => [
					"name"=> $shipping_name,
					"attn"=> "",
					"address"=> $shipping_address,
					"suite"=> "",
					"city"=> $shipping_city,
					"country"=> $shipping_country,
					"state"=> $shipping_state,
					"postal_code"=> $shipping_pin_code,
					"phone"=> $shipping_mobile,
					"ext"=> "",
					"department"=> "",
					"is_commercial"=> true
				],
				"packages"=> [
					"items"=> $items,
					"units"=> "imperial",
					"type"=> "package",
					"content"=> "goods"
				],
				"payment"=> [
					"payer"=> "F"
				],
				"options"=> [
					/*"insurance"=> [
						"value"=> 123.45,
						"description"=> "Children books"
					],*/
					"signature_required"=> false,
					"saturday_delivery"=> false,
					"reference"=>$reference,
					"driver_instructions"=> "",
					"address_correction"=> true,
					"return_documents_as"=> "url",
					"shipment_tracking_emails"=> "$store_email;$user_email"
				]
			];

			try{
				$rates = $flagship->createQuoteRequest($payload)->execute();
				//return $rates;
				//$rates = $flagship->createQuoteRequest($payload)->setStoreName($store_name)->setOrderId($id)->execute();
				#pr($rates,1);
				$rates=json_decode($rates);
				$ratesNew=array();
				$codes=FlagShipServiceCode();
				foreach($rates as $rate){
					if(array_key_exists($rate->rate->service->courier_code,$codes)){
						$ratesNew[]=$rate;
					}
				}
				//pr($rates,1);
				#pr($ratesNew,1);
				return $ratesNew;
			}
			catch(QuoteException $e){
				//echo $e->getMessage();
				//return $e->getMessage();
				//die('Stop');
			}
    }

	function FlagShipConfirm($ProductOrder,$ProductOrderItems,$CountryData,$stateData,$cityData,$storeData){
		    $json=array('status'=>0,'msg'=>'','data'=>array());
		    //pr($ProductOrder);
			//pr($ProductOrderItem);
			//pr($storeData,1);
			//die('OK');
			/*
			 * @params
			 * MY_ACCESS_TOKEN : use your Flagship token
			 * For test environment use https://test-api.smartship.io and https://api.smartship.io for a live one
			 * MY_WEBSITE : name of your website
			 * API_VERSION : this is same as the tag number from github. Instead of master branch, download the latest tag. It is something like v1.1.x
			 */
			$API_URL= FLAGSHIP_MODE =='live' ? 'https://api.smartship.io':'https://test-api.smartship.io';

			$MY_ACCESS_TOKEN= FLAGSHIP_MODE == 'live' ? MY_ACCESS_TOKEN_LIVE:MY_ACCESS_TOKEN_TEST;
			$website_name=isset($storeData['website_name']) ? $storeData['website_name'] :'printing.coop';
			$store_name=isset($storeData['name']) ? $storeData['name'] :'printing.coop';
			$store_email=isset($storeData['email']) ? $storeData['email'] :'info@printing.coop';

			$shipping_name=$ProductOrder['shipping_name'];
			$shipping_address=$ProductOrder['shipping_address'];
			$shipping_city=$cityData['name'];
			$shipping_country=$CountryData['iso2'];
			$shipping_state=$stateData['iso2'];
			$shipping_mobile=$ProductOrder['shipping_mobile'];
			$shipping_pin_code=$ProductOrder['shipping_pin_code'];
		    #pr($ProductOrder,1);
			$order_id=$ProductOrder['order_id'];
			$reference=$order_id.' '.$store_name;
			$driver_instructions='';
			$user_email=$ProductOrder['email'];
			$id=$ProductOrder['id'];
			$items=array();

			foreach($ProductOrderItems as $ProductOrderItem){
				$name=$ProductOrderItem['name'];
				//$description=$ProductOrderItem['name'];
				$shipping_box_length=$ProductOrderItem['shipping_box_length'];
				$shipping_box_width=$ProductOrderItem['shipping_box_width'];
				$shipping_box_height=$ProductOrderItem['shipping_box_height'];
				$shipping_box_weight=$ProductOrderItem['shipping_box_weight'];

				if(empty($shipping_box_length) || $shipping_box_length==0.00){
				    	$shipping_box_length=12;
				}
				if(empty($shipping_box_width) || $shipping_box_width==0.00){
				    	$shipping_box_width=9;
				}
				if(empty($shipping_box_height) || $shipping_box_height==0.00){
				    	$shipping_box_height=3;
				}
				if(empty($shipping_box_weight) || $shipping_box_weight==0.00){
				    	$shipping_box_weight=3;
				}
				$shipping_box_width=ceil($shipping_box_width);
				$shipping_box_height=ceil($shipping_box_height);
				$shipping_box_length=ceil($shipping_box_length);
				$shipping_box_weight=ceil($shipping_box_weight);
				$items[]=[
							"width"  => $shipping_box_width,
							"height" => $shipping_box_height,
							"length" => $shipping_box_length,
							"weight" => $shipping_box_weight,
							"description"=> $name
			   ];
			}
			$service=array();
			if(!empty($ProductOrder['shipping_method_formate'])){
				$shipping_method_formate=explode('-',$ProductOrder['shipping_method_formate']);
				if($shipping_method_formate[0]=="flagship"){
				$codeData=FlagShipServiceCode($shipping_method_formate[2]);
				$courier_name=$codeData['courier_name'];
				$courier_code=$codeData['courier_code'];
					$service=[
					"courier_name"=>$courier_name,
					"courier_code"=>$courier_code
					];
				}
		    }

			if(!empty($service)){
			$flagship = new Flagship($MY_ACCESS_TOKEN, $API_URL,$website_name,API_VERSION);
			$payload = [
				'from' =>[
					"name"=> "printing coop",
					"attn"=> "Mehdi Afzali",
					"address"=> "9166 rue Lajeunesse",
					"suite"=> "",
					"city"=> "MONTREAL",
					"country"=> "CA",
					"state"=> "QC",
					"postal_code"=> "H2M1S2",
					"phone"=> "5143848043",
					"ext"=> "",
					"department"=> "",
					"is_commercial"=> true
				],
				"to" => [
					"name"=> $shipping_name,
					"attn"=> $shipping_name,
					"address"=> $shipping_address,
					"suite"=> "",
					"city"=> $shipping_city,
					"country"=> $shipping_country,
					"state"=> $shipping_state,
					"postal_code"=> $shipping_pin_code,
					"phone"=> $shipping_mobile,
					"ext"=> "",
					"department"=> "",
					"is_commercial"=> true
				],
				"packages"=> [
					"items"=> $items,
					"units"=> "imperial",
					"type"=> "package",
					"content"=> "goods"
				],
				"payment"=> [
					"payer"=> "F"
				],
				'service'=>$service,
				"options"=> [
					/*"insurance"=> [
						"value"=> 123.45,
						"description"=> "Children books"
					],*/
					"signature_required"=> false,
					"saturday_delivery"=> false,
					"shipping_date"=>date('Y-m-d'),
					"reference"=>$reference,
					"driver_instructions"=> "",
					"address_correction"=> true,
					"return_documents_as"=> "url",
					"shipment_tracking_emails"=> "$store_email;$user_email"
				]
			];

			try{
				  $confirmedShipment = $flagship->confirmShipmentRequest($payload)->execute();
				  //$flagship->confirmShipmentRequest->setStoreName($store_name)->setOrderId($id)->execute();
				  //$confirmedShipment = $request->execute(); //returns a collection of rates

				  //echo $confirmedShipment->getLabel(); //returns regular label
				  //echo $confirmedShipment->getThermalLabel(); //returns thermal label
				  //$confirmedShipment->getTotal();
				  $json['data']=$confirmedShipment;
				  $json['status']=1;
				  $json['msg']='Shipping label created successfully';
			}
			catch(ConfirmShipmentException $e){
				$json['msg']=$e->getMessage();
				//die('Stop');
			}
		}else{
			$json['msg']='Invalid shipping method';
		}
		//pr($json);
		return $json;
    }

	function FlagShipTracking($ProductOrder,$storeData){
		    $json=array('status'=>0,'msg'=>'','data'=>array());
		    //pr($ProductOrder);
			//pr($ProductOrderItem);
			//pr($storeData,1);
			//die('OK');
			/*
			 * @params
			 * MY_ACCESS_TOKEN : use your Flagship token
			 * For test environment use https://test-api.smartship.io and https://api.smartship.io for a live one
			 * MY_WEBSITE : name of your website
			 * API_VERSION : this is same as the tag number from github. Instead of master branch, download the latest tag. It is something like v1.1.x
			 */
			$API_URL= FLAGSHIP_MODE =='live' ? 'https://api.smartship.io':'https://test-api.smartship.io';
			$MY_ACCESS_TOKEN= FLAGSHIP_MODE == 'live' ? MY_ACCESS_TOKEN_LIVE:MY_ACCESS_TOKEN_TEST;
			$website_name=isset($storeData['website_name']) ? $storeData['website_name'] :'printing.coop';

			$tracking_number=$ProductOrder['tracking_number'];
			$shipment_id=$ProductOrder['shipment_id'];
			//$shipment_id='786073265551';
			if(!empty($tracking_number) && !empty($shipment_id)){
				$flagship = new Flagship($MY_ACCESS_TOKEN, $API_URL,$website_name,API_VERSION);
				$payload = [
					 $shipment_id
				];
				try{
					  //$data=$flagship->availableServicesRequest()->execute();
					  //$data=$flagship->getShipmentListRequest()->execute();
					  $confirmedShipment = $flagship->getShipmentByIdRequest($shipment_id)->execute();
					  //pr($confirmedShipment,1);
					  $json['data']=$confirmedShipment;
					  $json['status']=1;
					  $json['msg']='Shipping label created successfully';
				}
				catch(GetShipmentByIdException $e){
					$json['msg']=$e->getMessage();
				}
		}else{
			$json['msg']='Invalid shipping method';
		}
		return $json;
    }

	function FlagShipCancal($ProductOrder,$storeData){
		    $json=array('status'=>0,'msg'=>'','data'=>array());
		    //pr($ProductOrder);
			//pr($ProductOrderItem);
			//pr($storeData,1);
			//die('OK');
			/*
			 * @params
			 * MY_ACCESS_TOKEN : use your Flagship token
			 * For test environment use https://test-api.smartship.io and https://api.smartship.io for a live one
			 * MY_WEBSITE : name of your website
			 * API_VERSION : this is same as the tag number from github. Instead of master branch, download the latest tag. It is something like v1.1.x
			 */
			$API_URL= FLAGSHIP_MODE =='live' ? 'https://api.smartship.io':'https://test-api.smartship.io';
			$MY_ACCESS_TOKEN= FLAGSHIP_MODE == 'live' ? MY_ACCESS_TOKEN_LIVE:MY_ACCESS_TOKEN_TEST;
			$website_name=isset($storeData['website_name']) ? $storeData['website_name'] :'printing.coop';

			$tracking_number=$ProductOrder['tracking_number'];
			$shipment_id=$ProductOrder['shipment_id'];
			//$shipment_id='786073265551';
			if(!empty($tracking_number) && !empty($shipment_id)){
				$flagship = new Flagship($MY_ACCESS_TOKEN, $API_URL,$website_name,API_VERSION);
				$payload = [
					 $shipment_id
				];
				try{
					  //$data=$flagship->availableServicesRequest()->execute();
					  //$data=$flagship->getShipmentListRequest()->execute();
					  $flagship->cancelShipmentRequest($shipment_id)->execute();
					  $json['status']=1;
					  $json['msg']='Shipping label cancelled successfully';
				}
				catch(CancelShipmentException $e){
					$json['msg']=$e->getMessage();
				}
		}else{
			$json['msg']='Invalid shipping method';
		}
		return $json;
    }

	#FlagShipTestRate();
	function FlagShipTestRate(){
			/*
			 * @params
			 * MY_ACCESS_TOKEN : use your Flagship token
			 * For test environment use https://test-api.smartship.io and https://api.smartship.io for a live one
			 * MY_WEBSITE : name of your website
			 * API_VERSION : this is same as the tag number from github. Instead of master branch, download the latest tag. It is something like v1.1.x
			 */
			$flagship = new Flagship(MY_ACCESS_TOKEN_TEST, 'https://test-api.smartship.io','printing.coop',API_VERSION);

			$payload = [
				'from' =>[
					"name"=> "printing coop",
					"attn"=> "Mehdi Afzali",
					"address"=> "9166 rue Lajeunesse",
					"suite"=> "",
					"city"=> "MONTREAL",
					"country"=> "CA",
					"state"=> "QC",
					"postal_code"=> "H2M1S2",
					"phone"=> "5143848043",
					"ext"=> "",
					"department"=> "",
					"is_commercial"=> true
				],
				"to" => [
					"name"=> "Papeterie St-Sauveur",
					"attn"=> "Papiterie",
					"address"=> "407 Rue Principale, 201",
					"suite"=> "",
					"city"=> "SAINT-SAUVEUR",
					"country"=> "CA",
					"state"=> "QC",
					"postal_code"=> "J0R1R4",
					"phone"=> "4502275252",
					"ext"=> "",
					"department"=> "Reception",
					"is_commercial"=> true
				],
				"packages"=> [
					"items"=> [
						[
							"width"=> 9,
							"height"=> 4,
							"length"=> 12,
							"weight"=> 11,
							"description"=> "Item description"
						],

					],
					"units"=> "imperial",
					"type"=> "package",
					"content"=> "goods"
				],
				"payment"=> [
					"payer"=> "F"
				],
				"options"=> [
					"insurance"=> [
						"value"=> 101,
						"description"=> "Children books"
					],
					"signature_required"=> false,
					"saturday_delivery"=> false,
					"reference"=> "123 test",
					"driver_instructions"=> "Doorbell broken, knock on door",
					"address_correction"=> true,
					"return_documents_as"=> "url",
					"shipment_tracking_emails"=> "jbeans@company.com;shipping1@company.com"
				]
			];

			try{
				$data=$flagship->availableServicesRequest()->execute();
                #pr($data,1);
				$rates = $flagship->createQuoteRequest($payload)->execute();
				//return $rates;
				//pr($rates,1);
				//$rates = $flagship->createQuoteRequest($payload)->setStoreName("My Awesome Store")->setOrderId('ABC1234')->execute();
				//pr($rates,1);
			}
			catch(QuoteException $e){
				echo $e->getMessage();
				die('Stop');
			}

			/*try{
				$rates = $flagship->createManifestRequest($payload)->execute();
				//return $rates;
				pr($rates,1);
				//$rates = $flagship->createQuoteRequest($payload)->setStoreName("My Awesome Store")->setOrderId('ABC1234')->execute();
				//pr($rates,1);
			}
			catch(CreateManifestException $e){
				echo $e->getMessage();
				die('Stop');
			}*/
}

#FlagShipTestConfirm();
function FlagShipTestConfirm(){
			/*
			 * @params
			 * MY_ACCESS_TOKEN : use your Flagship token
			 * For test environment use https://test-api.smartship.io and https://api.smartship.io for a live one
			 * MY_WEBSITE : name of your website
			 * API_VERSION : this is same as the tag number from github. Instead of master branch, download the latest tag. It is something like v1.1.x
			 */
			$flagship = new Flagship(MY_ACCESS_TOKEN_TEST, 'https://test-api.smartship.io','printing.coop',API_VERSION);
            //pr($flagship,1);
			$payload = [
				'from' =>[
					"name"=> "printing coop",
					"attn"=> "Mehdi Afzali",
					"address"=> "9166 rue Lajeunesse",
					"suite"=> "",
					"city"=> "MONTREAL",
					"country"=> "CA",
					"state"=> "QC",
					"postal_code"=> "H2M1S2",
					"phone"=> "5143848043",
					"ext"=> "",
					"department"=> "",
					"is_commercial"=> true
				],
				"to" => [
					"name"=> "FlagShip Courier Solutions",
					"attn"=> "FCS",
					"address"=> "Brunswick Blvd",
					"suite"=> "148",
					"city"=> "Pointe-Claire",
					"country"=> "CA",
					"state"=> "QC",
					"postal_code"=> "H9R5P9",
					"phone"=> "18663208383",
					"ext"=> "",
					"department"=> "Reception",
					"is_commercial"=> true
				],
				"packages"=> [
					"items"=> [
						[
							"width"=> 22,
							"height"=> 22,
							"length"=> 22,
							"weight"=> 22,
							"description"=> "Item description"
						],

					],
					"units"=> "imperial",
					"type"=> "package",
					"content"=> "goods"
				],
				"payment"=> [
					"payer"=> "F"
				],
				"service"=> [
					"courier_name"=>"FedEx",
					"courier_code"=>"FEDEX_GROUND"
				],
				"options"=> [
					/*"insurance"=> [
						"value"=> 123.45,
						"description"=> "Children books"
					],*/
					"signature_required"=> false,
					"saturday_delivery"=> false,
					"reference"=> "123 test",
					"driver_instructions"=> "Doorbell broken, knock on door",
					"address_correction"=> true,
					"return_documents_as"=> "url",
					"shipment_tracking_emails"=> "devouttest@gmail.com"
				]
			];

			try{
			      $confirmedShipment = $flagship->confirmShipmentRequest($payload)->execute();

				  //$confirmedShipment = $request->execute(); //returns a collection of rates
				  pr($confirmedShipment);
				  echo $confirmedShipment->getLabel(); //returns regular label
				  echo $confirmedShipment->getThermalLabel(); //returns thermal label
				  echo $confirmedShipment->getTotal();
			}
			catch(ConfirmShipmentException  $e){
				echo $e->getMessage();
				die('Stop');
			}
}
    function  FlagShipServiceCode($code=null){
		$ups_service_code   = [
		/*'FEDEX_GROUND'        => ['flagship_code' =>'standard',
                                 'courier_code' => 'FEDEX_GROUND',
                                 'courier_desc' => 'Ground',
                                 'courier_name' => 'FedEx'
								 ],*/

		'FEDEX_2_DAY'         => ['flagship_code' =>'secondDay',
                                 'courier_code' => 'FEDEX_2_DAY',
                                 'courier_desc' => '2 Days',
                                 'courier_name' => 'FedEx'
								 ],
		'FEDEX_EXPRESS_SAVER' => ['flagship_code' =>'express',
                                 'courier_code' => 'FEDEX_EXPRESS_SAVER',
                                 'courier_desc' => 'Economy',
                                 'courier_name' => 'FedEx'
								 ],
		'PRIORITY_OVERNIGHT'  => ['flagship_code' =>'expressAm',
                                 'courier_code' => 'PRIORITY_OVERNIGHT',
                                 'courier_desc' => 'Priority Overnight',
                                 'courier_name' => 'FedEx'
								 ],
		'STANDARD_OVERNIGHT'  => ['flagship_code' =>'expressAm',
                                 'courier_code' => 'STANDARD_OVERNIGHT',
                                 'courier_desc' => 'Standard Overnight',
                                 'courier_name' => 'FedEx'
								 ],
		'GRD'                    => ['flagship_code' =>'standard',
                                 'courier_code' => 'GRD',
                                 'courier_desc' => 'Dicom Ground',
                                 'courier_name' => 'Dicom'
								 ],
		'PurolatorExpress9AM'    => ['flagship_code' =>'expressEarlyAm',
                                 'courier_code' => 'PurolatorExpress9AM',
                                 'courier_desc' => 'Purolator Express 9AM',
                                 'courier_name' => 'courier_name'
								 ],
        'PurolatorExpress10:30AM' => ['flagship_code' =>'expressAm',
                                 'courier_code' => 'PurolatorExpress10:30AM',
                                 'courier_desc' => 'Purolator Express 10:30 AM',
                                 'courier_name' => 'Purolator'
								 ],
        'PurolatorExpress'       => ['flagship_code' =>'express',
                                 'courier_code' => 'PurolatorExpress',
                                 'courier_desc' => 'Purolator Express',
                                 'courier_name' => 'Purolator'
								 ],

		];

		if(!empty($code)){
		 	return $ups_service_code[$code];
			exit();
		}
	    return $ups_service_code;
	}

	function  FlagShipTrackingStatus($code=null){
		$ups_service_code   = [
		'M'        => 'Manifested',
		'P'        => 'Pickup',
		'T'        => 'In transit',
		'U'        => 'Delivered',
		'X'        => 'Exception',
		];
		if(!empty($code)){
		 	return $ups_service_code[$code];
			exit();
		}
	    return $ups_service_code;
	}

	function calculateShippingCost($order_amount){
		$shiping_coust=0.00;
		$order_amount=round($order_amount,2);

		if($order_amount <= 100.99){
			$shiping_coust=25;
		}else if($order_amount >= 101 && $order_amount <= 300.99){
			 $shiping_coust=40;
		}else if($order_amount >= 301 && $order_amount <= 999.99){
			$shiping_coust=($order_amount*15)/100;
			$shiping_coust=round($shiping_coust,2);
		}else if($order_amount > 1000){
			$shiping_coust=0.00;
		}
		return $shiping_coust;
	}

