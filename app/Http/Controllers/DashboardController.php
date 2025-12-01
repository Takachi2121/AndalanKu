<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use App\Models\Produk;
use App\Models\Testimoni;
use Google\Analytics\Data\V1beta\BetaAnalyticsDataClient;
use Google\Analytics\Data\V1beta\DateRange;
use Google\Analytics\Data\V1beta\Dimension;
use Google\Analytics\Data\V1beta\Metric;
use Illuminate\Routing\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $active = "dashboard";
        $title = "Dashboard";

        $totalProduk = Produk::count();
        $totalGaleri = Galeri::count();
        $totalTestimoni = Testimoni::count();

        $client = new BetaAnalyticsDataClient([
            'credentials' => storage_path('app/andalanku-473303-9cf243226bc7.json'),
        ]);

        $property_id = '506579980';

        $response = $client->runReport([
            'property' => 'properties/' . $property_id,
            'dateRanges' => [
                new DateRange(['start_date' => '7daysAgo', 'end_date' => 'today']),
            ],
            'dimensions' => [
                new Dimension(['name' => 'date']),
            ],
            'metrics' => [
                new Metric(['name' => 'activeUsers']),
            ],
        ]);

        $labels = [];
        $data = [];
        foreach ($response->getRows() as $row) {
            $labels[] = $row->getDimensionValues()[0]->getValue();
            $data[] = (int) $row->getMetricValues()[0]->getValue();
        }

        return view('admin.management.dashboard', compact('labels', 'active', 'data', 'title', 'totalProduk', 'totalGaleri', 'totalTestimoni'));
    }
}
