<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class utilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $instructions = DB::table('instructions')->get();
        return view('editor.instruction.index', compact('instructions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('editor.instruction.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          
          $request->validate([
            'instruction' => 'required',
            // 'authors_ids' => 'required',
            // 'volume' => 'required',
            // 'type' => 'required',
            // 'pdf' => 'required|mimes:pdf|max:40400'
        ]);

        // $chkDuplicate = DB::table('volumes')
        //               ->where('name',$request['name'])
        //               ->first();
               
        // if($chkDuplicate){
        //     return redirect()->back()->with('error', 'This volume was created before!');
        // }

        $saveData = DB::table('instructions')->insert([
            'instructions' => $request['instruction'],
            'serial_number' => $request['serial_number']
        ]);

        if($saveData){
            return redirect()->route('editor.instructions')
            ->with('success', 'Instruction saved successfully!');
        }else{
            return redirect()->back()
            ->with('error', 'Something went worng!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = DB::table('instructions')->find($id);
        return view('editor.instruction.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = DB::table('instructions')->find($id);
        return view('editor.instruction.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'instruction' => 'required',
            // 'authors_ids' => 'required',
            // 'volume' => 'required',
            // 'type' => 'required',
            // 'pdf' => 'required|mimes:pdf|max:40400'
        ]);

        // $chkDuplicate = DB::table('instructions')
        //               ->where('name',$request['name'])
        //               ->first();
               
        // if($chkDuplicate){
        //     return redirect()->back()->with('error', 'This volume was created before!');
        // }
       

        $saveData= DB::table('instructions')
        ->where('id', $id)
        ->update(['instructions' => $request['instruction'],
                 'serial_number' => $request['serial_number']]);
       

        if($saveData){
            return redirect()->route('editor.instructions')->with('success','Updated successfully');
           
        }else{
            return redirect()->back()->with('error', 'Something went worng!');
            
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $instruction = DB::table('instructions')->where('id',$id)->delete();
        
        

        return redirect()->back()->with('success','successfully deleted');
    }
}
