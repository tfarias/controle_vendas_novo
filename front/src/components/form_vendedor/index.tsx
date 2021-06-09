import { useRouter } from "next/router";
import { useForm } from "react-hook-form";
import { Vendedor } from "../../interfaces/vendedor";
import { Form, Button } from "react-bootstrap";
import { AxiosError, AxiosResponse } from "axios";
import toastError from "../../services/error.service";
import apiHost from "../../services/api-host";
interface Props {
  vendedor?: Vendedor;
}

const FormVendedor: React.FC<Props> = ({ vendedor }) => {
  const router = useRouter();
  const {
    register,
    handleSubmit,
    formState: { errors },
  } = useForm<Vendedor>({
    defaultValues: vendedor,
  });

  const onSubmit = (data: Vendedor) => {
    return vendedor ? update(data) : create(data);
  };

  const create = async (data: Vendedor) => {
    await apiHost
      .post("/vendedor", data)
      .then((response: AxiosResponse) => {
        router.push("/vendedor");
      })
      .catch((err: AxiosError) => {
        if (err.response) {
          toastError(err.response.data.errors, data);
        }
      });
  };
  const update = async (data: Vendedor) => {
    await apiHost
      .put(`/vendedor/${vendedor?.id}`, data)
      .then((response: AxiosResponse) => {
        router.push("/vendedor");
      })
      .catch((err: AxiosError) => {
        if (err.response) {
          toastError(err.response.data.errors, data);
        }
      });
  };

  return (
    <Form onSubmit={handleSubmit(onSubmit)}>
      <Form.Group className="mb-6" controlId="nome">
        <Form.Label>Nome</Form.Label>
        <Form.Control
          type="text"
          placeholder="Nome"
          {...register("nome", { required: true })}
          isInvalid={errors.nome && true}
        />

        {errors.nome && errors.nome.type === "required" && (
          <Form.Control.Feedback type="invalid">
            O Nome é obrigatório!
          </Form.Control.Feedback>
        )}
      </Form.Group>

      <Form.Group className="mb-6" controlId="email">
        <Form.Label>E-mail</Form.Label>
        <Form.Control
          type="text"
          placeholder="E-mail"
          {...register("email", { required: true, pattern: /^\S+@\S+$/i })}
          isInvalid={errors.email && true}
        />
        {errors.email && errors.email.type === "required" && (
          <Form.Control.Feedback type="invalid">
            E-mail é obrigatório
          </Form.Control.Feedback>
        )}
        {errors.email && errors.email.type === "pattern" && (
          <Form.Control.Feedback type="invalid">
            Informe um e-mail válido
          </Form.Control.Feedback>
        )}
      </Form.Group>

      <Button variant="primary" type="submit">
        Enviar
      </Button>
    </Form>
  );
};

export default FormVendedor;
