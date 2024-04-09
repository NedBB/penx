<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row">
    <div class="col-xl-4 mb-4 col-lg-5 col-12">
      <div class="card">
        <div class="d-flex align-items-end row">
          <div class="col-7">
            <div class="card-body text-nowrap">
              <h5 class="card-title mb-0">Hello <span class="text-capitalize bold">{{auth()->user()->username}}</span>! 🎉</h5>
              <p class="mb-2">Welcome to Nigeria Union of Pensioners </p>
              {{-- <h4 class="text-primary mb-1">$48.9k</h4>
              <a href="javascript:;" class="btn btn-primary waves-effect waves-light">View Sales</a>
             --}}
            </div>
          </div>
          <div class="col-5 text-center text-sm-left">
            <div class="card-body pb-0 px-0 px-md-4">
              
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-8 mb-4 col-lg-7 col-12">
      <div class="card h-100">
        <div class="card-header">
          <div class="d-flex justify-content-between mb-3">
            <h5 class="card-title mb-0">Statistics</h5>
            <small class="text-muted">Today</small>
          </div>
        </div>
        <div class="card-body">
          <div class="row gy-3">
            <div class="col-md-3 col-6">
              <div class="d-flex align-items-center">
                <div class="badge rounded-pill bg-label-primary me-3 p-2">
                  <i class="ti ti-chart-pie-2 ti-sm"></i>
                </div>
                <div class="card-info">
                  <h5 class="mb-0">{{$staff}}</h5>
                  <small>Staff</small>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-6">
              <div class="d-flex align-items-center">
                <div class="badge rounded-pill bg-label-info me-3 p-2">
                  <i class="ti ti-users ti-sm"></i>
                </div>
                <div class="card-info">
                  <h5 class="mb-0">{{$national}}</h5>
                  <small>National</small>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-6">
              <div class="d-flex align-items-center">
                <div class="badge rounded-pill bg-label-danger me-3 p-2">
                  <i class="ti ti-shopping-cart ti-sm"></i>
                </div>
                <div class="card-info">
                  <h5 class="mb-0">{{$account}}</h5>
                  <small>Accounts</small>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-6">
              <div class="d-flex align-items-center">
                <div class="badge rounded-pill bg-label-success me-3 p-2">
                  <i class="ti ti-wallet ti-sm"></i>
                </div>
                <div class="card-info">
                  <h5 class="mb-0">{{$bank}}</h5>
                  <small>Bank</small>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
