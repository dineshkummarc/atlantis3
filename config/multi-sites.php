<?php

return [
   

    'site-1' => [
        'domain' => 'http://a3.dev.gentecsys.net',
        'name' => 'Site 1',        
        /*
         * Only one can be a master site
         */
        'master' => TRUE
    ],
    
    'site-2' => [
        'domain' => 'http://a3.angel.dev.gentecsys.net',
        'name' => 'Site 2',
        'master' => FALSE
    ]
   
];
