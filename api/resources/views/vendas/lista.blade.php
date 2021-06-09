@extends('layouts.pdf')
@section('conteudo')

    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td style="text-align: center"><h3>Relatório de vendas</h3></td>
        </tr>
    </table>
    <hr/>
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td>Vendedor:</td>
            <td>{{ $vendas->first()->vendedor->nome }}</td>
        </tr>
        <tr>
            <td>Email:</td>
            <td>{{ $vendas->first()->vendedor->email }}</td>
        </tr>
        <tr>
            <td>Data:</td>
            <td>{{ $vendas->first()->data->format('d/m/Y') }}</td>
        </tr>
    </table>

    <hr/>
            <table width="100%" cellpadding="0" cellspacing="0">
                <thead>
                <tr>
                    <th style="text-align: left">Id</th>
                    <th style="text-align: left">Data da Venda</th>
                    <th style="text-align: left">Valor da Venda</th>
                    <th style="text-align: left">Comissão</th>
                </tr>
                </thead>
                <tbody>
                @forelse($vendas as $venda)
                    <tr>
                        <td>{{$venda->id}}</td>
                        <td>{{$venda->data->format('d/m/Y H:i')}}</td>
                        <td>R$ {{number_format($venda->valor,2,',','.')}}</td>
                        <td>R$ {{number_format($venda->comissao,2,',','.')}}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">Você não fez nenhuma venda hoje!</td>
                    </tr>
                @endforelse
                </tbody>
                @if($vendas->isNotEmpty())
                    <tfoot>
                    <tr>
                        <td colspan="2">&nbsp;</td>
                        <td>R$ {{number_format($vendas->pluck('valor')->sum(),2,',','.')}}</td>
                        <td>R$ {{number_format($vendas->pluck('comissao')->sum(),2,',','.')}}</td>
                        <td>&nbsp;</td>
                    </tr>
                    </tfoot>
                @endif
            </table>
@endsection
