<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Link') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <div class="mt-10 sm:mt-0">
                    <div class="md:grid md:grid-cols-3 md:gap-6">
                        <div class="flex mt-5 md:mt-0 md:col-span-1 justify-center items-center">
                            <h1 class="text-3xl md:ml-7 sm:ml-0">Link Shortener</h1>
                        </div>

                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <form action="{{ route('updateLink', ['slug' => $link->slug]) }}" method="POST">
                                @csrf
                                <div class="shadow overflow-hidden sm:rounded-md">
                                    <div class="px-4 py-5 bg-white sm:p-6">
                                        <div class="grid grid-cols-6 gap-6">
                                            <div class="col-span-6 sm:col-span-6">
                                                <label for="name" class="block text-sm font-medium text-gray-700">Link
                                                    Name</label>
                                                <input type="text" name="name" id="name"
                                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                                    value="{{ $link->name }}" required>
                                            </div>

                                            <div class="col-span-6 sm:col-span-6">
                                                <label for="url" class="block text-sm font-medium text-gray-700">Link
                                                    URL</label>
                                                <input type="url" name="url" id="url"
                                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                                    value="{{ $link->link }}" required>
                                            </div>

                                            <div class="col-span-6 sm:col-span-6">
                                                <label for="slug" class="block text-sm font-medium text-gray-700">Custom
                                                    Slug</label>
                                                <input type="text" name="slug" id="slug"
                                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                                    value="{{ $link->slug }}" required>
                                                <p class="mt-2 text-sm text-gray-500" id="linkFinal">
                                                    Shortened Link: {{ env('APP_URL') . $link->slug }}
                                                </p>
                                            </div>

                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="linkStatus"
                                                    class="block text-sm font-medium text-gray-700">Link Status</label>
                                                <select id="linkStatus" name="linkStatus"
                                                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                    @if ($link->status === 1)
                                                    <option value="1" selected>Active</option>
                                                    <option value="0">Inactive</option>
                                                    @else
                                                    <option value="1">Active</option>
                                                    <option value="0" selected>Inactive</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                        <button type="submit"
                                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            Update
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('customScript')
    <script>
        $(document).ready(function () {
            $('#slug').keyup(function () {
                $('#linkFinal').text("Shortened Link: " + {!! json_encode(env('APP_URL')) !!} + $(this).val().replaceAll(' ', '-'));
                $('#slug').val($(this).val().replaceAll(' ', '-'));
            });
        });
    </script>
    @endsection
</x-app-layout>