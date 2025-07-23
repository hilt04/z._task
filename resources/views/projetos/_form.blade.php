@csrf
<x-input nome="nome" :valorPadrao="$projeto->nome ?? ''" labelTitulo="Nome do projeto" />
<x-input nome="orcamento" :valorPadrao="$projeto->orcamento ?? ''" labelTitulo="Orçamento do projeto" />
<x-input nome="data_inicio" :valorPadrao="$projeto->data_inicio ?? ''" labelTitulo="Data de inicio do projeto" />
<x-input nome="data_final" :valorPadrao="$projeto->data_final ?? ''" labelTitulo="Data final do projeto" />

<x-select 
    nome="client_id"
    labelTitulo="Cliente do projeto"
    itemID="id"
    itemDescricao="nome"
    :lista="$clientes"
    :valorPadrao="$projeto->client_id ?? ''"
/>

<x-select-multiple 
    nome="funcionarios"
    labelTitulo="Funcionários que trabalham no projeto"
    itemID="id"
    itemDescricao="nome"
    :lista="$funcionarios"
    :valorPadrao="isset($projeto) ? $projeto->employees->pluck('id')->toArray() : []"
/>

<x-botao-primario titulo="Salvar dados projeto" />

@push('scripts')
    <script src="https://unpkg.com/imask"></script>
    <script>
        let formatoData = '00/00/0000';

        IMask(
            document.getElementById('data_inicio'), {
                mask: formatoData
            }
        );

        IMask(
            document.getElementById('data_final'), {
                mask: formatoData
            }
        );

        IMask(document.getElementById('orcamento'), {
            mask: Number,  // enable number mask

            // other options are optional with defaults below
            scale: 2,  // digits after point, 0 for integers
            thousandsSeparator: '.',  // any single char
            padFractionalZeros: true,  // if true, then pads zeros at end to the length of scale
            normalizeZeros: true,  // appends or removes zeros at ends
            radix: ',',  // fractional delimiter
            mapToRadix: ['.'],  // symbols to process as radix

            // additional number interval options (e.g.)
            min: 1,
            autofix: true,
        });
    </script>
@endpush