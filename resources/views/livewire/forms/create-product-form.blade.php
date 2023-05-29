<div>



    <div class="bg-blue-100 p-10"> lHellw  </div>
    
     <form wire:submit.prevent="create">
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Create Product</h2>
                <p class="mt-1 text-sm leading-6 text-gray-600">This information will be displayed publicly so be careful
                    what you share.</p>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                    <div class="sm:col-span-4">
                        <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Product
                            name</label>
                        <div class="mt-2">
                            <div
                                class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                <input type="text" wire:model="product_name" autocomplete="username"
                                    class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                    placeholder="">
                            </div>
                            {{ $product_name }}
                              
                            @error('product_name') <span class="error text-red-600 text-sm">{{ $message }}</span> @enderror
                        </div>


                        <div class="mt-2">
                            <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Product
                                Price</label>
                            <div
                                class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                <input type="number" wire:model="product_price"
                                    class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                    placeholder="">
                            </div>
                            @error('product_price') <span class="error text-red-600 text-sm">{{ $message }}</span> @enderror

                        </div>


                        <div class="col-span-full mt-6">
                            <label for="about" class="block text-sm font-medium leading-6 text-gray-900">Write
                                product descriptions</label>
                            <div class="mt-2">
                                <textarea wire:model="description" rows="3"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                            </div>


                            {{ $description }}
                            @error('description') <span class="error text-red-600 text-sm">{{ $message }}</span> @enderror

                        </div>
                        <div class="col-span-full mt-6">
                            <label for="about" class="block text-sm font-medium leading-6 text-gray-900"> Product Image</label>
                            <div class="mt-2">
                               <input type="file" wire:model="photo">
                            </div>


                            
                            <div wire:loading wire:target="photo" >
                            <div class="w-96 h-96 bg-gray-200 mt-2 lp" >


                                
                                <div class="lds-dual-ring"></div>
                                
                            </div>
                        </div>
                            @error('photo') <span class="error text-red-600 text-sm">{{ $message }}</span> @enderror
                        

                            
                            @if ($photo)
        Photo Preview:
        <img src="{{ $photo->temporaryUrl() }}" class="w-96 h-96" >
    @endif
                        </div>
                        <div class="col-span-full mt-6">
                            <div class="sm:col-span-3">
                                <label for="country" class="block text-sm font-medium leading-6 text-gray-900">Product
                                    Caegory</label>
                                <div class="mt-2">
                                    <select wire:model="category"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                        <option value="clothing">Clothing</option>
                                        <option value="school supplies">School Supplies</option>
                                        <option value="constructions material">Contruction Materials</option>
                                    </select>
                                </div>
                            </div>


                            {{ $category }}
                            @error('category') <span class="error text-red-600 text-sm">{{ $message }}</span> @enderror

                        </div>


                        <div class="mt-10 space-y-10">
                            <fieldset>
                                <legend class="text-sm font-semibold leading-6 text-gray-900">Product Target Customers
                                </legend>
                                <div class="mt-6 space-y-6">
                                    <div class="relative flex gap-x-3">
                                        <div class="flex h-6 items-center">
                                            <input wire:model="tags" type="checkbox" value="adult"
                                                class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                        </div>
                                        <div class="text-sm leading-6">
                                            <label for="comments" class="font-medium text-gray-900">Adult</label>
                                        </div>
                                    </div>
                                    <div class="relative flex gap-x-3">
                                        <div class="flex h-6 items-center">
                                            <input wire:model="tags" type="checkbox" value="children"
                                                class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                        </div>
                                        <div class="text-sm leading-6">
                                            <label for="candidates" class="font-medium text-gray-900">Children</label>
                                        </div>
                                    </div>
                                    <div class="relative flex gap-x-3">
                                        <div class="flex h-6 items-center">
                                            <input wire:model="tags" type="checkbox" value="everyone"
                                                class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                        </div>
                                        <div class="text-sm leading-6">
                                            <label for="offers" class="font-medium text-gray-900">Everyone</label>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    @foreach ($tags as $tag)
                                        {{ $tag }}
                                    @endforeach
                                    @error('tags') <span class="error text-red-600 text-sm">{{ $message }}</span> @enderror


                            </fieldset>
                            <fieldset>
                                <legend class="text-sm font-semibold leading-6 text-gray-900">Product Discounts</legend>
                                <div class="mt-6 space-y-6">
                                    <div class="flex items-center gap-x-3">
                                        <input wire:model="discounts" value="20%" type="radio"
                                            class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                        <label for="push-everything"
                                            class="block text-sm font-medium leading-6 text-gray-900">20%</label>
                                    </div>
                                    <div class="flex items-center gap-x-3">
                                        <input wire:model="discounts" value="30%" type="radio"
                                            class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                        <label for="push-email"
                                            class="block text-sm font-medium leading-6 text-gray-900">30%</label>
                                    </div>
                                    <div class="flex items-center gap-x-3">
                                        <input wire:model="discounts" value="40%" type="radio"
                                            class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                        <label for="push-nothing"
                                            class="block text-sm font-medium leading-6 text-gray-900">40%</label>
                                    </div>
                                </div>
                                @error('discounts') <span class="error text-red-600 text-sm">{{ $message }}</span> @enderror

                            </fieldset>
                        </div>
                    </div>


                </div>

                <div class="mt-6 flex items-center justify-end gap-x-6">
                    {{-- <x-button spinner="loading" primary label="Save without target" /> --}}
                    <x-button  spinner="create" dark label="Save" type="submit" />
                </div>
    </form> 

    <x-dialog />
      
</div>
-