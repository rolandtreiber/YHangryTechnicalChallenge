<?php

namespace App\Http\Controllers;

use App\Http\Service\CuisineService;
use Illuminate\Http\Request;

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
