import Link from "next/link";
import { Button } from "react-bootstrap";
type Props = {
  title: string;
  titleButton: string;
  action?: string;
};

const Content: React.FC<Props> = ({ title, titleButton, children, action }) => {
  return (
    <div className="content-wrapper" style={{ minHeight: "93vh" }}>
      <div className="content-header">
        {title && (
          <div className="container-fluid">
            <div className="row mb-2">
              <div className="col-sm-9">
                <h1 className="m-0 text-dark">{title}</h1>
              </div>
              <div className="col-sm-3 text-right text-muted">
                {action && (
                  <Link href={action}>
                    <Button variant="secondary">
                      {titleButton && titleButton}
                    </Button>
                  </Link>
                )}
              </div>
            </div>
          </div>
        )}
      </div>
      <div className="content">
        <div className="container-fluid">{children}</div>
      </div>
    </div>
  );
};

export default Content;
