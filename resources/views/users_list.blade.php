<head>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body>
    {{-- Header --}}
    
    {{-- Side bar --}}
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <span class="fs-5 d-none d-sm-inline">Drive</span>
                    </a>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                        <li class="nav-item">
                            <a href=""class="nav-link align-middle px-0">
                                <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Danh sách người dùng</span>
                            </a>
                        </li>
                        <li> 
                            <a href="{{route('admin.admin_documents')}}" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-speedometer2"></i> <span class="ms-1 d-none d-sm-inline">Danh sách tài liệu</span> </a>
                        </li>
                        <li>
                            <a href="{{route('admin.create_document')}}" class="nav-link px-0 align-middle ">
                                <i class="fs-4 bi-bootstrap"></i> <span class="ms-1 d-none d-sm-inline">Tạo tài liệu</span></a>
                        </li>
                    </ul>
                    <div class="dropdown">
                        <a href="" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://png.pngtree.com/png-vector/20190629/ourmid/pngtree-office-work-user-icon-avatar-png-image_1527655.jpg" alt="hugenerd" width="30" height="30" class="rounded-circle">
                            <span class="d-none d-sm-inline mx-1">{{Auth::User()->name}}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                            {{-- <li><a class="dropdown-item" href="">New project...</a></li>
                            <li><a class="dropdown-item" href="">Settings</a></li>
                            <li><a class="dropdown-item" href="">Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li> --}}
                            <li><a class="dropdown-item" href="{{route('logout')}}">Sign out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            {{-- Main --}}
            <div class="main">
                <div style="display:flex; margin-top:10px">
                    <button style="height:38px;" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddModal" id="add_button">
                        Thêm thành viên
                    </button>   
                    <form style="margin-left:10px;" method="post" action="{{route('admin.add_group')}} ">
                        @csrf
                        <button type="submit" class="btn btn-primary" id="delete">Thêm nhóm</button>
                    </form>
                </div>
                <table class="table table-dark table-hover" id="users">
                    <thead>
                        <tr>
                            <th>STT</th>
                            {{-- <th>id</th> --}}
                            <th>Tên</th>
                            <th>email</th>
                            <th>Vai trò</th>
                            {{-- <th>Số lượng tài liệu đóng góp</th> --}}
                            <th>Nhóm</th>
                            <th>Actions</th>
                            {{-- <th>Password</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i=0;
                        $selected_row=0;   
                        @endphp
                        @foreach($users as $user)
                            @php
                                $i++;   
                            @endphp
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$user['name']}}</td>
                                <td>{{$user['email']}}</td>
                                <td>{{$user['role']}}</td>
                                {{-- <td>{{$user['document_count']}}</td> --}}
                                <td>{{ $user['user_group_name'] }}</td>
                                {{-- <td>{{$user['']}}</td> --}}
                                <td style="display:flex;" >
                                    <button style="height:38px" type="button" class="btn btn-primary edit" data-bs-toggle="modal" data-bs-target="#myModal" id="edit"
                                    data-id="{{ $user['id'] }}" 
                                    data-name="{{ $user['name'] }}"
                                    data-email="{{ $user['email'] }}"
                                    data-role="{{ $user['role'] }}"
                                    data-group="{{ $user['group_user'] }}">
                                        Sửa
                                    </button>
                                    <form style="margin-left:10px;" method="post" action="{{route('admin.delete_user')}} ">
                                        @csrf
                                        <button type="submit" class="btn btn-primary" id="delete">Xóa</button>
                                        <input type="hidden" id="id" name="id" value="{{$user['id']}}">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{route('admin.edit_user')}}" method="post">
                    @csrf
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Sửa thông tin người dùng</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                
                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name" class="form-label">Tên:</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="email" class="form-label">Email:</label>
                                <input type="text" name="email" id="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="Role" class="form-label">Vai trò</label>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="radio1" name="role" value="Admin" checked>Admin
                                    <label class="form-check-label" for="radio1"></label>
                                  </div>
                                  <div class="form-check">
                                    <input type="radio" class="form-check-input" id="radio2" name="role" value="User">User
                                    <label class="form-check-label" for="radio2"></label>
                                  </div>
                            </div>
                            <label for="name" class="form-label">Nhóm:</label>
                            <div class="dropdown">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                                  {{$user['group_user']}}
                                </button>
                                <ul class="dropdown-menu">
                                    @foreach($groups as $group)
                                        <li><a class="dropdown-item" href="#">{{$group['name']}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <input type="hidden" id="id" name="id" class="edit_id">
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-success" value="Sửa">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div> 
    </div>
    {{-- </div> --}}
    <div class="modal" id="AddModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{route('admin.add_user')}}" method="post">
                    @csrf
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Thêm thành viên</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                
                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name" class="form-label">Tên:</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="email" class="form-label">Email:</label>
                                <input type="text" name="email" id="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="pass" class="form-label">Mật khẩu:</label>
                                <input type="text" name="pass" id="pass" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="groups" class="form-label">Nhóm người dùng:</label>
                                <input type="text" name="group" id="group" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="Role" class="form-label">Vai trò</label>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="radio1" name="role" value="Admin" checked>Admin
                                    <label class="form-check-label" for="radio1"></label>
                                  </div>
                                  <div class="form-check">
                                    <input type="radio" class="form-check-input" id="radio2" name="role" value="User">User
                                    <label class="form-check-label" for="radio2"></label>
                                  </div>
                            </div>
                        </div>
                        <input type="hidden" id="id" name="id" class="add_id">
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-success" value="Thêm">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div> 
    </div>
</body>

<script>
    $(users).ready(function() {
    $(users).on('click','.edit',function() {
        var id = $(this).data('id');
        var name = $(this).data('name');
        var email = $(this).data('email');
        var role = $(this).data('role');
        var group = $(this).data('group');
        $('.edit_id').val(id);
        $('#name').val(name);
        $('#email').val(email);
        $('#role').val(role);
        $('#group').val(group);
        if(role=='user')
            $('#radio2').prop('checked', true);
        else
            $('#radio1').prop('checked', true);
    })

    });
</script>