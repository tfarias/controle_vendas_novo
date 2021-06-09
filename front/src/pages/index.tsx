import Head from "next/head";
import Layout from "../components/layout";
import { Table, Row, Button } from "react-bootstrap";
import api from "../services/api";
import { Venda } from "../interfaces/venda";
import { Pagination } from "../interfaces/pagination";
import { GetServerSideProps } from "next";
import { AxiosError } from "axios";
import { toast } from "react-toastify";
import Pages from "../components/pagination";

interface IProps {
  vendas: Venda[];
  pagination: Pagination;
}

const Home: React.FC<IProps> = ({ vendas, pagination }) => {
  return (
    <Layout
      contentTitle="Vendas"
      contentTitleButton="Nova Venda"
      actionButton="/venda/add"
    >
      <div>
        <Head>
          <title>`Vendas</title>
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
          <Pages pagination={pagination} />
        </Row>
      </div>
    </Layout>
  );
};

export const getServerSideProps: GetServerSideProps<IProps> = async ctx => {
  const page = ctx.query.page || 1;
  const resp = await api
    .get(`/venda?page=${page}`)
    .then(res => res.data)
    .catch((err: AxiosError) => {
      toast.error("Erro ao carregar vendas!");
    });
  console.log(resp);
  const vendas = resp?.data || [];
  const pagination = resp?.meta.pagination || [];

  return {
    props: { vendas, pagination },
  };
};

export default Home;
