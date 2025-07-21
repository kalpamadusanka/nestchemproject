<div>
    <div class="main-panel ps ps--active-y p-2" id="main-panel">
        <div class="header d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
              <h4 class="mb-0 me-3">Manufacture</h4>
              <nav class="nav">

              </nav>
            </div>
            <livewire:admin.dashboard.notifylayout/>

          </div>
        <!-- Activation alert -->
        <div class="alert alert-danger" hidden>
            <strong>Activation email sent!</strong> Your database will expire in 3 hours. Didn't get the email?
        </div>



        <!-- Grid of Cards -->
        <div class="grid-container py-4">
            <a href="{{ route('admin.dashboard.dep.manufacture.material.request.dashboard') }}" wire:navigate>
                <div class="card" style="display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center;">
                    <div class="icon-container">
                        <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
                    <dotlottie-player src="https://lottie.host/bc39eb60-6a3f-4e88-bee1-7b2a720064a5/OpsUdLU93G.lottie" background="transparent" speed="1" style="width: 130px; height: 130px" loop autoplay></dotlottie-player>
                    </div>
                    <p>Material</p>
                </div>
             </a>
         <a href="{{ route('admin.dashboard.dep.manufacture.creating.manufacture.dashboard') }}" wire:navigate>
            <div class="card" style="display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center;">
                <div class="icon-container">
                    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
                    <dotlottie-player src="https://lottie.host/b32189e0-7e13-4e16-9305-b306b74db991/n7xJzfhxEr.lottie" background="transparent" speed="1" style="width: 130px; height: 130px" loop autoplay></dotlottie-player>
                </div>
                <p>Manufacture</p>
            </div>
         </a>

            <!-- Add more cards as needed -->
        </div>
    </div>
    <style>
        .card {
            border-radius: 10px;
            margin-bottom: 20px;
            text-align: center;
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
