<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Tbl_article;
use App\Tbl_article_typ;
use Illuminate\Support\Facades\DB;
// use DataTables;
use Validator;
use Yajra\Datatables\Datatables;

class ArticleController extends Controller
{
    public function __construct() 
    {
        // $this->middleware(['CheckRole:admin']);
        

    }
    public function index(Request $request)
    {
        // $user = Auth::user();
        // $user = authorizeRoles(['admin']);
        if ($request->ajax()){

            $data = DB::table('tbl_articles')->join('tbl_article_typ', 'tbl_articles.id_artikeltyp', '=', 'tbl_article_typ.id_artikeltyp')->whereNull('tbl_articles.deleted_at')
            ->select(['tbl_articles.traglast','tbl_articles.norm','tbl_articles.einsatz','tbl_articles.id_artikel','tbl_articles.bez_ravel','tbl_articles.bez_hersteller','tbl_articles.bez_mo2','tbl_articles.deleted_at','tbl_article_typ.bez_artikeltyp']);
            
            return Datatables::of($data)->addColumn('action', function ($data) {
                // return '<a href="#" class="btn btn-primary btn-sm mb-1">
                // <i class="fa fa-pencil" aria-hidden="true">edit</i></a>';
                $button = '<button type="button" name="edit" id="'.$data->id_artikel.'" class="edit btn btn-primary btn-sm">Edit</button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit" id="'.$data->id_artikel.'" class="delete btn btn-danger btn-sm">Delete</button>';
                        return $button;
            })
            ->rawColumns(['action'])
            ->make(true);

        }
        return view('articles.index');
        // return Datatables::of(Tbl_article::query())->make(true);   // simple all

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
