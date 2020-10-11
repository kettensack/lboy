<?php

namespace App\Http\Controllers;
use App\User;
use App\Tbl_article;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class DatatablesController extends Controller
{
/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()){

            console.log("working");
            $art = DB::table('tbl_articles')->join('tbl_article_typ', 'tbl_articles.id_artikeltyp', '=', 'tbl_article_typ.id_artikeltyp')->whereNull('tbl_articles.deleted_at')
            ->select(['tbl_articles.traglast','tbl_articles.norm','tbl_articles.einsatz','tbl_articles.id_artikel','tbl_articles.bez_ravel','tbl_articles.bez_hersteller','tbl_articles.bez_mo2','tbl_articles.deleted_at','tbl_article_typ.bez_artikeltyp']);
            
            return Datatables::of($art)->addColumn('action', function ($data) {
                // return '<a href="#" class="btn btn-primary btn-sm mb-1">
                // <i class="fa fa-pencil" aria-hidden="true">edit</i></a>';
                $button = '<button type="button" name="edit" id="'.$data->id_artikel.'" class="edit btn btn-primary btn-sm">Edit</button>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit" id="'.$data->id_artikel.'" class="delete btn btn-danger btn-sm">Delete</button>';
                        return $button;
            })
            ->rawColumns(['action'])
            ->make(true);

        }
        return view('datatables.index');
        // return Datatables::of(Tbl_article::query())->make(true);   // simple all

        //join with db fassade
        

        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('datatables.index');
        
    }
}