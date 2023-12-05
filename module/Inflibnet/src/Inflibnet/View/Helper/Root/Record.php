<?php

namespace Inflibnet\View\Helper\Root;
use VuFind\AjaxHandler\AbstractBase;

class Record extends \VuFind\View\Helper\Root\Record
{
    public function getDataForTable(array $tableData){

        $arr = [];
        $arr['label'] = 'Online access an article';
        $arr['context'] = [];
        $arr['pos'] = 1300;  
        $arr['value'] = $this->fetchjournalId();
        $tableData['demo'] = $arr;
        return $tableData;
    }


    /**
     * Get HTML to render a title.
     *
     * @param int $maxLength Maximum length of non-highlighted title.
     *
     * @return string
     */
   

    public function fetchjournalId(){
        $data = $this->driver->tryMethod('getJournalDetails');
        // print_r($data);
        return $data;
    }

    
    public function getTitleHtml($maxLength = 180)
    {

        $highlightedTitle = $this->driver->tryMethod('getHighlightedTitle');
        $title = trim($this->driver->tryMethod('getTitle'));

        $html = $title;
        $patterns = array(
            '/<italic>/i' => '<span style="font-style: italic !important;">',
            '/<\/italic>/i' => '</span>',
            '/<sc>/i' => '<span style="font-variant: small-caps !important;">',
            '/<\/sc>/i' => '</span>',
            '/<bold>/i' => '<span style="font-weight: bold !important;">',
            '/<\/bold>/i' => '</span>',
            
            '/<fixed-case>/i' => '<span style="text-transform: ; !important;">',
            '/<\/fixed-case>/i' => '</span>',

            '/<monospace>/i' => '<span style="font-family: monospace !important;">',
            '/<\/monospace>/i' => '</span>',

            '/<overline>/i' => '<span style="text-decoration: overline !important;">',
            '/<\/overline>/i' => '</span>',

            // '/<overline-start>/i' => '<span style="font-weight: bold !important;">',
            // '/<\/overline-start>/i' => '</span>',

            // '/<overline-end>/i' => '<span style="font-weight: bold !important;">',
            // '/<\/overline-end>/i' => '</span>',

            // '/<roman>/i' => '<span style="font-weight: bold !important;">',
            // '/<\/roman>/i' => '</span>',

            // '/<sans-serif>/i' => '<span style="font-weight: bold !important;">',
            // '/<\/sans-serif>/i' => '</span>',

            // '/<strike>/i' => '<span style="font-weight: bold !important;">',
            // '/<\/strike>/i' => '</span>',

            // '/<underline>/i' => '<span style="font-weight: bold !important;">',
            // '/<\/underline>/i' => '</span>',

            // '/<underline-start>/i' => '<span style="font-weight: bold !important;">',
            // '/<\/underline-start>/i' => '</span>',

            // '/<underline-end>/i' => '<span style="font-weight: bold !important;">',
            // '/<\/underline-end>/i' => '</span>',

            // '/<ruby>/i' => '<span style="font-weight: bold !important;">',
            // '/<\/ruby>/i' => '</span>',
        );
        $title = preg_replace(array_keys($patterns), array_values($patterns), $html);
        // echo $title;
        return $title;

        // $html = $title1;
        // $oldTag = 'italic';
        // $newTag = 'i';

        // $modifiedHtml = str_replace('<'.$oldTag.'>', '<'.$newTag.'>', $html);
        // $title = str_replace('</'.$oldTag.'>', '</'.$newTag.'>', $modifiedHtml);
        // // print_r($title);

        // print_r($this->driver->tryMethod('jounalId'));
        // $title = strip_tags($title);
        // // $highlightedTitle = strip_tags($highlightedTitle);
        
        // // // $str = preg_replace("~<italic>~", '<i>', $highlightedTitle);
        // // // $title = preg_replace("~</italic>~", '</i>', $str);
        // // // print_r($title);

        // // // $title = strip_tags($title1);

        // // // $title = strip_tags($title1,"<sc><italic>");
        

        // // if (!empty($highlightedTitle)) {
        // //     $highlight = $this->getView()->plugin('highlight');
        // //     $addEllipsis = $this->getView()->plugin('addEllipsis');
        // //     return $highlight($addEllipsis($highlightedTitle, $title));
        // // }
        // // if (!empty($title)) {
        // //     $escapeHtml = $this->getView()->plugin('escapeHtml');
        // //     $truncate = $this->getView()->plugin('truncate');
        // //     return $escapeHtml($truncate($title, $maxLength));
        // // }
        // // $transEsc = $this->getView()->plugin('transEsc');
        // return $transEsc('Title not available');
    }
}

