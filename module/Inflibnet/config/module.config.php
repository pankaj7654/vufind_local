<?php

return array (
  'vufind' => 
  array (
    'plugin_managers' => 
    array (
      'ajaxhandler' => 
      array (
        'factories' => 
        array (
          'Inflibnet\\AjaxHandler\\FetchINFMemberNameByIP' => 'Inflibnet\\AjaxHandler\\FetchINFMemberNameByIPFactory',
          'Inflibnet\\AjaxHandler\\FetchINFMemberCountByJournalID' => 'Inflibnet\\AjaxHandler\\FetchINFMemberCountByJournalIDFactory',
          'Inflibnet\\AjaxHandler\\FetchINFMemberDetailsByJournalID' => 'Inflibnet\\AjaxHandler\\FetchINFMemberDetailsByJournalIDFactory',
          'Inflibnet\\AjaxHandler\\INFMailerByAPI' => 'Inflibnet\\AjaxHandler\\INFMailerByAPIFactory',
          'Inflibnet\\AjaxHandler\\SetDDRAvailableBtnByJquery' => 'Inflibnet\\AjaxHandler\\SetDDRAvailableBtnByJqueryFactory',
          'Inflibnet\\AjaxHandler\\SaveUserDetails' => 'Inflibnet\\AjaxHandler\\SaveUserDetailsFactory',
          'Inflibnet\\AjaxHandler\\HomeJournalDetailShow' => 'Inflibnet\\AjaxHandler\\HomeJournalDetailShowFactory',
        ),
        'aliases' => 
        array (
          'fetchinfmembernamebyip' => 'Inflibnet\\AjaxHandler\\FetchINFMemberNameByIP',
          'fetchinfmembercountbyjournalid' => 'Inflibnet\\AjaxHandler\\FetchINFMemberCountByJournalID',
          'fetchinfmemberdetailsbyjournalid' => 'Inflibnet\\AjaxHandler\\FetchINFMemberDetailsByJournalID',
          'infmailerbyapi' => 'Inflibnet\\AjaxHandler\\INFMailerByAPI',
          'setddravailablebtnbyjquery' => 'Inflibnet\\AjaxHandler\\SetDDRAvailableBtnByJquery',
          'saveuserdetails' => 'Inflibnet\\AjaxHandler\\SaveUserDetails',
          'homejournaldetailshow' => 'Inflibnet\\AjaxHandler\\HomeJournalDetailShow',
        ),
      ),
      'recorddriver' => 
      array (
        'factories' => 
        array (
          'Inflibnet\\RecordDriver\\SolrDefault' => 'Inflibnet\\RecordDriver\\SolrDefaultFactory',
        ),
        'aliases' => 
        array (
          'VuFind\\RecordDriver\\SolrDefault' => 'Inflibnet\\RecordDriver\\SolrDefault',
        ),
      ),
      'recommend' => 
      array (
        'factories' => 
        array (
          'Inflibnet\\Recommend\\SideFacets' => 'Inflibnet\\Recommend\\SideFacetsFactory',
        ),
        'aliases' => 
        array (
          'VuFind\\Recommend\\SideFacets' => 'Inflibnet\\Recommend\\SideFacets',
        ),
      ),
      'auth' => 
      array (
        'factories' => 
        array (
          'Inflibnet\\Auth\\Shibboleth' => 'Inflibnet\\Auth\\ShibbolethFactory',
        ),
        'aliases' => 
        array (
          'VuFind\\Auth\\Shibboleth' => 'Inflibnet\\Auth\\Shibboleth',
        ),
      ),
    ),
  ),
  'plugin_managers' => 
  array (
  ),
  'service_manager' => 
  array (
    'factories' => 
    array (
      'Inflibnet\\View\\Helper\\Root\\Record' => 'Inflibnet\\View\\Helper\\Root\\RecordFactory',
      'Inflibnet\\AjaxHandler\\SetDDRbtn' => 'Inflibnet\\AjaxHandler\\SetDDRbtnFactory',
    ),
    'aliases' => 
    array (
      'record' => 'Inflibnet\\View\\Helper\\Root\\Record',
      'setddrbtn' => 'Inflibnet\\AjaxHandler\\SetDDRbtn',
    ),
  ),
  'controllers' => 
  array (
    'factories' => 
    array (
      'Inflibnet\\Controller\\MyResearchController' => 'Inflibnet\\Controller\\AbstractBaseFactory',
    ),
    'aliases' => 
    array (
      'VuFind\\Controller\\MyResearchController' => 'Inflibnet\\Controller\\MyResearchController',
    ),
  ),
  'router' => 
  array (
    'routes' => 
    array (
      'updateUserDetails' => 
      array (
        'type' => 'Laminas\\Router\\Http\\Segment',
        'options' => 
        array (
          'route' => '/MyResearch/updateUserDetails/[:id]',
          'constraints' => 
          array (
            'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
            'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
          ),
          'defaults' => 
          array (
            'controller' => 'Inflibnet\\Controller\\MyResearchController',
            'action' => 'updateUserDetails',
          ),
        ),
      ),
    ),
  ),
);