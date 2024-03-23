<x-app-layout>

    <div class="container-xxl flex-grow-1 container-p-y">
          <h4 class="py-3 mb-4"><span class="text-muted fw-light">Settings /</span> General Settings</h4>

          <!-- DataTable with Buttons -->
          <div class="card">
                <div class="card-header">
               
                </div>
                <div class="card-body">
                    <form id="editUserForm" class="row g-3" onsubmit="return false">
                    <div class="col-12 col-md-6">
                      <label class="form-label" for="modalEditUserFirstName">Rent</label>
                        <input
                          type="text"
                          id="modalEditUserFirstName"
                          name="modalEditUserFirstName"
                          class="form-control"
                          placeholder="John" />
                    </div>

                    <div class="col-12 col-md-6">
                      <label class="form-label" for="modalEditUserFirstName">Transport</label>
                        <input
                          type="text"
                          id="modalEditUserFirstName"
                          name="modalEditUserFirstName"
                          class="form-control"
                          placeholder="John" />
                    </div>

                    <div class="col-12 col-md-6">
                      <label class="form-label" for="modalEditUserFirstName">Meal</label>
                        <input
                          type="text"
                          id="modalEditUserFirstName"
                          name="modalEditUserFirstName"
                          class="form-control"
                          placeholder="John" />
                    </div>

                    <div class="col-12 col-md-6">
                      <label class="form-label" for="modalEditUserFirstName">Employee %</label>
                        <input
                          type="text"
                          id="modalEditUserFirstName"
                          name="modalEditUserFirstName"
                          class="form-control"
                          placeholder="John" />
                    </div>

                    <div class="col-12 col-md-6">
                      <label class="form-label" for="modalEditUserFirstName">Employer %</label>
                        <input
                          type="text"
                          id="modalEditUserFirstName"
                          name="modalEditUserFirstName"
                          class="form-control"
                          placeholder="John" />
                    </div>
                        
                    <div class="col-12 col-md-6">
                      <label class="form-label" for="modalEditUserFirstName">NGF</label>
                        <input
                          type="text"
                          id="modalEditUserFirstName"
                          name="modalEditUserFirstName"
                          class="form-control"
                          placeholder="John" />
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

</x-app-layout>