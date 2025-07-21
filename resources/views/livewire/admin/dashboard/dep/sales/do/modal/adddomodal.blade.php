<div>
    @if ($openadddomodal)
    <div class="modal fade show" style="display: block;" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable mw-750px">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Sale dispatch </h5>
                    <button type="button" class="btn-close text-white" wire:click="closeModal"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body p-4">
                    <form wire:submit.prevent="submit" enctype="multipart/form-data">
                        <!-- Account Type -->
                        <!-- Name -->

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Area<span class="text-danger">*</span></label>
                                <input type="text"  wire:model="area" class="form-control @error('area') is-invalid @enderror" id="area" >
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">DO No<span class="text-danger">*</span></label>
                                <input type="number"  wire:model="do_no" class="form-control @error('do_no') is-invalid @enderror" id="do_no" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Sale Represntative<span class="text-danger">*</span></label>
                                <select class="form-select @error('sale_represntative') is-invalid @enderror" wire:model.live="sale_represntative" id="sale_represntative">
                                    <option value="">Choose option</option>
                                    @if ($salesrepresentatives)
                                     @foreach ($salesrepresentatives as $s)
                                     <option value="{{ $s->id }}">{{ $s->name }}</option>
                                     @endforeach
                                    @endif
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Vehicle<span class="text-danger">*</span></label>
                                <select class="form-select @error('vehicle') is-invalid @enderror" wire:model.live="vehicle" id="vehicle">
                                    <option value="">Choose option</option>
                                    @if ($vehicles)
                                        @foreach ($vehicles as $v)
                                        <option value="{{ $v->id }}">{{ $v->item }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="row">


                            <div class="col-md-6 mb-3">
                                <label class="form-label">Driver<span class="text-danger">*</span></label>
                                <select class="form-select @error('driver') is-invalid @enderror" wire:model.live="driver" id="driver">
                                    <option value="">Choose option</option>
                                    @if ($drivers)
                                     @foreach ($drivers as $d)
                                     <option value="{{ $d->id }}">{{ $d->name }}</option>
                                     @endforeach

                                    @endif
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Date<span class="text-danger">*</span></label>
                                <input type="date"  wire:model="date" class="form-control @error('date') is-invalid @enderror" id="date" >
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Note<span class="text-danger">*</span></label>
                                <textarea wire:model="note" class="form-control" id="note"></textarea>
                            </div>
                        </div>




                        <!-- Submit Button -->
                        <div class="text-center">
                            <button type="button" class="btn btn-light me-2" wire:click="closeModal">Cancel</button>
                            <button type="submit" class="btn btn-primary">
                                <span wire:loading.remove>Save</span>
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
