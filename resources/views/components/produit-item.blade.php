<div class="col mb-5">
    <div class="card h-100">
        <!-- Product image-->
        @if ($article->image)
          <div
              style="background-image: url('{{ asset('storage/' . $article->image->path) }}');
              width: 100%;
              height: 200px;
              background-position: center;
              background-repeat: no-repeat;
              background-size: cover;"  >
        </div>
        @endif
        <!-- Product details-->
        <div class="card-body p-4">
            <div class="text-center">
                <!-- Product name-->
                <h5 class="fw-bolder">{{ $article->name }}</h5>
                <!-- Product reviews-->
                <div class="d-flex justify-content-center small text-warning mb-2">
                    <div class="bi-star-fill"></div>
                    <div class="bi-star-fill"></div>
                    <div class="bi-star-fill"></div>
                    <div class="bi-star-fill"></div>

                </div>
                <!-- Product price-->
                {{ $article->price }} $
            </div>
        </div>
        @auth
        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Payer</a></div>
        </div>
        @endauth
    </div>
</div>
