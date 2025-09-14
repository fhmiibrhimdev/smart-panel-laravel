<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Current;
use App\Models\Irradiance;
use App\Models\Power;
use App\Models\Temperature;
use App\Models\Voltage;
use Illuminate\Http\Request;

class SolarPanelController extends Controller
{

    public function store(Request $request)
    {
        $data = $request->all();

        // Save Temperature data if exists
        if (isset($data['temp'])) {
            $tempData = [
                'temp_a'  => $data['temp']['a'] ?? null,
                'temp_bc' => $data['temp']['bc'] ?? null,
                'temp_bh' => $data['temp']['bh'] ?? null,
                'temp_c'  => $data['temp']['c'] ?? null,
                'temp_dh' => $data['temp']['dh'] ?? null,
                'temp_dc' => $data['temp']['dc'] ?? null,
                'temp_fc' => $data['temp']['fc'] ?? null,
                'temp_fh' => $data['temp']['fh'] ?? null,
                'temp_g'  => $data['temp']['g'] ?? null,
                'temp_hh' => $data['temp']['hh'] ?? null,
                'temp_hc' => $data['temp']['hc'] ?? null,
                'temp_i'  => $data['temp']['i'] ?? null,
                'timestamp' => $data['timestamp'] ?? now(),
            ];
            Temperature::create($tempData);
        }

        // Save Voltage data if exists
        if (isset($data['voltage'])) {
            $voltageData = [
                'volt_a'  => $data['voltage']['a'] ?? null,
                'volt_bc' => $data['voltage']['bc'] ?? null,
                'volt_bh' => $data['voltage']['bh'] ?? null,
                'volt_c'  => $data['voltage']['c'] ?? null,
                'volt_dh' => $data['voltage']['dh'] ?? null,
                'volt_dc' => $data['voltage']['dc'] ?? null,
                'volt_fc' => $data['voltage']['fc'] ?? null,
                'volt_fh' => $data['voltage']['fh'] ?? null,
                'volt_g'  => $data['voltage']['g'] ?? null,
                'volt_hh' => $data['voltage']['hh'] ?? null,
                'volt_hc' => $data['voltage']['hc'] ?? null,
                'volt_i'  => $data['voltage']['i'] ?? null,
                'timestamp' => $data['timestamp'] ?? now(),
            ];
            Voltage::create($voltageData);
        }

        // Save Current data if exists
        if (isset($data['current'])) {
            $currentData = [
                'curr_a'  => $data['current']['a'] ?? null,
                'curr_bc' => $data['current']['bc'] ?? null,
                'curr_bh' => $data['current']['bh'] ?? null,
                'curr_c'  => $data['current']['c'] ?? null,
                'curr_dh' => $data['current']['dh'] ?? null,
                'curr_dc' => $data['current']['dc'] ?? null,
                'curr_fc' => $data['current']['fc'] ?? null,
                'curr_fh' => $data['current']['fh'] ?? null,
                'curr_g'  => $data['current']['g'] ?? null,
                'curr_hh' => $data['current']['hh'] ?? null,
                'curr_hc' => $data['current']['hc'] ?? null,
                'curr_i'  => $data['current']['i'] ?? null,
                'timestamp' => $data['timestamp'] ?? now(),
            ];
            Current::create($currentData);
        }

        return response()->json(['success' => true], 201);
    }

    public function storeTemp(Request $request)
    {
        $data = $request->all();
        $entry = Temperature::create($data);

        return response()->json(['success' => true, 'data' => $entry], 201);
    }

    public function storeVoltage(Request $request)
    {
        $data = $request->all();
        $entry = Voltage::create($data);

        return response()->json(['success' => true, 'data' => $entry], 201);
    }

    public function storeCurrent(Request $request)
    {
        $data = $request->all();
        $entry = Current::create($data);

        return response()->json(['success' => true, 'data' => $entry], 201);
    }

    public function storeIrradiance(Request $request)
    {
        $data = $request->all();
        $entry = Irradiance::create($data);

        return response()->json(['success' => true, 'data' => $entry], 201);
    }
}
