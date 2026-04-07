import axios from "axios";
import { createToaster } from "@meforma/vue-toaster";

const toaster = createToaster({ position: "top-right" });

export default function(to, from, next){
    axios 
        .get("http://127.0.0.1:8000/api/khach-hang/check-token", {
            headers: {
                Authorization: "Bearer " + localStorage.getItem("token_client")
            },
        }) 
        .then((res) =>{
            if(res.data.status){
                localStorage.setItem("ho_ten_khach_hang", res.data.ho_va_ten);
                localStorage.setItem("check_kh", res.data.status);
                next();
            } else{
                toaster.error(res.data.message);
                next("/khach-hang/dang-nhap");
            }
        })
        .catch((error) => {
      console.error("Lỗi xác thực token:", error);
      toaster.error("Bạn chưa đăng nhập. Vui lòng đăng nhập!");
      next("/khach-hang/dang-nhap");
    });
}