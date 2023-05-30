<div>
    <div class="px-4 sm:px-6 lg:px-8">
       
        <div class="mt-8 flow-root">
          <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
              <table class="min-w-full divide-y divide-gray-300">
                <thead>
                  <tr>
                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Product Name</th>
                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Price</th>
                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Descriptions</th>
                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">tags</th>
                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">image</th>
                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                      <span class="sr-only">Update</span>
                    </th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">

                    @forelse ($products as $item)
                    <tr>
                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">{{$item->product_name}}</td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{$item->product_price}}</td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{$item->description}}</td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ implode(' | ', json_decode($item->tags))}}</td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">

                        @if($item->files->count()> 0)
                        <a href="{{Storage::url($item->files->first()->file_path)}}"> <img src="{{Storage::url($item->files->first()->file_path)}}"  target="_blank"  class="w-20 h-20 object-cover"></a>
                        @endif
                        </td>
                        <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                            {{-- <x-button rose label="Rose" wire:click="$emit('update', {{}})" /> --}}
                            <x-button rose wire:click="$emit('showFormToDelete', {{$item->id}})">
                                Delete
                            </x-button>
                            <x-button rose wire:click="$emit('showFormToUpdate', {{$item->id}})">
                                Update
                            </x-button>
                        </td>
                      </tr>
                    @empty
                        <div>No Record</div>
                    @endforelse
                
      
                  <!-- More people... -->
                </tbody>
              </table>
              {{$products->links()}}
            </div>
          </div>
        </div>
      </div>
      
</div>
