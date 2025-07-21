<div>
    <div class="main-panel ps ps--active-y p-2" id="main-panel">
        <div class="header d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
              <h4 >Employee Management</h4>
              <nav class="nav">

              </nav>
            </div>
            <button class="btn btn-link text-decoration-none me-3" onclick="window.history.back()">
                <i class="bi bi-arrow-left-circle me-2"></i>Back
            </button>
            <livewire:admin.dashboard.notifylayout/>

          </div>
        <!-- Activation alert -->
        <div class="alert alert-danger" hidden>
            <strong>Activation email sent!</strong> Your database will expire in 3 hours. Didn't get the email?
        </div>


        <div class="content" style="padding-top: 7%">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4 class="card-title mb-0">Employee Management/{{ $userName ?? 'Not Updated' }}/documents</h4>
                            <a href="{{ route('neo.existing.employee.view.profile', ['userid' => $userid]) }}" wire:navigate class="btn btn-primary">View Profile</a>
                        </div>


                        <div class="card-body">
                            <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css"
                                rel="stylesheet">
                            <div class="content">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card-box">
                                                <div class="row">
                                                    @if ($documents)
                                                        @foreach ($documents as $doc)
                                                        <div class="col-lg-3">
                                                            <div class="file-man-box"><a href=""
                                                                    class="file-close"><i
                                                                        class="fa fa-times-circle"></i></a>
                                                                <div class="file-img-box px-2"><script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
                                                                    <dotlottie-player src="https://lottie.host/f5f8d142-bd73-4c96-9a98-78ca2eb426a2/5HKsWsaQLh.lottie" background="transparent" speed="1" style="width: 150px; height: 150px" loop autoplay></dotlottie-player></div>
                                                                    <a  wire:click="download({{ $doc->id }})" class="file-download">
                                                                        <i class="fa fa-download"></i>
                                                                    </a>
                                                                <div class="file-man-title">
                                                                  <h5 class="mb-0 text-overflow">{{ $doc->doc }}</h5>


                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    @endif




                                                </div>


                                            </div>
                                        </div>
                                        <!-- end col -->
                                    </div>
                                    <!-- end row -->
                                </div>
                                <!-- container -->
                            </div>
                        </div>

                    </div><!--  end card  -->
                </div> <!-- end col-md-12 -->
            </div> <!-- end row -->

        </div>


        <script>

                     window.addEventListener('docfounderror', function() {
                         Swal.fire({
                             icon: 'error',
                             title: 'Error!',
                             text: 'Document does not exist!',
                             showConfirmButton: false,
                             timer: 3000,
                             toast: true,
                             position: 'top-end'
                         });
                     });

                 </script>
    </div>
    <style>

.card-box {
                padding: 20px;
                border-radius: 3px;
                margin-bottom: 30px;
                background-color: #fff;
            }

            .file-man-box {
                padding: 20px;
                border: 1px solid #e3eaef;
                border-radius: 5px;
                position: relative;
                margin-bottom: 20px
            }

            .file-man-box .file-close {
                color: #f1556c;
                position: absolute;
                line-height: 24px;
                font-size: 24px;
                right: 10px;
                top: 10px;
                visibility: hidden
            }

            .file-man-box .file-img-box {
                line-height: 120px;
                text-align: center
            }

            .file-man-box .file-img-box img {
                height: 64px
            }

            .file-man-box .file-download {
                font-size: 32px;
                color: #98a6ad;
                position: absolute;
                right: 10px
            }

            .file-man-box .file-download:hover {
                color: #313a46
            }

            .file-man-box .file-man-title {
                padding-right: 25px
            }

            .file-man-box:hover {
                -webkit-box-shadow: 0 0 24px 0 rgba(0, 0, 0, .06), 0 1px 0 0 rgba(0, 0, 0, .02);
                box-shadow: 0 0 24px 0 rgba(0, 0, 0, .06), 0 1px 0 0 rgba(0, 0, 0, .02)
            }

            .file-man-box:hover .file-close {
                visibility: visible
            }

            .text-overflow {
                text-overflow: ellipsis;
                white-space: nowrap;
                display: block;
                width: 100%;
                overflow: hidden;
            }

            h5 {
                font-size: 15px;
            }
        .icon-container {
            font-size: 30px;
            color: #007bff;
        }
        .dashboard-title {
            margin-top: 20px;
            font-size: 18px;
        }
        .grid-container {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 20px;
        }
        .alert {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
            margin-bottom: 20px;
        }
        .header {
              background-color: #f8f9fa;
              padding: 10px 20px;
              border-bottom: 1px solid #ddd;
            }
            .nav-link {
              color: #000;
              font-weight: 500;
            }
            .nav-link:hover {
              color: #007bff;
            }
            .btn-new {
              border: 1px solid #6c757d;
              color: #6c757d;
            }
            .btn-new:hover {
              background-color: #6c757d;
              color: #fff;
            }
            .notification-badge {
              background-color: #dc3545;
              color: #fff;
              border-radius: 20px;
              padding: 5px 10px;
              font-size: 14px;
            }
            .profile-icon {
              width: 30px;
              height: 30px;
              background-color: #6c757d;
              color: #fff;
              border-radius: 50%;
              display: flex;
              justify-content: center;
              align-items: center;
              font-weight: bold;
            }
    </style>
</div>
