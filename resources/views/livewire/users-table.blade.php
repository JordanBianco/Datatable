<div>
    <h2 class="font-bold text-gray-800 text-xl mb-4">Livewire Datatable</h2>

    <header class="flex items-center justify-between my-4">

        <input
            wire:model="search"
            class="w-64 text-sm border border-gray-300 focus:outline-none rounded-xl p-2"
            type="search"
            placeholder="Cerca utente per nome o email">

        <div class="flex items-center space-x-4">
            <div class="flex items-center space-x-1">
                <span class="text-xs text-gray-500 uppercase">Risultati per pagina</span>
                <select wire:model="perPage" class="text-xs border border-gray-300 focus:outline-none rounded py-1 p-2">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                </select>
            </div>

            <div>
                <select
                    wire:model="active"
                    class="text-xs border border-gray-300 focus:outline-none rounded py-1 p-2">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                        <option value="all">All</option>
                </select>
            </div>
        </div>

    </header>

    <table class="w-full">
        <tr class="bg-gray-100 border-b border-gray-200 font-normal text-left text-gray-500 text-xs">
            <th class="p-4 space-x-1 uppercase w-1/4">
                <div class="flex items-center space-x-1">
                    <span wire:click="sortBy('name')" class="cursor-pointer">name</span>
                    @if ($sortBy == 'name')
                        @if ($sortAsc)
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd"></path></svg>
                        @else
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        @endif
                    @endif
                </div>
            </th>
            <th class="p-4 uppercase w-1/4">
                <div class="flex items-center space-x-1">
                    <span wire:click="sortBy('email')" class="cursor-pointer">email</span>
                    @if ($sortBy == 'email')
                        @if ($sortAsc)
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd"></path></svg>
                        @else
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        @endif
                    @endif
                </div>
            </th>
            <th class="p-4 uppercase w-1/4 text-center">
                Status
            </th>
            <th class="p-4 uppercase w-1/4">
                <div class="flex items-center space-x-1">
                    <span wire:click="sortBy('created_at')" class="cursor-pointer">Iscrizione</span>
                    @if ($sortBy == 'created_at')
                        @if ($sortAsc)
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd"></path></svg>
                        @else
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        @endif
                    @endif   
                </div>

            </th>
        </tr>
        @foreach ($users as $user)
            <tr class="{{ $loop->last ? '' : 'border-b border-gray-200' }} bg-gray-100">
                <td class="text-sm p-4 py-2 flex space-x-2 items-center">
                    <img src="https://source.unsplash.com/200x200/?face&crop=face&v=1" alt="user_avatar" class="rounded-full w-10 h-10">
                    <span>{{ $user->name }}</span>
                </td>
                <td class="text-sm p-4 py-2">{{ $user->email }}</td>
                <td class="text-sm p-4 py-2 text-center">
                    <button class="rounded-full px-2 py-1 text-xs {{ $user->active ? 'bg-indigo-100 text-indigo-500' : 'bg-red-100 text-red-500' }}">
                        {{ $user->active ? 'active' : 'inactive' }}
                    </button>
                </td>
                <td class="text-xs p-4 py-2">{{ $user->created_at->format('d M Y H:i') }}</td>
            </tr>                  
        @endforeach
    </table>

    <div class="mt-6">
        {{ $users->links() }}
    </div>
</div>
