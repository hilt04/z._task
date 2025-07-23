@csrf
<x-input nome="nome" :valorPadrao="$cliente->nome ?? ''" labelTitulo="Nome do cliente" />
<x-input nome="endereco" :valorPadrao="$cliente->endereco ?? ''" labelTitulo="Endereço do cliente" />
<x-input nome="descricao" :valorPadrao="$cliente->descricao ?? ''" labelTitulo="Descrição do cliente" />
<x-botao-primario titulo="Salvar dados Cliente" />