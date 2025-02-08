@extends('layouts.master-login')

@section('title', 'Login - ELPato Panel')

@section('content')
@section('page-title', 'Login - ELPato Panel')

<div id="particles-js"></div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 text-center mb-5">
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="wrap d-md-flex">

                <div class="login-wrap p-4 p-md-5">
                    <div class="d-flex">
                        <div class="w-100">
                            <br>
                        </div>
                    </div>
                    <form id="login-form" method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group mb-3">
                            <label class="label" for="email">{{ __('Email') }}</label>
                            <input id="email" type="text" class="form-control" name="email"
                                value="{{ old('email') }}" required autofocus placeholder="">
                            @error('email')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-3 position-relative">
                            <label class="label" for="password">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control" name="password" required autocomplete="off">
                            <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            @error('password')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group d-md-flex">
                            <div class="w-50 text-left">
                                <label class="checkbox-wrap checkbox-primary mb-0">{{ __('Remember Me') }}
                                    <input id="remember_me" type="checkbox" name="remember">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-primary rounded submit px-3">
                                {{ __('Login') }}
                            </button>
                        </div>
                    </form>
                </div>

                <div class="img">
                    <img src="{{ asset('/images/Elpatologin.gif') }}" alt="Side Image" width="500px" height="">
                </div>
            </div>
        </div>
    </div>
</div>

<script src="http://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
<script src="http://threejs.org/examples/js/libs/stats.min.js"></script>
<script>
    particlesJS("particles-js", {
        particles: {
            number: {
                value: 80,
                density: {
                    enable: true,
                    value_area: 800
                }
            },
            color: {
                value: "#59ab5e"
            },
            shape: {
                type: "circle",
                stroke: {
                    width: 0,
                    color: "#000000"
                },
                polygon: {
                    nb_sides: 5
                },
                image: {
                    src: "img/github.svg",
                    width: 100,
                    height: 100
                }
            },
            opacity: {
                value: 0.5,
                random: false,
                anim: {
                    enable: false,
                    speed: 1,
                    opacity_min: 0.1,
                    sync: false
                }
            },
            size: {
                value: 3,
                random: true,
                anim: {
                    enable: false,
                    speed: 40,
                    size_min: 0.1,
                    sync: false
                }
            },
            line_linked: {
                enable: true,
                distance: 150,
                color: "#59ab5e",
                opacity: 0.4,
                width: 1
            },
            move: {
                enable: true,
                speed: 6,
                direction: "none",
                random: false,
                straight: false,
                out_mode: "out",
                bounce: false,
                attract: {
                    enable: false,
                    rotateX: 600,
                    rotateY: 1200
                }
            }
        },
        interactivity: {
            detect_on: "canvas",
            events: {
                onhover: {
                    enable: false,
                    mode: "repulse"
                },
                onclick: {
                    enable: false,
                    mode: "push"
                },
                resize: true
            },
            modes: {
                grab: {
                    distance: 400,
                    line_linked: {
                        opacity: 1
                    }
                },
                bubble: {
                    distance: 400,
                    size: 40,
                    duration: 2,
                    opacity: 8,
                    speed: 3
                },
                repulse: {
                    distance: 200,
                    duration: 0.4
                },
                push: {
                    particles_nb: 4
                },
                remove: {
                    particles_nb: 2
                }
            }
        },
        retina_detect: true
    });
    var count_particles, stats, update;
    stats = new Stats();
    stats.setMode(0);
    stats.domElement.style.position = "absolute";
    stats.domElement.style.left = "0px";
    stats.domElement.style.top = "0px";
    document.body.appendChild(stats.domElement);
    count_particles = document.querySelector(".js-count-particles");
    update = function() {
        stats.begin();
        stats.end();
        if (window.pJSDom[0].pJS.particles && window.pJSDom[0].pJS.particles.array) {
            count_particles.innerText = window.pJSDom[0].pJS.particles.array.length;
        }
        requestAnimationFrame(update);
    };
    requestAnimationFrame(update);
</script>
@endsection
