@extends('Layouts.app')
@section('content')

    <div class="panel">
        <div class="panel-content">
            <div class="row">
                <div class="col-md-8">
                    <form class="form-horizontal form-stripe">
                        <h4 class="mb-xlg text-center"><b>Add New Brand Name</b></h4>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="brandName" placeholder="Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button id="brandAddbtn" type="submit" class="btn btn-primary">Save Brand</button>
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
  $('#brandAddbtn').click(function() {
    var brandName = $('#brandName').val();
    var brandSlug = $('#brandName').val();

    brandAddNewData(brandName, brandSlug);
  })

  function brandAddNewData(brandName, brandSlug) {
    if (brandName.length == 0) {
      toastr.error('Add Brand Name');
    } else {
      axios.post('/addBrand',{
          name: brandName,
          slug: brandSlug,
        })
        .then(function(response) {
          if (response.status == 200) {
            if (response.data == 1) {
              toastr.success('New Brand Added.');
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