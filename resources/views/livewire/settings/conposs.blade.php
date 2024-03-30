

    <div class="container-xxl flex-grow-1 container-p-y">
          <h4 class="py-3 mb-4"><span class="text-muted fw-light">Settings /</span> Conposs</h4>

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
                        <th>Grade Level</th>
                        <th>Step</th>
                        <th>Base Account </th>
                        <th>Increment Rate</th>
                        <th>Date Created</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">

                        @forelse ($conposses as $conposs)
                        <tr wire:key="{{ $conposs->id }}">
                            <td>
                                <span class="fw-medium text-capitalize">{{$conposs->gradelevel->gradelevelname->name}} {{$conposs->gradelevel->level}}</span>
                            </td>
                            <td>
                                <span class="fw-medium">{{$conposs->step}}</span>
                            </td>
                            <td>
                                <span class="fw-medium">{{$conposs->baseamount}}</span>
                            </td>
                            <td>
                                <span class="fw-medium">{{$conposs->incrementrate}}</span>
                            </td>
                            <td>
                                <span class="fw-medium">{{$conposs->created_at}}</span>
                            </td>
                            <td><a href="#" class="btn btn-sm btn-primary">Edit</a></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-danger text-center">No record exist at the moment</td>
                        </tr>
                    @endforelse
    
                    
                    </tbody>
                    
                </table>
                
                </div>
                <div class="card-footer">
                    {{$conposses->links()}}

                </div>
                
          </div>

          <!-- Edit User Modal -->
              <div class="modal fade" id="editUser" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-md modal-simple modal-edit-user">
                  <div class="modal-content p-3 p-md-5">
                    <div class="modal-body">
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      <div class="text-center mb-4">
                        <h3 class="mb-2">Add Conposs</h3>
                      </div>
                      <form id="editUserForm" class="row g-3" onsubmit="return false">
                      <div class="col-12 col-md-6">
                          <label class="form-label" for="modalEditUserLanguage">Grade level</label>
                          <select
                            id="modalEditUserLanguage"
                            name="modalEditUserLanguage"
                            class="select2 form-select"
                            >
                            <option value="">Select</option>
                          </select>
                        </div>

                        <div class="col-12 col-md-6">
                          <label class="form-label" for="modalEditUserFirstName">Base Amount</label>
                          <input
                            type="number"
                            id="modalEditUserFirstName"
                            name="modalEditUserFirstName"
                            class="form-control"
                            placeholder="John" />
                        </div>

                        <div class="col-12 col-md-6">
                          <label class="form-label" for="modalEditUserFirstName">Interest Rate</label>
                          <input
                            type="text"
                            id="modalEditUserFirstName"
                            name="modalEditUserFirstName"
                            class="form-control"
                            placeholder="Doe" />
                        </div>
                        
                        <div class="col-12 col-md-6">
                          <label class="form-label" for="modalEditUserFirstName">Step</label>
                          <select
                            id="modalEditUserLanguage"
                            name="modalEditUserLanguage"
                            class="select2 form-select"
                            >
                            <option value="">Select</option>
                          </select>
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