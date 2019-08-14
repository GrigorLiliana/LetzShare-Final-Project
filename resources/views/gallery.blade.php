@extends('layouts.app')

@section('title', 'Photo Gallery')

@section('content')

<div class="grid">
@foreach ($photos as $photo)
    <div class="grid__item" data-size="1280x857">
        <a href="{{ $photo->image_URL }}" class="img-wrap"><img src="{{ $photo->image_URL }}" alt="{{ $photo->image_title }}" />
            <div class="description description--grid">
                <h3>{{ $photo->image_title }}</h3>
                <p>{{ $photo->image_description }}</p>
                <h5><em>&mdash; {{ $photo->name }}</em></h5>
                <div class="details">
                    <ul>
                        <li><i class="fas fa-heart"></i><span>{{ $photo->likes_sum }}</span></li>
                        <li><i class="fas fa-map-marker-alt"></i><span>{{ $photo->locality_id }}</span></li>
                        <li>
                            @if($photo->category_id === 1)
                                <i class="fas fa-landmark"></i><span>Culture</span>
                            @endif

                            @if($photo->category_id === 2)
                                <i class="fas fa-users"></i><span>Events</span>
                            @endif

                            @if($photo->category_id === 4)
                                <i class="fas fa-monument"></i><span>Monuments</span>
                            @endif

                            @if($photo->category_id === 5)
                                <i class="fas fa-tree"></i><span>Nature</span>
                            @endif

                            @if($photo->category_id === 6)
                                <i class="fas fa-glass-cheers"></i><<span>Night Life</span>
                            @endif
                        <li>
                    </ul>
                </div>
            </div>
        </a>
    </div>
@endforeach
</div>
<div class="preview">
    <button class="action action--close"><i class="fa fa-times"></i><span class="text-hidden">Close</span></button>
    <div class="description description--preview"></div>
</div>

@endsection

<script src="{{ asset('js/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('js/masonry.pkgd.min.js') }}"></script>
<script src="{{ asset('js/classie.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
<script>
    (function() {
        var support = { transitions: Modernizr.csstransitions },
            // transition end event name
            transEndEventNames = { 'WebkitTransition': 'webkitTransitionEnd', 'MozTransition': 'transitionend', 'OTransition': 'oTransitionEnd', 'msTransition': 'MSTransitionEnd', 'transition': 'transitionend' },
            transEndEventName = transEndEventNames[ Modernizr.prefixed( 'transition' ) ],
            onEndTransition = function( el, callback ) {
                var onEndCallbackFn = function( ev ) {
                    if( support.transitions ) {
                        if( ev.target != this ) return;
                        this.removeEventListener( transEndEventName, onEndCallbackFn );
                    }
                    if( callback && typeof callback === 'function' ) { callback.call(this); }
                };
                if( support.transitions ) {
                    el.addEventListener( transEndEventName, onEndCallbackFn );
                }
                else {
                    onEndCallbackFn();
                }
            };

            new GridFx(document.querySelector('.grid'), {
            imgPosition : {
                x : -0.5,
                y : 1
            },
            onOpenItem : function(instance, item) {
                instance.items.forEach(function(el) {
                    if(item != el) {
                        var delay = Math.floor(Math.random() * 50);
                        el.style.WebkitTransition = 'opacity .5s ' + delay + 'ms cubic-bezier(.7,0,.3,1), -webkit-transform .5s ' + delay + 'ms cubic-bezier(.7,0,.3,1)';
                        el.style.transition = 'opacity .5s ' + delay + 'ms cubic-bezier(.7,0,.3,1), transform .5s ' + delay + 'ms cubic-bezier(.7,0,.3,1)';
                        el.style.WebkitTransform = 'scale3d(0.1,0.1,1)';
                        el.style.transform = 'scale3d(0.1,0.1,1)';
                        el.style.opacity = 0;
                    }
                });
            },
            onCloseItem : function(instance, item) {
                instance.items.forEach(function(el) {
                    if(item != el) {
                        el.style.WebkitTransition = 'opacity .4s, -webkit-transform .4s';
                        el.style.transition = 'opacity .4s, transform .4s';
                        el.style.WebkitTransform = 'scale3d(1,1,1)';
                        el.style.transform = 'scale3d(1,1,1)';
                        el.style.opacity = 1;

                        onEndTransition(el, function() {
                            el.style.transition = 'none';
                            el.style.WebkitTransform = 'none';
                        });
                    }
                });
            }
        });
    })();
</script>


