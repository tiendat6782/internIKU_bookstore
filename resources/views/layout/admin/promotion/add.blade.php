@extends('templates.admin.layout')
@section('content')
    <div class="container-fluid my-5 p-2 bg-white border border-2 border-white rounded-2">
        <form class="row g-3" action="{{ route('insert_promotion') }}" method="POST">
            @csrf
            <div class="col-md-6">
                <label for="inputname4" class="form-label">Name</label>
                <input type="text" class="form-control" id="inputname4" name="name">
                @if ($errors->has('name'))
                    <p><small class="px-2 text-danger">{{ $errors->first('name') }}</small></p>
                @endif

            </div>
            <div class="col-md-6">
                <label for="inputcode4" class="form-label">Code</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">Ramdom</span>
                    <input type="text" class="form-control" id="inputcode4" name="code" value="" aria-describedby="basic-addon1">
                </div>
                @if ($errors->has('code'))
                    <p><small class="px-2 text-danger">{{ $errors->first('code') }}</small></p>
                @endif
            </div>
            <div class="col-md-6 d-flex align-items-start">
                <div class="col-md-12">
                    <label for="myRange" class="form-label">Value</label>
                    <input type="range" class="form-range  bg-transpant" name="giatri" min="0" max="100"
                        step="5" id="myRange">
                    <span class="d-flex justify-content-center" class="" id="demo">0</span>
                </div>
            </div>

            <script>
                var slider = document.getElementById("myRange");
                var output = document.getElementById("demo");
                output.innerHTML = slider.value; // Display the default slider value

                // Update the current slider value (each time you drag the slider handle)
                slider.oninput = function() {
                    output.innerHTML = this.value;
                }

                var input = document.getElementById("inputcode4");
                var span = document.getElementById("basic-addon1");

                function makeid(length) {
                    let result = '';
                    const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                    const charactersLength = characters.length;
                    let counter = 0;
                    while (counter < length) {
                        result += characters.charAt(Math.floor(Math.random() * charactersLength));
                        counter += 1;
                    }
                    return result;
                }
                span.addEventListener("click", function() {
                    var code = makeid(10);
                    console.log(code);
                    input.value = code;
                });
            </script>
            <div class="col-md-6">
                <label for="datetime" class="">Date start</label>
                <div class="input-group date" id="datepicker">
                    <input type="date" name="start" class="form-control" id="datetime" />
                </div>
            </div>
            <div class="col-md-6">
                <label for="datetime" class="">Date end</label>
                <div class="input-group date" id="datepicker">
                    <input type="date" name="end" class="form-control" id="datetime" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Description</label>
                    <textarea class="form-control" name="description" id="" rows="2"></textarea>
                    @if ($errors->has('note'))
                        <p><small class="px-2 text-danger">{{ $errors->first('note') }}</small></p>
                    @endif
                </div>
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
        </form>
    </div>
@endsection
