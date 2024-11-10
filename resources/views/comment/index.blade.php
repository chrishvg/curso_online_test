<x-app-layout>
<div class="md:container md:mx-auto md:my-8 md:px-4 bg-white text-center divide-y">
    <table class="w-full text-sm text-left rtl:text-right mt-5">
        <thead class="text-xs uppercase">
            <tr>
                <th scope="col" class="px-6 py-3">Usuario</th>
                <th scope="col" class="px-6 py-3">Video</th>
                <th scope="col" class="px-6 py-3 w-1/2">Comentario</th>
                <th scope="col" class="px-6 py-3">Aprobado</th>
                <th scope="col" class="px-6 py-3">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @if (count($comments) == 0)
                <tr>
                    <td colspan="4" class="text-center">No hay comentarios disponibles</td>
                </tr>
            @endif
            @foreach ($comments as $comment)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">{{ $comment->user->name }}</td>
                    <td class="px-6 py-4">{{ $comment->video->title }}</td>
                    <td class="px-6 py-4">{{ $comment->comment }}</td>
                    <td class="px-6 py-4">{{ $comment->approved ? 'Si' : 'No' }}</td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-1">
                        <form action="{{ route('comments.approve', $comment->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button class="shadow bg-green-500 hover:bg-green-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                                Aprobar
                            </button>
                        </form>
                        <form action="{{ route('comments.decline', $comment->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button class="shadow bg-red-500 hover:bg-red-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                                No aprobar
                            </button>
                        </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</x-app-layout>
