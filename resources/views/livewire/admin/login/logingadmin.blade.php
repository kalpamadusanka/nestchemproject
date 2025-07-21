<div>
    <section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper">
					<div class="brand">
						<img src="img/logo.jpg" alt="logo">
					</div>
					<div class="card fat">
						<div class="card-body">
							<h4 class="card-title">Login</h4>
							<form  class="my-login-validation" wire:submit.prevent="login">
								<div class="form-group">
									<label for="email">E-Mail Address</label>
									<input id="email" type="email" class="form-control" wire:model="email" value="" required autofocus>
									<div class="invalid-feedback">
										Email is invalid
									</div>
								</div>

								<div class="form-group">
									<label for="password">Password

									</label>
									<input id="password" type="password" class="form-control" wire:model="password" required data-eye>
								    <div class="invalid-feedback">
								    	Password is required
							    	</div>
								</div>



                                <div class="form-group m-0">
                                    <button type="submit" class="btn btn-primary btn-block" wire:loading.attr="disabled">
                                        <span wire:loading.remove>Login</span>
                                        <span wire:loading>Please wait...</span>
                                    </button>
                                </div>

                                @if (session()->has('message'))
                                <div class="mt-2 text-green-500">{{ session('message') }}</div>
                            @endif

                            @if (session()->has('error'))
                                <div class="mt-2 text-danger">{{ session('error') }}</div>
                            @endif
							</form>
						</div>
					</div>

				</div>
			</div>
		</div>
	</section>
</div>
