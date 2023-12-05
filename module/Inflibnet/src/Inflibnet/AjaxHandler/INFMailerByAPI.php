<?php

namespace Inflibnet\AjaxHandler;
use Laminas\Mvc\Controller\Plugin\Params;
use VuFind\AjaxHandler\AbstractBase;
use Inflibnet\RecordDriver\SolrDefault;

class INFMailerByAPI extends AbstractBase
{
    // /**
    //  * Send an email.
    //  *
    //  * @param string $to Email recipient
    //  * @param string $from Email sender
    //  * @param string $subject Email subject
    //  * @param string $body Email body
    //  * @param string $doi DOI
    //  * @param string $title Article title
    //  * @param string $container_title Container title
    //  * @param string $issn ISSN
    //  * @param string $publisher Publisher
    //  * @param string $format Format
    //  * @param string $jid Journal ID
    //  * @param string $docId Document ID
    //  * @param string $reqContact Requestor contact
    //  * @param string $reqEmail Requestor email
    //  * @param string $reqId Requestor ID
    //  * @param string $reqName Requestor name
    //  * @param string $tomemid To member ID
    //  * @param string $userMemId User member ID
    //  * @param string $volume Volume
    //  * @param string $issue Issue
    //  * @param string $year Year
    //  *
    //  * @return bool True if the email was sent successfully, false otherwise.
    //  */
    // public function sendEmail(
    //     $to,
    //     $from,
    //     $subject,
    //     $body,
    //     $doi,
    //     $title,
    //     $container_title,
    //     $issn,
    //     $publisher,
    //     $format,
    //     $jid,
    //     $docId,
    //     $reqContact,
    //     $reqEmail,
    //     $reqId,
    //     $reqName,
    //     $tomemid,
    //     $userMemId,
    //     $volume,
    //     $issue,
    //     $year
    // ) {
    //     // Validate input here if needed, e.g., check if emails are valid, and sanitize data.

    //     try {
    //         $a = new SolrDefault();
    //         $mailSent = $a->senEmailApiCall(
    //             $to,
    //             $from,
    //             $subject,
    //             $body,
    //             $doi,
    //             $title,
    //             $container_title,
    //             $issn,
    //             $publisher,
    //             $format,
    //             $jid,
    //             $docId,
    //             $reqContact,
    //             $reqEmail,
    //             $reqId,
    //             $reqName,
    //             $tomemid,
    //             $userMemId,
    //             $volume,
    //             $issue,
    //             $year
    //         );
    //         return $mailSent;
    //     } catch (\Exception $e) {
    //         // Handle the exception, log the error, or return a relevant error message.
    //         error_log('Exception Message: ' . $e->getMessage());
    //         return false; // Email sending failed.
    //     }
    // }

    // /**
    //  * Handle the email sending request.
    //  *
    //  * @param Params $params
    //  * @return Response
    //  */
    // public function handleRequest(Params $params)
    // {
    //     // Extract parameters from the request.
    //     $to = $params->fromQuery('to');
    //     $from = $params->fromQuery('from');
    //     $subject = $params->fromQuery('subject');
    //     $body = $params->fromQuery('body');
    //     $doi = $params->fromQuery('doi');
    //     $title = $params->fromQuery('title');
    //     $container_title = $params->fromQuery('containerTitle');
    //     $issn = $params->fromQuery('issn');
    //     $publisher = $params->fromQuery('publisher');
    //     $format = $params->fromQuery('format');
    //     $jid = $params->fromQuery('jid');
    //     $docId = $params->fromQuery('docId');
    //     $reqName = $params->fromQuery('reqName');
    //     $reqEmail = $params->fromQuery('reqEmail');
    //     $reqContact = $params->fromQuery('reqContact');
    //     $reqId = $params->fromQuery('reqId');
    //     $tomemid = $params->fromQuery('tomemid');
    //     $userMemId = $params->fromQuery('userMemId');
    //     $volume = $params->fromQuery('volume');
    //     $issue = $params->fromQuery('issue');
    //     $year = $params->fromQuery('year');

    //     // Call the sendEmail method.
    //     $emailSent = $this->sendEmail(
    //         $to,
    //         $from,
    //         $subject,
    //         $body,
    //         $doi,
    //         $title,
    //         $container_title,
    //         $issn,
    //         $publisher,
    //         $format,
    //         $jid,
    //         $docId,
    //         $reqContact,
    //         $reqEmail,
    //         $reqId,
    //         $reqName,
    //         $tomemid,
    //         $userMemId,
    //         $volume,
    //         $issue,
    //         $year
    //     );

    //     // Return a response based on the email sending result.
    //     if ($emailSent) {
    //         return $this->formatResponse(['message' => 'Email sent successfully']);
    //     } else {
    //         return $this->formatResponse(['message' => 'Failed to send email'], 500); // HTTP 500 for internal server error.
    //     }
    // }



    public  function sendEmail($to,$from,$subject,$body,$doi,$title,$container_title,$issn,$publisher,$format,$jid,$docId,$reqContact,$reqEmail,$reqId,$reqName,$tomemid,$userMemId,$volume,$issue,$year,$author)
    {
        $a = new SolrDefault();
        $mailSent = $a->senEmailApiCall($to,$from,$subject,$body,$doi,$title,$container_title,$issn,$publisher,$format,$jid,$docId,$reqContact,$reqEmail,$reqId,$reqName,$tomemid,$userMemId,$volume,$issue,$year,$author);
        return $mailSent;
    }

    public function handleRequest(Params $params)
    {
        $to = $params->fromQuery('to');
        $from = $params->fromQuery('from');
        $subject = $params->fromQuery('subject');
        $body = $params->fromQuery('body');
        $doi = $params->fromQuery('doi');
        $title = $params->fromQuery('title');
        $container_title = $params->fromQuery('containerTitle');
        $issn = $params->fromQuery('issn');
        $publisher = $params->fromQuery('publisher');
        $format = $params->fromQuery('format');
        $jid = $params->fromQuery('jid');
        $docId = $params->fromQuery('docId');
        $reqName = $params->fromQuery('reqName');
        $reqEmail = $params->fromQuery('reqEmail');
        $reqContact = $params->fromQuery('reqContact');
        $reqId = $params->fromQuery('reqId');
        $tomemid = $params->fromQuery('tomemid');
        $userMemId = $params->fromQuery('userMemId');
        $volume = $params->fromQuery('volume');
        $issue = $params->fromQuery('issue');
        $year = $params->fromQuery('year');
        $author = $params->fromQuery('author');
        // $cc = $params->fromQuery('cc');
        // $replyTo = $params->fromQuery('replyTo');
        // senEmailApiCall($to,$from,$subject,$body,$doi,$title,$container_title,$container_volume,$container_issue,$issn,$publisher);
        $data = $this-> sendEmail($to,$from,$subject,$body,$doi,$title,$container_title,$issn,$publisher,$format,$jid,$docId,$reqContact,$reqEmail,$reqId,$reqName,$tomemid,$userMemId,$volume,$issue,$year,$author);
        return $this->formatResponse($data);
    }
}

