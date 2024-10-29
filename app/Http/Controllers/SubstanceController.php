<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Substance;
use App\Models\Region;
use App\Models\Search;
use App\Models\User;

class SubstanceController extends Controller
{
    public function substance(){
        $Substance = Substance::get();
        return view('substance',compact('Substance'));
    }

    public function substance_create(Request $request){
        $validate = $request->validate([
            'number' => ['required', 'string', 'max:255'],
            'part' => ['required', 'string', 'max:255'],
        ]);
        Substance::create([
            'number' => $request->number,
            'part' => $request->part,
        ]);
        return redirect()->back()->with('success', "Create substance success");
    }
    public function substance_delete(Request $request){
        $Substance = Substance::find($request->id);
        $Substance->delete();
        $Search = Search::where('substanse_id',$request->id)->get();
        foreach ($Search as $key => $value) {
            $value->delete();
        }
        return redirect()->back()->with('success', "Substance delete");
    }
}
