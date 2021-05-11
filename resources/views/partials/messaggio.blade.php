@if (session()->has('message'))
    <div class="col p-2 rounded border m-2" style="background-color: blue; box-shadow: 2px 2px 4px #000000">
        {{ session('message') }}
    </div>
@endif
