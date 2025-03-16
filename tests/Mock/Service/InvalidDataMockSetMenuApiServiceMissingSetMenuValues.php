<?php

namespace Tests\Mock\Service;

class InvalidDataMockSetMenuApiServiceMissingSetMenuValues extends BaseMockSetMenuApiService
{

    public function __construct()
    {
        $this->file = "tests/Mock/Static/mockSetMenusInvalidDataMissingSetMenuValues.json";
    }

}
