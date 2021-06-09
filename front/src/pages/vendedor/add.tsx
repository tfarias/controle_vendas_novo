import Head from "next/head";
import Layout from "../../components/layout";
import FormVendedor from "../../components/form_vendedor";

const VendedorCreate: React.FC = () => {
  return (
    <Layout contentTitle="Vendedores" contentTitleButton="Cadastrar vendedor">
      <div>
        <Head>
          <title>Vendas</title>
        </Head>
        <FormVendedor />
      </div>
    </Layout>
  );
};

export default VendedorCreate;
