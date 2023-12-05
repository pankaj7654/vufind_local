<?php

namespace Inflibnet\RecordDriver;
use Inflibnet\AjaxHandler\FetchINFMemberNameByIP;
use PhpParser\Node\Expr\Print_;

class SolrDefault extends \VuFind\RecordDriver\SolrDefault
{
    public function getApiUrlsArray(){
        $apiUlrFunctionCall = new FetchINFMemberNameByIP();
        $apiUrls = $apiUlrFunctionCall->getApiUrl();
        return $apiUrls;
    }

    public function getJournalDetails()
    {
        
       try{
        if(!isset($_COOKIE['mem_id'])){
            $a = new FetchINFMemberNameByIP();
            $memDetails = $a->checkIpAddress();
            
            $memid =  $memDetails[0];
        }
        else{
            $memid = $_COOKIE['mem_id'];
        }

        if(!isset($_COOKIE['email'])){
            $a = new FetchINFMemberNameByIP();
            $memDetails = $a->checkIpAddress();
            $email =  $memDetails[2];
        }
        else{
            $email = $_COOKIE['email'];
        }

        try{
            // print_r($this->fields);
            $jid = $this->fields['journal_id_str_mv'][0];
        }
        catch(\Exception $e){
            try{
                $jid = $this->fields['jid_str_mv'][0];
            }
            catch(\Exception $e){
                $jid = -1;
            }
        }
        try{
            $openAccess = $this->fields['openaccess_str_mv'][0];
        }
        catch(\Exception $e){
            $openAccess = "";
        }
        // try{
        //     $biharcat = $this->fields['biharcat_str_mv'][0];
        // }
        // catch(\Exception $e){
        //     $biharcat = "";
        // }

        try{
            $author = $this->fields['author_facet'][0];
        }
        catch(\Exception $e){
            $author = NULL;
        }

        try{
            $doi = $this->fields['doi_str_mv'][0];
        }
        catch(\Exception $e){
            $doi = NULL;
        }
        try{
            $title = $this->fields['title'];
        }
        catch(\Exception $e){
            $title = NULL;
        }
        try{
            $container_title = $this->fields['container_title'];
        }
        catch(\Exception $e){
            $container_title = NULL;
        }
        try{
            $container_volume = $this->fields['container_volume'];
        }
        catch(\Exception $e){
            $container_volume = NULL;
        }
        try{
            $container_issue = $this->fields['container_issue'];
        }
        catch(\Exception $e){
            $container_issue = NULL;
        }
        try{
            // $issn = $this->fields['issn'][0] . ', '.$this->fields['issn'][1];
            $issn = implode(", ",$this->fields['issn']);
        }
        catch(\Exception $e){
            $issn = NULL;
        }
        try{
            $publisher = $this->fields['publisher'][0];
        }
        catch(\Exception $e){
            $publisher = NULL;
        }
        try{
            $url = $this->fields['url'][0];
        }
        catch(\Exception $e){
            $url = NULL;
        }
        try{
            $format = $this->fields['format'][0];
        }
        catch(\Exception $e){
            $format = NULL;
        }
        try{
            $docId = $this->fields['id'];
        }
        catch(\Exception $e){
            $docId = NULL;
        }
        try{
            $publishDate = $this->fields['publishDate'][0];
            if($publishDate==''){
                $publishDate = NULL;
            }
        }
        catch(\Exception $e){
            $publishDate = NULL;
        }
        // $issn = $this->fields['issn'][0] . ', '.$this->fields['issn'][1];
        // $publisher = $this->fields['publisher'][0];
        // $url = $this->fields['url'][0];
        // print_r($openAccess);
        $result = $this->apidata($memid, $jid);

		$returnArray = array();
        $returnArray['accessStatus'] = $result;
		$returnArray['jid'] = $jid;
		$returnArray['doi'] = $doi;
        $returnArray['title'] = $title;
		$returnArray['container_title'] = $container_title;
        $returnArray['issn'] = $issn;
		$returnArray['publisher'] = $publisher;
        $returnArray['url'] = $url;
		$returnArray['format'] = $format;
        $returnArray['docId'] = $docId;
		$returnArray['container_volume'] = $container_volume;
        $returnArray['container_issue'] = $container_issue;
		$returnArray['publishDate'] = $publishDate;
        $returnArray['email'] = $email;
		$returnArray['memid'] = $memid;
        $returnArray['openAccess'] = $openAccess;
        $returnArray['author'] = $author;
        
        // print_r($returnArray);
        return $returnArray;
        // print_r($publisher);
        // return [$result,$jid,$doi,$title,$container_title,$issn,$publisher,$url,$format,$docId,$container_volume,$container_issue,$publishDate,$email,$memid];
       }
       
       catch(\Exception $e) {
            $exception1 = $e;
            return "";
        } 
        
    }


    public function apidata($memid, $jid){
        try{
            // $query2 = json_encode(array('memid'=>$memid));
            // // $query2 = http_build_query(array($query2));

            // $opts = array('http' => array(
            //         'method' => "POST",
            //         'header' => array("Content-Type: text/plain", "accept: application/json","User-Agent:MyAgent/1.0\r\n" ,"Authorization: Token ceb55820f197541419275b57b84277f48d9a6bf0"),
            //         'content'=>$query2
            //     )
            //     );
            // $context = stream_context_create($opts);
            // $file = file_get_contents('http://172.16.16.163/ermapi/member/search/members?page=1&limit=1000&journalId='.$jid, false, $context);
            //$file = file_get_contents('https://essapi.inflibnet.ac.in/member/search/members?page=1&limit=1000&JournalID='.$jid, true, $context);
        
            $baseUrlForGetmemDetails = str_replace(' ', '',$this->getApiUrlsArray()['get_mem_data']);
            $apiToken = $this->getApiUrlsArray()['api_token'];
            $statusArray = array();
            $statusArray['publisherAccess'] = 0;
            $statusArray['DDR'] = 0;
            if($memid != 'null') {
                $curl = curl_init();
                curl_setopt_array($curl, array(
                // CURLOPT_URL => 'http://172.16.16.163/ermapi/member/search/members?page=1&limit=1000&journalId='.$jid,
                CURLOPT_URL => $baseUrlForGetmemDetails.$jid,
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
                    'Authorization:'.$apiToken,
                    'Content-Type: text/plain'
                ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            $data = json_decode($response);
                if ($data->success == true) {        
                    $dataCount = $data->count;
                    if($dataCount == 0) {
                        $memberDetails =  $this->getMemberDetailsFromJournalId($jid, $memid); // From ILL Mapping API and allInstitute Subscriptions
                        if($memberDetails->count == 0) {
                            $statusArray['DDR'] = 0;
                        } else {
                            $statusArray['DDR'] = 1; // DDR Available
                        }
                    } else {
                        $statusArray['publisherAccess'] = 1; // Access from publisher
                    }
                }
            } 
            return $statusArray;  
        }
        catch(\Exception $e) {
            $memCount = $e;
            return "";
        }  
    }
    
       
    
    // this function is made for datatable 
    public  function getMemberDetailsFromJournalId($jid,$memid)
    {
        $body = json_encode(array('mem_id'=>$memid));
        $opts = array('http' => array(
            'method' => "POST",
            'header' => array("Content-Type: text/plain", "accept: application/json" ,"Authorization: Token ceb55820f197541419275b57b84277f48d9a6bf0"),
            'content'=>$body
        )
        );
       
        $context = stream_context_create($opts);
        $deliveringMemIds = file_get_contents('http://172.16.16.163/ermapi/ill/illMappingFetch', false, $context);
        $deliveringMemIds = json_decode($deliveringMemIds);
        $deliveringMemIds = $deliveringMemIds->data;
        $reqIds = "";
        foreach($deliveringMemIds as $ids){
            $reqIds = $reqIds. $ids->deliveringMemberId." " ;
        }
        $body = json_encode(array('memid'=>$reqIds));
        $opts = array('http' => array(
            'method' => "POST",
            'header' => array("Content-Type: text/plain", "accept: application/json" ,"Authorization: Token ceb55820f197541419275b57b84277f48d9a6bf0"),
            'content'=>$body
        )
        );
        $context = stream_context_create($opts);
        // $file = file_get_contents('http://172.16.0.43:3000/member/search/members?page=1&limit=1000&JournalID='.$jid, false, $context);
        $file = file_get_contents('http://172.16.16.163/ermapi/member/search/members?page=1&limit=1000&journalId='.$jid, false, $context);
        //$file = file_get_contents('https://essapi.inflibnet.ac.in/member/search/members?page=1&limit=1000&JournalID='.$jid, true, $context);
        $data2 = json_decode($file);
       
        if ($data2->success == true){
            $memname = $data2;
            return $memname;
        }

    }



    // this function is made for datatable 
    public  function getMemberEmail($jid, $tomemid,$frommemid)
    {
        try{
            // $get_mem_email = str_replace(' ', '',$this->getApiUrlsArray()['get_ill_contract']);

            $toMemId = json_encode(array('mem_id'=>$tomemid));
            $opts = array('http' => array(
                    'method' => "POST",
                    'header' => array("Content-Type: text/plain", "accept: application/json" ,"Authorization: Token ceb55820f197541419275b57b84277f48d9a6bf0"),
                    'content'=>$toMemId
                )
                );
            $context = stream_context_create($opts);
            $toEmail = file_get_contents('http://172.16.16.163/ermapi/ill/illContactFetch', false, $context);
            $toEmail = json_decode($toEmail);
            // print_r($data);
            $toEmailId ="";
            if ($toEmail->status == true){  
                $toEmailId = $toEmail->data[0]->contactEmail;
            }
            else{
                $toEmailId = 'Something went wrong ! in TO';
            }

            $fromMemId = json_encode(array('mem_id'=>$frommemid));
            
            $opts = array('http' => array(
                    'method' => "POST",
                    'header' => array("Content-Type: text/plain", "accept: application/json" ,"Authorization: Token ceb55820f197541419275b57b84277f48d9a6bf0"),
                    'content'=>$fromMemId
                )
                );
            $context = stream_context_create($opts);
            $fromEmail = file_get_contents('http://172.16.16.163/ermapi/ill/illContactFetch', false, $context);
            $fromEmail = json_decode($fromEmail);
            // print_r($data);
            $fromEmailId ="";
            if ($fromEmail->status == true){  
                $fromEmailId = $fromEmail->data[0]->contactEmail;
            }
            else{
                $fromEmailId = 'Something went wrong ! in TO';
            }
            return array('toEmailId'=>$toEmailId,'fromEmailId'=>$fromEmailId);
        }
        catch(\Exception $e) {
            $exception1 = $e;
            return "";
        }  
    }



    #Mail sender 
    public function senEmailApiCall($to,$from,$subject,$emailbody,$doi,$title,$container_title,$issn,$publisher,$format,$jid,$docId,$reqContact,$reqEmail,$reqId,$reqName,$tomemid,$userMemId,$volume,$issue,$year,$author){
        try{
            $body = json_encode(array('requesting_member_id'=>$userMemId,'delivering_member_id'=>$tomemid,'request_source'=>"0",'doi'=>$doi,'document_title'=>$title,'container_title'=>$container_title,'issn'=>$issn,'publisher'=>$publisher,'document_type'=>$format,'document_format'=>'online','jid'=>$jid,'documentId'=>$docId, 'requester_name'=>$reqName,'requester_mailid'=>$reqEmail,'requester_contact'=>$reqContact,'requester_identity'=>$reqId,'volume'=>$volume,'issue'=>$issue,'year'=>$year, 'author'=>$author));
            $opts = array('http' => array(
                    'method' => "POST",
                    'header' => array("Content-Type: text/plain", "accept: application/json" ,"Authorization: Token ceb55820f197541419275b57b84277f48d9a6bf0"),
                    'content'=>$body
                )
            );
            
            $context = stream_context_create($opts);
            // $file = file_get_contents('http://172.16.0.43:3000/member/search/members?page=1&limit=1000&JournalID='.$jid, false, $context);
            // $file = file_get_contents('http://172.16.16.163/ermapi/mailer/send-mail?to='.urlencode($to).'&subject='.urlencode($subject).'&replyTo='.urlencode($from), false, $context);
            $file = file_get_contents('http://172.16.16.163/ermapi/ill/illRequestAdd', false, $context);
            $data3 = json_decode($file);
            // print_r($data3);
            $body = json_encode(array('body'=>$emailbody));
            $opts = array('http' => array(
                    'method' => "POST",
                    'header' => array("Content-Type: text/plain", "accept: application/json" ,"Authorization: Token ceb55820f197541419275b57b84277f48d9a6bf0"),
                    'content'=>$body
                )
            );

            $context = stream_context_create($opts);
            $file = file_get_contents('http://172.16.16.163/ermapi/ill/illMailSend?to='.urlencode($to).'&subject='.urlencode($subject).'&cc='.urlencode($from).'&purpose="illRequest"', false, $context);
            $data3 = json_decode($file);
            return $data3;
        }
        catch(\Exception $e) {
            $exception1 = $e;
            return "";
        }  
    }
}

