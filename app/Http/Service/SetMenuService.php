<?php

namespace App\Http\Service;

interface SetMenuService
{
    public function getPaginatedResults($slug, $page);
}
