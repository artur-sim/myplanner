<?php

namespace App\Http\Controllers;

use App\Notes;
use App\Status;
use Illuminate\Http\Request;
use Validator;
use PDF;

class NotesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $note_collection = Notes::all(); 
        return view('notes.index',['note_collection'=>$note_collection]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $status = Status::all();
        $prior = [ '0-Minor', '1-Normal','2-Major', '3-Urgent', '4-Critical'];
        return view('notes.create',['status_collection'=>$status,'priority'=>$prior]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'title'=> ['required' ],
            'priority'=> ['required' ],
            'note'=> ['required' ],
            'status_id'=> ['required'],
        ] );

        if ($validator->fails()) {
            $request->flash();
            $prior = [ '0-Minor', '1-Normal','2-Major', '3-Urgent', '4-Critical'];
            return redirect()->route('notes.create',['priority'=>$prior])->withErrors($validator);
       }

        $note = new Notes;
        $note->title = $request->title;
        $note->priority = $request->priority;
        $note->note = $request->note;
        $note->status_id = $request->status_id;

        $note->save();

        return redirect()->route('notes.index',);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Notes  $notes
     * @return \Illuminate\Http\Response
     */
    public function show($order)
    {
        $asc = Notes::orderBy('status_id','asc')->get();
        $desc = Notes::orderBy('status_id','desc')->get();
        $prior = Notes::orderBy('priority','asc')->get();

       switch($order){
           case 'asc': return view('notes.index',['note_collection'=>$asc]);
           case 'desc': return view('notes.index',['note_collection'=>$desc]);
           case 'priority': return view('notes.index',['note_collection'=>$prior]);
           
       }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Notes  $notes
     * @return \Illuminate\Http\Response
     */
    public function edit(Notes $notes)
    {
        $status = Status::all();
        $prior = [ '0-Minor', '1-Normal','2-Major', '3-Urgent', '4-Critical'];
        return view('notes.edit',['note'=>$notes,'status_collection'=>$status, 'priority'=>$prior ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Notes  $notes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notes $notes)
    {
        $notes->title = $request->title;
        $notes->priority = $request->priority;
        $notes->note = $request->note;
        $notes->status_id = $request->status_id;

        $notes->save();

        return redirect()->route('notes.index',);
    }

    public function pdf(Notes $notes)
    {
        $pdf = PDF::loadView('notes.pdf', ['notes'=>$notes]);
        return $pdf->download('notes.pdf');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Notes  $notes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notes $notes)
    {
        $notes->delete();
        
        return redirect()->route('notes.index',)->with('success-message','Note was deleted');
    }
}
