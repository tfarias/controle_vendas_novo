import Head from "next/head";
import Layout from "../../../components/layout";
import FormVendedor from "../../../components/form_vendedor";
import { Vendedor } from "../../../interfaces/vendedor";
import { GetServerSideProps } from "next";
import api from "../../../services/api";
import { AxiosError } from "axios";
import { toast } from "react-toastify";

interface IProps {
  vendedor: Vendedor;
}

const VendedorCreate: React.FC<IProps> = ({ vendedor }) => {
  return (
    <Layout contentTitle="Vendedores" contentTitleButton="Cadastrar vendedor">
      <div>
        <Head>
          <title>Vendas</title>
        </Head>
        <FormVendedor vendedor={vendedor} />
      </div>
    </Layout>
  );
};

export const getServerSideProps: GetServerSideProps<IProps> = async ctx => {
  const vendedor = await api
    .get(`${process.env.API_URL}/vendedor/${ctx.query.id}/edit`)
    .then(res => res.data)
    .catch((err: AxiosError) => {
      toast.error("Erro ao carregar vendedor!");
    });

  return {
    props: { vendedor },
  };
};

export default VendedorCreate;
