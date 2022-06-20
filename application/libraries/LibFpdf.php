<?php
//fungsi untuk meload library
class LibFpdf
{
    public function __construct()
    {
        require(APPPATH . "/third_party/fpdf184/fpdf.php");
    }
}
