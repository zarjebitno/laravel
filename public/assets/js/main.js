$(document).ready(() => {
  const token = $('meta[name="csrf-token"]').attr('content');

  $.ajaxSetup({ headers: {
  'X-CSRF-TOKEN': token }
  });

  function ajax(url, method, dataType='JSON', data={}, success, error) {
    $.ajax({
      url: url,
      method: method,
      dataType: dataType,
      data: data,
      success: success,
      error: error
    })
  }

  $(document).on('click', '#main-nav .page-link', changePage)
  $(document).on('click', '.delete-comment-user', deleteComment)
  $(document).on('click', '#search-addon', changeSorting);
  $('#search_product_input').on('keyup', getProducts)
  $(document).on('click', '.delete-user', deleteUser);
  $(document).on('click', '.delete-post-btn', deletePost);
  $(document).on('click', '.log-pagination-item', logPagination);
  $(document).on('change', '#created_at_log', changeLogsByDate)
  $(document).on('click', '.delete-comment-btn', deleteCommentAdmin)
  $(document).on('click', '.comment-submit-btn', submitComment)
  $(document).on('click', '#register-form button', submitRegisterForm);

  function submitRegisterForm() {
    const pass = $('#password').val();
    const passConfirm = $('#password_confirmation').val();
    const passErr = $('.pass-err');
    const form = $('#register-form');

    console.log(pass.length)

    if(pass.length <= 8 || pass != passConfirm)
      passErr.css('display', 'block')
    else {
      passErr.css('display', 'none')
      form.submit();
    }
  }

  function submitComment() {
    const comment = $('#comment-form textarea');
    const postID = $('#post-id').val()
    
    if(!comment.val().length)
      $(comment).css('border', '1px solid red')
    else {
      $(comment).css('border', 'unset')

      ajax(
        `${baseUrl}/posts/${postID}`,
        'POST',
        'json',
        {content: comment.val()},
        (data) => {
          printComments(data),
          $(comment).val('')
        },
        (err) => console.log(err)
      )
    }
  }

  function deleteCommentAdmin(e) {
    e.preventDefault();
    const commentID = $(e.currentTarget).data('comment-id')

    console.log(baseUrl + '/admin/comments/' + commentID)

    ajax(
      baseUrl + '/admin/comments/' + commentID,
      'DELETE',
      'json',
      {comment: commentID},
      (data) => console.log(data),
      (err) => console.log('nono')
    )
  }

  function changeLogsByDate() {
    const logDate = $('#created_at_log').val();

    ajax(
      baseUrl + '/admin/paginate',
      'GET',
      'json',
      {logDate},
      (data) => {
        printLogs(data[0]),
        changeLogPagination(data[1]);
      },
      (err) => console.log(err)
    )
  }

  function changeLogPagination(pages) {
    const pag = $('#log-pag');
    let html = '';

    for(let i = 1; i <= pages; i++) {
      html += `<li class="list-group-item"><a href="#" class="log-pagination-item" data-page="${i}">${i}</a></li>`;
    }

    pag.html(html);
  }

  function logPagination(e) {
    e.preventDefault();
    const page = $(e.currentTarget).data('page');

    
    ajax(
      baseUrl + '/admin/paginate',
      'GET',
      'json',
      {page},
      (data) => printLogs(data),
      (err) => console.log(err)
    )
  }

  function printLogs(logs) {
    let html = '';
    const logWrap = $('#log-wrap');

    if(!logs.length) {
      html = '<tr><td>No matching log files</td></tr>'
    } else {
      logs.forEach(log => {
        html += `<tr>
        <td>${log}</td>
      </tr>`;
      });
    }


    logWrap.html(html)
;  }

  function deletePost(e) {
    e.preventDefault();
    const postID = $(e.currentTarget).data('post-id');

    ajax(
      baseUrl + '/admin/posts/' + postID,
      'DELETE',
      'json',
      {id: postID},
      (data) => printPostsAdmin(data),
      (err) => console.log('neok')
    )
  }

  function printPostsAdmin(posts) {
    let html = '';
    const postWrap = $('#post-wrap');

    console.log(posts.data)

    posts.data.forEach((post, key) => {
      html += `
      <tr>
        <th scope="row">${key+1}</th>
        <td>${post.title}</td>
        <td>${new Date(post.created_at).toLocaleString('en-us',{day: 'numeric', month:'short', year:'numeric'})}</td>
        <td class="d-flex justify-content-between">
          <a href="${baseUrl}/admin/posts${post.id}/edit" class="fas fa-edit"></a>
          <form action="${baseUrl}/admin/posts/delete/${post.id}" method="POST">
            <button type="button" class="delete-post-btn" data-post-id='${post.id}'>
              <i class="fas fa-trash"></i>
            </button>
          </form>
        </td>
      </tr>
      `;
    });
    postWrap.html(html)
  }

  function deleteUser(e) {
    e.preventDefault();
    const userID = $(e.currentTarget).data('user-id');
    
    ajax(
      baseUrl + '/admin/users/' + userID,
      'DELETE',
      'json',
      {id: userID},
      (data) => printUsers(data),
      (err) => console.log('neok')
    )
  }

  function printUsers(users) {
    let html = '';
    const usersTable = $('.users-table');

    users.data.forEach((user, key) => {
      html += `
          <tr>
          <th scope="row">${key+1}</th>
          <td>${user.username}</td>
          <td>${ user.email }</td>
          <td class="d-flex justify-content-between">
            <a href="${baseUrl}/admin/users/${user.id}/edit" class="fas fa-edit"></a>
            <form action="${baseUrl}/admin/delete/${user.id}"" method="POST">
              <button type="button" class="delete-user" data-user-id="${user.id}">
                <i class="fas fa-trash"></i>
              </button>
            </form>
          </td>
        </tr>
      `;
    });

    usersTable.html(html);
  }

  function changeSorting() {
    let sortValue = $('#search-addon').data('sort');
    $('#search-addon').data('sort', !sortValue)

    getProducts();
  }

  function changePage(e) {
    e.preventDefault();
    const links = $('#main-nav .page-item');
    $(links).removeClass('active');
    $(e.currentTarget).closest('.page-item').addClass('active')

    const page = $(this).data('page') ? $(this).data('page') : $(this).attr('href').split('page=')[1]

    ajax(
      baseUrl + '/posts/fetch',
      'GET',
      'json',
      {page},
      (data) => printPosts(data.data),
      (err) => console.log(err)
    )
  }

  function deleteComment(e) {
    const commentID = e.currentTarget.getAttribute('data-commentid');

    ajax(
      baseUrl + '/posts/comments/' + commentID,
      'DELETE',
      'json',
      {id: commentID},
      (data) => printComments(data),
      (err) => console.log('rrrr')
    )
  }

  function printComments(comments) {
    const commentBody = $('.comments-wrap');
    const userID = $('#user-id').val();

    let html = '';
    
    comments.forEach(comment => {
      html += `
      <div class="container mb-3 p0 single-comment">
        <div class="card-header d-flex justify-content-between align-items-center">
          <p class='m-0'>${comment.user.username}</p>
          <small class='d-block'>${new Date(comment.created_at).toLocaleString('en-us',{day: 'numeric', month:'short', year:'numeric'})}</small>
        </div>
        <div class="card-body position-relative">
          <p>${comment.content}</p>`;
      if(userID == comment.user_id) {
        html += `
            <form action="${baseUrl}/posts/${comment.post_id}" method="POST">
            <input type="hidden" name="comment_id" value="${comment.id}"/>
            <input type="hidden" name="user_id" value="${comment.user_id}"/>
            <i class="fas fa-trash position-absolute top-50% right-0 delete-comment-user" data-commentID='${comment.id}'></i>
          </form>
        `
      }
      html +=
        `</div>
      </div>
      `;
    });

    $(commentBody).html(html)
  }

  function getProducts() {
    const searchInputValue = $('#search_product_input').val();
    const sortValue = $('#search-addon').data('sort')

    // if(searchInputValue.length >= 3) {
      ajax(
        baseUrl + '/posts/fetch',
        'GET',
        'json',
        {searchInputValue, sortValue},
        (data) => {
          printPosts(data.data),
          changePagination(data.last_page, data.current_page)
        },
        (err) => console.log(err)
      )
    // }
  }

  function printPosts(posts) {
    const blogWrapper = $('.blog-custom-single-wrap');
    let html = '';

    if(posts.length) {
      posts.forEach(post => {
        html += `
        <div class="blog-box">
        <div class="post-media">
            <a href="${baseUrl}/posts/${post.id}">
                <img src="${publicFolder}assets/images/posts/${post.image}" alt="${post.image}" class="img-fluid">
            </a>
        </div>
        <!-- end media -->
        <div class="blog-meta big-meta text-center">
            <h4><a href="${baseUrl}/posts/${post.id}" title="">${post.title}</a></h4>
            <p>${trimPostDesc(post.content, 100)}</p>
            <small><a href="${baseUrl}/posts/category/${post.category.id}" title="">${post.category.name}</a></small>
            <small>${new Date(post.created_at).toLocaleString('en-us',{day: 'numeric', month:'short', year:'numeric'})}</small>
            <small>
                <span>by </span>
                <a href="${baseUrl}/posts/user/${post.user.id}" title="">${post.user.username}</a>
              </small>
            <small><i class="fa fa-comment"></i> ${post.comments != 0 ? post.comments.length : 'No Comments'} </small>
        </div><!-- end meta -->
      </div><!-- end blog-box -->    
        `;
      });
    } else {
      html = '<p>No posts matched.</p>'
    }

    $(blogWrapper).html(html)
  }

  function changePagination(totalLinks, currentPage){ 
    let html = "";

    for(let i = 1; i <= totalLinks; i++) { 
      if(i != currentPage) {
        html += `<li class="page-item"><a class="page-link" id="link${i}" data-page="${i}" href="#">${i}</a></li>`;
      } else {
        html += `<li class="page-item active"><a class="page-link" id="link${i}" data-page="${i}" href="#">${i}</a></li>`; 
      }
    }

    $(".pagination").html(html); 
    $(".page-link").click(changePage);
  }

  //helpers
  function trimPostDesc(description, length) {
    let trimmedString = description.substr(0, length);
    trimmedString = trimmedString.substr(0, Math.min(trimmedString.length, trimmedString.lastIndexOf(" ")))

    return trimmedString
  }
});