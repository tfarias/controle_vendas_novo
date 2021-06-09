import Head from 'next/head';
import Layout from '../../components/layout';
import { useRouter } from 'next/router';
import FormVenda from '../../components/form_venda';

const VendedorCreate: React.FC = () => {
  const router = useRouter();
  const vendedor = router.query.vendedor;
  return (
    <Layout contentTitle="Vendedores" contentTitleButton="Cadastrar vendedor">
      <div>
        <Head>
          <title>Vendas</title>
        </Head>
        <FormVenda vendedor={vendedor} />
      </div>
    </Layout>
  );
};

export default VendedorCreate;
