<div>
    <div class="main-panel ps ps--active-y p-2" id="main-panel">
        <div class="header d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
              <h4 class="mb-0 me-3">Accounts</h4>
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
         <a href="{{ route('admin.dashboard.dep.account.payment.account') }}" wire:navigate>
            <div class="card" style="display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center;">
                <div class="icon-container">
                    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
                    <dotlottie-player src="https://lottie.host/9536ed71-8902-46ce-ab6f-071dceb329fa/DK14LF9XT5.lottie" background="transparent" speed="1" style="width: 130px; height: 130px" loop autoplay></dotlottie-player>
                </div>
                <p>Payment Accounts</p>
            </div>
         </a>
         <a href="{{ route('admin.dashboard.accounts.do.funds') }}" wire:navigate>
            <div class="card" style="display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center;">
                <div class="icon-container">
                    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
                    <dotlottie-player src="https://lottie.host/9536ed71-8902-46ce-ab6f-071dceb329fa/DK14LF9XT5.lottie" background="transparent" speed="1" style="width: 130px; height: 130px" loop autoplay></dotlottie-player>
                </div>
                <p>DO Funds</p>
            </div>
         </a>
          <a href="{{ route('admin.dashboard.accounts.do.receiving') }}" wire:navigate>
            <div class="card" style="display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center;">
                <div class="icon-container">
                    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
                    <dotlottie-player src="https://lottie.host/9536ed71-8902-46ce-ab6f-071dceb329fa/DK14LF9XT5.lottie" background="transparent" speed="1" style="width: 130px; height: 130px" loop autoplay></dotlottie-player>
                </div>
                <p>DO Receive</p>
            </div>
         </a>
          <a href="{{ route('admin.dashboard.accounts.customer.account.dashboard') }}" wire:navigate>
            <div class="card" style="display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center;">
                <div class="icon-container">
                    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
                    <dotlottie-player src="https://lottie.host/9536ed71-8902-46ce-ab6f-071dceb329fa/DK14LF9XT5.lottie" background="transparent" speed="1" style="width: 130px; height: 130px" loop autoplay></dotlottie-player>
                </div>
                <p>Customer Account</p>
            </div>
         </a>
           <a href="{{ route('admin.dashboard.accounts.customer.schedule.payment.dashboard') }}" wire:navigate>
            <div class="card" style="display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center;">
                <div class="icon-container">
                    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
                    <dotlottie-player src="https://lottie.host/9536ed71-8902-46ce-ab6f-071dceb329fa/DK14LF9XT5.lottie" background="transparent" speed="1" style="width: 130px; height: 130px" loop autoplay></dotlottie-player>
                </div>
                <p>Schedule Payment</p>
            </div>
         </a>
         <a href="{{ route('admin.dashboard.accounts.customer.unallocated.payments') }}" wire:navigate>
            <div class="card" style="display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center;">
                <div class="icon-container">
                    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
                    <dotlottie-player src="https://lottie.host/9536ed71-8902-46ce-ab6f-071dceb329fa/DK14LF9XT5.lottie" background="transparent" speed="1" style="width: 130px; height: 130px" loop autoplay></dotlottie-player>
                </div>
                <p>Payments management</p>
            </div>
         </a>
            <a href="{{ route('admin.dashboard.accounts.assest.dashboard') }}" wire:navigate>
            <div class="card" style="display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center;">
                <div class="icon-container">
                    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
                    <dotlottie-player src="https://lottie.host/9536ed71-8902-46ce-ab6f-071dceb329fa/DK14LF9XT5.lottie" background="transparent" speed="1" style="width: 130px; height: 130px" loop autoplay></dotlottie-player>
                </div>
                <p>Assest</p>
            </div>
         </a>
           <a href="{{ route('admin.dashboard.accounts.trial.balance') }}" wire:navigate>
            <div class="card" style="display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center;">
                <div class="icon-container">
                    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
                    <dotlottie-player src="https://lottie.host/9536ed71-8902-46ce-ab6f-071dceb329fa/DK14LF9XT5.lottie" background="transparent" speed="1" style="width: 130px; height: 130px" loop autoplay></dotlottie-player>
                </div>
                <p>Trial balance</p>
            </div>
         </a>
        </div>

    </div>

</div>
