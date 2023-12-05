<?php

namespace Inflibnet\AjaxHandler;
use Laminas\Mvc\Controller\Plugin\Params;
use VuFind\AjaxHandler\AbstractBase;
use Inflibnet\RecordDriver\SolrDefault;

class FetchINFMemberDetailsByJournalID extends AbstractBase
{
    public function getMemberEmailAccessible($jid, $toMemId, $fromMemId)
    {
        // Instantiate SolrDefault or use dependency injection if applicable.
        $solrDefault = new SolrDefault();
        
        // Call the getMemberEmail method to retrieve the member's email.
        $memEmail = $solrDefault->getMemberEmail($jid, $toMemId, $fromMemId);
        
        return $memEmail;
    }

    public function handleRequest(Params $params)
    {
        // Retrieve 'jid', 'tomemid', and 'frommemid' parameters from the request.
        $jid = $params->fromQuery('jid');
        $toMemId = $params->fromQuery('tomemid');
        $fromMemId = $params->fromQuery('frommemid');
        
        // Get the member's email based on the parameters.
        $data = $this->getMemberEmailAccessible($jid, $toMemId, $fromMemId);
        
        // Format the response using the formatResponse method (assuming it exists).
        return $this->formatResponse($data);
    }
}

