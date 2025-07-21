<div>
    <div class="main-panel ps ps--active-y p-2" id="main-panel">
        <div class="header d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <h4 class="mb-0 me-3">Sales Management</h4>
                <nav class="nav">

                </nav>
            </div>
            <livewire:admin.dashboard.notifylayout />

        </div>
        <!-- Activation alert -->
        <div class="alert alert-danger" hidden>
            <strong>Activation email sent!</strong> Your database will expire in 3 hours. Didn't get the email?
        </div>



        <!-- Grid of Cards -->
        <div class="grid-container py-4">
            <a href="{{ route('admin.dashboard.dep.sale.do') }}" wire:navigate>
                <div class="card"
                    style="display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center;">
                    <div class="icon-container">
                        <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
                        <dotlottie-player
                            src="https://lottie.host/af8f7e1f-7552-41d6-87f1-16bbb657d584/e6Viiqx9Re.lottie"
                            background="transparent" speed="1" style="width: 130px; height: 130px" loop
                            autoplay></dotlottie-player>
                    </div>
                    <p>DO</p>
                </div>
            </a>
            <a href="{{ route('admin.dashboard.dep.sale.do.load') }}" wire:navigate>
                <div class="card"
                    style="display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center;">
                    <div class="icon-container">
                        <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
                        <dotlottie-player
                            src="https://lottie.host/0d00742d-debf-460a-a776-2dcd2c363e48/xiiByLk4WQ.lottie"
                            background="transparent" speed="1" style="width: 130px; height: 130px" loop
                            autoplay></dotlottie-player>
                    </div>
                    <p>Load</p>
                </div>
            </a>
            <a href="{{ route('admin.dashboard.dep.sale.distribute') }}" wire:navigate>
                <div class="card"
                    style="display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center;">
                    <div class="icon-container">
                        <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
                        <dotlottie-player
                            src="https://lottie.host/10ff5ccb-7701-4f98-a4ff-5d70e05e3d0c/ZZetnrDdbz.lottie"
                            background="transparent" speed="1" style="width: 130px; height: 130px" loop
                            autoplay></dotlottie-player>
                    </div>
                    <p>Distributing</p>
                </div>
            </a>
            <a href="{{ route('admin.dashboard.dep.sale.unload') }}" wire:navigate>
                <div class="card"
                    style="display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center;">
                    <div class="icon-container">
                        <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
                        <dotlottie-player
                            src="https://lottie.host/7a77e993-58ed-4747-a472-fe18635a2779/0hFW2fjkoc.lottie"
                            background="transparent" speed="1" style="width:130px; height: 130px" loop
                            autoplay></dotlottie-player>
                    </div>
                    <p>Unload</p>
                </div>
            </a>
            <a href="{{ route('admin.dashboard.dep.sale.customer.list.dashboard') }}" wire:navigate>
                <div class="card"
                    style="display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center;">
                    <div class="icon-container">
                        <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
                        <dotlottie-player
                            src="https://lottie.host/bb3685c8-1b67-4eee-9545-311d44b035f2/FeFYU77doL.lottie"
                            background="transparent" speed="1" style="width: 130px; height: 130px" loop
                            autoplay></dotlottie-player>
                    </div>
                    <p>Customer</p>
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
            height: 600px;
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
