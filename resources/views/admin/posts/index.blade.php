@extends('layouts.admin')

@section('title', 'List Post')

@section('custom-css')
<link rel="stylesheet" type="text/css" href="{{asset('admin/assets/js/vendor/datatables/css/dataTables.bootstrap4.min.css')}}"/>
@endsection;

@section('content')
  <div class="container-fluid mb-5">
      <section>
        
           <!--Top Table UI-->
          <div class="card p-2 mb-5">

              <!--Grid row-->
              <div class="row">
                  <!--Grid column-->
                  <div class="col-lg-3 col-md-12">

                      <!--Name-->
                      <select class="mdb-select colorful-select dropdown-primary mx-2 md-form mt-3">
                      <option value="" disabled selected>Bulk actions</option>
                      <option value="1">Delete</option>
                      <option value="2">Export</option>
                  </select>

                  </div>
                  <!--Grid column-->

                  <!--Grid column-->
                  <div class="col-lg-3 col-md-6">

                      <!--Blue select-->
                      <select class="mdb-select colorful-select dropdown-primary mx-2 md-form mt-3" multiple>
                        <option value="" disabled selected>Filter by Categories</option>
                        <option value="2">Never opened <span> (200)</span></option>
                        <option value="3">Opened but unanswered <span> (1800)</span></option>
                        <option value="4">Answered <span> (200)</span></option>
                        <option value="5">Unsunscribed <span> (50)</span></option>
                      </select>
                      <!--/Blue select-->

                  </div>
                  <!--Grid column-->

                  <!--Grid column-->
                  <div class="col-lg-3 col-md-6">

                      <!--Blue select-->
                      <select class="mdb-select colorful-select dropdown-primary mx-2 md-form mt-3" multiple>
                        <option value="" disabled selected>Filter by Tags</option>
                        <option value="1">Contacts in no segments <span> (100)</span></option>
                        <option value="1">Segment 1 <span> (2000)</span></option>
                        <option value="2">Segment 2 <span> (1000)</span></option>
                        <option value="3">Segment 3 <span> (4000)</span></option>
                      </select>
                      <!--/Blue select-->

                  </div>
                  <!--Grid column-->

                  <!--Grid column-->
                  <div class="col-lg-3 col-md-6">

                      <form class="form-inline md-form mt-2 ml-2">
                          <input class="form-control mt-2" type="text" placeholder="Search" style="max-width: 150px;">
                          <button class="btn btn-sm btn-primary ml-2 px-1"><i class="fa fa-search"></i>  </button>
                      </form>

                  </div>
                  <!--Grid column-->

              </div>
              <!--Grid row-->

          </div>
                <!--Top Table UI-->
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
          searching: false,
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
        $('.mdb-select').material_select();
    });
</script>
@endsection