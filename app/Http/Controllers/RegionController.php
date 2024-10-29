<?php

namespace App\Http\Controllers;
use App\Models\Region;
use Illuminate\Http\Request;
use App\Models\Substance;
use App\Models\Search;
use App\Models\User;

class RegionController extends Controller
{
    public function region(){
        $Region = Region::get();
        return view('region',compact('Region'));
    }

    public function region_create(Request $request){
        $validate = $request->validate([
            'coato' => ['required', 'string', 'max:255', 'unique:regions'],
            'name' => ['required', 'string', 'max:255', 'unique:regions'],
        ]);
        Region::create([
            'coato' => $request->coato,
            'name' => $request->name,
        ]);
        return redirect()->back()->with('success', "Create region success");
    }

    public function region_delete(Request $request){
        $Region = Region::find($request->id);
        $Region->delete();
        $Search = Search::where('region_id',$request->id);
        foreach ($Search as $key => $value) {
            $value->delete();
        }
        return redirect()->back()->with('success', "Region delete");
    }
}
