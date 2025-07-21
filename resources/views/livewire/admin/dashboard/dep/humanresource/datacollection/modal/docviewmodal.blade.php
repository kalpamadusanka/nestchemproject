<div>
    @if ($opendocviewmodal)
    <div class="modal fade show" style="display: block;" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">View document</h5>
                    <button type="button" class="btn-close text-white" wire:click="closeModal"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body p-4">
                    <form wire:submit.prevent="submit" enctype="multipart/form-data">
                        <div class="card-body">
                            <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css"
                                rel="stylesheet">
                            <div class="content">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card-box">
                                                <div class="row">
                                                    @if ($documents)
                                                        @foreach ($documents as $doc)
                                                        <div class="col-lg-3">
                                                            <div class="file-man-box">
                                                                <a wire:click="removedoc({{ $doc->id }})" class="file-close"><i class="fa fa-times-circle"></i></a>
                                                                <div class="file-img-box px-2">
                                                                    <!-- Document Icon -->
                                                                    <i class="fa fa-file-text" style="font-size: 150px; color: #007bff;"></i>
                                                                </div>
                                                                <a wire:click="download({{ $doc->id }})" class="file-download">
                                                                    <i class="fa fa-download"></i>
                                                                </a>
                                                                <div class="file-man-title">
                                                                    <h5 class="mb-0 text-overflow" style="font-size: 12px;">{{ $doc->doc }}</h5>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="text-center">
                            <button type="button" class="btn btn-light me-2" wire:click="closeModal">Close</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
