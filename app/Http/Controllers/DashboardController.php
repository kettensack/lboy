<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Tbl_article;
use App\Tbl_article_typ;
use App\Tbl_mkz_events;
use App\Tbl_events;
use Illuminate\Support\Facades\DB;
use DataTables;
use Validator;
// use Yajra\Datatables\Datatables;
use Carbon\Carbon;

class DashboardController extends Controller
{
    
    public function index(Request $request)
    {
        $user = Auth::user();
        $userid = $user->id;
        $date = Carbon::today()->toDateString();

        // $a = Carbon::now();
        // $a->month($a->month);
        // $Quarter = $a->quarter;
        
        // $date = new \Carbon\Carbon('-3 months');
        // $firstOfQuarter = $date->firstOfQuarter();
        // $lastOfQuarter = $date->lastOfQuarter();

        if ($request->ajax()){

            
            // $data = DB::table('tbl_events')
            // ->where('id_user', $userid)
            // ->whereDate('created_at', '=', $date)->get();
            
            $data = DB::table('tbl_events')
            ->join('tbl_stammdaten', 'tbl_events.id_liftboy', '=', 'tbl_stammdaten.id_liftboy')
            ->join('tbl_articles', 'tbl_articles.id_artikel', '=', 'tbl_stammdaten.id_artikel')
            ->join('tbl_event_typ', 'tbl_events.id_eventtyp', '=', 'tbl_event_typ.id_event')
            ->whereNull('tbl_events.deleted_at')
            ->whereNull('tbl_stammdaten.deleted_at')
            ->where('tbl_events.id_user', $userid)
            ->whereDate('tbl_events.created_at', '=', $date)
            ->select(['tbl_events.id_event', 'tbl_events.id_eventtyp' , 'tbl_events.created_at','tbl_articles.bez_ravel','tbl_stammdaten.id_club','tbl_stammdaten.snnr','tbl_event_typ.event_typ'])->get();
            
            return Datatables::of($data)->addColumn('action', function ($data) {
                // return '<a href="#" class="btn btn-primary btn-sm mb-1">
                // <i class="fa fa-pencil" aria-hidden="true">edit</i></a>';
                $button = '<button type="button" name="edit" id="'.$data->id_event.'" class="edit btn btn-primary btn-sm">Edit</button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit" id="'.$data->id_event.'" class="delete btn btn-danger btn-sm">Delete</button>';
                        return $button;
            })
            ->rawColumns(['action'])
            ->make(true);

        }
        
        // return Datatables::of(Tbl_events::query())->make(true);   // simple all
        return view('dashboard.index');
        //join with db fassade
        

        
        
    }



    public function show($id) {
        
        // * Display the specified resource.
        $articleID = $id;
        return view('articles.index',compact('articleID'));
               
    }


    public function create() {
        // * Show the form for creating a new resource.
        return view('articles.create');
    }

    
    public function store() {
        // * Store a newly created resource in storage.
        $data = request()->validate([
            // 'name' => 'required|String|min:1|max:20',
            // 'id_club' => 'required|numeric',
            // 'abgangMitErl' => 'required|numeric',
            // 'abgangOhneErl' => 'required|numeric',
            
        ]);
        
        Tbl_article::create($data);
        return redirect('/article')->with('msg','Created Article');
    }
    
 
    public function edit($id)
    {
        // * Show the form for editing the specified resource.
        $article = Tbl_article::findOrFail($id);

        return view('articles.edit',compact('article'));
    }

    
    public function update(Request $request, $id)
    {
        // * Update the specified resource in storage.
        $data = request()->validate([
            // 'name' => 'required|String|min:1|max:20',
            // 'id_club' => 'required|numeric|max:11',
            // 'abgangMitErl' => 'required|numeric|max:1',
            // 'abgangOhneErl' => 'required|numeric|max:1',
            
        ]);

        Tbl_article::whereId($id)->update($data);
        return redirect('/article')->with('msg','Article sucessfully updated');
    }

    
    
    public function destroy($id)
    {
        $delete = Tbl_article::find($id)->delete($id);
  
    return response()->json([
        'success' => true, 201
    ]);
    }
}
