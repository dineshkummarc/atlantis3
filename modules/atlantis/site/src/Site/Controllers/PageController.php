<?php

namespace Site\Controllers;

use Atlantis\Controllers\PageController as BasePageController;

class PageController extends BasePageController
{

    public function __construct(\Atlantis\Models\Interfaces\IPageInterface $page, \Atlantis\Models\Interfaces\IPatternInterface $pattern)
    {

        parent::__construct($page, $pattern);
    }


}