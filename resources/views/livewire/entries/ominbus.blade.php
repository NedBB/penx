
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Settings /</span> Omnibus</h4>

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
                  <th>Date</th>
                  <th>Group Head</th>
                  <th>Description</th>
                  <th>Amount</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                  @forelse ($omnibus as $omni)
                      <tr wire:key='{{$omni->id}}'>
                        <td class="text-capitalize">
                            <span class="fw-medium">{{$omni->created_at}}</span>
                            </td>
                          <td class="text-capitalize">
                          <span class="fw-medium">{{$omni->subhead->head->name}}</span>
                          </td>
                          <td>
                              <span class="fw-medium">{{$omni->description}}</span>
                          </td>
                          <td>
                              <span class="fw-medium">{{$omni->amount}}</span>
                          </td>
                      
                      </tr>
                  @empty
                      
                  @endforelse
                
              </tbody>
            </table>
          </div>
          <div class="card-footer">
              {{$omnibus->links()}}
          </div>
    </div>

    <!-- Edit User Modal -->
        <div class="modal fade" id="editUser" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-md modal-simple modal-edit-user">
            <div class="modal-content p-3 p-md-5">
              <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="mb-4" style="border-bottom: 1px solid #282828">
                  <h5 class="mb-2 text-uppercase">Add Omnibus</h3>
                </div>
                <form id="editUserForm" class="row g-3" onsubmit="return false">
                  <div class="col-12 col-md-6">
                    <label class="form-label" for="modalEditUserFirstName">Name</label>
                    <select class="form-control" name="staff_id">
                        <option>Select Option</option>
                    </select>
                  </div>
                  
                  <div class="col-12 col-md-6">
                    <label class="form-label">Date</label>
                    <input
                      type="date"
                      name="date"
                      class="form-control"
                      placeholder="John" />
                  </div>
                
                  <div class="col-12 col-md-6">
                    <label class="form-label" for="modalEditUserFirstName">Head</label>
                    <select class="form-control" name="head_id">
                        <option>Select Option</option>
                    </select>
                  </div>

                  <div class="col-12 col-md-6">
                    <label class="form-label" for="modalEditUserFirstName">Subhead</label>
                    <select class="form-control" name="subhead_id">
                        <option>Select Option</option>
                    </select>
                  </div>
                 
                  <div class="col-12 col-md-6">
                    <label class="form-label">PVNo</label>
                    <input
                      type="text"
                      name="pvno"
                      class="form-control"
                      placeholder="pvno" />
                  </div>

                  <div class="col-12 col-md-6">
                    <label class="form-label">Amount</label>
                    <input
                      type="number"
                      name="amount"
                      class="form-control"
                      placeholder="amount" />
                  </div>
                  <div class="col-12 col-md-12">
                    <label class="form-label">Description</label>
                    <input
                      type="text"
                      name="description"
                      class="form-control"
                      placeholder="description" />
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