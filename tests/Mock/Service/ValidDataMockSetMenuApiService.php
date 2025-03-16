<?php

namespace Tests\Mock\Service;

class ValidDataMockSetMenuApiService extends BaseMockSetMenuApiService
{
    public function __construct()
    {
        $this->file = "tests/Mock/Static/mockSetMenusValidData.json";
    }
}
