
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Settings /</span> Sub Head</h4>

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
                <tr>
                  <th>Name</th>
                  <th>Group Head</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                  @forelse ($subs as $sub)
                      <tr wire:key='{{$sub->id}}'>
                          <td class="text-capitalize">
                          <span class="fw-medium">{{$sub->name}}</span>
                          </td>
                          <td>
                              <span class="fw-medium">{{$sub->head->slug}}</span>
                          </td>
                          <td>
                              <span class="fw-medium"><button class="btn btn-sm btn-danger">delete</button></span>
                          </td>
                      
                      </tr>
                  @empty
                      
                  @endforelse
                
              </tbody>
            </table>
          </div>
          <div class="card-footer">
              {{$subs->links()}}
          </div>
    </div>

    <!-- Edit User Modal -->
        <div class="modal fade" id="editUser" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-md modal-simple modal-edit-user">
            <div class="modal-content p-3 p-md-5">
              <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                  <h3 class="mb-2">Add Group Head</h3>
                </div>
                <form id="editUserForm" class="row g-3" onsubmit="return false">
                  <div class="col-12 col-md-12">
                    <label class="form-label" for="modalEditUserFirstName">Name</label>
                    <input
                      type="text"
                      id="modalEditUserFirstName"
                      name="modalEditUserFirstName"
                      class="form-control"
                      placeholder="John" />
                  </div>
                  
                  <div class="col-12 col-md-12">
                    <label class="form-label" for="modalEditUserFirstName">Descriptions</label>
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