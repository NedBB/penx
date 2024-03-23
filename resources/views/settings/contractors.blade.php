<x-app-layout>

    <div class="container-xxl flex-grow-1 container-p-y">
          <h4 class="py-3 mb-4"><span class="text-muted fw-light">Settings /</span> Contractors</h4>

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
                      <th>Unique Id</th>
                        <th>Title</th>
                        <th>Surname</th>
                        <th>First name</th>
                        <th>Address</th>
                        <th>Account Name</th>
                        <th>Account No</th>
                        <th>Bank Name</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      <tr>
                      <td>
                          <span class="fw-medium">1</span>
                        </td>
                        <td>
                          <span class="fw-medium">Chief</span>
                        </td>
                        <td>
                          <span class="fw-medium">John</span>
                        </td>
                        <td>
                          <span class="fw-medium">Doe</span>
                        </td>
                        <td>
                          <span class="fw-medium">Abuja</span>
                        </td>
                        <td>
                          <span class="fw-medium">John Doe</span>
                        </td>
                        <td>
                          <span class="fw-medium">1903874635</span>
                        </td>
                        <td>
                          <span class="fw-medium">GTB</span>
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
                        <h3 class="mb-2">Add Contractor</h3>
                      </div>
                      <form id="editUserForm" class="row g-3" onsubmit="return false">
                      <div class="col-12 col-md-6">
                          <label class="form-label" for="modalEditUserLanguage">Title</label>
                          <select
                            id="modalEditUserLanguage"
                            name="modalEditUserLanguage"
                            class="select2 form-select"
                            >
                            <option value="">Select</option>
                          </select>
                        </div>

                        <div class="col-12 col-md-6">
                          <label class="form-label" for="modalEditUserFirstName">Surname</label>
                          <input
                            type="text"
                            id="modalEditUserFirstName"
                            name="modalEditUserFirstName"
                            class="form-control"
                            placeholder="John" />
                        </div>

                        <div class="col-12 col-md-6">
                          <label class="form-label" for="modalEditUserFirstName">Doe</label>
                          <input
                            type="text"
                            id="modalEditUserFirstName"
                            name="modalEditUserFirstName"
                            class="form-control"
                            placeholder="Doe" />
                        </div>
                        
                        <div class="col-12 col-md-6">
                          <label class="form-label" for="modalEditUserFirstName">Address</label>
                          <input
                            type="text"
                            id="modalEditUserFirstName"
                            name="modalEditUserFirstName"
                            class="form-control"
                            placeholder="John" />
                        </div>

                        <div class="col-12 col-md-6">
                          <label class="form-label" for="modalEditUserFirstName">Account Name</label>
                          <input
                            type="text"
                            id="modalEditUserFirstName"
                            name="modalEditUserFirstName"
                            class="form-control"
                            placeholder="John" />
                        </div>

                        <div class="col-12 col-md-6">
                          <label class="form-label" for="modalEditUserFirstName">Account No.</label>
                          <input
                            type="text"
                            id="modalEditUserFirstName"
                            name="modalEditUserFirstName"
                            class="form-control"
                            placeholder="John" />
                        </div>
                        <div class="col-12 col-md-6">
                          <label class="form-label" for="modalEditUserLanguage">Bank</label>
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

</x-app-layout>