<div>
    <h2 class="text-3xl font-medium">Order Total: ${{ $orders->total() }}</h2>
    <h2 class="text-2xl font-medium">Order Count: {{ $orders->count() }}</h2>

    <h3 class="mt-8 text-2xl font-medium">Log</h2>
    <div class="divide-y divide-gray-400">
        @foreach($orders->reverse() as $order)
            <div class="py-2">
                <strong>{{ $order->customer->name }}</strong> purchased
                <span>
                    @foreach($order->products as $product)
                        <strong>{{ $product->quantity}}x</strong>
                        <em>{{ $product->name }}</em> for a total of
                        <strong>${{ $product->total }}</strong>@if(! $loop->last),@endif
                    @endforeach
                </span>
            </div>
        @endforeach
    </div>

    <div class="mt-8">
        <x-lean::button wire:click="generate">
            Generate random order
        </x-lean::button>

        <x-lean::button design="secondary" wire:click="fetch">
            Fetch server state
        </x-lean::button>
        <span class="text-sm">(Try creating an order in another tab and click this button)</span>
    </div>
</div>
