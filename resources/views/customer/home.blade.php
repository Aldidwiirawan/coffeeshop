<section id="home">
    <div class="coffee-shop">
      <img src="{{ asset('Gambar/bg utama.jpg') }}" alt="" />
      <div class="overlay">
        <h1>DWIJAYA COFFEE</h1>
        <h2>HUMANITY RUNS ON COFFEE</h2>
      </div>
    </div>
    <div class="row">
      <div class="col-12 text-center">
        <h2>Welcome to our cafe</h2>
        <p>
          Coffee is a symbol of this life. There is a bitter taste and a sweet taste.<br />
          COLD, SOFT and CERTAINLY REFRESHING
        </p>
      </div>
      <div class="container">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
          @for ($i = 1; $i <= 6; $i++)
            <div class="col-4">
              <img src="{{ asset('Gambar/home ' . ['kiri atas', 'tengah atas', 'kanan atas', 'kiri bawah', 'tengah bawah', 'kanan bawah'][$i - 1] . '.jpeg') }}" alt="Image {{ $i }}" />
            </div>
          @endfor
        </div>
      </div>
    </div>
  </section>
