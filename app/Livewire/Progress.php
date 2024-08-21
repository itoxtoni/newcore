<?php

namespace App\Livewire;

use Illuminate\Bus\Batch;
use Illuminate\Support\Facades\Bus;
use Livewire\Component;
use Livewire\Attributes\Url;

class Progress extends Component
{
    #[Url]
    public $batch = '';
    public $percent = 0;

    public function render()
    {
        $bus = Bus::findBatch($this->batch);

        if($bus)
        {
            $job = ($bus->totalJobs - $bus->pendingJobs);
            $this->percent = intval(($job / $bus->totalJobs) * 100);
        }

        return view('livewire.progress');
    }
}
