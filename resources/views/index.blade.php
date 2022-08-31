@extends("layouts.app")
<style>
    .title{
        text-align: center;
    }

    .img{
        height: 300px;
        width: 300px;
    }

    .column{
        float: left;
        position: relative;
        right: -8%;
        width: 50%;
        padding: 3%;
    }

    #caption{
        text-align: center;
    }
</style>
@section("content")
    {{-- main landing page after the user logs in successfully or when the user goes to the home page --}}
    <br>
    <br>
    <div class = "title">
        <h2>Get up and use Workout Time!</h2>
    </div>

    <div>
        <p class = "title">Choose exercises, create workout plans, track your progress or interact with the community through the forums! The choice is yours!</p>
    </div>

    <div id = "exercise" class = "column">
        <h3>Exercises</h3>
        <a href = "{{url('exercise')}}"><img class = "img" src = "https://images.everydayhealth.com/images/how-to-train-if-you-have-an-ectomorph-body-type-722x406.jpg?sfvrsn=16febb96_1"></a>
    </div>

    <div id = "workout" class = "column">
        <h3>Create a workout plan</h3>
        <a href = "{{url('workout')}}"><img class = "img" src = "http://cdn.shopify.com/s/files/1/0430/6533/files/How_to_Create_a_Fitness_Plan.jpg?v=1586208771"></a>
    </div>

    <div id = "report" class = "column">
        <h3>Track your progress</h3>
        <a href = "{{url('report')}}"><img class = "img" src = "https://www.aihr.com/wp-content/uploads/Training-metrics-cover-1000x553-1.png"></a>
    </div>

    <div id = "community" class = "column">
        <h3>Interact with the community</h3>
        <a href = "{{url('community')}}"><img class = "img" src = "https://media.nature.com/lw800/magazine-assets/d41586-019-02368-z/d41586-019-02368-z_17033334.jpg"></a>
        <br>
        <br>
        <br>
    </div>

    @isset($exerciseReports)
        <div id = "popular">
            @if(count($exerciseReports) > 0 )
                <h3 id = "caption"><b>Top 3 most popular exercises this month! Be sure to check these exercises out!</b></h3>
                <table class="table">
                    <tr>
                        <th scope="col">First</th>
                        <th scope="col">Second</th>
                        <th scope="col">Third</th>
                    </tr>
                    @foreach($exerciseReports as $exerciseReport)
                    <tr>
                        <td>{{$exerciseReport->firstExercise}}</td>
                        <td>{{$exerciseReport->secondExercise}}</td>
                        <td>{{$exerciseReport->thirdExercise}}</td>
                    </tr>
                    @endforeach
                    </table>
            @else
                <p></p>
            @endif
        </div>
    @endisset


@endsection
