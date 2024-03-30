<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Settings /</span> Rank</h4>

    <!-- DataTable with Buttons -->
    <div class="card">
          <div class="card-header">
          <button type="button" class="btn btn-primary float-sm-end" data-bs-toggle="modal" data-bs-target="#editUser">
                  + Add Record
          </button>
          </div>
          <div class="table-responsive text-nowrap">
            <table class="table">
              <thead>
               <th>Name</th>
               <th>Action</th>
              </thead>
              <tbody class="table-border-bottom-0">
                @forelse ( $ranks as $rank)
                    <tr wire:key='{{$rank->id}}'>
                        <th>{{$rank->name}}</th>
                        <th><button class="btn btn-sm btn-danger">Delete</button></th>
                    </tr>
                @empty
                    <tr><td colspan="2" class="text-danger text-center">No data exist at the moment</td></tr>
                @endforelse
              </tbody>
            </table>
          </div>
          <div class="card-footer">
            {{$ranks->links()}}

        </div>
    </div>

    <!-- Edit User Modal -->
        <div class="modal fade" id="editUser" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-md modal-simple modal-edit-user">
            <div class="modal-content p-3 p-md-5">
              <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                  <h3 class="mb-2">Add Rank</h3>
                </div>
                <form id="editUserForm" class="row g-3" onsubmit="return false">
                  <div class="col-12 col-md-12">
                    <label class="form-label" for="modalEditUserFirstName">Rank</label>
                    <input
                      type="text"
                      id="modalEditUserFirstName"
                      name="modalEditUserFirstName"
                      class="form-control"
                      placeholder="John" />
                  </div>
                  
                
                  
                 
                    
                  </div>
                  <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                    <button
                      type="reset"
                      class="btn btn-label-secondary"
                      data-bs-dismiss="modal"
                      aria-label="Close">
                      Cancel
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!--/ Edit User Modal -->


</div>