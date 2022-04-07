<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Document;
use Illuminate\Support\Facades\Auth;
use App\Models\ChMessage as Message;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filename = $request->search;
        $documents = Document::where('agent_id', Auth::id())
            ->when($filename, function ($query, $filename) {
                return $query->where('file', 'LIKE', $filename. '%')->orWhere('notes', 'LIKE', '%'. $filename .'%');
            })
            ->paginate(5);
        $msg = Message::all()
            ->where('seen', 0)
            ->where('from_id', '!=', Auth::id())
            ->where('to_id', Auth::id());
        return view('dashboards.agent.documents', compact('documents', 'msg'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $msg = Message::all()
            ->where('seen', 0)
            ->where('from_id', '!=', Auth::id())
            ->where('to_id', Auth::id());
        return view('dashboards.agent.document-create', compact('msg'));
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
            'notes'         => 'required|max:255',
            'file'          => 'required|mimes:pdf'
        ]);

        $filename = $request->file->getClientOriginalName();
        $request->file->move(public_path('storage/documents'), $filename);

        Document::create([
            'agent_id'  => auth()->user()->id,
            'notes'     => $request->input('notes'),
            'file'      => $filename,
        ]);

        return redirect()->route('agent.documents.index')->withMessage('Document addded successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function download($file)
    {
        return response()->download('storage/documents/' .$file);
    }

    public function edit($id)
    {
        $document = Document::find($id);
        $msg = Message::all()
            ->where('seen', 0)
            ->where('from_id', '!=', Auth::id())
            ->where('to_id', Auth::id());
        return view('dashboards.agent.document-edit', compact('document', 'msg'))->withMessage('Document updated successfully.');
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
        $agent_id = auth()->user()->id;
        $request->validate([
            'notes'         => 'required|max:255',
            'file'          => 'mimes:pdf'
        ]);

        $input = $request->all();
        if($document = $request->file('file'))
        {
            $path = 'storage/documents/';
            $new = date('YmdHis'). "." .$document->getClientOriginalExtension();
            // $new = $image->getClientOriginalExtension();
            $document->move($path, $new);
            $input['file'] = "$new";
        }
        else
        {
            unset($input['file']);
        }
        
        
        Document::find($id)
        ->update($input);

        return redirect()->back()->withMessage('Updated successfully');
            
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
