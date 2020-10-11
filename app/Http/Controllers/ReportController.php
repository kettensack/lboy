<?php
   



namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Tbl_mkz_events;
use App\Tbl_events;
// use PDF;
use App\tbl_sv;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class ReportController extends Controller
{
    // public function __construct() 
    // {
    //     $this->middleware(['CheckRole:admin,pruefer']);
        

    // }
    


    public function report2 (Request $request)
    {
        $now = Carbon::now();
        $monat = $now->month;
        $jahr = $now->year;
        
        if ($request->year) {
            $show =  $request->year;
        }
        else {
            $show = $jahr;
        }
        if ($request->spanne) {
            $spanne =  $request->spanne;
        }
        else {
            $spanne = 12;
        }
        if ($request->kunde) {
            $kunde =  $request->kunde;
        }
        else {
            $kunde = 1;
        }

        


        $rowMonth = collect(['jan','feb','mar','apr','mai','jun','jul','aug','sept','okt','nov','dez']);
        $rowTyp = DB::table('Tbl_articles')->where('tbl_articles.id_artikeltyp' , '1')->whereNull('deleted_at')->get();
        $kunden = DB::table('Tbl_kunden')->whereNull('deleted_at')->get();
        // dd($kunden);

        $mkzevents = DB::table('Tbl_mkz_events')
        ->leftjoin('Tbl_events', 'Tbl_mkz_events.id_test', '=', 'Tbl_events.id_event')
        ->leftjoin('Tbl_stammdaten', 'tbl_stammdaten.id_liftboy', '=', 'Tbl_mkz_events.id_liftboy')
        ->leftjoin('Tbl_articles', 'Tbl_articles.id_artikel', '=', 'Tbl_stammdaten.id_artikel')
        ->leftjoin('Tbl_sv', 'Tbl_sv.id_liftboy', '=', 'Tbl_mkz_events.id_liftboy')
        ->where('tbl_articles.id_artikeltyp' , '1') 
        ->where('Tbl_stammdaten.id_kunde' , $kunde)
        ->where('Tbl_events.id_eventtyp' , '1')
        ->whereNull('tbl_sv.deleted_at') 
        ->whereNull('tbl_stammdaten.deleted_at') 
        ->whereNull('tbl_articles.deleted_at') 
        ->whereNull('tbl_events.deleted_at')     
        ->select('Tbl_mkz_events.id_liftboy','Tbl_mkz_events.id_article', 'Tbl_mkz_events.created_at','tbl_articles.int_einsatz','Tbl_stammdaten.baujahr','Tbl_stammdaten.id_kunde', 'Tbl_sv.created_at as lastSvTestDatum')
        ->orderBy('Tbl_mkz_events.created_at', 'desc')->get()->groupBy('id_liftboy');
        // dd($mkzevents);
        // init arrays - 2D -  based on active articles and month 
        foreach($rowTyp as $tkey=>$typ) {

                $uvvSumRow[$tkey] = null;
                $uvvNowOverRow[$tkey] = null;
                $uvvSumRowBlack[$tkey] = null;
                $svNowOverRow[$tkey] = null;
                $svSumRow[$tkey] = null;
            
            foreach($rowMonth as $mkey=>$month) {
                
                $uvvData[0][$mkey] = null;
                $uvvData[$typ->id_artikel][$mkey] = null;

                $uvvOver[0][$mkey] = null;
                $uvvOver[$typ->id_artikel][$mkey] = null;

                $svData[0][$mkey] = null;
                $svData[$typ->id_artikel][$mkey] = null;

                

            }
            
        }
        
        // dd($uvvData);
        
        // init arrays - 1D for sum 
        foreach($rowMonth as $mkey=>$month) {
                
            $uvvSumCol[$mkey] = null;
            $uvvSumColRed[$mkey] = null;
            $svSumCol[$mkey] = null;

        }   
        
        // fill arrays loop 
        $svTestOver = array();
        // foreach($svEvents as $event)
        //     $isSvArticle = ($event->id_artikel)-1;
        //     $isSvMonth = (date('m', strtotime($event->created_at)))-1;
        //     $svuvvErstelltJahr = (date('Y', strtotime($event->created_at)));
        //     $svErstellt = Carbon::parse($event->created_at);
        //     $svRelevant = $event->int_einsatz;
        //     $baujahr = $event->baujahr;
        //     if ( $svRelevant == 1 && $svErstellt->lessThan(Carbon::now()->subMonth(7)) )  {
        //         // wenn älter als 47 Monate dann....
        //         // $svNowOverRow[$isSvArticle] = $svNowOverRow[$isSvArticle]+1;
        //         // $svTestOver[$event->id_liftboy];
        //         }
        //     if ($svuvvErstelltJahr == $show) {   
        //         // $svData [$isSvArticle][$isSvMonth] = $svData[$isSvArticle][$isSvMonth]+1;
        //         // $svSumRow[$isSvArticle] = $uvvSumRow[$isSvArticle]+1;
        //         // $svSumCol[$isSvMonth] = $uvvSumCol[$isSvMonth]+1; 
        //     }
        // }
        
        // dd ($svTestOver);
        foreach($mkzevents as $gKey=>$group) {



            $target = $group->take(1);

            $isId = $target[0]->id_liftboy;
            $isArticle = ($target[0]->id_article)-1;
            
            $uvvErstelltJahr = (date('Y', strtotime($target[0]->created_at)));
            $uvvErstelltMonat = (date('m', strtotime($target[0]->created_at)))-1; 
            $uvvErstellt = Carbon::parse($target[0]->created_at);
            $svRelevant = $target[0]->int_einsatz;
            $svErstellt = Carbon::parse($target[0]->lastSvTestDatum);
            $fourYearsAgo = Carbon::now()->subMonth(47);
            $baujahr = $target[0]->baujahr;
            // dd ($svErstellt);
            
            if ($jahr == $show) {

                // aktuelles Jahr = gewähltes Anzeigejahr ....

                if ( $uvvErstellt->lessThan(Carbon::now()->subMonth(12)) && $uvvErstellt->greaterThan(Carbon::now()->subMonth($spanne+12))  )  {

                    // UVV created_at innerhalb 12 Monate  .....
                    
                    $uvvNowOverRow[$isArticle] = $uvvNowOverRow[$isArticle]+1; // rot GROß
                    $uvvSumColRed[$monat-1] = $uvvSumColRed[$monat-1]+1;
                    $uvvSumRow[$isArticle] = $uvvSumRow[$isArticle]+1;
                        
                    if (  $target[0]->lastSvTestDatum == null  &&  $svRelevant == 1  &&  $jahr-$baujahr >= 4 ) {

                        // .... SV Dokumente noch nicht vorhanden   &&   SV Relevant    &&    baujahr älter als 4 Jahre 

                        $svNowOverRow[$isArticle] = $svNowOverRow[$isArticle]+1; // gelb GROß
                        $svSumRow[$isArticle] = $svSumRow[$isArticle]+1; 
                        $svSumCol[$monat-1] = $svSumCol[$monat-1]+1;  
                        $svSumCol[$uvvErstelltMonat] = $svSumCol[$uvvErstelltMonat]+1;
                        
                           
                    }   
                    if ($svRelevant == 1 && $target[0]->lastSvTestDatum != null && $svErstellt < $fourYearsAgo) {

                        // SV Relevant && SV dokument vorhanden   &&     SV Dokument uvvNowOverRow  
                        
                        $svNowOverRow[$isArticle] = $svNowOverRow[$isArticle]+1;  // gelb GROß
                        $svSumRow[$isArticle] = $svSumRow[$isArticle]+1;
                        $svSumCol[$uvvErstelltMonat] = $svSumCol[$uvvErstelltMonat]+1;
                        $svSumCol[$monat-1] = $svSumCol[$monat-1]+1; 
                    }
                }
  
            
            }     
              

            if ($uvvErstelltJahr == $show) {   

                // UVV created_at = gewähltes Anzeigejahr ....
                

                 
                if ($uvvErstellt->lessThan(Carbon::now()->subMonth(12)))  {
                    $uvvOver [$isArticle][$uvvErstelltMonat] = $uvvOver[$isArticle][$uvvErstelltMonat]+1; // rot klein
                    $uvvSumColRed[$uvvErstelltMonat] = $uvvSumColRed[$uvvErstelltMonat]+1; // rot klein
                    $uvvSumRow[$isArticle] = $uvvSumRow[$isArticle]+1;
                    
                } else {
                    $uvvData [$isArticle][$uvvErstelltMonat] = $uvvData[$isArticle][$uvvErstelltMonat]+1; // schwarz
                    $uvvSumCol[$uvvErstelltMonat] = $uvvSumCol[$uvvErstelltMonat]+1;
                    $uvvSumRowBlack[$isArticle] = $uvvSumRowBlack[$isArticle]+1;
                }  
                
                

                
            }
            

            if ( $uvvErstelltJahr == $show-1 && $show == $jahr && $uvvErstelltMonat+1 > $monat) {

                // AB dem heutigen Monat in diesem Jahr
                  
                $uvvOver [$isArticle][$uvvErstelltMonat] = $uvvOver[$isArticle][$uvvErstelltMonat]+1; // rot klein
                $uvvSumColRed[$uvvErstelltMonat] = $uvvSumColRed[$uvvErstelltMonat]+1; // rot klein
                $uvvSumRow[$isArticle] = $uvvSumRow[$isArticle]+1;
                
            
                
                    
                    if ( $target[0]->lastSvTestDatum != null && $svErstellt < $fourYearsAgo || $target[0]->lastSvTestDatum == null && $svRelevant == 1 && $jahr-$baujahr >= 4)  {
                    // SV Dokumente vorhanden && SV Dokument uvvNowOverRow || SV Dokumente NICHT vorhanden && sv relevant && baujahr älter als : jahr
                        
                        $svData [$isArticle][$uvvErstelltMonat] = $svData[$isArticle][$uvvErstelltMonat]+1;
                        $svSumRow[$isArticle] = $svSumRow[$isArticle]+1;
                        $svSumCol[$uvvErstelltMonat] = $svSumCol[$uvvErstelltMonat]+1;
                        // $svNowOverRow[$isArticle] = $svNowOverRow[$isArticle]-1;
                         
                            
                    } 
                    
                 
            }
            if (  $show >$jahr ) {
                  
                $uvvOver [$isArticle][$uvvErstelltMonat] = $uvvOver[$isArticle][$uvvErstelltMonat]+1;
                $uvvSumColRed[$uvvErstelltMonat] = $uvvSumColRed[$uvvErstelltMonat]+1; // rot klein
                    // und alles für die nächsten Jahre.....
            
                
                    
                    if ( $target[0]->lastSvTestDatum != null && $svErstellt < $fourYearsAgo || $target[0]->lastSvTestDatum == null && $svRelevant == 1 && $show-$baujahr >= 4)  {
                     // SV Dokumente vorhanden && SV Dokument uvvNowOverRow || SV Dokumente NICHT vorhanden && sv relevant && baujahr älter als : show
                        
                        
                        $uvvSumRow[$isArticle] = $uvvSumRow[$isArticle]+1;
                        
                        // $uvvSumCol[$uvvErstelltMonat] = $uvvSumCol[$uvvErstelltMonat]+1;
                        
                        $svData [$isArticle][$uvvErstelltMonat] = $svData[$isArticle][$uvvErstelltMonat]+1;
                        $svSumCol[$uvvErstelltMonat] = $svSumCol[$uvvErstelltMonat]+1;
                        $svSumRow[$isArticle] = $svSumRow[$isArticle]+1;
                        // $svNowOverRow[$isArticle] = $svNowOverRow[$isArticle]-1;  

                        // if ( $uvvErstelltMonat+1 <= $monat)  {
                        //     $svNowOverRow[$isArticle] = $svNowOverRow[$isArticle]+1;
                        // }
                            
                    }  
                  
            }
            
            

      
            
                    
                    
                    
                    
                
                
                
            
            
        }
        // dd($uvvNowOverRow);
        $sumQua[0] = $uvvSumCol[0]+$uvvSumCol[1]+$uvvSumCol[2]; // grün/schwarz summe
        $sumQua[1] = $uvvSumCol[3]+$uvvSumCol[4]+$uvvSumCol[5];
        $sumQua[2] = $uvvSumCol[6]+$uvvSumCol[7]+$uvvSumCol[8];
        $sumQua[3] = $uvvSumCol[9]+$uvvSumCol[10]+$uvvSumCol[11];
        // $uvvSumFound = $sumQua[0]+$sumQua[1]+$sumQua[2]+$sumQua[3];
        $svSumQua[0] = $svSumCol[0]+$svSumCol[1]+$svSumCol[2]; // gelb summe
        $svSumQua[1] = $svSumCol[3]+$svSumCol[4]+$svSumCol[5];
        $svSumQua[2] = $svSumCol[6]+$svSumCol[7]+$svSumCol[8];
        $svSumQua[3] = $svSumCol[9]+$svSumCol[10]+$svSumCol[11];
        $sumFound = $mkzevents->count();
        $uvvSumQua[0] = $uvvSumColRed[0]+$uvvSumColRed[1]+$uvvSumColRed[2];// rot summe
        $uvvSumQua[1] = $uvvSumColRed[3]+$uvvSumColRed[4]+$uvvSumColRed[5];
        $uvvSumQua[2] = $uvvSumColRed[6]+$uvvSumColRed[7]+$uvvSumColRed[8];
        $uvvSumQua[3] = $uvvSumColRed[9]+$uvvSumColRed[10]+$uvvSumColRed[11];
        $uvvSumFound = $uvvSumQua[0]+$uvvSumQua[1]+$uvvSumQua[2]+$uvvSumQua[3];
        $sumFound = $mkzevents->count();
        $svSumFound = $svSumQua[0]+$svSumQua[1]+$svSumQua[2]+$svSumQua[3];
        $sumYear = array_sum($uvvSumCol);
        
        
        return view('reports.report2',compact('rowMonth','uvvOver','uvvData','uvvSumRowBlack','rowTyp','uvvSumRow','uvvSumCol','uvvSumColRed','uvvSumFound','uvvSumQua','sumQua','svSumFound','svSumQua','sumYear','jahr','show','spanne','kunden','kunde','uvvNowOverRow','monat','svData','svSumRow','svSumCol','svNowOverRow')); 
       
    }

    public function report1 (Request $request)
    {
        
        $now = Carbon::now();
        $monat = $now->month;
        $jahr = $now->year;
        
        if ($request->year) {
            $show =  $request->year;
        }
        else {
            $show = $jahr;
        }
        $rowMonth = collect(['jan','feb','mar','apr','mai','jun','jul','aug','sept','okt','nov','dez','summe']);
        $rowTyp = DB::table('Tbl_articles')->where('tbl_articles.id_artikeltyp' , '1')->whereNull('deleted_at')->get();
        
        // $mkzevents = Tbl_mkz_events::orderBy('created_at', 'desc')->select(['id_liftboy'])->distinct()->get('id_liftboy', 'created_at')->first();

        // $mkzevents = Tbl_mkz_events::where('id_artikeltyp' , '1')->orderBy('created_at', 'desc')->select('id_liftboy', 'created_at', 'id_article')->groupBy('id_liftboy')->get()->toArray() ;

        $mkzevents = DB::table('Tbl_mkz_events')
            ->leftjoin('Tbl_events', 'Tbl_mkz_events.id_test', '=', 'Tbl_events.id_event')
            ->leftjoin('Tbl_stammdaten', 'tbl_stammdaten.id_liftboy', '=', 'Tbl_mkz_events.id_liftboy')
            ->leftjoin('Tbl_articles', 'Tbl_articles.id_artikel', '=', 'Tbl_stammdaten.id_artikel')
            ->where('tbl_articles.id_artikeltyp' , '1') 
            ->where('Tbl_events.id_eventtyp' , '1')
            ->whereNull('tbl_stammdaten.deleted_at') 
            ->whereNull('tbl_events.deleted_at')
            // ->whereYear('Tbl_events.created_at', $jahr)      
            ->select('Tbl_mkz_events.id_liftboy','Tbl_mkz_events.id_article', 'Tbl_mkz_events.created_at')
            ->orderBy('Tbl_mkz_events.created_at', 'desc')->get()->groupBy('id_liftboy');
        // dd($mkzevents);
        return view('reports.report1',compact('mkzevents', 'rowTyp', 'rowMonth', 'jahr','show')); 
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
        
        
            
        // return view('mkz_events.index',compact('mkzevents', 'rowTyp', 'rowMonth', 'jahr','show')); 
       
    }



























    // das war ein versuch der scheiterte (alle daten in 1 Array zu schreiben)
    public function report3 (Request $request)
    {
        $now = Carbon::now();
        $monat = $now->month;
        $jahr = $now->year;
        
        if ($request->year) {
            $show =  $request->year;
        }
        else {
            $show = $jahr;
        }
        
        $rowMonth = collect(['jan','feb','mar','apr','mai','jun','jul','aug','sept','okt','nov','dez']);
        $rowTyp = DB::table('Tbl_articles')->where('tbl_articles.id_artikeltyp' , '1')->whereNull('deleted_at')->get();

        // $mkzevents = DB::table('Tbl_mkz_events')->orderBy('Tbl_mkz_events.created_at', 'desc')->distinct()->latest()
        // ->leftjoin('Tbl_stammdaten', 'tbl_stammdaten.id_liftboy', '=', 'Tbl_mkz_events.id_liftboy')
        // ->where('tbl_stammdaten.snnr', 'like' , '%D106%')
        // ->select('Tbl_mkz_events.id_liftboy','Tbl_stammdaten.baujahr')
        // ->get('Tbl_mkz_events.id_liftboy');



        // ('Tbl_mkz_events.id_liftboy','Tbl_mkz_events.id_article', 'Tbl_mkz_events.created_at','tbl_articles.int_einsatz','Tbl_stammdaten.baujahr', 'Tbl_sv.created_at as lastSvTestDatum')




        $mkzevents = DB::table('Tbl_mkz_events')
        ->orderBy('Tbl_mkz_events.created_at', 'desc')
        ->distinct()
        
        // ->where('Tbl_mkz_events.id_liftboy', 'like' , '%304%')
        ->leftjoin('Tbl_stammdaten', 'tbl_stammdaten.id_liftboy', '=', 'Tbl_mkz_events.id_liftboy')
        ->leftjoin('Tbl_articles', 'Tbl_articles.id_artikel', '=', 'Tbl_stammdaten.id_artikel')
        ->leftjoin('Tbl_events', 'Tbl_mkz_events.id_test', '=', 'Tbl_events.id_event')
            ->where('tbl_articles.id_artikeltyp' , '1') 
            ->where('Tbl_events.id_eventtyp' , '1')
            ->whereNull('tbl_stammdaten.deleted_at') 
            ->whereNull('Tbl_mkz_events.deleted_at')
        ->select('Tbl_mkz_events.id_liftboy','Tbl_stammdaten.baujahr')
        ->addSelect(['lastSvTestDatum' => function ($query) {
                $query->select('created_at')
                    ->from('Tbl_sv')
                    ->whereColumn('Tbl_sv.id_liftboy', '=', 'Tbl_mkz_events.id_liftboy');
                    // ->where('tbl_articles.id_artikeltyp' , '1');
            // ->limit(1)
            }])


        // ->addSelect(['baujahr' => function ($query) {
        //     $query->select('baujahr')
        //         ->from('tbl_stammdaten')
        //         ->whereColumn('tbl_stammdaten.id_liftboy', '=', 'Tbl_mkz_events.id_liftboy');
        // // ->limit(1)
        // }])
        // ->addSelect(['id_artikel' => function ($query) {
        //     $query->select('id_artikel')
        //         ->from('tbl_stammdaten')
        //         ->whereColumn('tbl_stammdaten.id_liftboy', '=', 'Tbl_mkz_events.id_liftboy');
        //         // ->where('tbl_articles.id_artikeltyp' , '1');
        // // ->limit(1)
        // }])
        // ->addSelect(['id_artikel' => function ($query) {
        //     $query->select('id_artikel')
        //         ->from('tbl_stammdaten')
        //         ->whereColumn('tbl_stammdaten.id_liftboy', '=', 'Tbl_mkz_events.id_liftboy');
        //         // ->where('tbl_articles.id_artikeltyp' , '1');
        // // ->limit(1)
        // }])
        // ->addSelect(['id_artikeltyp' => function ($query) {
        //     $query->select('id_artikeltyp')
        //         ->from('tbl_stammdaten')
        //         ->whereColumn('tbl_stammdaten.id_liftboy', '=', 'Tbl_mkz_events.id_liftboy');
        // // ->limit(1)
        // }])
        // ->addSelect(['id_artikeltyp' => function ($query) {
        //     $query->select('id_artikeltyp')
        //         ->from('Tbl_articles')
        //         ->whereColumn('Tbl_articles.id_artikel', '=', 'Tbl_stammdaten.id_artikel');
        //         // ->where('tbl_articles.id_artikeltyp' , '1') 
        // // ->limit(1)
        // }])
       
        ->get();

        


        // ->leftjoin('Tbl_articles', 'Tbl_articles.id_artikel', '=', 'Tbl_stammdaten.id_artikel')
        // ->leftjoin('Tbl_sv', 'Tbl_sv.id_liftboy', '=', 'Tbl_mkz_events.id_liftboy')
        // ->where('tbl_articles.id_artikeltyp' , '1') 
       
        // ->where('Tbl_events.id_eventtyp' , '1 OR 2')
        // ->whereNull('tbl_sv.deleted_at') 
        // ->whereNull('tbl_stammdaten.deleted_at') 
        // ->whereNull('tbl_articles.deleted_at') 
        // ->whereNull('tbl_events.deleted_at')
            
        // ->select('Tbl_mkz_events.id_liftboy','Tbl_mkz_events.id_article', 'Tbl_mkz_events.created_at','tbl_articles.int_einsatz','Tbl_stammdaten.baujahr', 'Tbl_sv.created_at as lastSvTestDatum')
        // ->orderBy('Tbl_mkz_events.created_at', 'desc')->get()->groupBy('id_liftboy');

        
        dd($mkzevents);
        
        
        
        ///////////////////JAHR///////////////
        // ------>   jan  ,  feb  ,  mar
        // art.1
        // art.2
        // art.3

        // create the main Show array [year][month][article][event] from year2000 to yearNow+10
        $showSpan = $jahr-2000+10;
        for ($i = 0; $i < $showSpan; $i++) {

            foreach($rowMonth as $mkey=>$month) {

                foreach($rowTyp as $tkey=>$typ) {

                    foreach($typ as $ekey=>$event) {

                        $uvvData[$i][$mkey][$typ->id_artikel]["uvv"] = null;
                        $uvvData[$i][$mkey][$typ->id_artikel]["sv"] = null;
                        $uvvData[$i][$mkey][$typ->id_artikel]["uvvOver"] = null;
                        $uvvData[$i][$mkey][$typ->id_artikel]["svOver"] = null;
    
                    }
                }
                
            }
            
            }
        // dd ($uvvData[0][0]);


        // create all Rows Data , based on active articles 
        foreach($rowTyp as $tkey=>$typ) {
            
            foreach($rowMonth as $mkey=>$month) {
                
                // $uvvData[0][$mkey] = null;
                // $uvvData[$typ->id_artikel][$mkey] = null;

                // $svData[0][$mkey] = null;
                // $svData[$typ->id_artikel][$mkey] = null;

                // //create Var - Row Sum 
                // $uvvSumRow[$tkey] = null;
                // $svSumRow[$tkey] = null;

                // //create Var - Over
                // $uvvNowOverRow[$tkey] = null;
                // $svNowOverRow[$tkey] = null;
                

            }
            
        }
        
        // dd($uvvData);
        
        foreach($rowMonth as $mkey=>$month) {
                
            // $uvvSumCol[$mkey] = null;
            // $svSumCol[$mkey] = null;

        }   
        
        
        foreach($svEvents as $event){

            $SvArticle = ($event->id_artikel)-1;
            $SvMonth = (date('m', strtotime($event->created_at)))-1;
            $svYear = (date('Y', strtotime($event->created_at)));
            $svErstellt = Carbon::parse($event->created_at);
            $baujahr = $event->baujahr;
            
            if ( $svErstellt->lessThan(Carbon::now()->subMonth(47)) )  {
                // wenn älter als 47 Monate dann....
                // $svNowOverRow[$isSvArticle] = $svNowOverRow[$isSvArticle]+1;
                
                }
                if ( $baujahr+4 >= $jahr )  {
                    
                }    
            
            if ($svYear+4-2000 == $show) {
                
                
                    
                $uvvData [$svYear][$SvMonth][$SvArticle]['sv'] = $uvvData [$svYear][$SvMonth][$SvArticle]['sv']+1;

                
                // $svSumRow[$isSvArticle] = $uvvSumRow[$isSvArticle]+1;
                // $svSumCol[$isSvMonth] = $uvvSumCol[$isSvMonth]+1;
                
                
            
                
            }
        }
        
        
        foreach($mkzevents as $gKey=>$group) {



            $target = $group->take(1);

            $isId = $target[0]->id_liftboy;
            $isArticle = ($target[0]->id_article)-1;
            
            $uvvErstelltJahr = (date('Y', strtotime($target[0]->created_at)));
            $uvvErstelltMonat = (date('m', strtotime($target[0]->created_at)))-1; 
            $uvvErstellt = Carbon::parse($target[0]->created_at);
            
            if ( $uvvErstellt->lessThan(Carbon::now()->subMonth(11)) )  {
                // wenn älter als 12 Monate dann....
                // $uvvNowOverRow[$isArticle] = $uvvNowOverRow[$isArticle]+1;
                }
            
            if ($uvvErstelltJahr == $show) {
                
                
                    
                // $uvvData [$isArticle][$uvvErstelltMonat] = $uvvData[$isArticle][$uvvErstelltMonat]+1;
                

                
                // $uvvSumRow[$isArticle] = $uvvSumRow[$isArticle]+1;
                // $uvvSumCol[$uvvErstelltMonat] = $uvvSumCol[$uvvErstelltMonat]+1;
                
                
            
                
            }
            
        }
        // dd($uvvNowOverRow);
        // $sumQua[0] = $uvvSumCol[0]+$uvvSumCol[1]+$uvvSumCol[2];
        // $sumQua[1] = $uvvSumCol[3]+$uvvSumCol[4]+$uvvSumCol[5];
        // $sumQua[2] = $uvvSumCol[6]+$uvvSumCol[7]+$uvvSumCol[8];
        // $sumQua[3] = $uvvSumCol[9]+$uvvSumCol[10]+$uvvSumCol[11];
        // $sumFound = $mkzevents->count();
        // $sumYear = array_sum($uvvSumCol);
        
        return view('reports.report2',compact('rowData','rowTyp','jahr','show','monat')); 
       
    }

























    



}
