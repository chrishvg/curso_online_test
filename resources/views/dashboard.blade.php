<x-app-layout>
<div class="flex flex-wrap mx-auto container mt-2 bg-white rounded-lg shadow-lg divide-y">
    <div class="flex flex-wrap -mx-3 mb-12 container mx-auto mt-2 pr-2">
        <form id="searchForm" class="w-full mx-auto">
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-2 pl-4">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="description">
                        Categoría
                    </label>
                    <select class="py-3 px-4 block w-full bg-gray-100 border-transparent rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500" name="category_id" id="category_id">
                        <option selected>All</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-span-2 pl-4">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="description">
                        Grupo de edad
                    </label>
                    <select class="py-3 px-4 block w-full bg-gray-100 border-transparent rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500" name="age_group" id="age_group">
                        <option selected>All</option>
                        <option value="5-8" @if(old('age_group') == '5-8') selected @endif>5-8</option>
                        <option value="9-13" @if(old('age_group') == '9-13') selected @endif>9-13</option>
                        <option value="14-16" @if(old('age_group') == '14-16') selected @endif>14-16</option>
                        <option value="16+" @if(old('age_group') == '16+') selected @endif>16+</option>
                    </select>
                </div>
                <div class="col-span-8 pl-4">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="description">
                        Nombre de curso / Descripción de curso / Titulo de video
                    </label>
                    <label for="query" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </div>
                        <input type="search" id="query" name="query" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-gray-500 focus:border-gray-500" placeholder="Title or Description" />
                        <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-4 py-2">Search</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="grid grid-cols-12 container mx-auto gap-4 bg-white rounded-lg shadow-lg">
    <div class="col-span-4 mx-auto">
        <div class="flex flex-col">
            <p class="text-xl">Usuarios</p>
            <table class="w-full text-sm text-left rtl:text-righ">
                <thead class="text-xs uppercase">
                    <tr>
                        <th scope="col" class="px-6 py-3">Administrador / Usuario</th>
                        <th scope="col" class="px-6 py-3">Nombre</th>
                        <th scope="col" class="px-6 py-3">Correo electrónico</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($users) == 0)
                        <tr>
                            <td colspan="4" class="text-center">No hay usuarios disponibles</td>
                        </tr>
                    @endif
                    @foreach ($users as $user)
                    <tr class="hover:bg-gray-50">
                        <td class="pl-6 py-4 w-0.5">
                            @if($user->hasRole('Admin'))
                                <div class="group flex relative">
                                    <svg class="w-3 h-5 me-2.5" title="admin" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7.75 4H19M7.75 4a2.25 2.25 0 0 1-4.5 0m4.5 0a2.25 2.25 0 0 0-4.5 0M1 4h2.25m13.5 6H19m-2.25 0a2.25 2.25 0 0 1-4.5 0m4.5 0a2.25 2.25 0 0 0-4.5 0M1 10h11.25m-4.5 6H19M7.75 16a2.25 2.25 0 0 1-4.5 0m4.5 0a2.25 2.25 0 0 0-4.5 0M1 16h2.25"/>
                                    </svg>
                                    <span class="group-hover:opacity-100 transition-opacity bg-gray-800 px-1 text-sm text-gray-100 rounded-md absolute left-1/2 -translate-x-1/2 translate-y-full opacity-0 m-4 mx-auto">Administrador</span>
                                </div>
                            @else
                                <div class="group flex relative">
                                    <svg class="w-3 h-5 me-2.5" title="user" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z"/>
                                    </svg>
                                    <span class="group-hover:opacity-100 transition-opacity bg-gray-800 px-1 text-sm text-gray-100 rounded-md absolute left-1/2 -translate-x-1/2 translate-y-full opacity-0 m-4 mx-auto">Usuario</span>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4">{{ $user->name }}</td>
                        <td class="px-6 py-4">{{ $user->email }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-span-8">
        <div class="flex flex-col">
            <p class="text-xl">Cursos</p>
            <div id="results">
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
            </div>
        </div>
    </div>
</div>
</x-app-layout>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#searchForm').on('submit', function (e) {
            e.preventDefault();

            const query = $('#query').val();
            const category_id = $('#category_id').val();
            const age_group = $('#age_group').val();

            $.ajax({
                url: '/courses/search',
                type: 'GET',
                data: {
                    query: query,
                    category_id: category_id,
                    age_group: age_group,
                    //_token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    $('#results').html(response);
                },
                error: function (xhr, status, error) {
                    console.error('AJAX Error:', error);
                    $('#results').html('<div>An error occurred while searching.</div>');
                }
            });
        });
    });
</script>
