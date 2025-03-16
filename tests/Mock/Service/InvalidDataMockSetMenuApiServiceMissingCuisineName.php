<?php

namespace Tests\Mock\Service;

class InvalidDataMockSetMenuApiServiceMissingCuisineName extends BaseMockSetMenuApiService
{
    public function __construct()
    {
        $this->file = "tests/Mock/Static/mockSetMenusInvalidDataMissingCuisineName.json";
    }

}
