<x-app-layout>
<div class="md:container md:mx-auto my-8 py-3 md:px-4 bg-white text-center divide-y">
    <form action="{{ route('video.store') }}" method="POST">
        @csrf
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="title">
                    Titulo
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border @error('title') border-red-500 @else border-gray-200 @enderror rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="title" type="text" name="title" value="{{ old('title') }}">

                @error('title')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="description">
                    Descripción
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border @error('description') border-red-500 @else border-gray-200 @enderror rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="description" type="text" name="description" value="{{ old('description') }}">

                @error('description')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="url">
                    URL
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border @error('url') border-red-500 @else border-gray-200 @enderror rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="url" type="text" name="url" value="{{ old('url') }}">

                @error('url')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-full md:w-1/2 px-3">
                <label for="course_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Grupo de edad</label>
                <select id="course_id" name="course_id" class="bg-gray-50 border @error('course_id') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @foreach ($courses as $course)
                        <option value="{{ $course->id }}" @if(old('course_id') == $course->id) selected @endif>{{ $course->name }}</option>
                    @endforeach
                </select>

                @error('course_id')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="w-full md:w-1/2 px-3 inline-block align-middle">
            <button class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                Agregar nuevo video
            </button>
        </div>
    </form>

    <table class="w-full text-sm text-left rtl:text-right mt-5">
        <thead class="text-xs uppercase">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Titulo
                </th>
                <th scope="col" class="px-6 py-3">
                    Descripción
                </th>
                <th scope="col" class="px-6 py-3">
                    Curso
                </th>
                <th scope="col" class="px-6 py-3">
                    URL
                </th>
            </tr>
        </thead>
        <tbody>
            @if (count($videos) == 0)
                <tr>
                    <td colspan="4" class="text-center">No hay videos disponibles</td>
                </tr>
            @endif
            @foreach ($videos as $video)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">{{ $video->title }}</td>
                    <td class="px-6 py-4 text-wrap hover:text-balance">{{ $video->description }}</td>
                    <td class="px-6 py-4">{{ $video->course->name }}</td>
                    <td class="px-6 py-4 text-wrap hover:text-balance">{{ $video->url }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</x-app-layout>
