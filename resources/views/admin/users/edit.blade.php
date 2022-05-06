<div class="row">

  <div class="col-lg-10">

      <!-- Circle Buttons -->
      <div class="card shadow mb-4">
          <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Add user</h6>
          </div>
          <div class="card-body">
              <form action="{{ route('users.update', ['user' => $user->id]) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputEmail4">First Name</label>
                    <input type="text" class="form-control" placeholder="First Name" name="first_name" value="{{ $user->first_name }}">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputPassword4">Last Name</label>
                    <input type="text" class="form-control" placeholder="Last Name" name="last_name" value="{{ $user->last_name }}">
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Email address</label>
                  <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email" value="{{ $user->email }}">
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputEmail4">Username</label>
                    <input type="text" class="form-control" placeholder="Username" name="username" value="{{ $user->username }}">
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

</div>