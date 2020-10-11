@extends('layouts.app')



@section('content')
<div class="container">    
    {{-- <br />
    <h3 align="center">Artikel</h3>
    <br />    
    <br /> --}}
        <div class="table-responsive-md">
            <table class="table table-bordered table-hover" id="article_table" style="width:100%" cellpadding="0" cellspacing="0" border="0">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Traglast</th>
                        <th>Norm</th>
                        <th>Einsatz</th>
                        <th>artikeltyp</th>
                        <th>name</th>
                        <th>name</th>
                        <th>name</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>                            
	<br />
    <br />
    <div align="right">
        <button type="button" name="create_record" id="create_record" class="btn btn-success btn-sm">Create Record</button>
    </div>
</div>
<div id="confirmModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2 class="modal-title">Confirmation</h2>
            </div>
            <div class="modal-body">
                <h4 align="center" style="margin:0;">Are you sure you want to remove this data?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});    
$(document).ready(function(){

$('#article_table').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: "{{ route('articleIndex') }}",
        
    },
    columns: [
                   { data: 'id_artikel', name: 'tbl_articles.id_artikel' },
                   { data: 'traglast', name: 'tbl_articles.traglast' },
                   { data: 'norm', name: 'tbl_articles.norm' },
                   { data: 'einsatz', name: 'tbl_articles.einsatz' },
                   { data: 'bez_artikeltyp', name: 'tbl_article_typ.bez_artikeltyp' },
                   { data: 'bez_ravel', name: 'tbl_articles.bez_ravel' },
                   { data: 'bez_hersteller', name: 'tbl_articles.bez_hersteller' },
                   { data: 'bez_mo2', name: 'tbl_articles.bez_mo2' },
                   { data: 'action', name: 'action', orderable: false }
                   
                ]
});
    
   $(document).on('click', '.delete', function(){
       id = $(this).attr('id');
       $('#confirmModal').modal('show');
   });

   $('#ok_button').click(function(){
    var token = $("meta[name='csrf-token']").attr("content");
   
   $.ajax(
   {
       url: "article/"+id,
       beforeSend:function(){
				$('#ok_button').text('Deleting...');
			},
       type: 'DELETE',
       data: {
           "id": id,
           "_token": token,
       },
       success:function(data)
			{
				
                    $('#confirmModal').modal('hide');
                    $('#ok_button').text('Delete');
					$('#article_table').DataTable().ajax.reload();
					
				
			}
   });
  
           
     
	});

});
</script>
@endpush