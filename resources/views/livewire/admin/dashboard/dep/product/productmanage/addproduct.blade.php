<div>
    <div class="main-panel ps ps--active-y p-2" id="main-panel">
        <!-- Header Section -->
        <div class="header d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <h4 class="me-3">Product Management</h4>
                <nav class="nav">
                    <!-- Navigation elements here -->
                </nav>
            </div>
            <button class="btn btn-link text-decoration-none me-3" onclick="window.history.back()">
                <i class="bi bi-arrow-left-circle me-2"></i>Back
            </button>
            <livewire:admin.dashboard.notifylayout />
        </div>

        <!-- Activation Alert -->
        <div class="alert alert-danger" hidden>
            <strong>Activation email sent!</strong> Your database will expire in 3 hours. Didn't get the email?
        </div>


            <!-- ... (keep your existing header and other sections) ... -->

            <div class="container mt-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Add new product</h4>
                    </div>

                    <div class="card-body">
                        <form  wire:submit.prevent="submit">
                        <div class="row">
                            <!-- Left Column - Form Fields -->
                            <div class="col-md-8">

                            <div class="row mb-3">
                                <div class="col-md-6 position-relative">
                                    <label for="product_name" class="form-label @error('product_name') is-invalid @enderror">Product Name</label>
                                    <input type="text"  class="form-control @error('product_name') is-invalid @enderror" id="product_name" wire:model="product_name">
                                </div>



                                    <div class="col-md-4 position-relative">
                                        <label for="product_code" class="form-label @error('product_code') is-invalid @enderror">Product Code</label>
                                        <input type="text"  class="form-control @error('product_code') is-invalid @enderror" id="product_code" wire:model="product_code">
                                    </div>


                            </div>
                            <div class="row mb-3">

                                <div class="col-md-6">
                                    <label for="qty" class="form-label">Quantity</label>
                                    <input type="number" step="0.01" class="form-control @error('qty') is-invalid @enderror" id="qty" wire:model="qty" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label for="uom" class="form-label">Unit of measurement</label>
                                    <input type="text"  class="form-control @error('uom') is-invalid @enderror" id="uom" wire:model="uom">
                                </div>


                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="alert_qty" class="form-label">Alert Quantity</label>
                                    <input type="number" step="0.01" class="form-control @error('alert_qty') is-invalid @enderror" id="alert_qty" wire:model="alert_qty">
                                </div>

                                <div class="col-md-6">
                                    <label for="product_group" class="form-label">Product group</label>
                                    <select wire:model="product_group" class="form-select  @error('product_group') is-invalid @enderror" id="product_group">
                                        <option value="">Select group</option>
                                         @if ($productgroup)
                                             @foreach ($productgroup as $group)
                                             <option value="{{ $group->id }}">{{ $group->product_group }}</option>
                                             @endforeach
                                         @endif

                                    </select>
                                </div>

                            </div>



                            </div>

                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Product Image</h5>
                                    </div>
                                    <div class="card-body">
                                        <!-- Image Upload Area -->
                                        <div class="mb-3">
                                            <label for="product_images" class="form-label">Upload Product Images</label>
                                            <input class="form-control" type="file" id="product_images" wire:model="product_images"  accept="image/*">
                                            <small class="text-muted">Max 1 image (JPEG, PNG, max 2MB each)</small>
                                            @error('product_images.*') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>

                                        <!-- Preview Section -->
                                        <div class="border rounded p-2 mb-3" style="min-height: 200px;">
                                            <h6 class="text-center text-muted mb-3">Image Preview</h6>

                                            <!-- Placeholder when no images -->
                                            @if(!$temp_images && !$product_images)
                                                <div class="text-center py-4">
                                                    <i class="bi bi-images fs-1 text-muted"></i>
                                                    <p class="text-muted">No images selected</p>
                                                </div>
                                            @endif

                                            <!-- Loading indicator -->
                                            <div class="text-center py-4" wire:loading wire:target="product_images">
                                                <div class="spinner-border text-primary" role="status">
                                                    <span class="visually-hidden">Loading...</span>
                                                </div>
                                                <p class="text-muted mt-2">Uploading images...</p>
                                            </div>

                                            <!-- Image Thumbnails -->
                                            <div class="row g-2">
                                                <!-- Temporary previews (before save) -->
                                                @if($temp_images)
                                                    @foreach($temp_images as $index => $temp_image)
                                                        <div class="col-6">
                                                            <div class="position-relative">
                                                                <img src="{{ $temp_image }}" class="img-thumbnail" style="height: 100px; width: 100%; object-fit: cover;">
                                                                <button wire:click.prevent="removeTempImage({{ $index }})" class="btn btn-sm btn-danger position-absolute top-0 end-0">
                                                                    <i class="bi bi-x"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif

                                                <!-- Saved images -->

                                            </div>
                                        </div>

                                        <!-- Featured Image Selection -->

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">

                                    <button type="submit" class="btn btn-success">
                                        <span class="indicator-label" wire:loading.remove>Add
                                            </span>
                                        <span class="indicator-progress" wire:loading>Please wait...
                                            <span
                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>

                                    <button class="btn btn-danger" type="reset">Cancel</button>
                                </div>
                            </div>

                        </div>
                    </form>
                    </div>
                </div>
            </div>


            <script>
document.addEventListener('livewire:navigated', function () {
        attachEventListeners();
    });

    document.addEventListener('DOMContentLoaded', function () {
        attachEventListeners();
    });
                window.addEventListener('errorproductAdded', function(event) {
                        Swal.fire({
                            icon: 'error', // Change icon to 'error' instead of 'success'
                            title: 'Error!',
                            text: event.detail.message, // Show the error message
                            showConfirmButton: false,
                            timer: 3000,
                            toast: true,
                            position: 'top-end'
                        });
                    });

                    window.addEventListener('productAdded', function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'New product added successfully!',
                            showConfirmButton: false,
                            timer: 3000,
                            toast: true,
                            position: 'top-end'
                        });
                    });
            </script>
    </div>

</div>
