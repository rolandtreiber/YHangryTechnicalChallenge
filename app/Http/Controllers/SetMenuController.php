<?php

namespace App\Http\Controllers;

use App\Http\Requests\SetMenusIndexRequest;
use App\Http\Resources\SetMenusIndexResource;
use App\Http\Service\SetMenuService;

class SetMenuController extends Controller
{
    private SetMenuService $setMenuService;

    public function __construct(SetMenuService $setMenuService)
    {
        $this->setMenuService = $setMenuService;
    }

    public function index(SetMenusIndexRequest $request, string $cuisineSlug = null)
    {
        return SetMenusIndexResource::collection($this->setMenuService->getPaginatedResults($cuisineSlug, $request->page));
    }
}
