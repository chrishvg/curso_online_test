<x-app-layout>
<div class="md:container md:mx-auto md:my-8 md:px-4 bg-white text-center divide-y">
    <form action="{{ route('comments.store') }}" method="POST">
        @csrf
        <input type="hidden" name="video_id" value="{{ $video->id }}">
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="comment">
                    Comentario para {{ $video->title }}
                </label>
                <textarea id="comment" name="comment" class="appearance-none block w-full bg-gray-200 text-gray-700 border @error('comment') border-red-500 @else border-gray-200 @enderror rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" placeholder="Escribe tu comentario" rows="3"></textarea>

                @error('comment')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="w-full md:w-1/2 px-3 inline-block align-middle">
            <button class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                Enviar
            </button>
        </div>
    </form>
</div>
</x-app-layout>
