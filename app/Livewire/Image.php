<?php

namespace App\Livewire;

use Livewire\Component;

class Image extends Component
{

    public $isHiddenFileInput = "hidden";
    public $notInitScannerQr = 1;

    public function initScan()
    {
        $this->isHiddenFileInput = "";
        $this->notInitScannerQr = 0;
    }

    public function render()
    {
        return view('livewire.image');
    }
}
