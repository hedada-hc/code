<?php 
namespace App\Foundations;

use App\Foundations\OpenSearch\Sdk\CloudsearchClient;
use App\Foundations\OpenSearch\Sdk\CloudsearchSearch;

use Config;

class OpenSearch{
    private $client;
    public function __construct(){
        $access_key = Config::get('opensearch.access_key');
        $secret = Config::get('opensearch.secret');
        $host = Config::get('opensearch.host');//根据自己的应用区域选择API
        $key_type = "aliyun";  //固定值，不必修改
        $opts = array('host'=>$host);
        $this->client = new CloudsearchClient($access_key,$secret,$opts,$key_type);
    }

    public function connect($app_name = null){
        // 实例化一个搜索类
        $search_obj = new CloudsearchSearch($this->client);
        // 指定一个应用用于搜索
        $search_obj->addIndex($app_name ? $app_name : Config::get('opensearch.app_name'));
        // 指定返回的搜索结果的格式为json
        $search_obj->setFormat("json");
        return $search_obj;
    }
}