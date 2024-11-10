<x-app-layout>
<div class="md:container md:mx-auto my-8 py-3md:px-4 bg-white text-center divide-y">
    @if (Auth::user()->hasRole('Admin'))
    <form action="{{ route('course.store') }}" method="POST">
    @csrf
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                    Nombre
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border @error('name') border-red-500 @else border-gray-200 @enderror rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="name" type="text" name="name" value="{{ old('name') }}">

                @error('name')
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
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="description">
                    Categoría
                </label>
                <select id="category_id" name="category_id" class="bg-gray-50 border @error('category_id') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @if(old('category') == $category->id) selected @endif>{{ $category->name }}</option>
                    @endforeach
                </select>

                @error('category')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="description">
                    Grupo de edad
                </label>
                <select id="age_group" name="age_group" class="bg-gray-50 border @error('age_group') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="5-8" @if(old('age_group') == '5-8') selected @endif>5-8</option>
                    <option value="9-13" @if(old('age_group') == '9-13') selected @endif>9-13</option>
                    <option value="14-16" @if(old('age_group') == '14-16') selected @endif>14-16</option>
                    <option value="16+" @if(old('age_group') == '16+') selected @endif>16+</option>
                </select>

                @error('age_group')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="w-full md:w-1/2 px-3 inline-block align-middle">
            <button class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                Agregar nuevo curso
            </button>
        </div>
    </form>
    @endif
    <table class="w-full text-sm text-left rtl:text-right mt-5">
        <thead class="text-xs uppercase">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Nombre
                </th>
                <th scope="col" class="px-6 py-3">
                    Descripción
                </th>
                <th scope="col" class="px-6 py-3">
                    Categoría
                </th>
                <th scope="col" class="px-6 py-3">
                    Grupo de edad
                </th>
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
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</x-app-layout>
