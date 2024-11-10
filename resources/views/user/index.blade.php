<x-app-layout>
    <div class="md:container md:mx-auto my-8 py-3 md:px-4 bg-white text-center divide-y">
        @if (session('success'))
            <div class="bg-green-500 text-white text-center py-2 px-4 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ isset($userToEdit) ? route('user.update', $userToEdit->id) : route('user.store') }}" method="POST">
            @csrf
            @if (isset($userToEdit))
                @method('PUT')
            @endif
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                        Nombre
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border @error('name') border-red-500 @else border-gray-200 @enderror rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="name" type="text" name="name" value="{{ old('name', $userToEdit->name ?? '') }}">

                    @error('name')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="w-full md:w-1/2 px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="email">
                        Email
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border @error('email') border-red-500 @else border-gray-200 @enderror rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="email" type="text" name="email" value="{{ old('email', $userToEdit->email ?? '') }}">

                    @error('email')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-1/2 px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="password">
                        Contraseña
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border @error('password') border-red-500 @else border-gray-200 @enderror rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="password" type="password" name="password" value="{{ old('password') }}">

                    @error('password')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="w-full md:w-1/2 px-3 inline-block align-middle">
                <button class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                    {{ isset($userToEdit) ? 'Actualizar usuario' : 'Agregar nuevo usuario' }}
                </button>
            </div>
        </form>

        <table class="w-full text-sm text-left rtl:text-right mt-5">
            <thead class="text-xs uppercase">
                <tr>
                    <th scope="col" class="px-6 py-3">Nombre</th>
                    <th scope="col" class="px-6 py-3">Email</th>
                    <th scope="col" class="px-6 py-3">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">{{ $user->name }}</td>
                        <td class="px-6 py-4">{{ $user->email }}</td>
                        <td class="px-6 py-4">
                            <a href="{{ route('user.edit', $user->id) }}" class="text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 font-medium rounded text-sm px-5 py-2.5 focus:outline-none">
                                Editar
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
