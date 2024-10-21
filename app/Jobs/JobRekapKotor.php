<?php

namespace App\Jobs;

use App\Dao\Models\Rs;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\WithoutOverlapping;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Laravie\SerializesQuery\Eloquent;
use Spatie\SimpleExcel\SimpleExcelWriter;

class JobRekapKotor implements ShouldQueue
{
    use Batchable;
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public $tries = 5;

    public function __construct(
        public $fileName,
        public $query,
        public $request,
        public $chunkIndex,
        public $chunkSize,
        public $delimiter
    ) {
    }

    private function getHeader()
    {
        $header = [
            'name' => 'Nama Linen',
        ];

        $rs = Rs::with(['has_ruangan'])->find($this->request['rs_id']);
        $ruangan = $rs->has_ruangan;
        $ruangan_pluck = $ruangan->pluck('ruangan_nama')->toArray();

        return array_merge($header, $ruangan_pluck);
    }

    public function handle()
    {
        $query = Eloquent::unserialize($this->query)
            ->select('*');

        if ($this->chunkIndex == 1)
        {
            $excel = SimpleExcelWriter::create($this->fileName, delimiter: $this->delimiter);
            $excel->addHeader(array_values($this->getHeader()));

        } else {

            if (! file_exists($this->fileName))
            {
                SimpleExcelWriter::create($this->fileName, delimiter: $this->delimiter)
                    ->addHeader(array_values($this->getHeader()));
            }

            $data_query = $query
            ->orderBy('jenis_nama', 'asc')
            ->skip(($this->chunkIndex - 1) * $this->chunkSize)
            ->take($this->chunkSize)
            ->get();

            $rs_id = $this->request['rs_id'];
            $start = $this->request['start_date'];
            $end = $this->request['end_date'];

            if (Cache::has($this->fileName.'_cache_rekap_kotor')) {
                $select = Cache::get($this->fileName.'_cache_rekap_kotor');
                Log::info('cache');
            }

            else {
                $query_kotor_per_ruangan = "
                SELECT *
                FROM view_rekap_kotor
                WHERE view_rs_id = $rs_id
                    AND view_tanggal >= '$start'
                    AND view_tanggal <= '$end'
                ";

                Log::info('belum cache');

                $select = DB::connection('report')->select($query_kotor_per_ruangan);
                Cache::add($this->fileName.'_cache_rekap_kotor', $select);
            }



            $rs = Rs::with(['has_ruangan'])->find($this->request['rs_id']);
            $ruangan = $rs->has_ruangan;

            // Log::info($select);

            foreach($data_query as $jenis)
            {
                $data[$jenis->jenis_id] = $jenis->jenis_nama;

                foreach($ruangan as $room)
                {
                    // $data[$room->ruangan_id] = $room->ruangan_nama;

                    $total = collect($select)
                        ->where('view_linen_id', $jenis->jenis_id)
                        ->where('view_ruangan_id', $room->ruangan_id)
                        ->sum('view_qty');

                    $data[$room->ruangan_id] = $total ?? 0;
                }
            }

            // Log::info($data);

            $file = $this->fileName;
            $open = fopen($file, 'a+');

            fputcsv($open, $data, env('CSV_DELIMITER', ','));

            fclose($open);
        }

    }

    private function usersGenerator($users)
    {
        foreach ($users as $user) {
            yield $user;
        }
    }

    public function middleware()
    {
        return [new WithoutOverlapping('export', 10)];
    }
}
