<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Youtube extends Controller
{
    function test(){
        return ["status"=>true];
    }

    function addField($url,$name,$value){
        if($value){
            str_replace(" ","%20",$value);
            str_replace(",","%2C",$value);
            return $url."&".$name."=".$value;
        }
        return $url;
    }
    // if user pass any these parameter so it will add to the request URL
    function getUrl(Request $req,$url){
        $url=$this->addField($url,"part","snippet");
        $url=$this->addField($url,"maxResults",50);
        $url=$this->addField($url,"pageToken",$req->pageToken);
        $url=$this->addField($url,"channelId",$req->channelId);
        $url=$this->addField($url,"channelType",$req->channelType);
        $url=$this->addField($url,"location",$req->location);
        $url=$this->addField($url,"locationRadius",$req->locationRadius);
        $url=$this->addField($url,"onBehalfOfContentOwner",$req->onBehalfOfContentOwner);
        $url=$this->addField($url,"order",$req->order);
        $url=$this->addField($url,"publishedAfter",$req->publishedAfter);
        $url=$this->addField($url,"publishedBefore",$req->publishedBefore);
        $url=$this->addField($url,"regionCode",$req->regionCode);
        $url=$this->addField($url,"relatedToVideoId",$req->relatedToVideoId);
        $url=$this->addField($url,"relevanceLanguage",$req->relevanceLanguage);
        $url=$this->addField($url,"safeSearch",$req->safeSearch);
        $url=$this->addField($url,"topicId",$req->topicId);
        $url=$this->addField($url,"type",$req->type);
        $url=$this->addField($url,"videoCaption",$req->videoCaption);
        $url=$this->addField($url,"videoCategoryId",$req->videoCategoryId);
        $url=$this->addField($url,"videoDefinition",$req->videoDefinition);
        $url=$this->addField($url,"videoDimension",$req->videoDimension);
        $url=$this->addField($url,"videoDuration",$req->videoDuration);
        $url=$this->addField($url,"videoEmbeddable",$req->videoEmbeddable);
        $url=$this->addField($url,"videoLicense",$req->videoLicense);
        $url=$this->addField($url,"videoSyndicated",$req->videoSyndicated);
        $url=$this->addField($url,"videoType",$req->videoType);
        return $url;
    }

    function getData(Request $req){
        header('Access-Control-Allow-Origin: *');
        header( 'Access-Control-Allow-Headers: Authorization, Content-Type' );
        $query = $req->q;     
        str_replace("|","%20",$query); 
        $keys=[
            "1"=>"AIzaSyCS_4H7s_SQmaUJM-uV8AFMYUHaSfxZShc",
            "2"=>"AIzaSyAw1If1Qd2HIBkfGhJn2Rzz9TO7GkihAQU"
        ];
        $key=$keys["2"];
        $url = "https://www.googleapis.com/youtube/v3/search";
        $url=$url."?key=".$key;

        if($query!="" and $query!=null){
            $url=$url."&q=".$query;
        }
        $url = $this->getUrl($req,$url);
        // calling the api
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $resp = curl_exec($ch);
        $result = json_decode($resp,true);
        curl_close($ch);
        if(array_key_exists("error",$result)){
            $result["status"]=false;
            $result["items"]=[];
        }else{
            $result["status"]=true;
            $result["error"]=[];
        }
        return $result;
    }
}
