import {toast} from 'react-toastify';

const toastError = (erros:any, obj:any) => {
  Object.keys(obj).map((key) => {
    if(erros[key]){
      erros[key].map((erro:any)=>{
        toast.error(erro);
      })
    }
  });

}

export default toastError;
