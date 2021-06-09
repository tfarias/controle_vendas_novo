import Head from 'next/head';
import Layout from '../../components/layout';
import { Table, Row } from 'react-bootstrap';
import { Venda } from '../../interfaces/venda';
import { GetServerSideProps } from 'next';
import { AxiosError } from 'axios';
import { toast } from 'react-toastify';
import { Pagination } from '../../interfaces/pagination';
import Pages from '../../components/pagination';
import { useEffect, useState } from 'react';
import apiHost from '../../services/api-host';
import { useRouter } from 'next/router';

interface IProps {
  vendedor: any;
}
const Vendas: React.FC<IProps> = ({ vendedor }) => {
  const router = useRouter();
  const page = router.query.page || 1;
  const [vendas, setVendas] = useState<Venda[]>([]);
  const [pagination, setPagination] = useState<Pagination>();

  useEffect(() => {
    apiHost
      .get(`/venda?page=${page}`)
      .then(res => {
        setVendas(res.data.data);
        setPagination(res.data.meta.pagination);
      })
      .catch((err: AxiosError) => {
        toast.error('Erro ao carregar vendas!');
      });
  }, []);

  return (
    <Layout
      contentTitle="Vendas"
      contentTitleButton="Nova Venda"
      actionButton={`/venda/add?vendedor=${vendedor}`}
    >
      <div>
        <Head>
          <title>Vendas</title>
        </Head>
        <Row>
          <Table striped bordered hover>
            <thead>
              <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Comissão</th>
                <th>Valor da venda</th>
                <th>Data da venda</th>
              </tr>
            </thead>
            <tbody>
              {vendas &&
                vendas.map(venda => (
                  <tr key={venda.id}>
                    <td>{venda.id}</td>
                    <td>{venda.vendedor.nome}</td>
                    <td>{venda.vendedor.email}</td>
                    <td>{venda.comissao}</td>
                    <td>{venda.valor_venda}</td>
                    <td>{venda.data_venda}</td>
                  </tr>
                ))}
            </tbody>
          </Table>
        </Row>
        <Row>
          <Row>{pagination && <Pages pagination={pagination} />}</Row>
        </Row>
      </div>
    </Layout>
  );
};

export const getServerSideProps: GetServerSideProps<IProps> = async ctx => {
  const vendedor = ctx.query.id;
  return {
    props: { vendedor },
  };
};

export default Vendas;
