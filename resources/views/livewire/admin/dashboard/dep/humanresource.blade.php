<div>
    <div class="main-panel ps ps--active-y p-2" id="main-panel">
        <div class="header d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
              <h4 class="mb-0 me-3">Human Resource</h4>
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
         <a href="{{ route('admin.dashboard.dep.human.resource.employee.addemployee') }}" wire:navigate>
            <div class="card" style="display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center;">
                <div class="icon-container">
                    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
                    <dotlottie-player src="https://lottie.host/d98c7bbf-edd0-4866-955b-d953ad52af0e/E2GooT3Z5F.lottie" background="transparent" speed="1" style="width: 130px; height: 130px" loop autoplay></dotlottie-player>
                </div>
                <p>Employee</p>
            </div>
         </a>
         <a href="{{ route('admin.dashboard.dep.human.resource.tickets.alltickets') }}" wire:navigate>
            <div class="card" style="display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center;">
                <div class="icon-container">
                    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
<dotlottie-player src="https://lottie.host/c8df11e4-7751-43cf-b207-8bf552c1824b/GohEkyiwBw.lottie" background="transparent" speed="1" style="width: 130px; height: 130px" loop autoplay></dotlottie-player>
                </div>
                <p>Tickets</p>
            </div>
        </a>
        <a href="{{ route('admin.dashboard.dep.human.resource.employee.attendence') }}" wire:navigate>
            <div class="card" style="display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center;">
                <div class="icon-container">
                    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
                    <dotlottie-player src="https://lottie.host/71de9514-1b5c-400e-9752-a0ebf81cbc13/NbnoHp3p3H.lottie" background="transparent" speed="1" style="width: 130px; height: 130px" loop autoplay></dotlottie-player>
                </div>
                <p>Attendance</p>
            </div>
        </a>
        <a href="{{ route('admin.dashboard.dep.human.resource.employee.worksheet') }}" wire:navigate>
            <div class="card" style="display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center;">
                <div class="icon-container">
                    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
                    <dotlottie-player src="https://lottie.host/48ba011f-1da4-450e-ab39-26d57ebca3a3/U9w1OWiU5s.lottie" background="transparent" speed="1" style="width: 130px; height: 130px" loop autoplay></dotlottie-player>
                </div>
                <p>Worksheet</p>
            </div>
        </a>
        <a href="{{ route('admin.dashboard.dep.human.resource.company.assets') }}" wire:navigate>
            <div class="card" style="display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center;">
                <div class="icon-container">
                    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
                    <dotlottie-player src="https://lottie.host/8b285ba1-e309-4e92-9cde-49132273ae43/pqRRUaCTDL.lottie" background="transparent" speed="1" style="width: 130px; height: 130px" loop autoplay></dotlottie-player>
                </div>
                <p>Assets</p>
            </div>
        </a>
        <a href="{{ route('admin.dashboard.dep.human.resource.company.expenses') }}" wire:navigate>
            <div class="card" style="display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center;">
                <div class="icon-container">
                    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
                    <dotlottie-player src="https://lottie.host/9b259145-38fd-4b44-822d-215ffd1c3364/ORaZsZ5W9q.lottie" background="transparent" speed="1" style="width: 130px; height: 130px" loop autoplay></dotlottie-player>
                </div>
                <p>Expenses</p>
            </div>
        </a>
        <a href="{{ route('admin.dashboard.dep.human.resource.data.collection') }}" wire:navigate>
            <div class="card" style="display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center;">
                <div class="icon-container">
                    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
                    <dotlottie-player src="https://lottie.host/7b553fb9-f649-4b28-9639-33857893e20f/SEOogxFWYn.lottie" background="transparent" speed="1" style="width: 130px; height: 130px" loop autoplay></dotlottie-player>
                </div>
                <p>Data Collection</p>
            </div>
        </a>
        <a href="{{ route('admin.dashboard.dep.human.resource.overtime') }}" wire:navigate>
            <div class="card" style="display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center;">
                <div class="icon-container">
                    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
                    <dotlottie-player src="https://lottie.host/e5fdd89d-cc1e-4c85-8cfd-6ad9b8138a0c/wmBVkcwLZr.lottie" background="transparent" speed="1" style="width: 130px; height: 130px" loop autoplay></dotlottie-player>
                </div>
                <p>Overtime</p>
            </div>
        </a>
        <a href="{{ route('admin.dashboard.dep.human.resource.loan.advance.dashboard') }}" wire:navigate>
            <div class="card" style="display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center;">
                <div class="icon-container">
                    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
                    <dotlottie-player src="https://lottie.host/e9df84b5-0893-4919-b70d-a1c411d6276d/wKlYtwBWe6.lottie" background="transparent" speed="1" style="width: 130px; height: 130px" loop autoplay></dotlottie-player>
                </div>
                <p>Loans & Advance</p>
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
