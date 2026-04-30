@include('layout.header')

<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Responsive Datatable -->
    <div class="card">
        <div class="card-datatable table-responsive pt-0">
            <table class="dt-scrollableTable table table-bordered text-nowrap" id="products_table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Register Date</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th class="text-nowrap">Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <!--/ Responsive Datatable -->

    <!-- Modal to add new record -->
    <div class="offcanvas offcanvas-end" id="add-new-products-record">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title" id="exampleModalLabel">New Product</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body flex-grow-1">
            <form class="add-new-products-record pt-0 row g-3" id="form-add-new-products-record" method="POST" action="{{ url('/products/add') }}" onsubmit="return false;">
                @csrf
                <div class="col-sm-12">
                    <div class="input-group input-group-merge">
                        <span id="title0" class="input-group-text"><i class='ri-file-list-3-line ri-18px'></i></span>
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="title" class="form-control" name="title" placeholder="Product Title" aria-label="Product Title" aria-describedby="title0" />
                            <label for="title">Title</label>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="input-group input-group-merge">
                        <span id="description0" class="input-group-text"><i class='ri-house-line ri-18px'></i></span>
                        <div class="form-floating form-floating-outline">
                            <textarea class="form-control h-px-100" id="description" name="description" placeholder="Product Description" rows="2" aria-describedby="description0" rows="2" aria-describedby="description0" rows="3"></textarea>
                            <label for="description">Description</label>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="input-group input-group-merge">
                        <span id="price0" class="input-group-text"><i class="ri-money-rupee-circle-line"></i></span>
                        <div class="form-floating form-floating-outline">
                            <input type="number" id="price" class="form-control" name="price" placeholder="12000" aria-label="12000" aria-describedby="price0" />
                            <label for="price">Price</label>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="input-group input-group-merge">
                        <span id="date_available0" class="input-group-text"><i class='ri-calendar-line ri-18px'></i></span>
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="date_available" class="form-control datepicker_all" name="date_available" placeholder="Select Date" aria-label="Select Date" aria-describedby="date_available0" readonly />
                            <label for="date_available">Date Available</label>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary data-submit me-sm-4 me-1">Submit</button>
                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- / Content -->

@include('layout.footer')
