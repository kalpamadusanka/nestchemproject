<div>
    @if ($openovertimecategorymodal)
    <div class="modal fade show" style="display: block;" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable mw-750px">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Add Category</h5>
                    <button type="button" class="btn-close text-white" wire:click="closeModal"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body p-4">
                    <form wire:submit.prevent="submit" enctype="multipart/form-data">
                        <!-- Profile Image Upload -->
                        <!-- Input Fields -->
                        <div class="mb-3">
                            <label class="form-label">Category Name<span class="text-danger">*</span></label>
                            <input type="text" wire:model="category_name" class="form-control @error('category_name') is-invalid @enderror" id="category_name">
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

                    <div class="mb-3 py-2">
                        <h5>Existing Categories</h5>
                        <ul class="list-group">
                            @if ($categories->count() > 0)
                            @foreach ($categories as $category)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $category->category_name }}
                                <button wire:click="deleteCategory({{ $category->id }})" class="btn btn-sm btn-danger">Delete</button>
                            </li>
                            @endforeach
                        @else

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Currently not available
                        </li>
                        @endif
                        </ul>
                    </div>


                </div>
            </div>
        </div>
    </div>
    @endif
</div>
