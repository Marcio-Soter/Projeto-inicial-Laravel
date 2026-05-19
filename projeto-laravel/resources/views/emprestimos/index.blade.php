@extends('layout')

@section('content')
<div class="max-w-6xl mx-auto mt-10 p-6 bg-white rounded-xl shadow-lg">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Painel de Empréstimos</h2>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-4 border-b">Aluno/Usuário</th>
                    <th class="p-4 border-b">Livro</th>
                    <th class="p-4 border-b">Data Saída</th>
                    <th class="p-4 border-b">Status</th>
                    <th class="p-4 border-b text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($emprestimos as $emp)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-4">{{ $emp->usuario->nome }}</td>
                    <td class="p-4 font-semibold">{{ $emp->livro->titulo }}</td>
                    <td class="p-4">{{ \Carbon\Carbon::parse($emp->data_emprestimo)->format('d/m/Y') }}</td>
                    <td class="p-4">
                        @if($emp->status == 'ativo')
                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-bold">Com o Aluno</span>
                        @else
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">Devolvido</span>
                        @endif
                    </td>
                    <td class="p-4 text-center">
                        @if($emp->status == 'ativo')
                            <form action="{{ route('emprestimos.devolver', $emp->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-1 rounded text-sm transition">
                                    Confirmar Devolução
                                </button>
                            </form>
                        @else
                            <span class="text-gray-400 text-sm italic">Finalizado</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection