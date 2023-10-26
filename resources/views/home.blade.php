
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;1,300&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">

        <link href="{{ asset('css/apply.css') }}" rel="stylesheet" type="text/css" media="all">
        <link href="{{ asset('css/base.css') }}" rel="stylesheet" type="text/css" media="all">
        <link href="{{ asset('css/fontawesome/css/all.min.css')}}" rel="stylesheet" type="text/css" media="all">

        <title>File Manager Application</title>
    </head>

    <body>
        <div class="app">

            <header class="header">
                <div class="grid">
                    <nav class="header_navbar">
                        <ul class="header_navbar-list">
                            <li class="header_navbar-item header_navbar-item--has-qrcode header_navbar-item--separate">
                                Use the application on your phone
                                <div class="header_qrcode">
                                    <img src="https://deo.shopeemobile.com/shopee/shopee-pcmall-live-sg/assets/d91264e165ed6facc6178994d5afae79.png" alt="QRCode" class="header_qrcode-img">
                                    <div class="header_qrcode-apps">
                                        <a href="" class="header_qrcode-link">
                                            <img src="https://deo.shopeemobile.com/shopee/shopee-pcmall-live-sg/assets/f4f5426ce757aea491dce94201560583.png" alt="QRgoogle" class="header_qrcode-download">
                                        </a>
                                        <a href="" class="header_qrcode-link">
                                            <img src="https://deo.shopeemobile.com/shopee/shopee-pcmall-live-sg/assets/39f189e19764dab688d3850742f13718.png" alt="QRappstore" class="header_qrcode-download">
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <li class="header_navbar-item">
                                <span class="header_navbar-item--no-pointer">File Manager Application</span>
                                <a href="" class="header_navbar-icon">
                                    <i class="header_navbar-icon fa-solid fa-file fa-xs"></i>
                                </a>
                                <a href="" class="header_navbar-icon">
                                    <i class="header_navbar-icon fa-brands fa-square-facebook fa-sm"></i>
                                </a>
                                <a href="" class="header_navbar-icon">
                                    <i class="header_navbar-icon fa-brands fa-instagram fa-sm"></i>
                                </a>
                                
                            </li>
                        </ul>
                        <ul class="header_navbar-list">
                            <li class="header_navbar-item">
                                <span class="header_navbar-icon--no-pointer">
                                    <i class="fa-solid fa-handshake-angle fa-xs"></i>
                                </span>
                                <a href="" class="header_navbar-item-link" ></a>Help</a>
                            </li>
                            <a href="{{route('signup')}}" class="header_navbar-item header_navbar-item--bold header_navbar-item--separate">Sign Up</a>
                            <a href="{{route('login')}}" class="header_navbar-item header_navbar-item--bold">Login</a>
                        </ul>
                    </nav>
                </div>
                
            </header>

            <div class="container">
                <div class="container-first">
                    <div class="container-first_introduce">
                        <div class="container-first_introduce-title">
                            <span>Introduce</span>
                        </div>
                        <div class="container-first_introduce-document">
                            <p>Phần mềm quản lý tài liệu, hồ sơ công việc CoDX linh hoạt giúp giải quyết khó khăn trong việc lưu trữ, tìm kiếm hồ sơ, đồng bộ quản lý tài liệu trong doanh nghiệp.</p>
                        </div>
                    </div>
                    <div class="container-first_download">
                        <div class="container-first_download-title">
                            <span>Download</span>
                        </div>
                        <div class="container-first_download-document">
                            <p>Đây là tài liệu hướng dẫn cài đặt phần mềm của chúng tôi thiết bị PC, laptop của bạn...</p>
                        </div>
                    </div>
                </div>

                <div class="container-second">
                    <div class="container-second_features">
                        <div class="container-second_features-title">
                            <span>Features</span>
                        </div>
                        <div class="container-second_features-document">
                            <p>Các tính năng hiệu quả của File Manager Application</p>
                        </div>
                    </div>
                    <div class="container-second_practical">
                        <div class="container-second_practical-title">
                            <span>Practical</span>
                        </div>
                        <div class="container-second_practical-document">
                            <p>Hãy cùng xem các đánh giá và một số ứng dụng thực tế được feedback từ người dùng của chúng tôi</p>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="footer">
                <div class="policy">
                    <ul class="policy-list">
                        <li class="policy-list_item">
                            <a class="policy-list_text href="">CHÍNH SÁCH BẢO MẬT</a>
                        </li>
                        <li class="policy-list_item">
                            <a class="policy-list_text href="">CHÍNH SÁCH SỬ DỤNG</a>
                        </li>
                        <li class="policy-list_item">
                            <a class="policy-list_text href="">QUY CHẾ HOẠT ĐỘNG</a>
                        </li>
                    </ul>
                </div>
                <div class="contact">
                    <ul class="contact-list">
                        <li class="contact-list-text">
                            <p>Chịu trách nhiệm sản xuất: Nguyễn Hoàng Thạch - SĐT: 0342315687</p>
                        </li>
                        <li class="contact-list-text">
                            <p>Chịu trách nhiệm nội dung: Nguyễn Mạnh Thịnh - SĐT: 0962433107</p>
                        </li>
                        <li class="contact-list-text">
                            <p>Liên hệ: 20010822@st.phenikaa-uni.edu.vn - 20010828@st.phenikaa-uni.edu.vn</p>
                        </li>
                        <li class="contact-list-text">
                            <p>Thông tin chi tiết xin gửi về: Trường Đại học Phenikaa - P. Nguyễn Trác, Yên Nghĩa, Hà Đông, Hà Nội</p>
                        </li>
                    </ul>
                </div>
            </footer>
            
        </div>

    </body>
</html>