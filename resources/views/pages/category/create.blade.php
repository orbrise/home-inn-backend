<div class="panel">
    <!-- Records Header Start -->
    <div class="records--header">
        <div class="title fa-shopping-bag">
            <h3 class="h3">Create New Categories </h3>
            <p>Found Total 1,330 Categories</p>
            <form method="post" action="{{ url('customers/addcategory')}}" enctype="multipart/form-data">
                {{csrf_field()}}

                <input type="hidden" name="level" value="{{ $level }}">
                <input type="hidden" name="catid" value="{{ $catid }}">
                <input type="hidden" name="shopid" value="{{ $shopid }}">
                <input type="hidden" name="id" value="{{ $id }}">


            <div class="form-inline">
                    <label class="mr-3  mb-3">
                        <span class="label-text sr-only">Category Name</span>
                        <input type="text" name="catname" placeholder="Enter Category Name" class="form-control">
                    </label>

                    

                    <label class="mr-3  mb-3 ">
                        <span class="label-text sr-only">Category Logo</span>
                        <input type="file" name="catimg"  class="form-control">
                    </label>

                    

                    <input type="submit" value="Submit" class="btn btn-sm btn-rounded btn-success mr-2  mb-3">
                    <button type="button" class="btn btn-sm btn-rounded btn-outline-secondary mb-3">Cancel</button>
                </div>
        </div>

    </div>
    <!-- Records Header End -->
</div>