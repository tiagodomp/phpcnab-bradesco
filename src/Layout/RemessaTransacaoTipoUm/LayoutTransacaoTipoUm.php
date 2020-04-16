<?php


namespace Phpcnab\Bradesco\Layout\RemessaTransacaoTipoUm;

use Phpcnab\Bradesco\File\ReadFileBase;
use Phpcnab\Bradesco\Layout\LayoutInterface;
use Phpcnab\Bradesco\Layout\LayoutBase;

class LayoutTransacaoTipoUm implements LayoutInterface
{
    use ValidatorTransacaoTipoUm;

    public $TipoRegistro = 'Transação';

    //alias campo tabela          posicao De/a      Nome do Campo  Tam. Campo   Tipo
    public $idRegistro                      = [1,1,'Identificação do Registro', 1, 'number'];

    public $agenciaDebito                   = [2,6,'Agência de Débito (opcional)', 5, 'number'];

    public $digitoAgenciaDebito             = [7,7,'Dígito da Agência de Débito (opcional)', 1, 'text'];

    public $razaoContaCorrente              = [8,12,'Razão da Conta Corrente (opcional)', 5, 'number'];

    public $contaCorrente                   = [13,19,'Conta Corrente (opcional)', 7, 'number'];

    public $digitoContaCorrente             = [20,20,'Dígito da Conta Corrente (opcional)', 1, 'text'];

    public $idEmpresaBeneficiaria           = [21,37,'Identificação da Empresa Beneficiária no Banco', 17, 'text'];

    public $numControleParticipante         = [38,62,'Número Controle do Participante', 25, 'text'];

    public $nomeBanco                       = [80,94,'Nome do Banco por Extenso', 15, 'text'];

    public $codigoBancoDebitado             = [63,65,'Código do Banco a ser debitado na Câmara de Compensação', 3, 'number'];

    public $campoMulta                      = [66,66,'Campo de Multa', 1, 'number'];

    public $percentualMulta                 = [67,70,'Percentual de multa', 4, 'number'];

    public $idTituloBanco                   = [71,81,'Identificação do Título no Banco', 11, 'number'];

    public $digAutoConferenciaNumBancario   = [82,82,'Digito de Auto Conferencia do Número Bancário', 1, 'text'];

    public $descontoBonificacaoDia          = [83,92, 'Desconto Bonificação por dia', 10, 'number'];

    public $condEmissaoPapeletaCobranca     = [93,93,'Condição para emissão da papeleta de cobrança', 1, 'number'];

    public $identEmiteBoletoDebitoAuto      = [94,94,'Identifica se emite Boleto para Débito Automático', 1, 'text'];

    public $identOperacaoBanco              = [95,104,'Identificação da Operação do Banco', 10, 'text'];

    public $indicadorRateioCredito          = [105,105,'Indicador Rateio Crédito (opcional)', 1, 'text'];

    public $enderecamentoAvisoDebitoAutoCC  = [106,106,'Endereçamento para Aviso do Débito Automático em Conta Corrente (opcional)', 1, 'number'];

    public $quantidadePagamento             = [107,108,'Quantidade de pagamentos', 2, 'text'];

    public $idOcorrencia                    = [109,110,'Identificação da ocorrência', 2, 'number'];

    public $numDocumento                    = [111,120,'Numero do documento', 10, 'text'];

    public $dataVencimentoTitulo            = [121,126,'Data do Vencimento do Título', 6, 'number'];

    public $valorTitulo                     = [127,139,'Valor do Título', 13, 'number'];

    public $bancoEncarregadoCobranca        = [140,142,'Banco Encarregado da Cobrança', 3, 'number'];

    public $agenciaDepositaria              = [143,147,'Agência Depositária', 5, 'number'];

    public $especieTitulo                   = [148,149,'Espécie de Título', 02, 'number'];

    public $id                              = [150,150,'Identificação', 1, 'text'];

    public $dataEmissaoTitulo               = [151,156,'Data da emissão do Título', 6, 'number'];

    public $primeiraInstrucao               = [157,158,'Primeira instrução', 2, 'number'];

    public $segundaInstrucao                = [159,160,'Segunda instrução', 2, 'number'];

    public $valorCobradoDiaAtraso           = [161,173,'Valor a ser cobrado por Dia de Atraso', 13, 'number'];

    public $dataLimiteConcessaoDesconto     = [174,179,'Data Limite P/Concessão de Desconto', 6, 'number'];

    public $valorDesconto                   = [180,192,'Valor do Desconto', 13, 'number'];

    public $valorIOF                        = [193,205,'Valor do IOF', 13, 'number'];

    public $valorAbatimentoConcedOuCancel   = [206,218,'Valor do Abatimento a ser concedido ou cancelado ', 13, 'number'];

    public $idTipoInscricaoPagador          = [219,220,'Identificação do Tipo de Inscrição do Pagador', 2, 'number'];

    public $numeroInscricaoPagador          = [221,234,'Numero de inscrição do Pagador', 14, 'number'];

    public $nomePagador                     = [235,274,'Nome do Pagador', 40, 'text'];

    public $enderecoCompleto                = [275,314,'Endereço completo', 40, 'text'];

    public $primeiraMensagem                = [315,326,'Primeira mensagem', 12, 'text'];

    public $CEP                             = [327,331,'CEP', 5, 'number'];

    public $sufixoCEP                       = [332,334,'Sufixo do CEP', 3, 'number'];

    public $sacadorAvalistaOuSegundaMensagem= [335,394,'Sacador/Avalista ou Segunda Mensagem', 60, 'text'];

    public $numSequencialRegistro           = [395,400,'Número Sequencial do Registro de Um em Um', 6, 'number'];

    public function __construct(ReadFileBase $linha){
        foreach(get_object_vars($this) as $propiedade => $parametros){
            if($propiedade == 'TipoRegistro')
                continue;

            $layoutBase             = new LayoutBase($propiedade, $parametros);
            $newPropiedade          = $layoutBase->setParametros($linha);
            $newPropiedade          = $this->validateDefault($newPropiedade, $linha->numSequencialRegistro);
            $newPropiedade          = $this->transformarValor($newPropiedade, $linha->numSequencialRegistro);
            $propiedadeValidation   = $propiedade.'Validation';
            $this->$propiedade      = (method_exists($this, $propiedadeValidation)) //Esta na Trait
                                        ?$this->$propiedadeValidation($newPropiedade, $linha->getNumLinhaRegistro())
                                        :$newPropiedade;
        }
    }

    public function get(){
        return $this;
    }

    public function getArray(){
        return get_object_vars($this);
    }

    public function getNumSequencialRegistro(){
        return $this->numSequencialRegistro;
    }

    public function getIdRegistro(){
        return $this->idRegistro;
    }

    public function getTipoRegistro(){
        return $this->TipoRegistro;
    }
}