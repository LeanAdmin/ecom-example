<div>
    <h1 class="text-3xl font-medium">Create order</h1>
    <label class="mt-4 block">
        Customer
        <select class="form-select" wire:model="order.customer_id">
            @foreach($this->customers as $customer)
                <option value="{{ $customer->id }}">{{ $customer->name }} ({{ $customer->email }})</option>
            @endforeach
        </select>
        @error('order.customer_id')
            <div class="mt-1 text-red-500 text-sm">
                <p>{{ $message }}</p>
            </div>
        @enderror
    </label>

    <div class="flex flex-col mt-8">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Product
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Quantity
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Total
                                </th>
                                <th class="px-6 py-3 bg-gray-50"></th>
                            </tr>
                        </thead>
                    <tbody>
                        @foreach($products as $index => $product)
                            @if($loop->odd)
                                {{-- Odd row --}}
                                <tr class="bg-white">
                            @else
                                {{-- Even row --}}
                                <tr class="bg-gray-50">
                            @endif
                                <td class="px-6 py-4 whitespace-no-wrap text-base leading-5 font-medium text-gray-900">
                                    <select class="form-select" wire:model="products.{{ $index }}.product_id">
                                        @foreach($availableProducts as $ap)
                                            <option value="{{ $ap->id }}">{{ $ap->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-base leading-5 text-gray-800">
                                    <input type="number" class="form-input" wire:model="products.{{ $index }}.quantity" step="1" min="1">
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-base font-medium leading-5 text-gray-900">
                                    ${{ $this->getProductTotal($product) }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-right text-base leading-5 font-medium">
                                    <x-lean::button design="danger" wire:click="removeProduct({{ $index }})">
                                        Remove
                                    </x-lean::button>
                                </td>
                            </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="flex justify-end mt-4">
                <x-lean::button design="secondary" wire:click="addProduct">
                    Add Product
                </x-lean::button>

                <div class="ml-2">
                    <x-lean::button wire:click="submit">
                        Create Order
                    </x-lean::button>
                </div>
            </div>
        </div>
    </div>
</div>
