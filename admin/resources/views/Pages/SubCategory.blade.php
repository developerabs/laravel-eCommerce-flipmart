@extends('Layouts.app')
@section('content')

<div class="panel">
  <div class="panel-content">
    <div class="row">
      <div class="col-md-8">
        <form class="form-horizontal form-stripe">
          <h4 class="mb-xlg text-center"><b>Add New Category Name</b></h4>
          <div class="form-group">
            <label for="parentCatData" class="col-sm-4 control-label">Parent Category</label>
            <div class="col-sm-8">
              <select name="parentCatData" id="parentCatData" class="form-control">
              <option value="">Select Option</option>
                @foreach($cat_data as $row)
                  <option value="{{ $row->id }}">{{ $row->category_name }}</option>
                @endforeach
              </select>
            </div>
            <label for="categoryName" class="col-sm-4 control-label sub-cat">Sub Category</label>
            <div class="col-sm-8 sub-cat">
              <input type="text" class="form-control" id="subCategoryName" placeholder="Category Name">
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button id="subCategoryAddbtn" type="submit" class="btn btn-primary">Save Category</button>
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
  $('#subCategoryAddbtn').click(function() {
    var parentCatData = $('#parentCatData').val();
    var subCategoryName = $('#subCategoryName').val();

    subCategoryAddNewData(parentCatData, subCategoryName);
  })

  function subCategoryAddNewData(parentCatData, subCategoryName) {
    if (parentCatData.length == 0) {
      toastr.error('Select Parent Category Name');
    }else if(subCategoryName.length == 0){
      toastr.error('Add Category Name');
    } else {
      axios.post('/categorys/addSubcategorys', {
          parentCatId: parentCatData,
          subCat: subCategoryName,
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
          toastr.error('Somthing want wrong. abu bakkar siddik');
        });
    }

  }
</script>
@endsection