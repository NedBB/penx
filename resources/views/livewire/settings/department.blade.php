<div class="container-xxl flex-grow-1 container-p-y">
          <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Settings /</span> Department</h4>

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
                        <th>Department</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse ($departments as $department)
                            <tr wire:key='{{$department->id}}'>
                                <td class="text-capitalize" style="width: 80%">
                                    <span class="fw-medium">{{$department->name}}</span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </td>
                          </tr>
                        @empty
                            
                        @endforelse
                      
                    </tbody>
                  </table>
                </div>
                <div class="card-footer">
                  {{$departments->links()}}
              </div>
          </div>
          
          <x-add-department/>


    </div>
