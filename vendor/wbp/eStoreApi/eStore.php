<?php

namespace wbp\eStoreApi;

use linslin\yii2\curl\Curl;
use yii\base\Component;

/**
 * Class eStore
 * @package wbp\eStoreApi
 */

class eStore extends Component{
    const apiVer='v1';

    protected $_client;

    public $options;
    public $apiUrl;
    public $curlOptions;
    public $lastCurlObject;

    public $authType;
    public $authToken;

    public function get($url,$cache=true,$raw = false)
    {
        $key=$this->apiUrl.$url;

        $data=false;
        if($cache) $data = \Yii::$app->cache->get($key);
        if($data === false) {
            $curl = $this->prepareRequest();
            $response = $curl->get($key, $raw);
            if ($response) {
                $cacheTime = false;
                if (isset($response['cacheTime'])) $cacheTime = $response['cacheTime'];
                if (isset($response['data'])) $response = $response['data'];
                if ($cacheTime) {
                    \Yii::$app->cache->set($key, $response, (int)$cacheTime);
                }
            }
        }else{
            $response=$data;
        }
        return $response;
    }
    public function post($url,$data,$isRaw = false)
    {
        foreach($data as $key=>$value){
            $fields_string[]=$key.'='.$value;
        }
        $this->curlOptions[CURLOPT_POSTFIELDS]=json_encode($data);

        $curl=$this->prepareRequest();
        $response=$curl->post($this->apiUrl.$url,$isRaw);

        return $response;
    }

    public function update($url,$data,$isRaw = false){
        foreach($data as $key=>$value){
            $fields_string[]=$key.'='.$value;
        }
        $this->curlOptions[CURLOPT_POSTFIELDS]=json_encode($data);

        $curl=$this->prepareRequest();
        $response=$curl->put($this->apiUrl.$url,$isRaw);

        return $response;
    }

    public function prepareRequest(){
        $this->lastCurlObject=new Curl();

        $this->curlOptions[CURLOPT_HTTPHEADER][]='Authorization: '.$this->authType.' '.$this->authToken;
        $this->curlOptions[CURLOPT_HTTPHEADER][]='ApiVer: '.eStore::apiVer;
        foreach($this->curlOptions as $key=>$value){
            $this->lastCurlObject->setOption($key,$value);
        }

        return $this->lastCurlObject;
    }


}