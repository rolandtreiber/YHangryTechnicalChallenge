<?php

namespace App\Http\Controllers;

use App\Service\CuisineService;

class CuisineController extends Controller
{
    private CuisineService $cuisineService;

    public function __construct(CuisineService $cuisineService)
    {
        $this->cuisineService = $cuisineService;
    }

    public function index()
    {
        return $this->cuisineService->getAllCuisines();
    }
}
