<?php

namespace App\Livewire\Export;

use Carbon\Carbon;
use App\Models\Todo;
use App\Models\Current;
use App\Models\Voltage;
use Livewire\Component;
use App\Models\Temperature;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;

class Csv extends Component
{
    use WithPagination;
    #[Title('Export CSV - Smart Panel')]

    public string $start_date = ''; // bound ke <input type="datetime-local">
    public string $end_date   = ''; // bound ke <input type="datetime-local">

    protected $paginationTheme = 'bootstrap';

    public $lengthData = 25;
    public $searchTerm;
    public $previousSearchTerm = '';
    public $isEditing = false;

    public $filter_parameter = 'Temperature';

    public $dataId, $title;

    public function render()
    {
        $this->searchResetPage();
        $search = '%' . $this->searchTerm . '%';

        switch ($this->filter_parameter) {
            case 'Voltage':
                $table = 'voltages';
                break;
            case 'Current':
                $table = 'currents';
                break;
            default:
                $table = 'temperatures';
                break;
        }

        $data = DB::table($table)
            ->where('created_at', 'LIKE', $search)
            ->orderBy('id', 'DESC')
            ->paginate($this->lengthData);

        return view('livewire.export.csv', compact('data'));
    }

    public function updatingLengthData()
    {
        $this->resetPage();
    }

    private function searchResetPage()
    {
        if ($this->searchTerm !== $this->previousSearchTerm) {
            $this->resetPage();
        }

        $this->previousSearchTerm = $this->searchTerm;
    }

    public function mount(): void
    {
        // default hari ini (00:00:00 s/d 23:59:59)
        $this->refreshToday();
    }

    public function refreshToday(): void
    {
        $today = now()->timezone(config('app.timezone', 'Asia/Jakarta'))->format('Y-m-d');
        $this->start_date = $today . 'T00:00';
        $this->end_date   = $today . 'T23:59';
    }

    private function normalizeLocalDatetime(?string $value): Carbon
    {
        // input datetime-local: "YYYY-MM-DDTHH:MM" (tanpa detik)
        // tambahkan ":00" agar presisi detik, lalu parse sesuai timezone app
        $value = (string) $value;
        if ($value && strlen($value) === 16) {
            $value .= ':00'; // jadi "YYYY-MM-DDTHH:MM:SS"
        }
        // Ganti 'T' ke ' ' supaya enak diformat
        $value = str_replace('T', ' ', $value);

        return Carbon::parse($value, config('app.timezone', 'Asia/Jakarta'));
    }

    public function exportCSV(): StreamedResponse
    {
        $start = $this->normalizeLocalDatetime($this->start_date); // Asia/Jakarta
        $end   = $this->normalizeLocalDatetime($this->end_date);

        if ($end->lt($start)) {
            [$start, $end] = [$end, $start];
        }

        // Jika data disimpan UTC, ubah $start/$end ke UTC:
        // $startUtc = $start->clone()->setTimezone('UTC');
        // $endUtc   = $end->clone()->setTimezone('UTC');
        // Kalau disimpan WIB, pakai langsung $start/$end.

        $filename = 'temperatures_' . now('Asia/Jakarta')->format('Ymd_His') . '.csv';

        return response()->streamDownload(function () use ($start, $end) {
            // Hindari output buffering berlebihan
            if (function_exists('ob_get_level')) {
                while (ob_get_level() > 0) ob_end_clean();
            }
            $out = fopen('php://output', 'w');

            // Header CSV: alias created_at -> timestamps
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

            // Format waktu di SQL agar tidak pakai Carbon per baris
            // Jika kolom disimpan WIB, cukup DATE_FORMAT(created_at,...)
            // Jika disimpan UTC dan ingin ditampilkan WIB: CONVERT_TZ(created_at,'+00:00','+07:00')
            $tzFrom = '+00:00'; // ganti ke '+07:00' kalau data tersimpan WIB
            $tzTo   = '+07:00'; // tampilkan sebagai Asia/Jakarta

            DB::table('temperatures')
                ->selectRaw("
                DATE_FORMAT(CONVERT_TZ(created_at, '{$tzFrom}', '{$tzTo}'), '%Y-%m-%d %H:%i:%s') as timestamps,
                temp_a, temp_bc, temp_bh, temp_c,
                temp_dh, temp_dc, temp_fc, temp_fh,
                temp_g, temp_hh, temp_hc, temp_i
            ")
                ->whereBetween('created_at', [$start, $end]) // atau [$startUtc, $endUtc] jika simpan UTC
                ->orderBy('created_at')
                ->cursor() // stream row-by-row
                ->each(function ($r) use ($out) {
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
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename={$filename}",
            'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
        ]);
    }
}
