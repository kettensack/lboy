<style>
    thead input {
        width: 100%;
    }
</style>    
<html lang="en">
    <head>
        <title>Laravel DataTables Tutorial Example</title>
            <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">  
            <link  href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
            <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
            <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/fixedheader/3.1.7/js/dataTables.fixedHeader.min.js"></script>
            
    
    </head>
          <body>
            <div class="container">    
                <br />
                <h3 align="center">Artikel</h3>
                <br />
                <div align="right">
                    <button type="button" name="create_record" id="create_record" class="btn btn-success btn-sm">Create Record</button>
                </div>
                <br />
              <div class="table-responsive">
                    <table class="table table-bordered" id="article_table" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>id_artikel</th>
                            <th>Traglast</th>
                            <th>Norm</th>
                            <th>Einsatz</th>
                            <th>bez_artikeltyp</th>
                            <th>bez_ravel</th>
                            <th>bez_hersteller</th>
                            <th>bez_mo2</th>
                            <th>Action</th>
                        </tr>
					</thead>
				</table>
			</div>
			<br />
			<br />
		</div>
	</body>
</html>

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

<script>
    $(function() {
          $('#article_table').DataTable({
          processing: true,
          serverSide: true,
          ajax: '{{ url('index') }}',
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
    });
    
   $(document).on('click', '.delete', function(){
       article_id = $(this).attr('id');
       $('#confirmModal').modal('show');
   });

   $('#ok_button').click(function(){
       $.ajax({
           url:"article/destroy/"+article_id,
           beforeSend:function(){
               $('#ok_button').text('Deleting...');
           },
           success:function(data)
           {
               setTimeout(function(){
                   $('#confirmModal').modal('hide');
                   $('#article_table').DataTable().ajax.reload();
                   alert('Data Deleted');
               }, 2000);
           }
       })
   });
    </script>

              

           
             
   