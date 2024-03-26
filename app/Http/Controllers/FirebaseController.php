<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class FirebaseController extends Controller
{
    public function showDashboard($dataType)
    {
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

    public function showTugasAkhirDashboard()
    {
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

    public function showRumahJamurDashboard()
    {
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
}
