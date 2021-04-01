<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Link Details') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

        <div class="md:grid md:grid-cols-3 md:gap-6">
          <div class="flex flex-col md:col-span-1 justify-center items-center ml-6">
            {!! QrCode::size(300)->generate( env('APP_URL') . $link->slug ); !!}
            <a class="mt-5" href="{{ route('downloadQR', ['slug' => $link->slug]) }}" target="_">
              <div class="text-sm text-blue-500 hover:text-indigo-900">
                Download QR Code</div>
            </a>
          </div>
          <div class="md:col-span-2">
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
              <div class="px-4 py-5 sm:px-6 sm:grid sm:grid-cols-2">
                <div class="sm:col-span-1">
                  <h3 class="text-lg leading-6 font-medium text-gray-900">
                    {{ $link->name }}
                  </h3>
                  <p class="mt-1 max-w-2xl text-sm text-gray-500">
                    Shortened link details
                  </p>
                </div>
                <div class="flex sm:col-span-1 justify-end items-center">
                  <a class="mr-3 delete-link" href="{{ route('deleteLink', ['slug' => $link->slug]) }}">
                    <button type="button"
                      class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                      Delete Link
                    </button>
                  </a>
                  <a href="{{ route('editLink', ['slug' => $link->slug]) }}">
                    <button type="button"
                      class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                      Edit Link
                    </button>
                  </a>
                </div>
              </div>
              <div class="border-t border-gray-200">
                <dl>
                  <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                      Link Name
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                      {{ $link->name }}
                    </dd>
                  </div>
                  <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                      Shortened Link URL
                    </dt>
                    <dd class="flex items-center space-x-3 mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                      <a href="{{ env('APP_URL') . $link->slug }}" target="_">
                        <div class="inline text-sm text-blue-500 hover:text-indigo-900">
                          {{ env('APP_URL') . $link->slug }}</div>
                      </a>
                      <button class="copy-btn" data-clipboard-text="{{ env('APP_URL') . $link->slug }}">
                        <svg class="w-4 h-4 text-gray-700 cursor-pointer" fill="none" stroke="currentColor"
                          viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                          </path>
                        </svg>
                      </button>
                    </dd>
                  </div>
                  <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                      Original URL
                    </dt>
                    <dd class="flex items-center space-x-3 mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                      <a href="{{ $link->link }}" target="_">
                        <div class="inline text-sm text-blue-500 hover:text-indigo-900">
                          {{ $link->link }}</div>
                      </a>
                      <button class="copy-btn" data-clipboard-text="{{ $link->link }}">
                        <svg class="w-4 h-4 text-gray-700 cursor-pointer" fill="none" stroke="currentColor"
                          viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                          </path>
                        </svg>
                      </button>
                    </dd>
                  </div>
                  <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                      Total Views
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                      {{ $link->counter }}
                    </dd>
                  </div>
                  <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                      Created At
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                      {{ $link->created_at }}
                    </dd>
                  </div>
                  <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                      Link Status
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                      @if ($link->status === 1)
                      <a href="{{ route('revertStatus', ['id' => $link->id]) }}">
                        <span
                          class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                          Active
                        </span>
                      </a>
                      @else
                      <a href="{{ route('revertStatus', ['id' => $link->id]) }}">
                        <span
                          class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                          Inactive
                        </span>
                      </a>
                      @endif
                    </dd>
                  </div>
                </dl>
              </div>
            </div>
          </div>

        </div>

      </div>
    </div>
  </div>

  @section('customScript')
  <script>
    $(document).on('click', '.delete-link', function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) { 
                    window.location.replace("/delete/" + {!! json_encode($link->slug) !!});
                }
            })
        });

    var clipboard = new ClipboardJS('.copy-btn');
  </script>
  @endsection
</x-app-layout>