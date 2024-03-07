<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class getDataMasterModel extends Model
{
    use HasFactory;

    private $getDatabase;

    public function __construct()
    {
        $this->getDatabase = DB::connection('mysql');
    }

    public function getDataFlagType()
    {
        $getFlagType = $this->getDatabase->table('flag_type')
        ->select('flag_name', 'type_work', 'ID')
        ->where('deleted', 0)
        ->get();
        return $getFlagType;
    }
}
