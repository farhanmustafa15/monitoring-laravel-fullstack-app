<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class FirebaseController extends Controller
{
    public function showDashboard()
    {
        $client = new Client();
        $url = 'https://finalproject-87a3e-default-rtdb.asia-southeast1.firebasedatabase.app/.json';

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
}
