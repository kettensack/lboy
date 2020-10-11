@if(!isset($data))	
@endif
<style>
	table {
	font-size: 9px;
	/* font-family: Impact, Charcoal, sans-serif; */
	}
	th {
	font-size: 9px;
	/* font-family: Impact, Charcoal, sans-serif; */
	}    
</style>
  
<table>
	
	<tr>
		<th width="80%"><H3>Wiederkehrende Prüfung durch den Sachkundigen DGUV Vorschrift 54</H3></th>
		<th width="20%"><img src="/img/NM_Logo_Typo_rechts_RGB.jpg" width="150" height="44"></th>
	</tr>
	<tr>
		<th><p>Prüfprotokoll für die Durchführung der Prüfung nach DGUV Grundsatz 309-008. (Anlage zum Prüfbuch)</p></th>	
	</tr>
	<tr><th></th></tr>
	<tr><th></th></tr>
</table>

<table  border="1" cellspacing="0">
	<tr>
		<th><b>Inventar-Nr:</b></th>
		<th>@if ((isset($data))) {{$data->id_club}} @endif</th>
		<th rowspan="2"><p>@if ((isset($data))) {{$data->traglast}} {{$data->norm}} {{$data->einsatz}} @endif</p></th>
		<th rowspan="2">@if ((isset($data))){{$data->id_club}} @endif</th>
	</tr>
	<tr>
		<td><b>Seriennummer:</b></td>
		<td>@if ((isset($data))){{$data->snnr}}@endif</td>
	</tr>
</table>

<br>
<br> 

{{-- CONTENT HEAD --}}

<table  border="0" width="100%">	
	<tbody>
	<tr>
		<th width="10%"><b>1.</b></th>
		<th width="50%"><b>Dokumentation</b></th>
		<th width="20%"> i.o.</th>
		<th width="20%"></th>
	</tr>
	<tr>
		<td>1.1.</td>
		<td>CE Konformitätserklärung</td>
	</tr>
	<tr>
		<td>1.1.1.</td>
		<td>Prüfbuch , Betriebsanleitung</td>
	</tr>
	<tr><td></td></tr>
	<tr>
		<th><b>1.2.</b></th>
		<th><b>Kennzeichnung</b></th>
		<th> i.o.</th>    
	</tr>
	<tr>
		<td>1.2.1.</td>
		<td>Typenschild / Seriennummer</td>
	</tr>
	<tr>
		<td>1.2.2.</td>
		<td>Typenkennzeichnung nach SQP2</td>
	</tr>
	<tr><td></td></tr>
	<tr>
		<th><b>1.3. </b></th>
		<th><b>Tragkonstruktion</b></th>
		<th> i.o.</th>    
	</tr>
	<tr>
		<td>1.3.1.</td>
		<td>Haltegriffe</td>
	</tr>
	<tr>
		<td>1.5.5.</td>
		<td>Lasthaken / Maßhaltigkeit</td>
	</tr>
	<tr>
		<td>1.5.6.</td>
		<td>Sperrlinke am Lasthaken / Spannfeder</td>
	 </tr>
	<tr><td></td></tr>
	<tr>
		<th><b>1.4. </b></th>
		<th><b>Ausrüstung</b></th>
		<th> i.o.</th>     
	</tr>
	<tr>
		<td>1.4.1.</td>
		<td>Getriebe- / Bremskappen</td>
	</tr>
	  <tr>
		<td>1.4.2.</td>
		<td>Gehäuse + Getriebedeckel</td>
	</tr>
	  <tr>
		<td>1.4.3.</td>
		<td>Zugentlastung,Anschlusskabel</td>
	</tr>
	  <tr>
		<td>1.4.4.</td>
		<td>CEE Stecker</td>
	</tr>
	  <tr>
		<td>1.4.5.</td>
		<td>VDE Prüfung</td>
	</tr>
	  <tr>
		<td>1.4.6.</td>
		<td>Kettenspeicher, Befestigung</td>
	</tr>
	  <tr>
		<td>1.4.7.</td>
		<td>Sekundärsicherung, Kettenspeicher</td>
	</tr>
	  <tr>
		<td>1.4.8.</td>
		<td>Kettenführungsplatte, Niederhalter</td>
	</tr>
	  <tr>
		<td>1.4.9.</td>
		<td>Aufhängeöse</td>
	</tr>
	  <tr>
		<td>1.4.10.</td>
		<td>Befestigungsbolzen der Aufhängeöse / Splinte</td>
	</tr>
	<tr><td></td></tr>
	<tr>
		<th><b>1.5.</b></th>
		<th><b>Tragmittel</b></th>
		<th> i.o.</th>     
	</tr>
	<tr>
		<td>1.5.1.</td>
		<td>Rundstahlkette (Verformung, Anrisse, Korrosionsnarben)</td>
	</tr>
	<tr>
		<td>1.5.2.</td>
		<td>Kettenschmierung</td>
	</tr>
	  <tr>
		<td>1.5.3.</td>
		<td>Abnahme Gliederdicke durch Verschleiß im Toleranzbereich</td>
	</tr>
	<tr>
		<td>1.5.4.</td>
		<td>Lasthakengeschirr, Sicherung Schalenschrauben</td>
	</tr>
	
	<tr>
		<td>1.5.7.</td>
		<td>Hubbegrenzer Schalenschrauben, Sicherungslack</td>
	</tr>
	<tr>
		<td>1.5.8.</td>
		<td>Gummipuffer am Hubbegrenzer</td>
	</tr>
	<tr><td></td></tr>
	<tr>
		<th><b>1.6.</b></th>
		<th><b>Sicherheitseinrichtungen</b></th>
		<th></th>    
	</tr>
	<tr>
		<td>1.6.</td>
		<td>Bremse 1 Justage</td>
		@if ((isset($request->cbx_bremse1)) && ($request->cbx_bremse1 == 1))<td> ja </td> 
		@else <td> nein </td>
		@endif
		
	</tr>
	 <tr>
		<td>1.6.</td>
		<td>Bremse 2 Justage</td>
		@if ((isset($request->cbx_bremse2)) && ($request->cbx_bremse2 == 1))<td> ja </td> 
		@else <td> nein </td>
		@endif
		
	</tr>
	<tr>
		<td>1.6.3.</td>
		<td>Funktionsprüfung Kupplung</td>
		<td> i.o.</td>
		<td>m.130%-160% Nennlast</td>
	</tr>
	<tr>
		<td>1.6.4.</td>
		<td>Lastprüfung Bremse</td>
		<td> i.o.</td>
		<td>m.125% Nennlast</td>
	</tr>
	<tr>
		<td>1.6.5.</td>
		<td>Lastprüfung Bremse 2 </td>
		<td> i.o.</td>
		<td>m.125% Nennlast</td>
	</tr>  
	<tr>
		<td>1.6.6.</td>
		<td>Lastprüfung bestanden </td>
		<td> i.o.</td>
	</tr>  
	<tr>
		<td>1.6.1.</td>
		<td>Prüfung der Bremse & Kupplung laut Prüfanweisung Elektrokettenzug D8 und D8+ von N&M</td>
		<td> i.o.</td>
	</tr>
</tbody>
</table>
<br>
<hr>
<br>
<table  border="0" cellspacing="0">
	<tr>
		<th width="30%"><b>Prüfdatum</b></th>
		<th width="30%"><b>Befund</b></th>
		<th width="20%"><b>Unterschrift des Sachkundigen</b></th>
		<th width="20%"></th>
	</tr>
	<tr>
		<td><p>@if ((isset($heute))){{$heute}}@endif</p></td>
		<td><p>Geprüft von: {{ Auth::user()->name }}</p></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td><img src="/img/image002.jpg" width="100" height="60"></td>
		<td><img src="/img/image003.jpg" width="100" height="60"></td>
	</tr>
</table>
<br> 




{{-- <table border="1" width="100%" cellpadding="10" >
	<tr>
		<th width="10%">SNo.</th>
		<th width="40%">Name</th>
		<th width="50%">{{$heute}}</th>
	</tr>
 
	
 
		<tr>
			<td align="center">{{$heute}}</td>
			<td> {{$data}}</td>
			<td>{{$i}}</td>
		</tr>
 
		@if(!isset($data))	
		@endif
 
</table> --}}
 
