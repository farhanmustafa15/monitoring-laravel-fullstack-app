<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class FirebaseController extends Controller
{
    public function getData($dataType)
    {
        $client = new Client();
        $url = env('FIREBASE_API_URL', '') . '/.json';

        try {
            $response = $client->get($url);
            $newData = json_decode($response->getBody(), true);

            if ($dataType === 'tugas-akhir' && isset($newData['TugasAkhir']['SetData'])) {
                $newDataSet = $newData['TugasAkhir']['SetData'];
            } elseif ($dataType === 'rumah-jamur' && isset($newData['RumahJamur']['SetData'])) {
                $newDataSet = $newData['RumahJamur']['SetData'];
            } else {
                return response()->json(['error' => 'Data not found'], 500);
            }

            $extractedData = [
                'avgh' => $newDataSet['avgh'],
                'avgt' => $newDataSet['avgt']
            ];

            $fileName = $dataType . '.json';
            $storedData = Storage::exists($fileName) ? json_decode(Storage::get($fileName), true) : [];

            $maxId = count($storedData) > 0 ? max(array_keys($storedData)) : 0;
            $newId = $maxId + 1;
            $storedData[$newId] = $extractedData;

            Storage::put($fileName, json_encode($storedData));

            return response()->json($storedData);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch data from Firebase'], 500);
        }
    }

    public function showDashboard($dataType)
    {
        try {
            $fileName = $dataType . '.json';
            $storedData = Storage::exists($fileName) ? json_decode(Storage::get($fileName), true) : [];

            // Get the three latest entries
            $latestData = array_slice($storedData, -3, 3, true);

            // Save combined results to JSON file
            $resultFileName = $dataType . '_combined.json';
            Storage::put($resultFileName, json_encode($latestData));

            Log::info('Latest data:', $latestData);

            return view('dashboard.dashboard', compact('latestData', 'dataType'));
        } catch (\Exception $e) {
            Log::error('Failed to fetch data', ['exception' => $e]);
            return response()->json(['error' => 'Failed to fetch data'], 500);
        }
    }

    public function showHistory($dataType)
    {
        try {
            $fileName = $dataType . '.json';
            $storedData = Storage::exists($fileName) ? json_decode(Storage::get($fileName), true) : [];

            $avgtData = array_column($storedData, 'avgt');
            $avghData = array_column($storedData, 'avgh');

            return view('history.history', compact('avgtData', 'avghData', 'dataType'));
        } catch (\Exception $e) {
            Log::error('Failed to fetch historical data', ['exception' => $e]);
            return response()->json(['error' => 'Failed to fetch historical data'], 500);
        }
    }

    private function fuzzyLogic($temperature, $humidity)
    {
        $tempCategory = $this->categorizeTemperature($temperature);
        $humCategory = $this->categorizeHumidity($humidity);

        Log::info('Categorized values', ['temperature' => $temperature, 'tempCategory' => $tempCategory, 'humidity' => $humidity, 'humCategory' => $humCategory]);

        if ($tempCategory == 'Rendah' && $humCategory == 'Rendah') {
            return 'Rendah';
        } elseif ($tempCategory == 'Rendah' && $humCategory == 'Normal') {
            return 'Rendah';
        } elseif ($tempCategory == 'Rendah' && $humCategory == 'Tinggi') {
            return 'Rendah';
        } elseif ($tempCategory == 'Normal' && $humCategory == 'Rendah') {
            return 'Rendah';
        } elseif ($tempCategory == 'Normal' && $humCategory == 'Normal') {
            return 'Normal';
        } elseif ($tempCategory == 'Normal' && $humCategory == 'Tinggi') {
            return 'Tinggi';
        } elseif ($tempCategory == 'Tinggi' && $humCategory == 'Rendah') {
            return 'Tinggi';
        } elseif ($tempCategory == 'Tinggi' && $humCategory == 'Normal') {
            return 'Tinggi';
        } elseif ($tempCategory == 'Tinggi' && $humCategory == 'Tinggi') {
            return 'Tinggi';
        }

        return 'Unknown';
    }

    private function categorizeTemperature($temperature)
    {
        if ($temperature < 20) {
            return 'Rendah';
        } elseif ($temperature <= 30) {
            return 'Normal';
        } else {
            return 'Tinggi';
        }
    }

    private function categorizeHumidity($humidity)
    {
        if ($humidity < 40) {
            return 'Rendah';
        } elseif ($humidity <= 60) {
            return 'Normal';
        } else {
            return 'Tinggi';
        }
    }
}
