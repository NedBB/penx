
    <div class="container-xxl flex-grow-1 container-p-y">
          <h4 class="py-3"><span class="text-muted fw-light">Settings /</span> System Settings</h4>

          <!-- DataTable with Buttons -->
          <div class="card">
                <div class="card-body">
                    <form id="editUserForm" class="row g-3" onsubmit="return false">
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="modalEditUserFirstName">Rent</label>
                        <input
                            type="text"
                            id="modalEditUserFirstName"
                            name="modalEditUserFirstName"
                            class="form-control"
                            placeholder="rent" 
                            value="{{$settings->rent}}"
                            />
                    </div>
                    
                    <div class="col-12 col-md-6">
                        <label class="form-label">Transport</label>
                        <input
                        type="text"
                        name="transport"
                        class="form-control"
                        placeholder="Doe" 
                        value="{{$settings->transport}}"
                        />
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label">Meal</label>
                        <input
                            type="text"
                            name="meal"
                            class="form-control"
                            placeholder="Doe" 
                            value="{{$settings->meal}}"
                            />
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">Employee %</label>
                        <input
                            type="text"
                            name="employee"
                            class="form-control"
                            placeholder="Doe"  
                            value="{{$settings->employee_contrib}}"
                            />
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">Employer %</label>
                        <input
                            type="text"
                            name="employer"
                            class="form-control"
                            placeholder="Doe"
                            value="{{$settings->employer_contrib}}"
                            />
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">NGF</label>
                        <input
                            type="text"
                            name="ngf"
                            class="form-control"
                            placeholder="Doe" 
                            value="{{$settings->nhf}}"
                            />
                    </div>
                
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                    
                    </div>
                </form>
                    
            
                </div>
    </div>
    </div>