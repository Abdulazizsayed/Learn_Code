<div class="container famous-courses mt-5">
    @foreach ($tracks as $track)
    <h3 class="mt-5 mb-4">
        Last <a href="#">{{ \Str::limit($track->name, 20) }}</a> Courses
    </h3>
    <div class="row">
        @forelse ($track->courses()->limit(4)->get() as $course)
        <div class="col-sm-3">
            <div class="course pb-2">
                <a href="/courses/{{ $course->slug }}">
                    <img class="course-img" src="/images/{{ $course->photo ? $course->photo->filename : 'default.jpg' }}" alt="Track image">
                </a>
                <h5 class="p-2">
                    <a href="/courses/{{ $course->slug }}">{{ \Str::limit($course->title, 20) }}</a>
                </h5>
                <span class="{{ $course->status ? 'text-danger' : 'text-success' }} pl-2">{{ $course->status ? 'Paid' : 'Free' }}</span>
                <span class="float-right pr-2" title="Users enrolled">{{ $course->users->count() }}</span>
            </div>
        </div>
        @empty
        <div class="col-sm-12">
            <p class="lead text-center">This track have no courses yet!</p>
        </div>
        @endforelse
        @if ($loop->index == 1)
        <div class="famous-tracks container">
            <hr>
            <h4 class="mt-3">Famous topics for you</h4>
            <div class="tracks">
                @foreach ($famous_tracks as $famous_track)
                <a class="btn btn-secondary track-name mt-3 mb-3" href="#" title="{{ $famous_track->name }}">{{ \Str::limit($famous_track->name, 5) }}</a>
                @endforeach
            </div>
        </div>
        @endif
        @auth
            @if ($loop->index == 2)
    </div>
    <hr>
    <h3 class="mt-5 mb-4">
            Recommended courses for you
    </h3>
    <div class="row">
                @forelse ($recommended_courses as $recommended_course)
        <div class="col-sm-3">
            <div class="course pb-2">
                <a href="#">
                    <img class="course-img" src="/images/{{ $recommended_course->photo ? $recommended_course->photo->filename : 'default.jpg' }}" alt="Track image">
                </a>
                <h5 class="p-2">
                    <a href="#">{{ \Str::limit($recommended_course->title, 20) }}</a>
                </h5>
                <span class="{{ $recommended_course->status ? 'text-danger' : 'text-success' }} pl-2">{{ $recommended_course->status ? 'Paid' : 'Free' }}</span>
                <span class="float-right pr-2" title="Users enrolled">{{ $recommended_course->users->count() }}</span>
            </div>
        </div>
                @empty
            <div class="col-sm-12">
                <p class="lead text-center">No recommended courses for you!</p>
            </div>
                @endforelse
            @endif
        @endauth
    </div>
    <hr>
    @endforeach
</div>
