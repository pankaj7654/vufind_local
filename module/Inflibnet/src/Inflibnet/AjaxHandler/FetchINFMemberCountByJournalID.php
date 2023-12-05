<?php

namespace Inflibnet\AjaxHandler;
use Laminas\Mvc\Controller\Plugin\Params;
use VuFind\AjaxHandler\AbstractBase;
use Inflibnet\RecordDriver\SolrDefault;

class FetchINFMemberCountByJournalID extends AbstractBase
{
    public function getMemberDetailsFromJournalIdAccessible($jid, $memId)
    {
        // Instantiate SolrDefault or use dependency injection if applicable.
        $solrDefault = new SolrDefault();
        
        // Call the getMemberDetailsFromJournalId method and retrieve member details.
        $memDetails = $solrDefault->getMemberDetailsFromJournalId($jid, $memId);
        
        return $memDetails;
    }

    public function handleRequest(Params $params)
    {
        // Retrieve 'jid' and 'memid' parameters from the request.
        $jid = $params->fromQuery('jid');
        $memId = $params->fromQuery('memid');
        
        // Get member details based on 'jid' and 'memid'.
        $data = $this->getMemberDetailsFromJournalIdAccessible($jid, $memId);
        
        // Format the response using the formatResponse method (assuming it exists).
        return $this->formatResponse($data);
    }
}

