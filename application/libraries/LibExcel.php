<?php
//fungsi untuk meload library
class LibExcel
{
    public function __construct()
    {
        require(APPPATH . "/third_party/simplexlsx/src/SimpleXLSX.php");
    }
}
