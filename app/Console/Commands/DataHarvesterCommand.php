<?php

namespace App\Console\Commands;

use App\Http\Service\ApiDataHandlerService;
use App\Http\Service\ApiDataHandlerServiceImpl;
use App\Http\Service\SetMenuApiService;
use App\Http\Service\SetMenuApiServiceImpl;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DataHarvesterCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:data-harvester';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    private ApiDataHandlerService $apiDataHandlerService;

    public function __construct(ApiDataHandlerService $apiDataHandlerService)
    {
        parent::__construct();
        $this->apiDataHandlerService = $apiDataHandlerService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->line("Fetching first page");
        $rawData = $this->apiDataHandlerService->retrieveData(1)['data'];
        sleep(2);
        do {
            $nextPage = $this->apiDataHandlerService->retrieveNextPage();
            $this->line("Fetching page: ".$this->apiDataHandlerService->getActivePage());
            $rawData = array_merge($rawData, $nextPage['data']);
            sleep(2);
        } while ($nextPage['links']['next']);
        $this->line("Extracting data...");
        $data = $this->apiDataHandlerService->extractData($rawData);
        $this->line("Extracting data successful.");
        $this->line("Persisting data...");
        $this->apiDataHandlerService->persistData($data);
        $this->line("Persisting data successful.");
        $this->line(DB::table('cuisines')->count(). " cuisines were saved into the database.");
        $this->line(DB::table('set_menus')->count(). " set menus were saved into the database.");
    }
}
