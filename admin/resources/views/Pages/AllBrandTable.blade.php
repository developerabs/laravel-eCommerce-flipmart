@extends('Layouts.app')
@section('content')
<div class="content-header">
                <!-- leftside content header -->
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Tables</a></li>
            <li><a>Data-table</a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInRight">
    <div class="col-sm-12">
        <h4 class="section-subtitle"><b>Searching, ordering and paging</b></h4>
        <div class="panel">
            <div class="panel-content">
                <div class="table-responsive">
                    <table id="basic-table" class="data-table table table-striped nowrap table-hover" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody id="brand_table">
                   
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

 @endsection           

@section('script')
<script type="text/javascript">
getBrandTableData();
  function getBrandTableData() {
    axios.get('/getAllBrand')
      .then(function(response) {
        if (response.status == 200) {
            $('#basic-table').DataTable().destroy();
            $('#brand_table').empty();
          var jasonData = response.data;
          let a = 1;
          $.each(jasonData, function(i, item) {
            let statusdata =(jasonData[i].status ==1) ? 'Active':'Inactive';
            $('<tr>').html(
                "<td>" + a + "</td>" +
                "<td>" + jasonData[i].brand_name + "</td>" +
                "<td>" + jasonData[i].brand_slug + "</td>" +
                "<td>" + statusdata + "</td>" +
                "<td><a class='btn btn-primary btn-xs activeInactiveBtn' data-id=" + jasonData[i].id + " ><i class='fa fa-arrow-up'></i></a><a class='btn btn-warning btn-xs' data-id=" + jasonData[i].id + " ><i class='fa fa-pencil'></i></a><a class='btn btn-danger btn-xs deleteBrandBtn' data-id=" + jasonData[i].id + " ><i class='fa fa-trash-o'></i></a></td>"
                
            ).appendTo('#brand_table');
          a++;
          });
          $('.activeInactiveBtn').click(function() {
             var id = $(this).data('id');
             brandActiveInactive(id);
          })
          $('.deleteBrandBtn').click(function() {
             var id = $(this).data('id');
             deleteBrand(id);
          })
          $('#basic-table').DataTable({"order":false});
          $('.dataTables_length').addClass('bs-select');

        } else {
          toastr.error('Somthing want wrong.');
        }

      })
      .catch(function(error) {
        toastr.error('Somthing want wrong.');
      });
  } 

    //service confirm delete


  function brandActiveInactive(brandId) {
    axios.post('/brandActiveInactive', {
        id: brandId
      })
      .then(function(response) {
        if (response.status == 200) {
          if (response.data == 1) {
            toastr.success('Brand Status is Changed');
            getBrandTableData();
          } else {
            toastr.error('Somthing want wrong.');
          }
        }
      })
      .catch(function(error) {
        toastr.error('Somthing want wrong.');
      });
  }
  function deleteBrand(brandId) {
    axios.post('/deleteBrand', {
        id: brandId
      })
      .then(function(response) {
        if (response.status == 200) {
          if (response.data == 1) {
            toastr.success('Brand Delete Success');
            getBrandTableData();
          } else {
            toastr.error('Delete Fail.');
          }
        }
      })
      .catch(function(error) {
        toastr.error('Somthing want wrong.');
      });
  }
</script>
@endsection