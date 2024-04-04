
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
                  <th></th>
                  <th>Date</th>
                  <th>Group Head</th>
                  <th>Description</th>
                  <th>Amount</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
              
                  @forelse ($omnibusses as $omni)
                      <tr wire:key='{{$omni->id}}'>
                        <td><input type="checkbox" wire:model='selected' /></td>
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
                      <tr><td colspan="5" class="text-center text-danger">No data exist at the moment</td></tr>
                  @endforelse
              </tbody>
            </table>
          </div>

          <div class="card-footer">
              {{$omnibusses->links()}}
          </div>
    </div>

    <x-add-omnibus :title="$title" :heads="$heads"/>

</div>