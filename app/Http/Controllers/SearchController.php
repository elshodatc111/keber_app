<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region;
use App\Models\Search;
use App\Models\Substance;
use App\Models\User;

class SearchController extends Controller
{
    public function search(){
        $Search = Search::join('regions','regions.id','=','searches.region_id')->join('substances','substances.id','=','searches.substanse_id')->get();
        $Region = Region::get();
        $Substance = Substance::get();
        return view('search',compact('Search','Region','Substance'));
    }
    public function search_create(Request $request){
        $request->validate([
            'photo' => 'required|mimes:jpg',
            'region_id' => 'required',
            'substanse_id' => 'required',
            'data' => 'required',
            'type' => 'required',
            'fio' => 'required',
            'addres' => 'required',
            'qyj' => 'required',
        ]);
        $Region = Region::find($request->region_id);
        $Substance = Substance::find($request->substanse_id);
        $imageName = "user_".$request->number." ".time().'.'.$request->photo->extension();
        $request->photo->move(public_path('photo'), $imageName);
        Search::create([
            'region_id'=>$request->region_id,
            'substanse_id'=>$request->substanse_id,
            'data'=>$request->data,
            'fio'=>$request->fio,
            'addres'=>$request->addres,
            'photo'=>$imageName,
            'qyj'=>$request->qyj,
            'type'=>$request->type,
        ]);
        return redirect()->back()->with('success', "Create new user success");
    }
    public function searchs($id){
        $Search = Search::join('regions','regions.id','=','searches.region_id')
        ->join('substances','substances.id','=','searches.substanse_id')
        ->where('searches.id',$id)->first();
        $Region = Region::get();
        $Substance = Substance::get();
        return view('search_show',compact('Search','Region','Substance'));
    }
    public function search_update_data(Request $request){
        $request->validate([
            'id' => 'required',
            'region_id' => 'required',
            'substanse_id' => 'required',
            'data' => 'required',
            'type' => 'required',
            'fio' => 'required',
            'addres' => 'required',
            'qyj' => 'required',
        ]);
        $Search = Search::find($request->id);
        $Search->region_id = $request->region_id;
        $Search->substanse_id = $request->substanse_id;
        $Search->data = $request->data;
        $Search->type = $request->type;
        $Search->fio = $request->fio;
        $Search->addres = $request->addres;
        $Search->qyj = $request->qyj;
        $Search->save();
        return redirect()->back()->with('success', "Update user success");
    }
    public function search_update_photo(Request $request){
        $request->validate([
            'photo' => 'required|mimes:jpg',
            'id' => 'required',
        ]);
        $Search = Search::find($request->id);
        $imageName = "user_".$request->number." ".time().'.'.$request->photo->extension();
        $request->photo->move(public_path('photo'), $imageName);
        $Search->photo = $imageName;
        $Search->save();
        return redirect()->back()->with('success', "Update user image success");
    }
    public function search_delete(Request $request){
        $request->validate([
            'id' => 'required',
        ]);
        $Search = Search::find($request->id);
        $Search->delete();  
        return redirect()->route('search')->with('success', "User deleted");
    }
}
