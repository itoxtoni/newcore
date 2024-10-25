<?php

namespace App\Http\Controllers;

use App\Dao\Enums\Core\NotificationType;
use App\Dao\Models\Jenis;
use App\Dao\Models\Rs;
use App\Facades\Model\RsModel;
use App\Facades\Model\UserModel;
use App\Http\Controllers\Core\ReportController;
use App\Jobs\JobRekapKotor;
use Illuminate\Bus\Batch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Throwable;
use Illuminate\Support\Str;
use Laravie\SerializesQuery\Eloquent;

class ReportRekapKotorController extends ReportController
{
    public $data;

    public function __construct(RsModel $model)
    {
        $this->model = $model::getModel();
    }

    public function beforeForm()
    {
        Rs::getModel()->test();
        self::$share = [
            'rs' => Cache::get('cache_rs')->pluck(RsModel::field_name(), RsModel::field_primary()),
        ];
    }

    public function getData()
    {
        $query = Rs::with('has_jenis')->find(request('rs_id'));

        return $query->has_jenis()->orderBy('jenis_nama', 'ASC');
    }

    public function getPrint(Request $request)
    {
        set_time_limit(0);

        $this->data = $this->getData();

        $total = $this->data->count();
        $numberOfChunks = ceil($total / env('CSV_CHUNK', 1000));

        $file_name = 'report_rekap_kotor';

        $name = 'public/files/export/'.Str::snake($file_name).'-'.now()->toDateString().'-'.str_replace(':', '-', now()->toTimeString()).'.csv';
        $batches = [];

        for ($i = 1; $i <= $numberOfChunks; $i++) {
            $batches[] = new JobRekapKotor($name, Eloquent::serialize($this->data), $request->all(), $i, env('CSV_CHUNK', 1000), env('CSV_DELIMITER', ','));
        }

        $user_id = auth()->user()->id;

        $batch = Bus::batch($batches)
            ->name('Export Users')
            ->then(function (Batch $batch) use ($name, $user_id) {
                Storage::put($name, file_get_contents($name));

                $notification = new \MBarlow\Megaphone\Types\NewFeature(
                    'Download File Success',
                    'File Ready to download',
                    asset(str_replace('public/', '', $name)),
                    'Download'
                );

                sendNotification($notification, NotificationType::Success, $user_id);

            })
            ->catch(function (Batch $batch, Throwable $e) use ($user_id) {

                $notification = new \MBarlow\Megaphone\Types\Important(
                    'Download File Error',
                    $e->getMessage(),
                );

                sendNotification($notification, NotificationType::Error, $user_id);

            })
            ->finally(function (Batch $batch) use ($name) {
                Storage::disk('local')->delete($name);
            })
            ->onQueue('export')
            ->dispatch();

        // $batch = exportCsv('users', UserModel::query(), JobRekapKotor::class, env('CSV_DELIMITER', ','), 1);
        if ($request->queue == 'batch') {
            $url = moduleRoute('getCreate', array_merge(['batch' => $batch->id], $request->all()));

            return redirect()->to($url);
        }

        return moduleView(modulePathPrint(), $this->share([
            'data' => $this->data,
        ]));
    }
}
