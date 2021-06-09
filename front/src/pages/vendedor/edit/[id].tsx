import Head from 'next/head';
import Layout from '../../../components/layout';
import FormVendedor from '../../../components/form_vendedor';
import { Vendedor } from '../../../interfaces/vendedor';
import { GetServerSideProps } from 'next';
import { AxiosError } from 'axios';
import { toast } from 'react-toastify';
import apiHost from '../../../services/api-host';
import { useEffect, useState } from 'react';

interface IProps {
  id: any;
}

const VendedorCreate: React.FC<IProps> = ({ id }) => {
  const [vendedor, setVendedor] = useState<Vendedor>();

  useEffect(() => {
    apiHost
      .get(`/vendedor/${id}/edit`)
      .then(res => {
        setVendedor(res.data);
      })
      .catch((err: AxiosError) => {
        toast.error('Erro ao carregar vendas!');
      });
  }, []);

  return (
    <Layout contentTitle="Vendedores" contentTitleButton="Cadastrar vendedor">
      <div>
        <Head>
          <title>Vendas</title>
        </Head>
        {vendedor && <FormVendedor vendedor={vendedor} />}
      </div>
    </Layout>
  );
};

export const getServerSideProps: GetServerSideProps<IProps> = async ctx => {
  const id = ctx.query.id;
  return {
    props: { id },
  };
};

export default VendedorCreate;
