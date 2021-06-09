import Link from "next/link";
import { toast } from "react-toastify";
import { AxiosError } from "axios";
import apiHost from "../../services/api-host";

const Header: React.FC = () => {
  const handleNotificacoes = () => {
    apiHost
      .get(`/send`)
      .then(res => {
        toast.success(
          "Relatório diário de caixa será enviado em breve! \n Lembre-se de checar se o comando queue:work está rodando no container da api :) "
        );
      })
      .catch((err: AxiosError) => {
        toast.error(err.response?.data.message);
      });
  };

  return (
    <nav className="main-header navbar navbar-expand bg-white navbar-light border-bottom">
      <ul className="navbar-nav">
        <li className="nav-item">
          <a className="nav-link" data-widget="pushmenu" href="#">
            <i className="fa fa-bars"></i>
          </a>
        </li>
        <li className="nav-item d-none d-sm-inline-block">
          <Link href="/">
            <a className="nav-link">Home</a>
          </Link>
        </li>
      </ul>
      <ul className="navbar-nav ml-auto">
        <li className="nav-item">
          <a
            onClick={handleNotificacoes}
            className="nav-link"
            data-widget="control-sidebar"
            data-slide="true"
            href="#"
          >
            <i className="fa fa-th-large" /> Enviar Notificações
          </a>
        </li>
      </ul>
    </nav>
  );
};

export default Header;
