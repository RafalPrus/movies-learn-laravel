<div class="relative">
    <input wire:model.debounce.500ms="search" type="text" class="mt-2 md:mt-0 bg-gray-800 text-sm rounded-full w-64 px-4 pl-8 py-1" placeholder="Search">
    <div class="absolute top-0">
        <svg class="fill-current w-4 text-gray-500 mt-2.5 md:mt-0.5 ml-2" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"></path><path d="M15.5 14h-.79l-.28-.27c1.2-1.4 1.82-3.31 1.48-5.34-.47-2.78-2.79-5-5.59-5.34-4.23-.52-7.79 3.04-7.27 7.27.34 2.8 2.56 5.12 5.34 5.59 2.03.34 3.94-.28 5.34-1.48l.27.28v.79l4.25 4.25c.41.41 1.08.41 1.49 0 .41-.41.41-1.08 0-1.49L15.5 14zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path></svg>
    </div>
    <div class="absolute bg-gray-800 text-sm rounded w-64 mt-4">
        <ul>
            @if(count($searchResults) > 1)
                @foreach($searchResults as $result)
                    <li class="border-b border-gray-700">
                        <a href="{{ route('movies.show', $result['id']) }}" class="block hover:bg-gray-700 px-3 py-3">{{ $result['original_title'] }}</a>
                    </li>
                @endforeach
            @endif
        </ul>
    </div>
</div>
