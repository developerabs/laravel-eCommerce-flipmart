@extends('Layouts.app')
@section('content')

<div class="panel">
  <div class="panel-content">
    <div class="row">
      <div class="col-md-8">
        <form class="form-horizontal form-stripe">
          <h4 class="mb-xlg text-center"><b>Add New Category Name</b></h4>
          <div class="form-group">
            <label for="categoryName" class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="categoryName" placeholder="Category Name">
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button id="categoryAddbtn" type="submit" class="btn btn-primary">Save Category</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
  // catch add new service data 
  $('#categoryAddbtn').click(function() {
    var categoryName = $('#categoryName').val();
    var categoryslug = $('#categoryName').val();

    categoryAddNewData(categoryName, categoryslug);
  })

  function categoryAddNewData(categoryName, categoryslug) {
    if (categoryName.length == 0) {
      toastr.error('Add Category Name');
      alert(categoryName);
    } else {
      axios.post('/categorys/addcategorys', {
          catName: categoryName,
          catSlug: categoryslug,
        })
        .then(function(response) {
          if (response.status == 200) {
            if (response.data == 1) {
              toastr.success('New Category Added.');
            } else {
              toastr.error('Added fail.');
            }
          } else {
            toastr.error('Somthing want wrong.');
          }
        })
        .catch(function(error) {
          toastr.error('Somthing want wrong.');
        });
    }

  }
</script>
@endsection