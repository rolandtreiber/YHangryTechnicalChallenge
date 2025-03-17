<?php

namespace App\Service;

use Illuminate\Support\Collection;

interface ApiDataHandlerService
{
    public function retrieveData(?int $page): array;
    public function retrieveNextPage(): array;
    public function extractData(array $data): Collection;
    public function persistData(Collection $setMenus): void;
    public function setActivePage(int $page): void;
    public function getActivePage(): int;
}
