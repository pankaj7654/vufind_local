<?php

namespace Inflibnet\AjaxHandler;
use VuFind\AjaxHandler\AbstractBase;
use Laminas\Mvc\Controller\Plugin\Params;
use Inflibnet\AjaxHandler\FetchINFMemberNameByIP;

class HomeJournalDetailShow extends AbstractBase
{
    public function homeJournalData(){
        try{
            if(!isset($_COOKIE['mem_id'])){
                $a = new FetchINFMemberNameByIP();
                $memDetails = $a->checkIpAddress();
                $memid =  $memDetails[0];
            }
            else{
                $memid = $_COOKIE['mem_id'];
            }

            $curl = curl_init();
            $base_url = 'http://172.16.16.163/ermapi/e-resource/member-to-resource';
            $body_data = array(
                "access_type" => "null",
                "active" => "null",
                "attributes" => "null",
                "category" => "null",
                "id" => "null",
                "mem_id" => "1000",
                "res_id" => "null",
                "resname" => "null",
                "subscription_type" => "null"
            );
        
            $query_params = http_build_query(array('page' => 1, 'limit' => 10, 'body' => json_encode($body_data)));
            $full_url = $base_url . '?' . $query_params;
            curl_setopt_array($curl, array(
                CURLOPT_URL => $full_url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS =>'{
                    "memid": "'.$memid.'"
                    }',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Token ceb55820f197541419275b57b84277f48d9a6bf0',
                    'Content-Type: text/plain'
                ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            $data = json_decode($response);
            return $data;
            if ($data && isset($data->success) && $data->success == true) {
                // Assuming 'success' is a key in the response JSON
                $resultData = $data; // Extracting data if success is true
                return $resultData;
            } else {
                return "Data not found or request unsuccessful";
            }
        } 
        catch (\Exception $e) {
            // Handle any exceptions that might occur during the cURL request
            $errorMessage = $e->getMessage(); // Retrieve the error message
            return "Error: " . $errorMessage;
        }
    }

    public function handleRequest(Params $params)
    {

        // $data = "IIT mumbai";
        $data = $this->homeJournalData();
        return $this->formatResponse($data);
    }
}

