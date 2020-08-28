<?php

namespace App\Http\Controllers;

use App\Stat;
use Illuminate\Http\Request;

class StatController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    //

    public function showAllStats(Request $request){

        $record = Stat::where('user_id', auth()->user()->id)->orderBy('created_at','desc')->get();

        if($record){ return $record ;}
        else{ return response()->json('No record exist');}

    }

    public function create(Request $request){
        //validation
        $this->validate($request, [
            'selected' => 'required|string',
            'motherAge' => 'required|string',
            'birthOrder' => 'required|string',
            'birthGender' => 'required|string',
            'birthCount' => 'required|numeric',
            'birthMale' => 'required|numeric',
            'birthFemale' => 'required|numeric',
            'comment' => 'nullable|string'
        ]);

        //insert record
        $stat = new Stat;
        
        $stat->user_id = auth()->user()->id;
        $stat->location = $request->input('selected');
        $stat->age = $request->input('motherAge');
        $stat->birthorder = $request->input('birthOrder');
        $stat->gender = $request->input('birthGender');
        $stat->count = $request->input('birthCount');
        $stat->male = $request->input('birthMale');
        $stat->female = $request->input('birthFemale');
        $stat->comment = $request->input('comment');

        $stat->save();

        return response()->json($stat); 
    }

    public function delete($id){
        
        $record = Stat::findOrFail($id);

        if($record->user_id !== auth()->user()->id){ return response()->json('Unauthorized delete attempt', 401);}
        else{
            $record->delete();
            return response()->json('Deleted Successfully!');
        }
    }

}
