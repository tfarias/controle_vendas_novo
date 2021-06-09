import React, { FunctionComponent } from "react";
import { useRouter } from "next/dist/client/router";
import Link from "next/link";

interface Props {
  projectName: string;
}

const defaultProps: Props = {
  projectName: "Teste Tray",
};

const Sidebar: FunctionComponent<Props> = ({ projectName }) => {
  const router = useRouter();

  return (
    <aside className="main-sidebar sidebar-dark-primary elevation-4">
      <Link href="/">
        <a className="brand-link text-center">
          <i className="fa fa-home fa-2x brand-image ml-2" />
          <span className="brand-text font-weight-light">
            {projectName && projectName}
          </span>
        </a>
      </Link>

      <div className="sidebar">
        <nav className="mt-2">
          <ul
            className="nav nav-pills nav-sidebar flex-column"
            data-widget="treeview"
            role="menu"
            data-accordion="false"
          >
            <li className="nav-item">
              <Link href="/">
                <a
                  className={[
                    "nav-link",
                    router?.pathname === "/" ? "active" : "",
                  ].join(" ")}
                >
                  <i className="nav-icon fa fa-home" />
                  <p>Vendas</p>
                </a>
              </Link>
            </li>
            <li className="nav-item">
              <Link href="/vendedor">
                <a
                  className={[
                    "nav-link",
                    router?.pathname === "/vendedor" ? "active" : "",
                  ].join(" ")}
                >
                  <i className="nav-icon fa fa-user-circle" />
                  <p>Vendedores</p>
                </a>
              </Link>
            </li>
          </ul>
        </nav>
      </div>
    </aside>
  );
};

Sidebar.defaultProps = defaultProps;

export default Sidebar;
