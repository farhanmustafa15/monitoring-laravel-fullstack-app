<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Storage;

class FirebaseController extends Controller
{

    // API JSON
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

    // Dashboard
    public function showDashboard($dataType)
    {
        session(['dashboardType' => $dataType]);

        $client = new Client();
        $url = env('FIREBASE_API_URL', '') . '/.json';

        try {
            $response = $client->get($url);
            $data = json_decode($response->getBody(), true);

            if ($dataType === 'tugas-akhir' && isset($data['TugasAkhir']['SetData'])) {
                $tugasAkhirData = $data['TugasAkhir']['SetData'];

                return view('dashboard.dashboard', compact('tugasAkhirData'));
            } elseif ($dataType === 'rumah-jamur' && isset($data['RumahJamur']['SetData'])) {
                $rumahJamurData = $data['RumahJamur']['SetData'];

                return view('dashboard.dashboard', compact('rumahJamurData'));
            } else {
                return response()->json(['error' => 'Data not found'], 500);
            }
            if ($dataType === 'tugas-akhir' && isset($data['TugasAkhir']['SetData'])) {
                $tugasAkhirData = $data['TugasAkhir']['SetData'];
                return response()->json($tugasAkhirData);
            } elseif ($dataType === 'rumah-jamur' && isset($data['RumahJamur']['SetData'])) {
                $rumahJamurData = $data['RumahJamur']['SetData'];
                return response()->json($rumahJamurData);
            } else {
                return response()->json(['error' => 'Data not found'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch data from Firebase'], 500);
        }
    }

    // Tugas Akhir DB
    public function showTugasAkhirDashboard()
    {
        session(['dashboardType' => 'tugas-akhir']);

        $client = new Client();
        $url = env('FIREBASE_API_URL', '') . '/.json';

        try {
            $response = $client->get($url);
            $data = json_decode($response->getBody(), true);

            if (isset($data['TugasAkhir']['SetData'])) {
                $tugasAkhirData = $data['TugasAkhir']['SetData'];

                return view('dashboard.dashboard', compact('tugasAkhirData'));
            } else {
                return response()->json(['error' => 'TugasAkhir data not found'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch data from Firebase'], 500);
        }
    }

    // Rumah Jamur DB
    public function showRumahJamurDashboard()
    {
        session(['dashboardType' => 'rumah-jamur']);

        $client = new Client();
        $url = env('FIREBASE_API_URL', '') . '/.json';

        try {
            $response = $client->get($url);
            $data = json_decode($response->getBody(), true);

            if (isset($data['RumahJamur']['SetData'])) {
                $rumahJamurData = $data['RumahJamur']['SetData'];

                return view('dashboard.dashboard', compact('rumahJamurData'));
            } else {
                return response()->json(['error' => 'RumahJamur data not found'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch data from Firebase'], 500);
        }
    }

    // History
    public function showHistory($collection)
    {
        try {
            $fileName = $collection . '.json';
            $filePath = storage_path('app/' . $fileName);

            if (!file_exists($filePath)) {
                return response()->json(['error' => 'File not found'], 500);
            }

            $jsonString = file_get_contents($filePath);
            $data = json_decode($jsonString, true);

            $avghData = [];
            $avgtData = [];

            // Get the 100 latest data points
            $data = array_slice($data, -100, 100, true);

            foreach ($data as $key => $value) {
                if (isset($value['avgh']) && isset($value['avgt'])) {
                    $avghData[$key] = $value['avgh'];
                    $avgtData[$key] = $value['avgt'];
                }
            }

            return view('history.history', compact('avghData', 'avgtData'));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch data from JSON file'], 500);
        }
    }

}
