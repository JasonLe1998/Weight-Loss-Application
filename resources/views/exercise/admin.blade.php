@extends("layouts.app")

@section("content")
{{--admin page only shown when the userRole is "admin" to have CRUD functionality of the exercises  --}}
    <h1>Exercise Page Admin</h1>

  {!! Form::open(['action' => 'App\Http\Controllers\ExerciseController@search', 'method' => 'GET']) !!}
    <div class ="form-group">
        {{Form::label('search', "Search")}}
        {{Form::text('search', "", ['class' => 'form-control', "autocomplete"=> "off"])}}
    </div>
    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
  {!! Form::close() !!}
  <br>
  <br>

    <form action = "javascript:getCalories()">
      <div id = "calBurned" class="p-3 mb-2 bg-info text-white">
        <select class="form-select" aria-label="size 3 select example" name = "exerciseDropdown" id = "exerciseDropdown" onchange="this.form.submit()">
            @foreach($data as $row)
                <option value = "{{$row->MET}}">{{$row->name}}</option>
            @endforeach
        </select>
        <p>How Many Calories Did I Burn?</p>
        <p id = "dropdownValue"></p>
        <label for="weight">Your weight (Pounds):</label><br>
        <input type="text" id="weight" name="weight"><br>
        <label for="duration">Duration (Minutes):</label><br>
        <input type="text" id="duration" name="duration"><br><br>
        <p id = "calories">Calories Burned: 0</p>
      </div>
    </form>

    <a href = "exercise/all">
        <button type = "button" class = "btn btn-primary">Edit Exercises</button>
    </a>

    <a href = "exercise/reports">
      <button type = "button" class = "btn btn-primary">Exercises Report For Admin</button>
    </a>

    <script>
      /**function to calculate the calories burned for each exercise depending on which exercise is selected from the dropdown list
      */
      function getCalories(){
        var exerciseValue = document.getElementById("exerciseDropdown").value;
        var weightValue = document.getElementById("weight").value;
        var durationValue = document.getElementById("duration").value;
        var calorieValue = (weightValue/2.20462) * exerciseValue * 0.0175 * durationValue; //calculation for the calories value
        document.getElementById("calories").innerHTML = "Calories Burned: " + calorieValue.toFixed(2);
        return false;
      }
    </script>



@endsection
