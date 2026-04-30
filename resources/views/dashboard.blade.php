@include('layout.header')

<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row g-6 mb-6">
    <!-- Total Products -->
    <div class="col-xxl-2 col-md-2 col-sm-3">
      <div class="card h-100">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
            <div class="avatar">
              <div class="avatar-initial bg-label-primary rounded-3">
                <i class="ri-task-line ri-24px"></i>
              </div>
            </div>
          </div>
          <div class="card-info mt-5">
            <h5 class="mb-1">{{ $totalProducts }}</h5>
            <p>Total Products</p>
          </div>
        </div>
      </div>
    </div>
    <!--/ Total Products -->
    
    @php 
    if (session()->has('type') && session()->get('type') === 'admin'):         
    @endphp
    <!-- Total Users -->
    <div class="col-xxl-2 col-md-2 col-sm-3">
      <div class="card h-100">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
            <div class="avatar">
              <div class="avatar-initial bg-label-success rounded-3">
                <i class="ri-user-line ri-24px"></i>
              </div>
            </div>
          </div>
          <div class="card-info mt-5">
            <h5 class="mb-1">{{ $totalAccounts }}</h5>
            <p>Total Accounts</p>
          </div>
        </div>
      </div>
    </div>
    <!--/ Total Users -->
    @php
        endif;
    @endphp
    
  </div>
</div>
<!-- / Content -->

@include('layout.footer')
