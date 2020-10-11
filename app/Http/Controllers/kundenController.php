<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tbl_kunde;

class kundenController extends Controller
{
    public function index() {
        
        // * Display a listing of the resource.
        $kunden = Tbl_kunde::all();
        return view('kunden.index',compact('kunden')); 
          
    }


    public function show($id) {
        
        // * Display the specified resource.
        $kundenID = $id;
        return view('kunden.index',compact('kundenID'));
               
    }


    public function create() {
        // * Show the form for creating a new resource.
        return view('kunden.create');
    }

    
    public function store() {
        // * Store a newly created resource in storage.
        $data = request()->validate([
            'name' => 'required|String|min:1|max:20',
            'ort' => 'required|String|min:1|max:50',
            'strasse' => 'required|String|min:1|max:50',
           
        ]);
        
        Tbl_kunde::create($data);
        return redirect('/kunden')->with('msg','Created kunde');
    }
    
 
    public function edit($id)
    {
        // * Show the form for editing the specified resource.
        $kunde = Tbl_kunde::findOrFail($id);

        return view('kunden.edit',compact('kunde'));
    }

    
    public function update(Request $request, $id)
    {
        // * Update the specified resource in storage.
        $data = request()->validate([
            'name' => 'required|String|min:1|max:20',
            'ort' => 'required|String|min:1|max:50',
            'strasse' => 'required|String|min:1|max:50',
           
        ]);

        Tbl_kunde::whereId($id)->update($data);
        return redirect('/kunden')->with('msg','Kunde sucessfully updated');
    }

    
    public function destroy($id)
    {
        // * Remove the specified resource from storage.
        $kunde = Tbl_kunde::findOrFail($id);
        $kunde->delete();
        return redirect('/kunden')->with('msg','Kunde sucessfully deleted');
    }
}
