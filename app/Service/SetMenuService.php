<?php

namespace App\Service;

interface SetMenuService
{
    public function getPaginatedResults($slug, $page);
}
