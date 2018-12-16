<?php

namespace App\Exports;

use App\Evacuation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings; // used for adding header row
//use Illuminate\Support\Facades\DB; -> in order to use db schema builder

//class EvacsExport implements FromCollection (mas paspas ang fromquery)
class EvacsExport implements FromQuery, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        return Evacuation::select('created_at', 'emergency')->where('status', 'Done')->withCount(['household_evacs' => function ($buang){
            $buang->where("center_id", '<>', NULL);
        }])->orderBy('id', 'desc');
    }

    public function headings(): array
    {
        return [
            'Date & Time',
            'Emergency Type',
            'No. of Evacuees'
        ];
    }
    /*
    public function collection()
    {
        //other way of retrieving with joins
        return DB::table('posts')
                        ->leftJoin('users', 'users.id', '=', 'posts.user_id')
                        ->select('posts.title','posts.body','users.name')
                        ->get();
    }*/
}
