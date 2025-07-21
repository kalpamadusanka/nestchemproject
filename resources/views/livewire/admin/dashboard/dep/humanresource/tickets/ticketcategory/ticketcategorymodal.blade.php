<div>
    @if ($openticketcategorymodal)
        <div class="modal fade show" style="display: block;" tabindex="-1" aria-modal="true" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable mw-750px">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Add Ticket</h5>
                        <button type="button" class="btn-close text-white" wire:click="closeModal"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body p-4">
                        <form wire:submit.prevent="submit" enctype="multipart/form-data">
                            <!-- Profile Image Upload -->


                            <!-- Input Fields -->
                            <div class="mb-3">
                                <label class="form-label">Ticket Category<span class="text-danger">*</span></label>
                                <input type="text" wire:model="ticketcategory" id="ticketcategory"
                                    class="form-control @error('ticketcategory') is-invalid @enderror"
                                    placeholder="Enter category name">
                            </div>


                            <!-- Submit Button -->
                            <div class="text-center">
                                <button type="button" class="btn btn-light me-2"
                                    wire:click="closeModal">Cancel</button>
                                <button type="submit" class="btn btn-primary">
                                    <span wire:loading.remove>Add</span>
                                    <span wire:loading>Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                            </div>
                        </form>

                        <div class="mt-4">
                            <h5>Ticket Categories</h5>
                            <ul class="list-group" style="max-height: 200px; overflow-y: auto;">
                                @if ($ticketcategorylist)
                                    @foreach ($ticketcategorylist as $ticketcat)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            {{ $ticketcat->category_name }}
                                            <button class="btn btn-sm btn-danger text-white bg-red-500 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-opacity-50 p-2 rounded" wire:click="delete({{ $ticketcat->id }})">
                                                Delete
                                            </button>

                                        </li>
                                    @endforeach
                                @endif


                            </ul>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
