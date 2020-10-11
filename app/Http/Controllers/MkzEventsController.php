<?php
   



namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Tbl_mkz_events;
use App\Tbl_mkz_luftspalt;
use App\Tbl_mkz_haken;
use App\Tbl_events;
use App\Tbl_txt_bemerkung;
use App\Tbl_txt_kette;
use App\Tbl_warnung;
use App\Tbl_stammdaten;
use App\tbl_articles;
use PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class MkzEventsController extends Controller
{
    // public function __construct() 
    // {
    //     $this->middleware(['CheckRole:admin,pruefer']);
        

    // }
    public function index() {
        
        // * Display a listing of the resource.
        // $mkzevents = Tbl_mkz_events::sortable()->paginate(10); //Alle
        // $mkzevents = Tbl_mkz_events::with('jstamm')->sortable()->paginate(10);

        $now = Carbon::now();
        $jahr = $now->year;
        $monat = $now->month;
        
        $rowMonth = collect(['Typ','Traglast','Norm','Einsatz','jan','feb','mar','apr','mai','jun','jul','aug','sept','okt','nov','dez','summe']);
        $rowTyp = DB::table('Tbl_articles')->where('tbl_articles.id_artikeltyp' , '1')->whereNull('deleted_at')->get();
        
        // $mkzevents = DB::table('Tbl_events')
        //     ->join('Tbl_stammdaten', 'tbl_stammdaten.id_liftboy', '=', 'Tbl_events.id_liftboy')
        //     ->join('Tbl_articles', 'Tbl_articles.id_artikel', '=', 'Tbl_stammdaten.id_artikel')
        //     ->where('tbl_articles.id_artikeltyp' , '1') 
        //     ->where('Tbl_events.id_eventtyp' , '1')
        //     ->whereNull('tbl_stammdaten.deleted_at') 
        //     ->whereNull('tbl_events.deleted_at')
        //     // ->whereYear('Tbl_events.created_at', $jahr)      
        //     ->select('tbl_events.id_liftboy','tbl_events.id_artikel', 'Tbl_events.created_at')
        //     ->orderBy('Tbl_events.created_at', 'desc')->get()->groupBy('id_liftboy');
        //     dd($mkzevents);
        $mkzevents = DB::table('Tbl_mkz_events')
            ->leftjoin('Tbl_events', 'Tbl_mkz_events.id_test', '=', 'Tbl_events.id_event')
            ->leftjoin('Tbl_stammdaten', 'tbl_stammdaten.id_liftboy', '=', 'Tbl_mkz_events.id_liftboy')
            ->leftjoin('Tbl_articles', 'Tbl_articles.id_artikel', '=', 'Tbl_stammdaten.id_artikel')
            ->where('tbl_articles.id_artikeltyp' , '1') 
            ->where('Tbl_events.id_eventtyp' , '1')
            ->whereNull('tbl_stammdaten.deleted_at') 
            ->whereNull('tbl_events.deleted_at')
            // ->whereYear('Tbl_events.created_at', $jahr)      
            ->select('tbl_stammdaten.id_liftboy','tbl_articles.id_artikel', 'Tbl_events.created_at')
            ->orderBy('Tbl_mkz_events.created_at', 'desc')->get()->groupBy('id_liftboy');
        // dd($mkzevents);
            // $mkzevents = $mkzevents->groupBy(function ($grp) {
            //     return $grp->id_liftboy ; // or whatever you can use as a key
            // });
            // ->get();           
        // $mkzevents = DB::table('Tbl_events' )
        // ->select('s.*')
        // ->leftJoin('Tbl_events as s1', function ($join) {
        //     $join->on('s.id_liftboy', '=', 's1.id_liftboy')
        //     ->where('s1.id_eventtyp' , '1')
        //     // ->whereNull('s1.deleted_at') 
        // ->where(DB::raw('s.created_at < s1.created_at'));

        // })
            // ->join('Tbl_stammdaten', 'tbl_stammdaten.id_liftboy', '=', 's.id_liftboy')
            // ->join('Tbl_articles', 'Tbl_articles.id_artikel', '=', 'Tbl_stammdaten.id_artikel')
            // ->where('tbl_articles.id_artikeltyp' , '1') 
            
            // ->whereNull('tbl_stammdaten.deleted_at') 
            
            // ->select('tbl_stammdaten.id_liftboy','tbl_articles.id_artikel', 's.created_at')   
        
            // $mkzevents = $mkzevents->groupBy(function ($grp) {
            //     return $grp->id_liftboy ; // or whatever you can use as a key
            // });
            // dd($mkzevents);
        // $test = Tbl_events::with('allMkzEvents')
        // ->orderBy('created_at', 'desc')->get()->groupBy('id_liftboy');
        // dd ($test);
            
        // return view('mkz_events.index',compact('mkzevents', 'rowTyp', 'rowMonth', 'jahr')); 
       
    }


    public function show($id) {
        
        // * Display the specified resource.
        $mkzevent = $id;
        return view('mkz_events.index',compact('mkzevent'));
               
    }


    public function create($id_liftboy) {
        
        // * Show the form for creating a new resource.
        return view('mkz_events.create', compact('id_liftboy'));
    }

    public function store(Request $request) {
        
        if ($id_liftboy = $request->get('id_liftboy')) {

            if(isset($request->id_eventtyp)) {

                $id_eventtyp = $request->get('id_eventtyp');

            } else {

                dd("errorcode385986143");
            }
            if(Auth::user()) {

                $user = Auth::user();
                $userid = $user->id;

            } else {

                dd("errorcode856254629");

            }
            if ($data = Tbl_events::create(array_merge($request->all(), ['id_user' => $userid], ['id_eventtyp' => $id_eventtyp]))) {

                $lastID = $data->id_event;
            } else {

                dd("errorcode991620154");

            }
            
            if (isset($lastID)) {
                
                    Tbl_mkz_events::create(array_merge($request->all(), ['id_test' => $lastID],['id_user' => $userid] ));

                    if($request->has('txt') && !empty($request->input('txt'))) {
                        // $data = request()->validate([
                        //     'txt' => 'required|String|min:1|max:499'
                        //     ]);
                        Tbl_txt_bemerkung::create(array_merge( ['txt' => $request->txt], ['id_event' => $lastID] ));
                    }
                    if($request->has('warnung') && !empty($request->input('warnung'))) {
                        Tbl_warnung::create(array_merge( ['warnung' => $request->warnung], ['id_event' => $lastID] ));
                    }
                    if($request->has('txt_chain') && !empty($request->input('txt_chain'))) {
                        Tbl_txt_kette::create(array_merge( ['txt_chain' => $request->txt_chain], ['id_event' => $lastID] ));
                    }
                    if($request->has('dez_hakenmaul') || ('dez_hakengrund')) {
                        Tbl_mkz_haken::create(array_merge($request->all(), ['id_event' => $lastID] ));
                    }
                    if($request->has('B1_SO') || ('B1_SU') || ('B1_SL') || ('B2_SO') || ('B2_SU') || ('B1_SL')) {
                        Tbl_mkz_luftspalt::create(array_merge($request->all(), ['id_event' => $lastID] ));
                    }

                    
                    // create(array_merge($request->all(), ['id_user' => $userid], ['id_eventtyp' => $id_eventtyp])))

            } else {

                dd("errorcode793273628");

            }
            
            
        }
        $data = DB::table('tbl_stammdaten')
            ->where('tbl_stammdaten.id_liftboy', $id_liftboy)
            ->leftjoin('tbl_articles', 'tbl_stammdaten.id_artikel', '=', 'tbl_articles.id_artikel')
            ->first();

        $path = '/dokumente/motorkettenzug/uvv/';
        $today = Carbon::today()->format('Ymd');
        $filename= $today.'_'.$data->id_club.'_'.$data->snnr.'_UVV'.'.pdf'; 
        
        if (file_exists(public_path($path.$filename))) {

            $time = Carbon::now()->format('His');
            $filename= $today.'_'.'cn'.'_'.'sn'.'_UVV'.$time.'.pdf';

        }

        $heute = Carbon::today()->format('d.m.Y');
        $view = \View::make('pdf.pdfMkzUvv', compact('data','heute','request'));
        $html_content = $view->render();
        
        
        PDF::AddPage();
        PDF::writeHTML($html_content, true, false, true, false, '');
        PDF::Output(public_path($path.$filename), 'F');
        
        return redirect('/dashboard')->with('msg','Created event');  
    }
    
 
    public function edit($id)
    {
        // * Show the form for editing the specified resource.
        $mkzevent = Tbl_mkz_events::findOrFail($id);

        return view('mkz_events.edit',compact('mkzevent'));
    }

    
    public function update(Request $request, $id)
    {
        // * Update the specified resource in storage.
        $data = request()->validate([

        ]);

        Tbl_mkz_events::whereId($id)->update($data);
        return redirect('/mkz')->with('msg','event sucessfully updated');
    }

    
    public function destroy($id)
    {   //////ACHTUNG HIER MUSS AUCH DAS tbl_events ITEM gelöscht werden !
        // * Remove the specified resource from storage.
        // $kunde = Tbl_mkz_events::findOrFail($id);
        // $kunde->delete();
        // return redirect('/mkz')->with('msg','event sucessfully deleted');
    }



}
