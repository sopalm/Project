      <script>
          $(document).ready(function() {
              $('#tablepage-span').DataTable();
          } );
          $('#tablepage-span').dataTable( {
              searching: true
          } );

          $(document).ready(function() {
              $('#tablepage').DataTable();
          } );
          $('#tablepage').dataTable( {
              searching: false
          } );
          $(document).ready(function() {
              $('#tablepage-doctor').DataTable();
          } );
          var tableexcel = $('#tablepage-doctor').dataTable( {
              dom: 'lBrtip',
                buttons: [
                    'print',
                    'excel'
                ]
              
          } );
          $(document).ready(function() {
              $('#tablepage-page').DataTable();
          } );
          $('#tablepage-page').dataTable( {
              searching: false,
              paging:   false,
              ordering: true,
              info:     false
          } );
          $(document).ready(function() {
              $('#tablepage-page2').DataTable();
          } );
          $('#tablepage-page2').dataTable( {
              searching: false,
              paging:   false,
              ordering: true,
              info:     false
          } );
          
          $(document).ready(function() {
              // Setup - add a text input to each footer cell
              $('#example tfoot th').each( function () {
                  var title = $(this).text();
                  $(this).html( '<input class="dtb" type="text" placeholder="'+title+'" />' );
              } );
           
              // DataTable
              var table = $('#example').DataTable({
                searching: true,
                "aaSorting": [],
              });
           
              // Apply the search
              table.columns().every( function () {
                  var that = this;
           
                  $( 'input', this.footer() ).on( 'keyup change', function () {
                      if ( that.search() !== this.value ) {
                          that
                              .search( this.value )
                              .draw();
                      }
                  } );
              } );
              } );

          $(document).ready(function() {
              // Setup - add a text input to each footer cell
              $('#example1 tfoot th').each( function () {
                  var title = $(this).text();
                  $(this).html( '<input class="dtb" type="text" placeholder="'+title+'" />' );
              } );
           
              // DataTable
              var table1 = $('#example1').DataTable({
                searching: true,
                "aaSorting": [],
              });
           
              // Apply the search
              table1.columns().every( function () {
                  var that = this;
           
                  $( 'input', this.footer() ).on( 'keyup change', function () {
                      if ( that.search() !== this.value ) {
                          that
                              .search( this.value )
                              .draw();
                      }
                  } );
              } );
          } );

          $(document).ready(function() {
              // Setup - add a text input to each footer cell
              $('#example2 tfoot th').each( function () {
                  var title = $(this).text();
                  $(this).html( '<input class="dtb" type="text" placeholder="'+title+'" />' );
              } );
           
              // DataTable
              var table = $('#example2').DataTable({
                searching: true,
                "aaSorting": []
              });
           
              // Apply the search
              table.columns().every( function () {
                  var that = this;
           
                  $( 'input', this.footer() ).on( 'keyup change', function () {
                      if ( that.search() !== this.value ) {
                          that
                              .search( this.value )
                              .draw();
                      }
                  } );
              } );
          } );
          $(document).ready(function() {
              // Setup - add a text input to each footer cell
              $('#example3 tfoot th').each( function () {
                  var title = $(this).text();
                  $(this).html( '<input class="dtb" type="text" placeholder="'+title+'" />' );
              } );
           
              // DataTable
              var table = $('#example3').DataTable({
                searching: true
              });
           
              // Apply the search
              table.columns().every( function () {
                  var that = this;
           
                  $( 'input', this.footer() ).on( 'keyup change', function () {
                      if ( that.search() !== this.value ) {
                          that
                              .search( this.value )
                              .draw();
                      }
                  } );
              } );
          } );


          $(document).ready(function() {
            $('.edit-sup').click(function(){
                        var supID = $(this).attr('data-supID');
                        var supName = $(this).attr('data-supName');
                        var tag = $(this).attr('data-tag');
                        $('#supID').val(supID);
                        $('#supName').val(supName);
                         $('#tag').val(tag);
                } );
            } );
      </script>