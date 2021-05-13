<div id="callModal" @if($visibile) style="display: none" @else style="display: block; height: 100%;
  width: 100%;
  position: absolute;
  top: 0;
  left: 0;
  background-color: rgba(0,0,0,0.45);" @endif tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
     xmlns:wire="http://www.w3.org/1999/xhtml">
    <div class="modal-dialog" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 500px; box-shadow: 2px 2px 4px #000000;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Fissare recall per: {{$clientName}} {{$clientCognome}}</h5>
                <button type="button" class="btn-close" wire:click="closeModal()" aria-label="Close"></button>
            </div>
                <div class="modal-body">
                    <div class="modal-body">
                        <input type="hidden" wire:model="clientId">
                        <input type="date" wire:model="clientCall" >
                    </div>
                </div>
                <div class="modal-footer">
                    <a wire:click="inserisci()" class="btn btn-primary">Inserisci recall</a>
                </div>
        </div>
    </div>
</div>
