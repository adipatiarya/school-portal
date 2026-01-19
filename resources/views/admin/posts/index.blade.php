@extends('layouts.admin')

@section('title', 'List Post')

@section('custom-css')
<link rel="stylesheet" type="text/css" href="{{asset('admin/assets/js/vendor/datatables/css/dataTables.bootstrap4.min.css')}}"/>
@endsection;

@section('content')
  <div class="container-fluid mb-5">
      <section>
          <h2 class="font-weight-bold mt-lg-5 mb-5 pb-4"><strong>Post list</strong></h2>
          <div class="row">
            
              <div class="col-md-12">                     
                  <div class="card">
                      <div class="card-body">
                          <table id="datatables" class="table table-striped table-bordered table-responsive-md" cellspacing="0" width="100%">
                              <thead>
                                <tr>
                                  <th>ID</th>
                                  <th>Title</th>
                                  <th>Content</th>
                                  <th>Categories</th>
                                  <th>Tags</th>
                                  <th>Created At</th>
                                  <th>Updated At</th>
                                </tr>
                              </thead>
                          </table>
                      </div>
                  </div>
              </div>
          </div>
      </section>

  </div>
@endsection


@section('custom-js')

<script type="text/javascript" src="{{asset('admin/assets/js/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/assets/js/vendor/datatables/js/dataTables.bootstrap4.min.js')}}"></script>

<script>
  
    $(document).ready(function() {
        $('#datatables').dataTable().fnDestroy();
        const columns =  [
              { data: 'id', name: 'id' },
              { data: 'title', name: 'title' },
              { data: 'content', name: 'content' },
              { data: 'categories', name: 'categories', render: function(data){
                  return data.join(', '); // tampilkan array kategori sebagai string
              }},
              { data: 'tags', name: 'tags', render: function(data){
                  return data.join(', '); // tampilkan array tag sebagai string
              }},
              { data: 'created_at', name: 'created_at' },
              { data: 'updated_at', name: 'updated_at' },
        ];

        var table= $('#datatables').DataTable({
          processing: true,       // tampilkan indikator loading
          serverSide: true,       // aktifkan server-side mode
          ajax: {
              url: "{{ route('admin.posts.index') }}",  // endpoint API Laravel
              type: 'GET',         // atau 'POST' sesuai kebutuhan
              data: function(dt) {
                 console.log(dt)
                 const params = {
                    draw: dt?.start,
                    length: dt?.length,
                    sorts: {
                       [columns[dt.order[0]?.column]?.data]:dt.order[0].dir
                    },
                    
                };
                
                if(dt.search.value) {
                  Object.assign(params, {search: dt.search.value })
                }
                return params;
              }
          },
          
          columns
        });
    });

    // Material Select Initialization
    $(document).ready(function () {
        $('select[name="datatables_length"]').material_select();
    });
</script>
@endsection