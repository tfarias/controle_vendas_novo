import React, { FunctionComponent } from 'react';
import { useRouter } from 'next/dist/client/router';
import { Pagination } from '../../interfaces/pagination';
import ReactPaginate from 'react-paginate';
interface Props {
  pagination: Pagination | any;
}

const Pages: FunctionComponent<Props> = ({ pagination }) => {
  const router = useRouter();

  const handlePage = (page: any) => {
    const currentPath = router.pathname;
    const currentQuery = router.query;
    currentQuery.page = page.selected + 1;
    router.push({
      pathname: currentPath,
      query: currentQuery,
    });
  };

  return (
    <div>
      {pagination.total_pages > 1 && (
        <ReactPaginate
          breakClassName={'page-item'}
          breakLinkClassName={'page-link'}
          containerClassName={'pagination'}
          pageClassName={'page-item'}
          pageLinkClassName={'page-link'}
          previousClassName={'page-item'}
          previousLinkClassName={'page-link'}
          nextClassName={'page-item'}
          nextLinkClassName={'page-link'}
          activeClassName={'active'}
          previousLabel={'previous'}
          nextLabel={'next'}
          breakLabel={'...'}
          initialPage={pagination.current_page - 1}
          pageCount={pagination.total_pages}
          marginPagesDisplayed={2}
          pageRangeDisplayed={5}
          onPageChange={handlePage}
        />
      )}
    </div>
  );
};

export default Pages;
