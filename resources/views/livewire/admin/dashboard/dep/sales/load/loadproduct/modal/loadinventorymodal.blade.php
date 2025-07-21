<div>
    @if ($opencurrentinventory)
    <div class="modal fade show" style="display: block;" tabindex="-1" aria-modal="true" role="dialog">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">
             <div class="modal-header bg-primary text-white">
                 <h5 class="modal-title">Current Inventory</h5>
                 <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" wire:click="closeModal"></button>
             </div>
             <div class="modal-body">
                 <form wire:submit.prevent="submit">
                     <!-- Search and Filter Row -->
                     <div class="flex-container">
                        @foreach($inventoryItem as $product)
                        <div class="column">
                            <div class="product-card-modern">
                                <!-- Product Image with hover effect -->
                                <div class="product-image-modern">
                                    <img src="{{ url('product/' . $product->productData->product_image) }}"
                                         alt="{{ $product->productData->product_name }}"
                                         class="product-img">
                                    <div class="image-overlay"></div>
                                </div>

                                <!-- Product Info -->
                                <div class="product-info p-4">
                                    <!-- Product Name -->
                                    <h4 class="text-lg font-medium text-gray-900 mb-3">
                                        {{ $product->productData->product_name }}
                                    </h4>

                                    <!-- Stock Information -->
                                    <div class="space-y-3">
                                        <!-- Loaded Units -->
                                        <div class="flex items-center">
                                            <div class="w-3 h-3 bg-blue-500 rounded-full mr-2"></div>
                                            <span class="text-sm text-gray-700">
                                                <span class="font-medium">{{ $product->qty }}</span> units loaded
                                            </span>
                                        </div>

                                        <!-- Available Units -->
                                        <div class="flex items-center">
                                            <div class="w-3 h-3 bg-green-500 rounded-full mr-2"></div>
                                            <span class="text-sm text-gray-700">
                                                <span class="font-medium">{{ $product->in_loading_stock }}</span> units available
                                            </span>
                                        </div>

                                        <!-- Sold Units -->
                                        <div class="flex items-center">
                                            <div class="w-3 h-3 bg-gray-400 rounded-full mr-2"></div>
                                            <span class="text-sm text-gray-700">
                                                <span class="font-medium">{{ $product->qty - $product->in_loading_stock }}</span> units sold
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Stock Bar Visualization -->
                                    <div class="mt-4">
                                        <div class="stock-indicator">
                                            <div class="stock-progress"
                                                 style="--percentage: {{ ($product->in_loading_stock/$product->qty)*100 }}%;
                                                        --color: {{ ($product->in_loading_stock/$product->qty)*100 > 50 ? '#10B981' : (($product->in_loading_stock/$product->qty)*100 > 20 ? '#F59E0B' : '#EF4444') }};">
                                                <span>{{ round(($product->in_loading_stock/$product->qty)*100) }}%</span>
                                            </div>
                                            <div class="stock-details">
                                                <span class="stock-label">Stock</span>
                                                <span class="stock-amount">{{ $product->in_loading_stock }} of {{ $product->qty }}</span>
                                            </div>
                                        </div>

                                        <style>
                                        .stock-indicator {
                                            display: flex;
                                            align-items: center;
                                            gap: 12px;
                                            font-family: 'Inter', sans-serif;
                                        }

                                        .stock-progress {
                                            width: 44px;
                                            height: 44px;
                                            border-radius: 50%;
                                            background: conic-gradient(var(--color) var(--percentage), #E5E7EB 0);
                                            display: flex;
                                            align-items: center;
                                            justify-content: center;
                                            position: relative;
                                        }

                                        .stock-progress::before {
                                            content: '';
                                            position: absolute;
                                            width: 36px;
                                            height: 36px;
                                            border-radius: 50%;
                                            background: white;
                                        }

                                        .stock-progress span {
                                            font-size: 11px;
                                            font-weight: 600;
                                            z-index: 1;
                                            color: var(--color);
                                        }

                                        .stock-details {
                                            display: flex;
                                            flex-direction: column;
                                        }

                                        .stock-label {
                                            font-size: 12px;
                                            color: #6B7280;
                                        }

                                        .stock-amount {
                                            font-size: 13px;
                                            font-weight: 500;
                                            color: #111827;
                                        }
                                        </style>
                                        <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
                                            <div
                                                class="h-full bg-green-500"
                                                style="width: {{ ($product->in_loading_stock / $product->qty) * 100 }}%"
                                            ></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                 </form>
             </div>
             <div class="modal-footer d-flex justify-content-between flex-wrap">
                <div><strong>Total Amount:</strong> Rs. {{ number_format($totalAmount, 2) }}</div>
                <div><strong>Can Total:</strong> Rs. {{ number_format($canTotal, 2) }}</div>
                <div><strong>Purchased Cans:</strong> {{ $purchasedCans }}</div>
                <div><strong>Exchanged Cans:</strong> {{ $exchangedCans }}</div>
                <div><strong>Total Qty Sold:</strong> {{ $totalQtySold }}</div>
            </div>


         </div>
     </div>
 </div>
    @endif
<style>
    /* Modern Product Card Styles */
.product-card-modern {
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.05);
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.product-card-modern:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 20px rgba(0, 0, 0, 0.1);
}

.product-image-modern {
    position: relative;
    padding-top: 75%; /* 4:3 aspect ratio */
    overflow: hidden;
}

.product-img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.image-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(to bottom, rgba(0,0,0,0) 60%, rgba(0,0,0,0.1) 100%);
}

.product-info-modern {
    padding: 1.5rem;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

.product-name-modern {
    font-size: 1.1rem;
    font-weight: 600;
    color: #2d3748;
    margin-bottom: 0.75rem;
    line-height: 1.4;
}

.product-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.product-qty-modern {
    font-size: 0.9rem;
    color: #4a5568;
    display: flex;
    align-items: center;
    gap: 0.3rem;
}

.product-price-modern {
    font-size: 1rem;
    font-weight: 700;
    color: #2b6cb0;
}

.product-action-btn {
    margin-top: auto;
    background: #f7fafc;
    border: 1px solid #e2e8f0;
    color: #4a5568;
    padding: 0.6rem 1rem;
    border-radius: 8px;
    font-size: 0.9rem;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    width: 100%;
}

.product-action-btn:hover {
    background: #edf2f7;
    border-color: #cbd5e0;
    color: #2d3748;
}

/* Responsive columns */
.column {
    padding: 0.75rem;
    width: 100%;
}

@media (min-width: 576px) {
    .column {
        width: 50%;
    }
}

@media (min-width: 768px) {
    .column {
        width: 33.333%;
    }
}

@media (min-width: 992px
    html {
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen,
    Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
}



.flex-container {
  width: 100%;
  overflow: auto;
  display: flex;
  flex-wrap: wrap;
  overflow: hidden;
}

.content-container {
  height: 180px;
  background: #0066ff;
  line-height: 180px;
  text-align: center;
  color: white;
  font-size: 20vh;
  width: 100%;
  margin: 10px 0;
  box-shadow: 0 5px 9px 0 #0000008c;
  border-radius: 8px;
}

.column {
  padding: 0 10px;
  box-sizing: border-box;
  flex: 25%;
  max-width: 25%;
}

@media (max-width: 800px) {
  .column {
    flex: 50%;
    max-width: 50%;
  }
}

@media (max-width: 400px) {
  .column {
    flex: 100%;
    max-width: 100%;
  }
}

.content-container:hover {
  background: #2055a4;
}

</style>

 </div>
