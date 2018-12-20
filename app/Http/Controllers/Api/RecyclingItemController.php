<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\RecyclingItem;
use App\RecyclingCategory; 

class RecyclingItemController extends Controller
{

    public function categoires_list()
    {
        return RecyclingCategory::select('id','name_en','name_ar')->where('status',1)->get();
    }

    public function list()
    {
        return RecyclingItem::select('recycling_items.id','recycling_items.name_en','recycling_items.name_ar','recycling_items.quantity',
                              \DB::raw("CONCAT('".asset('images/RecyclingItem')."/',recycling_items.image) as image"),
                              'recycables.name as recycable_name' )
                     ->leftJoin('recycables','recycables.id','recycling_items.recycable_id')
                     ->groupBy('recycling_items.id')
                     ->where('recycling_items.status',1)
                     ->paginate();
    }


}
