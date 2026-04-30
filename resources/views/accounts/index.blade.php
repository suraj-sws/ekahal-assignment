@include('layout.header')

<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Responsive Datatable -->
    <div class="card">
        <div class="card-datatable table-responsive pt-0">
            <table class="dt-scrollableTable table table-bordered text-nowrap" id="accounts_table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Login Type</th>
                        <th>Register Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <!--/ Responsive Datatable -->
</div>
<!-- / Content -->

@include('layout.footer')
