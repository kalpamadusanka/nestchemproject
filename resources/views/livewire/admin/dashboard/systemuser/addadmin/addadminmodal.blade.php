<div>
    @if ($viewsystemusermodal)
    <div class="modal fade show" style="display: block;" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable mw-750px">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Add User</h5>
                    <button type="button" class="btn-close text-white" wire:click="closeModal"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body p-4">
                    <form wire:submit.prevent="submit" enctype="multipart/form-data">
                        <!-- Profile Image Upload -->
                        <div class="text-center mb-4">
                            <div class="position-relative d-inline-block">
                                <div id="avatar-preview" class="rounded-circle overflow-hidden" style="width: 120px; height: 120px; background-image: url(); background-size: cover; background-position: center;">
                                    @if ($avatar)
                                    <img src="{{ $avatar->temporaryUrl() }}" alt="Profile Image" class="w-100 h-100">
                                    @else
                                    <div class="d-flex align-items-center justify-content-center h-100 w-100 bg-light">
                                        <i class="bi bi-person-circle text-muted" style="font-size: 3rem;"></i>
                                    </div>
                                    @endif
                                </div>
                                <label
                                class="position-absolute bottom-0 end-0 rounded-circle shadow d-flex align-items-center justify-content-center"
                                style="transform: translate(25%, 25%); width: 30px; height: 30px; background-color: #007bff; color: white; cursor: pointer;">
                                <i class="bi bi-pencil"></i>
                                <input
                                    type="file"
                                    wire:model="avatar"
                                    accept=".png, .jpg, .jpeg"
                                    class="d-none"
                                >
                            </label>

                            </div>
                            <div class="form-text mt-2">Allowed file types: png, jpg, jpeg.</div>
                        </div>

                        <!-- Input Fields -->
                        <div class="mb-3">
                            <label class="form-label">Full Name <span class="text-danger">*</span></label>
                            <input type="text" wire:model="user_name" id="user_name" class="form-control @error('user_name') is-invalid @enderror" placeholder="Enter full name">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" wire:model="user_email" id="user_email" class="form-control @error('user_email') is-invalid @enderror" placeholder="example@domain.com">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password <span class="text-danger">*</span></label>
                            <input type="password" wire:model="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter password">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Location <span class="text-danger">*</span></label>
                            <select wire:model="location" class="form-select  @error('location') is-invalid @enderror" id="location">
                                <option value="">Select location</option>
                                <option value="colombo">Colombo</option>
                            </select>
                        </div>

                        <!-- Role Selection -->
                        <div class="mb-4">
                            <label class="form-label">Role <span class="text-danger">*</span></label>
                            @if (!empty($roles))
                                <div class="d-flex flex-wrap gap-3">
                                    @foreach ($roles as $role)
                                        <div class="form-check">
                                            <input
                                                class="form-check-input"
                                                type="radio"
                                                wire:model="user_role"
                                                value="{{ $role->name }}"
                                                id="role_{{ $role->id }}"/>
                                            <label
                                                class="form-check-label"
                                                for="role_{{ $role->id }}">
                                                {{ $role->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-muted">No roles available.</p>
                            @endif
                        </div>


                        <!-- Submit Button -->
                        <div class="text-center">
                            <button type="button" class="btn btn-light me-2" wire:click="closeModal">Cancel</button>
                            <button type="submit" class="btn btn-primary">
                                <span wire:loading.remove>Submit</span>
                                <span wire:loading>Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
