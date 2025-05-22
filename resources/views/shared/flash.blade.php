 @if(session('success'))
        <div class="alert alert-success" x-data="{show: true}" x-show="show" x-init="setTimeout(() => show = false, 1000)">
            {{session('success')}}
        </div>
        @endif
        @if($errors->any())

        <div class="alert alert-danger" x-data="{show: true}" x-show="show" x-init="setTimeout(() => show = false, 3000)">
            <ul class="my-0">
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif