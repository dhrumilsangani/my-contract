<?php

use App\Models\Subscription;

function enCodeVal($val){
    if(!empty($val)){
        $res = Hashids::encode($val);
        //$res = Hashids::encodeHex($val);
		return $res;
	}
}

function deCodeVal($val){
	if(!empty($val)){
		$res = Hashids::decode($val);
		//$res = Hashids::decodeHex($val);
		if(!empty($res)){
			return $res[0];
		}
	}
}

function getUserInfo($userId){
	$results =  \App\Models\User::where('id',$userId)->first();
	return $results;
}

function cmsInfo(){
	$results =  \App\Models\CmsPage::where('status',1)->get();
	return $results;
}


function getContent($slug){
	$results =  \App\Models\Content::where('content_slug',$slug)->where('status',1)->first();
	return $results;
}

function categoriesName($id){
	$results =  \App\Models\ContractCategories::select('categories_name')->where('id',$id)->first();
	//return $results['categories_name'];
	if(!empty($results['categories_name'])){
		return $results['categories_name'];	
	}else{
		return "";
	}
}

function checkSubscription()
{
	/*start check Subscription plan*/
	if(isset(Auth::user()->id)){
		$sub = \App\Models\Subscription::where('user_id',Auth::user()->id)->where('status',1)->first();
		if(!empty($sub)){
			if($sub->type == "One-Off Contract"){
				$contractDetail = \App\Models\ContractData::where('created_by',Auth::user()->id)->where('one_coontract_status',1)->get();
				if(count($contractDetail) > 0){
					return 2;        
				}else{
					return 1;
				}
			}else{
				return 1;
			}
		}else{
			return 0;
		}
	}else{
		return 0;
	}
	/*End check Subscription plan*/
}


function str_limit($value, $limit = 100, $end = '...')
{
    $limit = $limit - mb_strlen($end); // Take into account $end string into the limit
    $valuelen = mb_strlen($value);
    return $limit < $valuelen ? mb_substr($value, 0, mb_strrpos($value, ' ', $limit - $valuelen)) . $end : $value;
}

function checkSubscriptionDetail(){
	$sub = Subscription::select('type')->where('user_id',Auth::user()->id)->where('status',1)->first();
	return $sub->type;
} 

function convertDate($date)
{	
	return date(DATE_FORMAT, strtotime($date));
}

function convertOnlyDate($date)
{	
	return date("Y-m-d", strtotime($date));
}

function datetimeformat($date = '') {
    if (!empty($date)) {
        return date("Y-m-d H:i:s", strtotime($date));
    } else {
        return date("Y-m-d H:i:s");
    }
}
?>