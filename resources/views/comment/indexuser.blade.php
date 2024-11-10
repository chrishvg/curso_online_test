<x-app-layout>
<div class="md:container md:mx-auto md:my-8 md:px-4 bg-white text-center divide-y">
    <table class="w-full text-sm text-left rtl:text-right mt-5">
        <thead class="text-xs uppercase">
            <tr>
                <th scope="col" class="px-6 py-3 w-1/3">Video</th>
                <th scope="col" class="px-6 py-3">Comentario</th>
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
                    <td class="px-6 py-4">{{ $comment->video->title }}</td>
                    <td class="px-6 py-4">{{ $comment->comment }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</x-app-layout>
