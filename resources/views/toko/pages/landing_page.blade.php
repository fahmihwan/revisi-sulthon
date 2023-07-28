@extends('toko.layout.main')

@section('styles')

    <style>
        /* ---- particles.js container ---- */
        #particles-js {
            position: absolute;
            width: 100%;
            height: 70%;
            background-color: black;
            background-image: url("");
            background-repeat: no-repeat;
            background-size: cover;
            z-index: -2;
            background-position: 50% 50%;
        }


        .js-count-particles {
            font-size: 1.1em;
        }

        #stats,
        .count-particles {
            -webkit-user-select: none;
            margin-top: 5px;
            margin-left: 5px;
        }


        #stats {
            border-radius: 3px 3px 0 0;
            overflow: hidden;
        }

        .count-particles {
            border-radius: 0 0 3px 3px;
        }
    </style>
@endsection


@section('breadcrumb')
    <nav class="flex border  border-gray-200" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="#" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900  ">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                        </path>
                    </svg>
                    Home
                </a>
            </li>
            {{-- <img src="{{ './storage/' . 'image-items/r9wxbZp3hLKZZqgVhlkNb89hHVXr0yg1n9bvRvFm.jpg' }}" style="width: 100px;"
            alt=""> --}}
        </ol>
    </nav>



    {{-- resend_email --}}
    @include('toko.components.resend_email_confirmation')
    @if (session('status'))
        <div class="bg-green-200 text-green-800 p-2 block ">
            <i class="fa-solid fa-circle-check"></i>
            {{ session('status') }}
        </div>
    @endif
@endsection

@section('container')
    {{-- This account is not confirmed. Click Here to resend confirmation email. --}}
    <div class="w-full  ">
        <div id="particles-js"></div>
        <div class=" w-full border-b h-96 flex justify-center items-center">
          <div class="text-center">
            <h1 class="text-white mb-10 text-4xl ">Outlaws Studio Store</h1>
            <a href="/list-item"
                class="border-white border w-56 text-center hover:bg-white hover:text-black duration-300 font-light  text-white p-3 text-3xl">
                Shop now
        
            </a>
          </div>
        </div>
        

    </div>

   
@endsection

@section('script')
    <script src="http://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script> <!-- stats.js lib -->
    <script src="http://threejs.org/examples/js/libs/stats.min.js"></script>

  
  
  

    <script>
      $('.your-class').slick({
        setting-name: setting-value
      });

        particlesJS("particles-js", {
            "particles": {
                "number": {
                    "value": 80,
                    "density": {
                        "enable": true,
                        "value_area": 800
                    }
                },
                "color": {
                    "value": "#ffffff"
                },
                "shape": {
                    "type": "circle",
                    "stroke": {
                        "width": 0,
                        "color": "#000000"
                    },
                    "polygon": {
                        "nb_sides": 5
                    },
                    "image": {
                        "src": "img/github.svg",
                        "width": 100,
                        "height": 100
                    }
                },
                "opacity": {
                    "value": 0.5,
                    "random": false,
                    "anim": {
                        "enable": false,
                        "speed": 1,
                        "opacity_min": 0.1,
                        "sync": false
                    }
                },
                "size": {
                    "value": 3,
                    "random": true,
                    "anim": {
                        "enable": false,
                        "speed": 40,
                        "size_min": 0.1,
                        "sync": false
                    }
                },
                "line_linked": {
                    "enable": true,
                    "distance": 150,
                    "color": "#ffffff",
                    "opacity": 0.4,
                    "width": 1
                },
                "move": {
                    "enable": true,
                    "speed": 6,
                    "direction": "none",
                    "random": false,
                    "straight": false,
                    "out_mode": "out",
                    "bounce": false,
                    "attract": {
                        "enable": false,
                        "rotateX": 600,
                        "rotateY": 1200
                    }
                }
            },
            "interactivity": {
                "detect_on": "canvas",
                "events": {
                    "onhover": {
                        "enable": true,
                        "mode": "repulse"
                    },
                    "onclick": {
                        "enable": true,
                        "mode": "push"
                    },
                    "resize": true
                },
                "modes": {
                    "grab": {
                        "distance": 400,
                        "line_linked": {
                            "opacity": 1
                        }
                    },
                    "bubble": {
                        "distance": 400,
                        "size": 40,
                        "duration": 2,
                        "opacity": 8,
                        "speed": 3
                    },
                    "repulse": {
                        "distance": 200,
                        "duration": 0.4
                    },
                    "push": {
                        "particles_nb": 4
                    },
                    "remove": {
                        "particles_nb": 2
                    }
                }
            },
            "retina_detect": true
        });
    </script>
@endsection
