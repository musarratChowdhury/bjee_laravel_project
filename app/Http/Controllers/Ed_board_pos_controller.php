<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Ed_board_pos_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $positions = DB::table('ed_board_position')->get();
        return view('editor.ed_board_position.index',compact('positions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('editor.ed_board_position.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'PositionName' => 'required',
            // 'authorEmailAddress' => 'required',
            // 'authors_ids' => 'required',
            // 'volume' => 'required',
            // 'type' => 'required',
        ]);

        $chkDuplicate = DB::table('ed_board_position')
                      ->where('POSITION_NAME',$request['PositionName'])
                      ->first();
               
        if($chkDuplicate){
            return redirect()->route('editor.create-ed-board-position')->with('error', 'This Position was created before!');
        }

        $saveData = DB::table('ed_board_position')->insert([
            'POSITION_NAME' => $request['PositionName'],
            'HIERARCHY_NO' => $request['HierarchyNo'],
            'IS_ACTIVE' => $request['IsActive']
        ]);

        if($saveData){
            return redirect()->route('editor.ed-board-position')
            ->with('success', 'Editorial board Position saved successfully.');
        }else{
            return redirect()->route('editor.create-ed-board-position')
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
        $position = DB::table('ed_board_position')->find($id);
        return view('editor.ed_board_position.show', compact('position'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $position = DB::table('ed_board_position')->find($id);
        return view('editor.ed_board_position.edit', compact('position'));
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
            'PositionName' => 'required',
            
            
        ]);
        
        $chkDuplicate = DB::table('ed_board_position')
        ->where('POSITION_NAME',$request['PositionName'])
        ->first();
 
            if($chkDuplicate){
            return redirect()->back()->with('error', 'This Position already exists!');
                    }


              $saveData= DB::table('ed_board_position')
              ->where('ID', $id)
             ->update(['POSITION_NAME' => $request['PositionName'],
                       'HIERARCHY_NO' => $request['HierarchyNo'],
                       'IS_ACTIVE' => $request['IsActive']]);


               if($saveData){
                  return redirect()->route('editor.ed-board-position')->with('success','Updated successfully');

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
        $person=DB::table('ed_board_position')->where('ID',$id)->delete();
        return redirect()->route('editor.ed-board-position')->with('success', 'Position removed successfully!');//
    }
}
