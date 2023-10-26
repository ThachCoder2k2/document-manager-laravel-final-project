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
                                <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Danh sách tập tin</span>
                            </a>
                        </li>
                        <li> 
                            <a href="{{ route('user.upload') }}" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-speedometer2"></i> <span class="ms-1 d-none d-sm-inline">Upload File</span> </a>
                        </li>
                        {{-- <li>
                            <a href="{{ route('tagged') }}" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">Có gắn dấu sao</span></a>
                        </li>
                        <li>
                            <a href="{{ route('bin') }}"  class="nav-link px-0 align-middle ">
                                <i class="fs-4 bi-bootstrap"></i> <span class="ms-1 d-none d-sm-inline">Thùng rác</span></a>
                        </li> --}}
                        <li>
                            <a href="{{ route('user.create_document') }}" class="nav-link px-0 align-middle ">
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
            {{-- Upload Bar --}}
            <div class="main">
                <table class="table table-dark table-hover" id="documents">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên</th>
                            <th>Kiểu</th>
                            <th>Mô tả ngắn</th>
                            <th>Tác giả</th>
                            <th>Chỉnh sửa lần cuối</th>
                            <th>Kích thước</th>
                            <th>Quyền truy cập</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i=0;
                        $selected_row=0;   
                        @endphp
                        @foreach($documents as $document)
                            @php
                                $i++;   
                            @endphp
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$document['name']}}</td>
                                <td>{{$document['type']}}</td>
                                <td>{{$document['short_description']}}</td>
                                <td>{{$document['user_name']}}</td>
                                <td>{{$document['last_time_modified']}}</td>
                                <td>{{round($document['size']/1000)}}kb</td>
                                <td>{{$document['visibility']}}</td>
                                <td  style="display:flex;">
                                    <form method="get" action="{{route('user.download_local')}} ">
                                        @csrf
                                        <button type="submit" class="btn btn-primary" id="download">Tải xuống</button>
                                        <input type="hidden" id="id" name="id" value={{$document['id']}}>
                                    </form>
                                    <form style="margin-left:10px" method="post" action="{{route('user.preview')}} ">
                                        @csrf
                                        <button type="submit" class="btn btn-primary" id="watch">Xem</button>
                                        <input type="hidden" id="id" name="id" value={{$document['id']}}>
                                    </form>

                                    <button class="btn btn-primary edit" style="height:38px; margin-left:10px" type="button" data-bs-toggle="modal" data-bs-target="#myModal" id="edit" 
                                        data-id="{{ $document['id'] }}" 
                                        data-name="{{ $document['name'] }}"  
                                        data-short_description="{{ $document['short_description'] }}" 
                                        data-visibility="{{ $document['visibility'] }}">
                                        Sửa
                                    </button>
                                    <form style="margin-left:10px" method="post" action="{{route('user.delete_document')}} ">
                                        @csrf
                                        <button type="submit" class="btn btn-primary" id="delete">Xóa</button>
                                        <input type="hidden" id="id" name="id" value={{$document['id']}}>
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
                <form action="{{route('user.edit_document')}}" method="post">
                    @csrf
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Sửa thông tin tài liệu</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                
                        <!-- Modal body -->
                        <div class="modal-body">
                            <input type="hidden" id="id" class="id" name="id">
                            <div class="form-group">
                                <label for="filename" class="form-label">Tên file:</label>
                                <input type="text" name="filename" id="filename" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="short_description" class="form-label">Mô tả ngắn:</label>
                                <input style="width:1200px" type="text" name="short_description" id="short_description" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="short_description" class="form-label">Quyền truy cập</label>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="radio1" name="visibility" value="Only Me" checked>Only Me
                                    <label class="form-check-label" for="radio1"></label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="radio2" name="visibility" value="Public">Public
                                    <label class="form-check-label" for="radio2"></label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="radio3" name="visibility" value="Member Only">Member Only
                                    <label class="form-check-label" for="radio3"></label>
                                </div>
                            </div>
                        </div>
                    
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-success" value="Sửa">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

<script>
    $(document).ready(function() {
    $(document).on('click','.edit',function() {
        var id = $(this).data('id');
        var name = $(this).data('name');
        var type = $(this).data('type');
        var short_description = $(this).data('short_description');
        var size = $(this).data('size');
        var visibility = $(this).data('visibility');
        //$request->request->set('id', id);
        $('.id').val(id);
        $('#filename').val(name);
        $('#type').val(type);
        $('#short_description').val(short_description);
        $('#size').val(size);
        //alert(name);
        if(visibility=='Public')
            $('#radio2').prop('checked', true);
        else if(visibility=='Member Only')
            $('#radio3').prop('checked', true);
        else 
            $('#radio1').prop('checked', true);
    })
    });
</script>