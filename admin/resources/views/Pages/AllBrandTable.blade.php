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
<input type="checkbox" data-toggle="toggle" data-on="Enabled" data-off="Disabled">
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
<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog p-5" role="document">
    <div class="modal-content p-5" id="modal_body">
      <h6 id="brandEditId" class="d-none"></h6>
      <h5 class="mb-4">Update Service</h5>
      <div id="serviceEditeForm" class="d-none">
        <input type="text" id="brandNameId" class="form-control mb-4 d-block">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button>
        <button id="brandUpdateConfirmbtn" type="button" class="btn btn-sm btn-danger">Update</button>
      </div>
    </div>
  </div>
</div>

 @endsection           

@section('script')
<script type="text/javascript">
getBrandTableData();
  function getBrandTableData() {
    axios.get('/brand/getAllBrand')
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
                "<td><a class='btn btn-primary btn-xs activeInactiveBtn' data-id=" + jasonData[i].id + " ><i class='fa fa-arrow-up'></i></a><a class='btn btn-warning btn-xs editBrandBtn' data-id=" + jasonData[i].id + " ><i class='fa fa-pencil'></i></a><a class='btn btn-danger btn-xs deleteBrandBtn' data-id=" + jasonData[i].id + " ><i class='fa fa-trash-o'></i></a></td>"
                
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
          $('.editBrandBtn').click(function() {
            var id = $(this).data('id');
            $('#brandEditId').html(id);
            brandUpdateDetails(id);
            $('#editModal').modal('show');

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
    axios.post('/brand/brandActiveInactive', {
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
    axios.post('/brand/deleteBrand', {
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

  function brandUpdateDetails(detailsId) {
    axios.post('/brand/brandUpdateDetails', {
        id: detailsId
      })
      .then(function(response) {
        if (response.status == 200) {
          var jasonData = response.data;
          $('#brandNameId').val(jasonData[0].brand_name);
        } else {
          toastr.error('Somthing want wrong.');

        }
      })
      .catch(function(error) {
        toastr.error('Somthing want wrong.');
      });
  }
   $('#brandUpdateConfirmbtn').click(function() {
    var id = $('#brandEditId').html();
    var name = $('#brandNameId').val();

    brandUpdateConfirmbtn(id, name);
  })
  function brandUpdateConfirmbtn(id, brandName) {
    if (brandName.length == 0) {
      toastr.error('Brand Name is Empty!.');
    } else {
      axios.post('/brand/brandUpdateConfirm', {
          id: id,
          brandName: brandName
        })
        .then(function(response) {
          $('#serviceUpdateConfirmbtn').html("Update");
          if (response.status == 200) {
            if (response.data == 1) {
              $('#editModal').modal('hide');
              toastr.success('Update Success.');
              getBrandTableData();
            } else {
              $('#editModal').modal('hide');
              toastr.error('Update Fail.');
              getBrandTableData();
            }
          } else {
            $('#editModal').modal('hide');
            toastr.error('Somthing want wrong.');
          }
        })
        .catch(function(error) {
          $('#editModal').modal('hide');
          toastr.error('Somthing want wrong.');
        });
    }

  }
</script>
@endsection