<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;

class TemperatureExportController extends Controller
{
    public function export(Request $request): StreamedResponse
    {
        // Ambil query string ?start=YYYY-MM-DDTHH:MM&end=...
        $start = $request->query('start'); // "YYYY-MM-DDTHH:MM"
        $end   = $request->query('end');

        // normalisasi ke "YYYY-MM-DD HH:MM:SS"
        $norm = function (?string $v) {
            if (!$v) return null;
            if (strlen($v) === 16) $v .= ':00';
            return str_replace('T', ' ', $v);
        };
        $start = $norm($start);
        $end   = $norm($end);

        if ($start && $end && $end < $start) {
            [$start, $end] = [$end, $start];
        }

        $filename = 'temperatures_' . now('Asia/Jakarta')->format('Ymd_His') . '.csv';

        return response()->streamDownload(function () use ($start, $end) {
            if (function_exists('ob_get_level')) {
                while (ob_get_level() > 0) ob_end_clean();
            }
            $out = fopen('php://output', 'w');

            // header
            fputcsv($out, [
                'timestamps',
                'temp_a',
                'temp_bc',
                'temp_bh',
                'temp_c',
                'temp_dh',
                'temp_dc',
                'temp_fc',
                'temp_fh',
                'temp_g',
                'temp_hh',
                'temp_hc',
                'temp_i',
            ]);

            // Sesuaikan tzFrom/To: jika data disimpan UTC, gunakan '+00:00' -> '+07:00'
            $tzFrom = '+00:00';
            $tzTo   = '+07:00';

            $q = DB::table('temperatures')->selectRaw("
                DATE_FORMAT(CONVERT_TZ(created_at, '{$tzFrom}', '{$tzTo}'), '%Y-%m-%d %H:%i:%s') as timestamps,
                temp_a, temp_bc, temp_bh, temp_c,
                temp_dh, temp_dc, temp_fc, temp_fh,
                temp_g, temp_hh, temp_hc, temp_i
            ")->orderBy('created_at');

            if ($start && $end) {
                $q->whereBetween('created_at', [$start, $end]);
            }

            $q->cursor()->each(function ($r) use ($out) {
                fputcsv($out, [
                    $r->timestamps,
                    $r->temp_a,
                    $r->temp_bc,
                    $r->temp_bh,
                    $r->temp_c,
                    $r->temp_dh,
                    $r->temp_dc,
                    $r->temp_fc,
                    $r->temp_fh,
                    $r->temp_g,
                    $r->temp_hh,
                    $r->temp_hc,
                    $r->temp_i,
                ]);
            });

            fflush($out);
            fclose($out);
        }, $filename, [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename={$filename}",
            'Cache-Control'       => 'no-store, no-cache, must-revalidate, max-age=0',
        ]);
    }
}
