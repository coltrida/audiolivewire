<div xmlns:livewire="">
    <livewire:nav-bar/>

    <div class="relative flex items-top justify-center min-h-screen sm:pt-0 pt-3 pb-3" style="color: white; background-color: #1a202c">

        <div @if($homeVisibile) style="display: block" @else style="display: none;" @endif>
            <livewire:home
                :homeVisibile='$homeVisibile'
            />
        </div>

        <div @if($magazzinoFilialeVisibile) style="display: block" @else style="display: none;" @endif>
            <livewire:magazzino-filiale
                :idFiliale='$idFiliale'
                :magazzinoFilialeVisibile='$magazzinoFilialeVisibile'
            />
        </div>

        <div @if($loginVisibile) style="display: block" @else style="display: none;" @endif>
            <livewire:login-register
                :loginVisibile='$loginVisibile'
            />
        </div>
    </div>

</div>

