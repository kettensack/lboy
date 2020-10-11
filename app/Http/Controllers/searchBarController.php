<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tbl_stammdaten;
use App\tbl_articletyp;
use App\tbl_articles;

use Illuminate\Support\Facades\DB;
// use Illuminate\Database\QueryException;

class searchBarController extends Controller
{
    // public function __construct() 
    // {
    //     $this->middleware(['CheckRole:admin,user,pruefer,expert']);
        

    // }
    
    public function show(Request $request)
    {
        // dd ($request);
        if ($sn = $request->get('inputsn')) {
            // echo "sn :".$sn;
            // $targets = tbl_stammdaten::where('snnr', 'like' , '%' . $sn . '%')->get();
            $targets = DB::table('tbl_stammdaten')
                ->where('tbl_stammdaten.snnr', 'like' , '%' . $sn . '%')
                ->leftjoin('tbl_articles', 'tbl_stammdaten.id_artikel', '=', 'tbl_articles.id_artikel')
                ->leftjoin('tbl_article_typ', 'tbl_articles.id_artikeltyp', '=', 'tbl_article_typ.id_artikeltyp')
                ->select('tbl_article_typ.*' , 'tbl_articles.*', 'tbl_stammdaten.*')
                ->paginate(10);
            
            if ($targets->count() > 1) {

                // dd($targets);
                return view('search',compact('targets')); 
                 

            } else if ($targets->count() == 1) {

                $target = DB::table('tbl_stammdaten')->where('snnr', $sn)->first();

            } else {
                return view('search',compact('targets'));
            }

            
            
        }
        if ($lb = $request->get('inputlb')) {
            // echo "lb :".$lb;
            $targets = DB::table('tbl_stammdaten')
                ->where('tbl_stammdaten.id_liftboy', 'like' , '%' . $lb . '%')
                ->leftjoin('tbl_articles', 'tbl_stammdaten.id_artikel', '=', 'tbl_articles.id_artikel')
                ->leftjoin('tbl_article_typ', 'tbl_articles.id_artikeltyp', '=', 'tbl_article_typ.id_artikeltyp')
                ->select('tbl_article_typ.*' , 'tbl_articles.*', 'tbl_stammdaten.*')
                ->paginate(10);
            
            if ($targets->count() > 1) {

                // dd($targets);
                return view('search',compact('targets'));  

            } else if ($targets->count() == 1) {

                $target = DB::table('tbl_stammdaten')->where('id_liftboy', $lb)->first();

            } else {
                return view('search',compact('targets'));
            }
            
        }
        
        if ($id = $request->get('inputid')) {
            
            if (strlen((string)$id)) {
                
                // $targets = DB::table('tbl_stammdaten')->where('id_club', 'like' , '%' . $id . '%')->get();
                $targets = DB::table('tbl_stammdaten')
                ->where('tbl_stammdaten.id_club', 'like' , '%' . $id . '%')
                ->leftjoin('tbl_articles', 'tbl_stammdaten.id_artikel', '=', 'tbl_articles.id_artikel')
                ->leftjoin('tbl_article_typ', 'tbl_articles.id_artikeltyp', '=', 'tbl_article_typ.id_artikeltyp')
                ->select('tbl_article_typ.*' , 'tbl_articles.*', 'tbl_stammdaten.*')
                ->paginate(10);
                
                if ($targets->count() > 1) {

                    // dd($targets);
                    return view('search',compact('targets')); 

                }   else if ($targets->count() == 1) {
                    $target = $targets->first();
                    $id = $target->id_club;
                    
                    
                } else {
                    return view('search',compact('targets'));  
                }

            }

            // $target = DB::table('tbl_stammdaten')->where('id_club', $id)->first();

        }
        
        if (isset($target)){
            // dd($target);
/////////////////////////////
            
            $data = DB::table('tbl_stammdaten')
            ->where('tbl_stammdaten.id_liftboy', $target->id_liftboy)
            ->leftjoin('tbl_articles', 'tbl_stammdaten.id_artikel', '=', 'tbl_articles.id_artikel')
            ->leftjoin('tbl_article_typ', 'tbl_articles.id_artikeltyp', '=', 'tbl_article_typ.id_artikeltyp')
            ->select('tbl_article_typ.*' , 'tbl_articles.*', 'tbl_stammdaten.*')
            ->first();
            $xdata = DB::table('tbl_events')
            ->where('tbl_events.id_liftboy', $target->id_liftboy)
            ->leftjoin('users', 'tbl_events.id_user', '=', 'users.id')
            ->leftjoin('tbl_mkz_events', 'tbl_events.id_event', '=', 'tbl_mkz_events.id_test')
            ->leftjoin('tbl_event_typ', 'tbl_events.id_eventtyp', '=', 'tbl_event_typ.id_event')
            ->leftjoin('tbl_txt_bemerkung', 'tbl_events.id_event', '=', 'tbl_txt_bemerkung.id_event')
            ->leftjoin( 'tbl_txt_kette' , 'tbl_events.id_event', '=', 'tbl_txt_kette.id_event')
            ->leftjoin( 'tbl_warnung', 'tbl_events.id_event', '=', 'tbl_warnung.id_event')
            ->leftjoin( 'tbl_mkz_luftspalt', 'tbl_events.id_event', '=', 'tbl_mkz_luftspalt.id_event')
            ->leftjoin( 'tbl_mkz_haken', 'tbl_events.id_event', '=', 'tbl_mkz_haken.id_event')
            ->leftjoin( 'tbl_sv', 'tbl_events.id_event', '=', 'tbl_sv.id_event')
            ->select('users.name','tbl_sv.*','tbl_mkz_haken.*', 'tbl_mkz_luftspalt.*','tbl_warnung.warnung', 'tbl_txt_kette.txt_chain', 'tbl_txt_bemerkung.txt','tbl_event_typ.*' ,'tbl_mkz_events.*', 'tbl_events.*')
            ->orderBy('tbl_events.created_at', 'desc') 
            ->get();

            // dump($data);
            //   dd($xdata);
            return view('mkz_events.history',compact('xdata','data')); 
        } else {
             return view('mkz_events.history');
        }     
              
    }
    
    
}