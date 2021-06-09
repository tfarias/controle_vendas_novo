import Head from "next/head";
import { useRouter } from "next/router";
import Layout from "../../components/layout";
import { Table, Row, Button, OverlayTrigger, Tooltip } from "react-bootstrap";
import * as Icon from "react-bootstrap-icons";
import api from "../../services/api";
import { Vendedor } from "../../interfaces/vendedor";
import { GetServerSideProps } from "next";
import { AxiosError } from "axios";
import { toast } from "react-toastify";
import Link from "next/link";
import { Pagination } from "../../interfaces/pagination";
import Pages from "../../components/pagination";

interface IProps {
  vendedores: Vendedor[];
  pagination: Pagination;
}
const Vendedores: React.FC<IProps> = ({ vendedores, pagination }) => {
  const router = useRouter();

  return (
    <Layout
      contentTitle="Vendedores"
      contentTitleButton="Cadastrar vendedor"
      actionButton="/vendedor/add"
    >
      <div>
        <Head>
          <title>Vendedores</title>
        </Head>
        <Row>
          <Table striped bordered hover>
            <thead>
              <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Email</th>
                <th style={{ width: "10%" }}></th>
              </tr>
            </thead>
            <tbody>
              {vendedores &&
                vendedores.map(vendedor => (
                  <tr key={vendedor.id}>
                    <td>{vendedor.id}</td>
                    <td>{vendedor.nome}</td>
                    <td>{vendedor.email}</td>
                    <td style={{ textAlign: "center" }}>
                      <Link href={`/vendedor/edit/${vendedor.id}`}>
                        <Button>
                          <Icon.Pencil />
                        </Button>
                      </Link>{" "}
                      <OverlayTrigger
                        key={vendedor.id}
                        placement="bottom"
                        overlay={
                          <Tooltip id={`tooltip-${vendedor.id}`}>
                            Vendas
                          </Tooltip>
                        }
                      >
                        <Button
                          variant="secondary"
                          onClick={() => router.push(`/venda/${vendedor.id}`)}
                        >
                          <Icon.List />
                        </Button>
                      </OverlayTrigger>
                    </td>
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
    .get(`/vendedor?page=${page}`)
    .then(res => res.data)
    .catch((err: AxiosError) => {
      console.log(`aqui${err}`);
      toast.error("Erro ao carregar vendedores!");
    });

  const vendedores = resp.data || [];
  const pagination = resp.data.meta?.pagination || [];

  return {
    props: { vendedores, pagination },
  };
};

export default Vendedores;
