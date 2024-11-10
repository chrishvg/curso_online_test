<table class="w-full text-sm text-left rtl:text-righ" >
    <thead class="text-xs uppercase">
        <tr>
            <th scope="col" class="px-6 py-3">Nombre</th>
            <th scope="col" class="px-6 py-3">Descripción</th>
            <th scope="col" class="px-6 py-3">Categoría</th>
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
                    <a href="{{ $video->url }}" class="text-blue-500 hover:text-blue-700 underline" target="_blank">
                        {{ $video->title }}
                    </a><br>
                @endforeach
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
