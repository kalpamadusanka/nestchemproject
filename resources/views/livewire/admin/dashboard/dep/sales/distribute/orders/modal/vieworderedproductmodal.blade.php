<div>
    @if ($opensalesproduct)
    <div class="modal fade show" style="display: block;" tabindex="-1" aria-modal="true" role="dialog">
     <div class="modal-dialog modal-lg modal-dialog-scrollable">
         <div class="modal-content">
             <div class="modal-header bg-primary text-white">
                 <h5 class="modal-title">Sold Products</h5>
                 <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" wire:click="closeModal"></button>
             </div>
             <div class="modal-body">
                 <form wire:submit.prevent="submit">
                     <!-- Search and Filter Row -->
                     <div class="flex-container">
                       <div class="products-row"> <!-- Add this wrapper div -->
    @foreach($salesorderItem as $product)
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
            <div class="product-info-modern">
                <h3 class="product-name-modern">{{ $product->productData->product_name }}</h3>

                <div class="product-meta">
                    <span class="product-qty-modern">
                        <i class="fas fa-box-open"></i> {{ $product->quantity }} units sold
                    </span>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
                    </div>
                 </form>
             </div>

         </div>
     </div>
 </div>
    @endif
<style>
    /* Modern Product Card Styles */
    .products-row {
    display: flex;          /* Make the container a flex container */
    flex-wrap: wrap;        /* Allow items to wrap to next line if needed */
    gap: 20px;             /* Space between items */
    overflow-x: auto;      /* Add horizontal scroll if items overflow */
    padding-bottom: 10px;  /* Space for scrollbar */
}

.column {
    flex: 0 0 auto;        /* Don't grow or shrink, use content width */
    width: 200px;          /* Set a fixed width for each product card */
    /* Or use min-width if you want them to be flexible */
    /* min-width: 200px; */
}

.product-card-modern {
    height: 100%;          /* Make cards take full height of column */
    /* Rest of your card styles */
}
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
