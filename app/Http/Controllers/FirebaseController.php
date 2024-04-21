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
        // Fetch data from Firebase
        $client = new Client();
        $url = env('FIREBASE_API_URL', '') . '/.json';

        try {
            $response = $client->get($url);
            $newData = json_decode($response->getBody(), true);

            // Check if the new data is available
            if ($dataType === 'tugas-akhir' && isset($newData['TugasAkhir']['SetData'])) {
                $newDataSet = $newData['TugasAkhir']['SetData'];
            } elseif ($dataType === 'rumah-jamur' && isset($newData['RumahJamur']['SetData'])) {
                $newDataSet = $newData['RumahJamur']['SetData'];
            } else {
                return response()->json(['error' => 'Data not found'], 500);
            }

            // Extract only 'avgh' and 'avgt' from the new data
            $extractedData = [
                'avgh' => $newDataSet['avgh'],
                'avgt' => $newDataSet['avgt']
            ];

            // Fetch previously stored data from storage
            $fileName = $dataType . '.json';
            $storedData = Storage::exists($fileName) ? json_decode(Storage::get($fileName), true) : [];

            // Get the highest ID from the stored data
            $maxId = count($storedData) > 0 ? max(array_keys($storedData)) : 0;

            // Increment the ID for the new data
            $newId = $maxId + 1;

            // Add the new data with the incremented ID
            $storedData[$newId] = $extractedData;

            // Store the updated data back into storage
            Storage::put($fileName, json_encode($storedData));

            return response()->json($storedData);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch data from Firebase'], 500);
        }
    }

    // Dashboard
    public function showDashboard($dataType)
    {
        // Set the dashboard type in the session
        session(['dashboardType' => $dataType]);

        $client = new Client();
        $url = env('FIREBASE_API_URL', '') . '/.json';

        try {
            $response = $client->get($url);
            $data = json_decode($response->getBody(), true);

            // Check if the selected data type exists and has the expected structure
            if ($dataType === 'tugas-akhir' && isset($data['TugasAkhir']['SetData'])) {
                // Access all data within TugasAkhir
                $tugasAkhirData = $data['TugasAkhir']['SetData'];

                // Pass the TugasAkhir data to the view
                return view('dashboard.dashboard', compact('tugasAkhirData'));
            } elseif ($dataType === 'rumah-jamur' && isset($data['RumahJamur']['SetData'])) {
                // Access all data within RumahJamur
                $rumahJamurData = $data['RumahJamur']['SetData'];

                // Pass the RumahJamur data to the view
                return view('dashboard.dashboard', compact('rumahJamurData'));
            } else {
                // Handle case where data is not found
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
        // Set the dashboard type in the session
        session(['dashboardType' => 'tugas-akhir']);

        $client = new Client();
        $url = env('FIREBASE_API_URL', '') . '/.json';

        try {
            $response = $client->get($url);
            $data = json_decode($response->getBody(), true);

            // Check if TugasAkhir data exists and has the expected structure
            if (isset($data['TugasAkhir']['SetData'])) {
                // Access all data within TugasAkhir
                $tugasAkhirData = $data['TugasAkhir']['SetData'];

                // Pass the TugasAkhir data to the view
                return view('dashboard.dashboard', compact('tugasAkhirData'));
            } else {
                // Handle case where TugasAkhir data is not found
                return response()->json(['error' => 'TugasAkhir data not found'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch data from Firebase'], 500);
        }
    }
    // Rumah Jamur DB
    public function showRumahJamurDashboard()
    {
        // Set the dashboard type in the session
        session(['dashboardType' => 'rumah-jamur']);

        $client = new Client();
        $url = env('FIREBASE_API_URL', '') . '/.json';

        try {
            $response = $client->get($url);
            $data = json_decode($response->getBody(), true);

            // Check if RumahJamur data exists and has the expected structure
            if (isset($data['RumahJamur']['SetData'])) {
                // Access all data within RumahJamur
                $rumahJamurData = $data['RumahJamur']['SetData'];

                // Pass the RumahJamur data to the view
                return view('dashboard.dashboard', compact('rumahJamurData'));
            } else {
                // Handle case where RumahJamur data is not found
                return response()->json(['error' => 'RumahJamur data not found'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch data from Firebase'], 500);
        }
    }

    public function showHistory(Request $request, $dataType)
    {
        try {
            // Determine the file name based on the data type
            $fileName = $dataType . '.json';

            // Fetch historical data from storage
            $storedData = Storage::exists($fileName) ? json_decode(Storage::get($fileName), true) : [];

            // Pass the historical data to the view
            return view('history.history', compact('storedData', 'dataType'));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch historical data'], 500);
        }
    }


    // public function index()
    // {
    //     $rumahJamurData = $this->getDataFromJson('rumah-jamur.json');
    //     $tugasAkhirData = $this->getDataFromJson('tugas-akhir.json');

    //     return view('dashboard', compact('rumahJamurData', 'tugasAkhirData'));
    // }

    // private function getDataFromJson($fileName)
    // {
    //     $json = Storage::disk('local')->get($fileName);
    //     return json_decode($json, true);
    // }
}
