<x-layout>
    @if(session('success'))
        <div class="p-3 bg-green-600 text-white rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="p-3 bg-red-600 text-white rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="space-y-12 p-10">
        <div class="border-b border-white/10">
            <div class="mt-2 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-12 p-10 bg-gray-800 rounded-lg">
                <div class="sm:col-span-6">
                    <form method="POST" action="/formtest">
                        @csrf
                        <label for="email" class="block text-sm/6 font-medium text-white">Enter Email</label>
                        <div class="mt-2">
                            <div class="flex items-center rounded-md bg-white/5 pl-3 outline-1 -outline-offset-1 outline-white/10 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-500">
                                <input 
                                    id="email" 
                                    type="email" 
                                    name="email" 
                                    required
                                    placeholder="juandelacruz@umindanao.edu.ph" 
                                    class="block min-w-0 grow bg-transparent py-1.5 pr-3 pl-1 text-base text-white placeholder:text-gray-500 focus:outline-none sm:text-sm/6" 
                                    @if(count($emails) >= 5) disabled @endif
                                />
                            </div>

                            @error('email')
                                <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mt-3 flex items-center gap-x-6 justify-end">
                            <a href="/delete-emails" class="text-sm font-semibold text-gray-400 hover:text-white">Clear All</a>
                            
                            <button type="submit" class="rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white hover:bg-indigo-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500" @if(count($emails) >= 5) disabled @endif>
                                Save Email
                            </button>
                        </div>
                    </form>
                </div>

                <div class="sm:col-span-6 border-l border-white/10 pl-6">
                    <h2 class="text-lg font-semibold text-white mb-4">Stored Emails</h2>

                    @if(count($emails) >= 5)
                        <p class="text-yellow-400 text-sm mb-3">Maximum of 5 emails reached.</p>
                    @endif

                    <ul class="divide-y divide-white/5">
                        @if(count($emails) > 0)
                            @foreach ($emails as $index => $email)
                                <li class="py-3 flex items-center justify-between">
                                    <span class="text-sm text-gray-300">{{ $email }}</span>
                                    <form method="POST" action="/delete-email">
                                        @csrf
                                        <input type="hidden" name="index" value="{{ $index }}">
                                        <button type="submit" class="rounded-md bg-red-500 px-2 py-1 text-xs font-semibold text-white hover:bg-red-400">
                                            Delete
                                        </button>
                                    </form>
                                </li>
                            @endforeach
                        @else
                            <li class="py-3 text-sm text-gray-500 italic">The list is currently empty.</li>
                        @endif
                    </ul>
                </div>

            </div>
        </div>
    </div>
</x-layout>