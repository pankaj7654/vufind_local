<?php

namespace Inflibnet\Recommend;

class SideFacets extends \VuFind\Recommend\SideFacets
{
    // public function getFacetSet()
    // {
    //     $facetSet = $this->results->getFacetList($this->mainFacets);

    //     foreach ($this->hierarchicalFacets as $hierarchicalFacet) {
    //         if (isset($facetSet[$hierarchicalFacet])) {
    //             if (!$this->hierarchicalFacetHelper) {
    //                 throw new \Exception(
    //                     get_class($this) . ': hierarchical facet helper unavailable'
    //                 );
    //             }

    //             $facetArray = $this->hierarchicalFacetHelper->buildFacetArray(
    //                 $hierarchicalFacet,
    //                 $facetSet[$hierarchicalFacet]['list']
    //             );
    //             $facetSet[$hierarchicalFacet]['list'] = $this
    //                 ->hierarchicalFacetHelper
    //                 ->flattenFacetHierarchy($facetArray);
    //         }
    //     }


    //     // $indexUni = -1;
    //     foreach ($facetSet as $item){
    //         // if ($item['label'] == 'Openaccess'){
    //             $reqList = $item['list'];
    //             $indexUni = array_search($item,$facetSet);
    //             // $i=1;
    //             foreach($reqList as $req){
    //                 $itemIndex = array_search($req,$reqList);
    //                 $config = $this->configLoader->get('openaccess');
    //                 $facetSet[$indexUni]['list'][$itemIndex]['displayText']=$config['Openaccess'][$facetSet[$indexUni]['list'][$itemIndex]['value']];
    //                 // print_r($itemIndex);
    //                 // $i++;
    //                 // print_r($facetSet[$indexUni]['list'][$itemIndex]);
    //             }
    //         // }
    //     }
    //     // print_r($facetSet);
    //     return $facetSet;
    // }
}

