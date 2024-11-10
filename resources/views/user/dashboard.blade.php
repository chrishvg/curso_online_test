<x-app-layout>
<div class="md:container md:mx-auto md:my-8 md:px-4 bg-white text-center divide-y">
    <form action="{{ route('course.register') }}" method="POST">
        @csrf
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="description">
                    Cursos disponibles
                </label>
                <select id="course_id" name="course_id" class="bg-gray-50 border @error('course_id') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @foreach ($allCourses as $course)
                        <option value="{{ $course->id }}" @if(old('course_id') == $course->id) selected @endif>{{ $course->name }} - {{ $course->category->name }}</option>
                    @endforeach
                </select>

                @error('course_id')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="w-full md:w-1/2 px-3 inline-block align-middle">
            <button class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                Registrarse
            </button>
        </div>
    </form>

    <table class="w-full text-sm text-left rtl:text-right mt-5">
        <thead class="text-xs uppercase">
            <tr>
                <th scope="col" class="px-6 py-3">Curso</th>
                <th scope="col" class="px-6 py-3">Descripción del curso</th>
                <th scope="col" class="px-6 py-3">Categoria</th>
                <th scope="col" class="px-6 py-3">Grupo de edad</th>
                <th scope="col" class="px-6 py-3">Videos</th>
            </tr>
        </thead>
        <tbody>
            @if (count($courses) == 0)
                <tr>
                    <td colspan="4" class="text-center">No hay cursos disponibles</td>
                </tr>
            @endif
            @foreach ($courses as $course)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">{{ $course->name }}</td>
                    <td class="px-6 py-4">{{ $course->description }}</td>
                    <td class="px-6 py-4">{{ $course->category->name }}</td>
                    <td class="px-6 py-4">{{ $course->age_group }}</td>
                    <td class="px-6 py-4">
                        @foreach ($course->videos as $video)
                            <div class="flex items-center">
                            <a href="{{ $video->url }}" class="text-blue-500 hover:text-blue-700 underline" target="_blank">
                                {{ $video->title }}
                            </a><br>
                            @php
                                $like = $video->likes()->where('user_id', Auth::user()->id)->first();
                            @endphp
                            @if (!isset($like) || $like->pivot->like == false)
                                <a href="{{ route('video.like', $video->id) }}" class="text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 font-medium rounded text-sm px-5 py-2.5 focus:outline-none m-1">
                                    Me gusta
                                </a>
                            @else
                                <a href="{{ route('video.like', $video->id) }}" class="text-white bg-red-500 hover:bg-red-700 focus:ring-4 font-medium rounded text-sm px-5 py-2.5 focus:outline-none m-1">
                                    No me gusta
                                </a>
                            @endif
                                <a href="{{ route('comments.write', $video->id) }}" class="text-white bg-green-500 hover:bg-green-700 focus:ring-4 font-medium rounded text-sm px-5 py-2.5 focus:outline-none m-1">
                                    Comentar
                                </a>
                            </div>
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</x-app-layout>
