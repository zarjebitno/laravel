<div class="row">

  <div class="col-lg-6">

      <!-- Circle Buttons -->
      <div class="card shadow mb-4">
          <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Add post</h6>
          </div>
          <div class="card-body">
            <form method="POST" action="{{ @route('posts.store') }}" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <label for="exampleFormControlInput1">Post Title</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="post_title">
              </div>
              <div class="form-group">
                <div class="form-group">
                  <label for="exampleFormControlFile1">Featured Image</label>
                  <input type="file" class="form-control-file" id="exampleFormControlFile1" name="post_image">
                </div>
              </div>
              <div class="form-group">
                <label for="exampleFormControlSelect2">Post Category</label>
                <select class="form-control" id="exampleFormControlSelect2" name="post_cat">
                  <option value="0">Select a category</option>
                  @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>  
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="exampleFormControlTextarea1">Post Content</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="post_content"></textarea>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
      </div>

  </div>

  <div class="col-lg-6">

      <div class="card shadow mb-4">
          <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Manage posts</h6>
          </div>
          <div class="card-body">
            <table class="table table-hover table-sm">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Title</th>
                  <th scope="col">Date</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody id="post-wrap">
                @foreach($posts as $key => $post)
                <tr>
                  <th scope="row">{{ $key + 1 }}</th>
                  <td>{{ $post->title }}</td>
                  <td>{{ date('F j, Y', $post->postedAt) }}</td>
                  <td class="d-flex justify-content-between">
                    <a href="{{ route('admin.posts.edit', ['post' => $post->id]) }}" class="fas fa-edit"></a>
                    <form action="{{ route('admin.posts.destroy', ['post' => $post->id]) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="button" class="delete-post-btn" data-post-id='{{ $post->id }}'>
                        <i class="fas fa-trash"></i>
                      </button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            {{ $posts->links() }}
          </div>
      </div>

  </div>

</div>