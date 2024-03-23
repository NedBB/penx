<x-app-layout>

    <div class="container-xxl flex-grow-1 container-p-y">
          <h4 class="py-3 mb-4"><span class="text-muted fw-light">Settings /</span> System Users</h4>

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
                        <th>Username</th>
                        <th>Date Created</th>
                        <th>Edit Password</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      <tr>
                        <td>
                          <i class="ti ti-brand-angular ti-lg text-danger me-3"></i>
                          <span class="fw-medium">Angular Project</span>
                        </td>
                        <td>Albert Cook</td>
                        <td>
                          <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                            
                            
                            <li
                              data-bs-toggle="tooltip"
                              data-popup="tooltip-custom"
                              data-bs-placement="top"
                              class="avatar avatar-xs pull-up"
                              title="Christina Parker">
                              <img src="../../assets/img/avatars/7.png" alt="Avatar" class="rounded-circle" />
                            </li>
                          </ul>
                        </td>
                        
                      </tr>
                    </tbody>
                  </table>
                </div>
          </div>

          <!-- Edit User Modal -->
              <div class="modal fade" id="editUser" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-md modal-simple modal-edit-user">
                  <div class="modal-content p-3 p-md-5">
                    <div class="modal-body">
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      <div class="text-center mb-4">
                        <h3 class="mb-2">Add Users</h3>
                      </div>
                      <form id="editUserForm" class="row g-3" onsubmit="return false">
                        <div class="col-12 col-md-12">
                          <label class="form-label" for="modalEditUserFirstName">Username</label>
                          <input
                            type="text"
                            id="modalEditUserFirstName"
                            name="modalEditUserFirstName"
                            class="form-control"
                            placeholder="John" />
                        </div>
                        <div class="col-12 col-md-12">
                          <label class="form-label" for="modalEditUserLastName">Password</label>
                          <input
                            type="password"
                            id="modalEditUserLastName"
                            name="modalEditUserLastName"
                            class="form-control"
                            placeholder="Doe" />
                        </div>

                        <div class="col-12 col-md-12">
                          <label class="form-label" for="modalEditUserLastName">Confirm Password</label>
                          <input
                            type="password"
                            id="modalEditUserLastName"
                            name="modalEditUserLastName"
                            class="form-control"
                            placeholder="Doe" />
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

</x-app-layout>