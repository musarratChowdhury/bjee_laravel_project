<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Ed_board_pos_detail_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $positions = DB::table('ed_board_detail')->get();
        return view('editor.ed_board_position_details.index',compact('positions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('editor.ed_board_position_details.create');
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
            'personName' => 'required',
            // 'authorEmailAddress' => 'required',
            // 'authors_ids' => 'required',
            // 'volume' => 'required',
            // 'type' => 'required',
        ]);

        $chkDuplicate = DB::table('ed_board_detail')
                      ->where('PERSON_NAME',$request['personName'])
                      ->first();
               
        if($chkDuplicate){
            return redirect()->route('editor.create-ed-board-position-details')->with('error', 'This Person was created before!');
        }

        $saveData = DB::table('ed_board_detail')->insert([
            'PERSON_NAME' => $request['personName'],
            'PERSON_EMAIL' => $request['personEmail'],
            'PERSON_PHONE' => $request['personPhone'],
            'DEPT_NAME' => $request['deptName'],
            'UNI_NAME' => $request['uniName'],
            'ED_BOARD_POSITION_ID' => $request['edBoardPositionId'],
            'IS_ACTIVE' => $request['isActive']
        ]);

        if($saveData){
            return redirect()->route('editor.ed-board-position-details')
            ->with('success', 'Person Details saved successfully.');
        }else{
            return redirect()->route('editor.create-ed-board-position-details')
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
        
        $position = DB::table('ed_board_detail')->find($id);
        return view('editor.ed_board_position_details.show', compact('position'));  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $position = DB::table('ed_board_detail')->find($id);
        return view('editor.ed_board_position_details.edit', compact('position'));
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
            'personName' => 'required',
            
            
        ]);
        
        $chkDuplicate = DB::table('ed_board_detail')
        ->where('PERSON_NAME',$request['personName'])
        ->first();
 
            if($chkDuplicate){
            return redirect()->back()->with('error', 'This Person already exists!');
                    }


              $saveData= DB::table('ed_board_detail')
              ->where('ID', $id)
             ->update(['PERSON_NAME' => $request['personName'],
             'PERSON_EMAIL' => $request['personEmail'],
             'PERSON_PHONE' => $request['personPhone'],
             'DEPT_NAME' => $request['deptName'],
             'UNI_NAME' => $request['uniName'],
             'ED_BOARD_POSITION_ID' => $request['edBoardPositionId'],
             'IS_ACTIVE' => $request['isActive']]);


               if($saveData){
                  return redirect()->route('editor.ed-board-position-details')->with('success','Updated successfully');

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
        $person=DB::table('ed_board_detail')->where('ID',$id)->delete();
        return redirect()->route('editor.ed-board-position-details')->with('success', 'Person Details removed successfully!');//
    }
}
