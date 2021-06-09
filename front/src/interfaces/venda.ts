import {Vendedor} from './vendedor';

export type Venda = {
  id: number,
  vendedor: Vendedor
  valor_venda: string,
  comissao: string,
  data_venda: string
}
