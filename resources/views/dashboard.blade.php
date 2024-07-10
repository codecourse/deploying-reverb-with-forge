<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div
                        x-data="{
                            messages: [],

                            broadcastMessage () {
                                fetch(`/broadcast`, { method: 'POST', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' } })
                            }
                        }"
                        x-init="
                            Echo.channel('global')
                                .listen('.Message', (e) => {
                                    messages.push(e.body)
                                })
                        "
                    >
                        <div>
                            <button x-on:click="broadcastMessage">Broadcast a message</button>

                            <div class="mt-6" x-show="messages.length">
                                <template x-for="message in messages">
                                    <div x-text="message"></div>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
