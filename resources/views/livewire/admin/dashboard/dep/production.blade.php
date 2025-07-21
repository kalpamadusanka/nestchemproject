<div>
    <div class="main-panel ps ps--active-y p-2" id="main-panel">
        <div class="header d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
              <h4 class="mb-0 me-3">Material</h4>
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

         <a href="{{ route('admin.dashboard.dep.production.warehouse.dashboard') }}" wire:navigate>
            <div class="card" style="display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center;">
                <div class="icon-container">
                    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
                    <dotlottie-player src="https://lottie.host/3453c02a-5e87-42e4-a791-1d59228ac428/1tcm1Gn1B1.lottie" background="transparent" speed="1" style="width: 130px; height: 130px" loop autoplay></dotlottie-player>
                </div>
                <p>Warehouse</p>
            </div>
        </a>

        <a href="{{ route('admin.dashboard.dep.production.supplier.dashboard') }}" wire:navigate>
            <div class="card" style="display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center;">
                <div class="icon-container">
                    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
                    <dotlottie-player src="https://lottie.host/71de9514-1b5c-400e-9752-a0ebf81cbc13/NbnoHp3p3H.lottie" background="transparent" speed="1" style="width: 130px; height: 130px" loop autoplay></dotlottie-player>
                </div>
                <p>Supplier</p>
            </div>
        </a>
        <a href="{{ route('admin.dashboard.dep.production.material.dashboard') }}" wire:navigate>
            <div class="card" style="display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center;">
                <div class="icon-container">
                    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
                    <dotlottie-player src="https://lottie.host/bc39eb60-6a3f-4e88-bee1-7b2a720064a5/OpsUdLU93G.lottie" background="transparent" speed="1" style="width: 130px; height: 130px" loop autoplay></dotlottie-player>
                </div>
                <p>Inventory</p>
            </div>
         </a>
        <a href="{{ route('admin.dashboard.dep.production.po.dashboard') }}" wire:navigate>
            <div class="card" style="display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center;">
                <div class="icon-container">
                    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
                    <dotlottie-player src="https://lottie.host/9b00eba1-6653-4dc5-96a6-37031792f821/dvzMrspUS6.lottie" background="transparent" speed="1" style="width: 130px; height: 130px" loop autoplay></dotlottie-player>
                </div>
                <p>Purchasing & Receiving</p>
            </div>
        </a>
        <a href="{{ route('admin.dashboard.dep.production.material.record.history') }}" wire:navigate>
            <div class="card" style="display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center;">
                <div class="icon-container">
                    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
                    <dotlottie-player src="https://lottie.host/32f2c471-1704-4c13-9646-3ef891404955/oqZWfxJ3Dj.lottie" background="transparent" speed="1" style="width: 130px; height: 130px" loop autoplay></dotlottie-player>
                </div>
                <p>Material History</p>
            </div>
        </a>
        <a href="{{ route('admin.dashboard.dep.production.material.request.list') }}" wire:navigate>
            <div class="card" style="display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center;">
                <div class="icon-container">
                    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
                    <dotlottie-player src="https://lottie.host/72f5f76d-c7f3-4c22-98bf-b804075cdeee/jSZmpYzFNi.lottie" background="transparent" speed="1" style="width: 130px; height: 130px" loop autoplay></dotlottie-player>
                </div>
                <p>Requests</p>
            </div>
        </a>
            <!-- Add more cards as needed -->
        </div>
    </div>

</div>
