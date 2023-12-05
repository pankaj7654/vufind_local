<?php

namespace Inflibnet\AjaxHandler;
use Laminas\Mvc\Controller\Plugin\Params;
use VuFind\AjaxHandler\AbstractBase;
use Inflibnet\View\Helper\Root\Record;
// use Inflibnet\RecordDriver\SolrDefault;

class SetDDRAvailableBtnByJquery extends AbstractBase
{
    public function DDRFunction()
    {      
        // return "pppppppppppppppppp";  
        try{
            $dataobj = new Record();
            $responsedata = $dataobj->fetchjournalId();
            print_r($responsedata);
            // return "pppppppppppppppppp";
            return $responsedata;
        } 
        
        catch(\Exception $e){
            return $e;
        }
  
    }

    
    public function handleRequest(Params $params)
    {
        // $jid = $params->fromQuery('jid');
        // $memId = $params->fromQuery('memid');
        $data = $this->DDRFunction();
        return $this->formatResponse($data);
    }
}