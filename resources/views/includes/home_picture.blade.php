<div class="home_picture">
    <div class="container-fluid">
        <div class="background-text text-center">
            <p>
                Start learning for <span class="free"> <strong> Free </strong></span>
            </p>
            <p>
                {{ \App\Course::all()->count() }} Courses in {{ \App\Track::all()->count() }} Tracks are available for you!
            </p>
            <a class="btn btn-success" href="/register">Start learning</a>
            <a class="btn btn-primary" href="/register">My courses</a>
        </div>
    </div>
</div>
