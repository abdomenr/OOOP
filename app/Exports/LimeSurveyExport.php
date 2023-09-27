<?php

namespace App\Exports;

use App\Models\LimeSurvey689126;
use Maatwebsite\Excel\Concerns\FromCollection;

class LimeSurveyExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return LimeSurvey689126::all();
    }
}
