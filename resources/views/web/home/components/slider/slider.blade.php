<div class="homepage-slider" id="homepage-slider">
    <div class="swiper-wrapper homepage-slider-wrapper">
        @foreach($slides as $slide)
            <div class="swiper-slide homepage-slider-single">
                <img src="{{ $slide->cover->getUrl() }}" alt="{{ $slide->title }}" class="img-fluid homepage-slider-single-cover">
                <div class="container homepage-slider-single-container">
                    <div class="row pb-5">
                        <div class="col-12">
                            <x-cinematography.details
                                :cinematography="$slide"
                                size="{{ \App\View\Components\Cinematography\Details::SIZE_LARGE }}"
                            />
                        </div>
                    </div>
                    <div class="row pt-5">
                        <div class="col-12">
                            <a href="#" class="btn btn-outline-white d-block m-auto w-25 p-2">
                                {{ __('web.views.home.slider.learn_more') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="homepage-slider-pagination"></div>

    <div class="homepage-slider-button homepage-slider-button-prev">
        <i class="fas fa-angle-left"></i>
    </div>
    <div class="homepage-slider-button homepage-slider-button-next">
        <i class="fas fa-angle-right"></i>
    </div>
</div>
