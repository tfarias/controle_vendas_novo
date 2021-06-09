import { useRouter } from "next/router";
import { useForm } from "react-hook-form";
import { Venda } from "../../interfaces/venda";
import { Form, Button } from "react-bootstrap";

import { AxiosError, AxiosResponse } from "axios";
import CurrencyInput from "react-currency-input-field";
import { Vendedor } from "../../interfaces/vendedor";
import { toast } from "react-toastify";
import { useEffect, useState } from "react";
import { Invalid } from "./style";
import toastError from "../../services/error.service";
import apiHost from "../../services/api-host";

interface Props {
  vendedor?: any;
}

const FormVenda: React.FC<Props> = ({ vendedor }) => {
  const router = useRouter();
  const [vendedores, setVendedores] = useState<Vendedor[]>([]);

  useEffect(() => {
    apiHost
      .get(`/vendedor/lista`)
      .then(res => {
        setVendedores(res.data.data);
      })
      .catch((err: AxiosError) => {
        console.log(err);
        toast.error("Erro ao carregar vendedores!!");
      });
  }, []);
  const {
    register,
    handleSubmit,
    formState: { errors },
  } = useForm<Venda>();
  const onSubmit = (data: Venda) => {
    const body = {
      valor: data.valor_venda,
      vendedor_id: vendedor ? vendedor : data.vendedor.id,
    };

    apiHost
      .post("/venda", body)
      .then((response: AxiosResponse) => {
        vendedor ? router.push(`/venda/${vendedor}`) : router.push("/");
      })
      .catch((err: AxiosError) => {
        if (err.response) {
          toastError(err.response.data.errors, body);
        }
      });
  };

  return (
    <Form onSubmit={handleSubmit(onSubmit)}>
      <Form.Group className="mb-6" controlId="vendedor">
        <Form.Label>Vendedor</Form.Label>

        <Form.Control
          as="select"
          custom
          {...register("vendedor.id", { required: vendedor ? false : true })}
          isInvalid={errors.vendedor && true}
          value={vendedor}
          defaultValue={vendedor}
        >
          <option value="">Selecione</option>;
          {vendedores.map(v => {
            return (
              <option key={v.id} value={v.id}>
                {v.nome}
              </option>
            );
          })}
        </Form.Control>

        {errors.vendedor && errors.vendedor.id?.type === "required" && (
          <Form.Control.Feedback type="invalid">
            Vendedor deve ser selecionado
          </Form.Control.Feedback>
        )}
      </Form.Group>

      <Form.Group className="mb-6" controlId="valor">
        <Form.Label>Valor</Form.Label>
        <CurrencyInput
          {...register("valor_venda", { required: true })}
          className="form-control"
          placeholder="Valor"
          decimalsLimit={2}
          prefix="R$ "
        />

        {errors.valor_venda && errors.valor_venda.type === "required" && (
          <Invalid type="invalid">O valor é obrigatório</Invalid>
        )}
      </Form.Group>

      <Button variant="primary" type="submit">
        Enviar
      </Button>
    </Form>
  );
};

export default FormVenda;
