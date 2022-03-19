<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            アカウント情報
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-flash-message status="info" />
                    <section class="text-gray-600 body-font">
                        <div class="container mx-auto flex px-5 py-24 items-center justify-center flex-col">
                            <img class="lg:w-2/6 md:w-3/6 w-5/6 mb-10 object-cover object-center rounded" alt="hero" src="https://dummyimage.com/720x600">
                            <div class="text-center lg:w-2/3 w-full">
                                <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-900">{{ $user->name }}</h1>
                                <p class="mb-8 leading-relaxed">{{ $user->email }}</p>
                                <div class="flex justify-center">
                                    <button onclick="location.href='{{ route('user.edit', ['user' => $user->id]) }}'" class="inline-flex text-white bg-blue-500 border-0 py-2 px-6 focus:outline-none hover:bg-blue-600 rounded text-lg">編集</button>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
