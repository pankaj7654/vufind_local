<?php

namespace Inflibnet\AjaxHandler;
use Laminas\Mvc\Controller\Plugin\Params;
use VuFind\AjaxHandler\AbstractBase;
use VuFind\GeoFeatures\AbstractConfig;
use VuFind\Config\PluginManager;

class FetchINFMemberNameByIP extends AbstractBase
{
    // /**
    //  * Configuration loader
    //  *
    //  * @var \VuFind\Config\PluginManager
    //  */
    // protected $configLoader;

    // /**
    //  * Constructor
    //  *
    //  * @param \VuFind\Config\PluginManager $configLoader Configuration loader
    //  */
    // public function __construct(\VuFind\Config\PluginManager $configLoader)
    // {
    //     $this->configLoader = $configLoader;
    // }

    public function checkIpAddress()
    {              
        try{
            $ipaddress = $this->fetchIP();

            if(!isset($_COOKIE["memname"]) && !isset($_COOKIE["email"]) && !isset($_COOKIE["mem_id"])) {
                $memResult = $this->setIpaddress($ipaddress);
                // print_r("SystemIP= ".$ipaddress." OrgIP= ".$memResult);
                return $memResult;
                 
            } else {
                $memResult = [];
                $mem_id = $_COOKIE["mem_id"];
                $memName = $_COOKIE["memname"];
                $email = $_COOKIE["email"];
                array_push($memResult, $mem_id, $memName,$email);
                // array_push($arrayname,"arrayValue1","arrayValue2");
                return $memResult;
            }
        }
        catch(\Exception $e) {
            echo 'Exception Message: ' .$e->getMessage();
          }   
    }

    /**
     * Convert a config object to an options array; return empty array if
     * configuration is missing or incomplete.
     *
     * @param string $configName   Name of config file to read
     * @param string $section      Name of section to read
     * @param array  $validOptions List of valid fields to read
     *
     * @return array
     */
    function getApiUrl() {
        // Construct the absolute path to api_url.ini
        $apiConfigFile = 'C:\vufind\local\config\vufind\api_url.ini';

        // Read the API URL configuration from the absolute path
        $apiConfig = parse_ini_file($apiConfigFile, true);
    
        // Check if the API name exists in the configuration
        if (isset($apiConfig['Api_url'])) {
            return $apiConfig['Api_url'];
        } else {
            return null; // Handle the case where the API name is not found
        }

        // if ($this->configLoader !== null) {
        //     $config = $this->configLoader->get('api_url');
        //     $apiUrldata = $config['Api_url'];
        //     print_r($apiUrldata);
        // } else {
        //     // Handle the case where the object is null
        //     $config = $this->configLoader."object null found";
        // }
        // return $config;
    }
  
    public function setIpaddress($ipaddress){
        try{
            // $baseApiUrl = $this->getApiUrl();
            // print_r($baseApiUrl);
            $baseApiUrl = str_replace(' ', '',$this->getApiUrl()['get_mem_name']);
            $apiToken = $this->getApiUrl()['api_token'];

            $curl = curl_init();
            curl_setopt_array($curl, array(

                CURLOPT_URL =>$baseApiUrl.'172.16.0.43',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS =>'',
                CURLOPT_HTTPHEADER => array(
                    'Authorization:'.$apiToken,
                    'Content-Type: text/plain'
                ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            $data = json_decode($response);
            // print_r($data);

            if ($data->success == true){
                $memName = $data->data->memName ? $data->data->memName : 'Guest User';
                $ipstart = $data->data->ipstart ? $data->data->ipstart : '';
                $ipend = $data->data->ipend ? $data->data->ipend : '';
                $id = $data->data->id ? $data->data->id : '0';
                $mem_id = $data->data->mem_id ? $data->data->mem_id : 'null';
                $email = $data->data->email1 ? $data->data->email1 : 'null';
            }
            else{
                $memName = 'Guest User';
                $ipstart = $ipaddress;
                $ipend = '';
                $id = '0';
                $mem_id = 'null';
                $email = 'null';
            }
			$memName = $memName .' (' . $ipaddress .')';
			
            setcookie('memname',$memName,  time() + (86400 * 30), "/");           //30 days
            setcookie('ipstart',$ipstart,  time() + (86400 * 30), "/");              //30 days
            setcookie('ipend',$ipend,  time() + (86400 * 30), "/");                  //30 days
            setcookie('id',$id,  time() + (86400 * 30), "/");                        //30 days
            setcookie('mem_id',$mem_id,  time() + (86400 * 30), "/");                //30 days
            setcookie('email',$email,  time() + (86400 * 30), "/");           //30 days
            $memResult = [];
            array_push($memResult, $mem_id, $memName,$email);
            return $memResult;
        }
        catch(\Exception $e) {
            $memName = "Guest User";
            setcookie('memname',$memName,  time() + (86400 * 30), "/");  
            setcookie('ipstart',$ipaddress,  time() + (86400 * 30), "/");              //30 days
            setcookie('ipend',$ipend,  time() + (86400 * 30), "/");                  //30 days
            setcookie('id',$id,  time() + (86400 * 30), "/");                        //30 days
            setcookie('mem_id',$mem_id,  time() + (86400 * 30), "/");           //30 days
            setcookie('email',$email,  time() + (86400 * 30), "/");
            $memResult = [];
            array_push($memResult,$mem_id,$memName,$email);
            return $memResult;
        }   
    }

    public function fetchIP(){
        $ipAddress = '';
        if (! empty($_SERVER['HTTP_CLIENT_IP'])) {
            // to get shared ISP IP address
            $ipAddress = $_SERVER['HTTP_CLIENT_IP'];
        } else if (! empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            // check for IPs passing through proxy servers
            // check if multiple IP addresses are set and take the first one
            $ipAddressList = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            foreach ($ipAddressList as $ip) {
                if (! empty($ip)) {
                    // if you prefer, you can check for valid IP address here
                    $ipAddress = $ip;
                    break;
                }
            }
        } else if (! empty($_SERVER['HTTP_X_FORWARDED'])) {
            $ipAddress = $_SERVER['HTTP_X_FORWARDED'];
        } else if (! empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP'])) {
            $ipAddress = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
        } else if (! empty($_SERVER['HTTP_FORWARDED_FOR'])) {
            $ipAddress = $_SERVER['HTTP_FORWARDED_FOR'];
        } else if (! empty($_SERVER['HTTP_FORWARDED'])) {
            $ipAddress = $_SERVER['HTTP_FORWARDED'];
        } else if (! empty($_SERVER['REMOTE_ADDR'])) {
            $ipAddress = $_SERVER['REMOTE_ADDR'];
        }
		$ipAddress =  $_SERVER['REMOTE_ADDR'];
		
        return $ipAddress;
    }


    public function handleRequest(Params $params)
    {

        // $data = "IIT mumbai";
        $data = $this->checkIpAddress();
        return $this->formatResponse($data);
    }
}

