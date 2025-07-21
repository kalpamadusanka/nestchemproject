<div>
    @if ($openshelfviewmodal)
    <div class="modal fade show" style="display: block;" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Shelf view</h5>
                    <button type="button" class="btn-close text-white" wire:click="closeModal"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body p-4">
    <div class="container py-5">
        <div class="library-shelves">
            @if ($shelfdetails)
                @foreach ($shelfdetails as $s)
                <div class="shelf-unit">
                    <div class="shelf-content">
                        <div class="shelf-books" style="width: {{ min($s->qty * 5, 100) }}%">
                            <span class="book-count">{{ $s->qty }}</span>
                        </div>
                    </div>
                    <div class="shelf-board"></div>
                    <div class="shelf-info">
                        <strong>{{ $s->shelfCheck->shelf_no ?? 'N/A' }}</strong><br>
                        {{ $s->productStockcCheck->productGroup->product_group }}
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</div>

<style>
    .library-shelves {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    .shelf-unit {
        width: 150px;
        margin-bottom: 30px;
    }

    .shelf-content {
        height: 100px;
        background: #f9f4e8;
        border-left: 10px solid #d4c9a8;
        padding: 10px 5px 0 5px;
        position: relative;
    }

    .shelf-books {
        height: 80px;
        background: #4a6baf;
        border-radius: 2px;
        position: relative;
        transition: width 0.3s;
    }

    .book-count {
        position: absolute;
        right: -25px;
        top: 50%;
        transform: translateY(-50%);
        background: #333;
        color: white;
        padding: 2px 8px;
        border-radius: 10px;
        font-size: 12px;
    }

    .shelf-board {
        height: 10px;
        background: #d4c9a8;
        margin-top: -5px;
        box-shadow: 0 3px 5px rgba(0,0,0,0.1);
    }

    .shelf-info {
        padding: 10px 5px;
        font-size: 13px;
        text-align: center;
    }
</style>
            </div>
        </div>
    </div>
    @endif
</div>
