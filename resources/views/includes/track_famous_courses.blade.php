<div class="container famous-courses mt-5">
    <hr>
    @foreach ($tracks as $track)
    <h3 class="mt-5 mb-4">
        Last <a href="#">{{ \Str::limit($track->name, 20) }}</a> Courses
    </h3>
    <div class="row">
        @forelse ($track->courses()->limit(4)->get() as $course)
        <div class="col-sm-3">
            <div class="course pb-2">
                <a href="#">
                    <img class="course-img" src="/images/{{ $course->photo ? $course->photo->filename : 'default.jpg' }}" alt="Track image">
                </a>
                <h5 class="p-2">
                    <a href="#">{{ \Str::limit($course->title, 20) }}</a>
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
    </div>
    <hr>
    @endforeach
</div>
