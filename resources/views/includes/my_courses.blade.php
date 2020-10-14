<!--Carousel Wrapper-->
<div id="multi-item-example" class="carousel slide carousel-multi-item mt-5" data-ride="carousel" data-interval="false">

    @if ($user_courses->count() > 0)
    <!--Controls-->
    <div class="controls-top text-center">
        <a class="btn-floating mr-2" href="#multi-item-example" data-slide="prev"><i class="fas fa-chevron-left"></i></a>
        <a class="btn-floating ml-2" href="#multi-item-example" data-slide="next"><i class="fas fa-chevron-right"></i></a>
    </div>
    <!--/.Controls-->
    @endif

    <!--Slides-->
    <div class="carousel-inner container" role="listbox">
        <div class="row">
            <div class="col-sm-6">
                <h2>Resume leaning</h2>
            </div>
            <div class="col-sm-6 text-right pt-3">
                <a href="/mycourses">
                    All courses
                </a>
            </div>
        </div>

        <div class="carousel-item active">
            <div class="row">
            @forelse ($user_courses as $course)
                @if ($loop->index % 3 == 0 && $loop->index != 0)
            </div>
        </div>
                <div class="carousel-item">
                    <div class="row">
                @endif

                <div class="col-md-4">
                    <div class="card mb-2 bg-light">
                        @if ($course->photo)
                        <img class="card-img-top"
                            src="/images/{{ $course->photo->filename }}"
                            alt="Course image">
                        @else
                        <img class="card-img-top"
                            src="/images/default.jpg"
                            alt="Card image cap">
                        @endif
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="{{ $course->link }}" title="{{ $course->title }}">{{ \Str::limit($course->title, 20) }}</a>
                            </h4>
                            <p class="card-text">
                                Track: <a href="#">{{ \Str::limit($course->track->name, 20) }}</a>
                            </p>
                            <a class="btn btn-primary">Button</a>
                        </div>
                    </div>
                </div>
            @empty
            <div class="col-md-12">
                <h3 class="text-center">You have not enrolled in any courses yet!</h3>
            </div>
            @endforelse
            </div>
        </div>

    </div>
    <!--/.Slides-->

</div>
<!--/.Carousel Wrapper-->
