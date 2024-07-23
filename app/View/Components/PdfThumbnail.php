<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PdfThumbnail extends Component
{
    public $pdfUrl;
    public $width;
    public $height;

    public function __construct($pdfUrl, $width = '100px', $height = '100px')
    {
        $this->pdfUrl = $pdfUrl;
        $this->width = $width;
        $this->height = $height;
    }

    public function render()
    {
        return view('components.pdf-thumbnail');
    }
}