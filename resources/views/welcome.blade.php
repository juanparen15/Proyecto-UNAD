@extends('layouts.principal')
@section('title', 'Inventario Documental')

@section('content')
<div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(homeland/images/hero_bg_2.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
    <div class="container">
      <div class="row align-items-center justify-content-center text-center">
        <div class="col-md-10">
          <h1 class="mb-2">{{$empresa->nombre}}</h1>
        </div>
      </div>
    </div>
</div> 

  <div class="site-section">
    <div class="container">
      <div class="row">
        <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
          <img src="homeland/images/about.jpg" alt="Image" class="img-fluid">
        </div>
        <div class="col-md-5 ml-auto"  data-aos="fade-up" data-aos-delay="200">
          <div class="site-section-title">
            <h2>Misión</h2>
          </div>
          <p class="lead">
            {{$empresa->mision}}
          </p>
        </div>
      </div>
    </div>
  </div>

  <div class="site-section">
      <div class="container">
        <div class="row mb-5 justify-content-center"  data-aos="fade-up" >
            <div class="col-md-7">
                <div class="site-section-title text-center">
                    <h2>Visión</h2>
                    <p>
                        {{$empresa->vision}}  
                    </p>
                </div>
            </div>
        </div>
      
    </div>
 </div>


 <div class="site-section">
    <div class="container">

      <div class="row justify-content-center mb-5">
        <div class="col-md-7 text-center">
          <div class="site-section-title">
            <h2>Visita Nuestro sitio web Alcaldia Municipal de Puerto Boyacá</h2>
          </div>

          <p><a href="{!! $empresa->url  !!}" class="btn btn-white btn-outline-primary  py-3 px-5 rounded-0 btn-2">Ir a la pagina</a></p>

        </div>
      </div>

    </div>
  </div>

@endsection
