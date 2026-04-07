import axios from "axios";
import { createToaster } from "@meforma/vue-toaster";

const toaster = createToaster({ position: "top-right" });

export default function (to, from, next) {
  var token = localStorage.getItem("token_admin");
  axios
    .get("http://127.0.0.1:8000/api/admin/check-token", {
      headers: {
        Authorization: "Bearer " + token,
      },
    })
    .then((response) => {
      if (response.data.status) {
        
        next();
      } else {
        toaster.error(response.data.message || "Phiên đăng nhập hết hạn!");
        next("/admin/dang-nhap");
      }
    })
    .catch((error) => {
      console.error("Lỗi xác thực token:", error);
      toaster.error("Bạn chưa đăng nhập. Vui lòng đăng nhập!");
      next("/admin/dang-nhap");
    });
}
