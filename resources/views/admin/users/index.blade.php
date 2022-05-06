<div class="row">

  <div class="col-lg-6">

      <!-- Circle Buttons -->
      <div class="card shadow mb-4">
          <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Add user</h6>
          </div>
          <div class="card-body">
              <form action="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputEmail4">First Name</label>
                    <input type="text" class="form-control" placeholder="First Name" name="first_name">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputPassword4">Last Name</label>
                    <input type="text" class="form-control" placeholder="Last Name" name="last_name">
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Email address</label>
                  <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email">
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputEmail4">Username</label>
                    <input type="text" class="form-control" placeholder="Username" name="username">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputPassword4">Password</label>
                    <input type="password" class="form-control" id="inputPassword4" placeholder="Password" name="password">
                  </div>
                </div>
                <button type="submit" class="btn btn-primary float-right">Submit</button>
              </form>
          </div>
      </div>

  </div>

  <div class="col-lg-6">

      <div class="card shadow mb-4">
          <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Manage users</h6>
          </div>
          <div class="card-body">
            <table class="table table-hover table-sm">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Username</th>
                  <th scope="col">Email</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody class="users-table">
                @foreach($users as $key => $user)
                <tr>
                  <th scope="row">{{ $key + 1 }}</th>
                  <td>{{ $user->username }}</td>
                  <td>{{ $user->email }}</td>
                  <td class="d-flex justify-content-between">
                    <a href="{{ route('admin.users.edit', ['user' => $user->id]) }}" class="fas fa-edit"></a>
                    <form action="{{ route('admin.users.destroy', ['user' => $user->id]) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="button" class="delete-user" data-user-id="{{ $user->id }}">
                        <i class="fas fa-trash"></i>
                      </button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            {{ $users->links() }}
          </div>
      </div>

  </div>

</div>