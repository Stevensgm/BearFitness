<div class="relative">
    <button wire:click="toggleCarrito" class="icono-carrito">
        🛒<span >{{$cartCount}}</span>
    </button>
    @if($mostrarCarrito)
   
            @livewire('carrito')
       
      
    @endif
</div>