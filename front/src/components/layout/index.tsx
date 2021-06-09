import React from "react";
import Content from "../content";
import Footer from "../footer";

import Header from "../header";
import Sidebar from "../sidebar";

type Props = {
  contentTitle: string;
  contentTitleButton: string;
  actionButton?: string;
};

const Layout: React.FC<Props> = ({
  children,
  contentTitle,
  contentTitleButton,
  actionButton,
}) => {
  return (
    <div className="wrapper">
      <Header />
      <Sidebar projectName="Sistema Vendas" />
      <Content
        title={contentTitle}
        titleButton={contentTitleButton}
        action={actionButton}
      >
        {children}
      </Content>
      <Footer />
    </div>
  );
};

export default Layout;
