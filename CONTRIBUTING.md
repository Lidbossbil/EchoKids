# Hướng dẫn đóng góp (Contributing Guidelines)

Tài liệu này dành cho nhóm 5 thành viên thực hiện Khóa luận tốt nghiệp. Để dự án hoạt động trơn tru, tất cả thành viên cần tuân thủ nghiêm ngặt các quy tắc Git Workflow dưới đây.

## 🌟 Quy tắc vàng của nhóm
* **KHÔNG** ai được commit thẳng vào nhánh `main` hoặc nhánh `dev`.
* Mọi tính năng đều bắt buộc phải đi qua **Pull Request (PR)**.

## 🌿 1. Quy tắc phân nhánh (Branching)
Dự án sử dụng 2 nhánh chính và các nhánh tính năng tạm thời:
* **`main`**: Nhánh production dành cho code đã ổn định và đã được review. Chỉ nhận merge từ nhánh `dev` khi hoàn thành sprint.
* **`dev`**: Nhánh tích hợp hàng ngày, là nơi gộp tất cả các tính năng sau khi được review.
* **`feature/...`**: Nhánh tính năng cá nhân tạo riêng cho task của mình, tách ra từ `dev` và merge ngược lại `dev` thông qua PR.
  * *Quy tắc đặt tên:* viết thường và dùng dấu gạch ngang, ví dụ: `feature/ten-tinh-nang`.

## 💬 2. Quy tắc Commit Message
Mỗi commit chỉ nên thực hiện 1 việc nhỏ, message phải tuân theo chuẩn: `type(scope): mô tả ngắn`

**Các loại `type` phổ biến:**
* `feat`: Tính năng mới
* `fix`: Sửa bug
* `refactor`: Tái cấu trúc (không thay đổi logic)
* `docs`: Cập nhật tài liệu
* `chore`: Cài đặt, cấu hình hệ thống
* `style`: Định dạng code (indentation, semi-colon...)
* `test`: Viết thêm unit test

## 🔄 3. Luồng làm việc hàng ngày (Daily Workflow)
Khi nhận một task mới, bạn cần thực hiện đúng các bước sau:
1. **Lấy code mới nhất**: Chuyển sang nhánh `dev` và cập nhật (`git checkout dev` và `git pull origin dev`).
2. **Tạo nhánh tính năng**: Tạo nhánh mới từ `dev` (`git checkout -b feature/ten-tinh-nang`).
3. **Code và Commit**: Thường xuyên kiểm tra thay đổi (`git status`) và commit đúng chuẩn.
4. **Cập nhật với dev trước khi push**: Lấy code mới nhất (`git fetch origin`) và rebase nhánh của bạn lên đầu nhánh `dev` (`git rebase origin/dev`).
5. **Push lên GitHub**: Đẩy nhánh feature của bạn lên (`git push origin feature/ten-tinh-nang`). Sử dụng `--force-with-lease` nếu bạn vừa rebase.
6. **Tạo Pull Request (PR)**: Tạo PR trên GitHub để nhóm tiến hành review code.

## 🤝 4. Quy tắc Pull Request & Merge
* Đảm bảo `base` là nhánh **`dev`** (KHÔNG phải `main`) và `compare` là nhánh `feature` của bạn.
* PR cần có mô tả rõ ràng về tính năng và hướng dẫn cách test.
* **Merge PR tính năng (`feature` -> `dev`)**: Khuyến nghị dùng **"Squash and merge"** để lịch sử commit gọn gàng hơn.
* **Merge vào Main (`dev` -> `main`)**: Thực hiện vào cuối sprint hoặc khi nộp bài chi tiết.
* Xóa nhánh `feature` sau khi merge thành công.

## ✅ 5. Checklist trước khi tạo Pull Request
* [ ] Đã chạy `git fetch` + `git rebase origin/dev` trước khi push.
* [ ] Code chạy được ở local, không có lỗi báo đỏ.
* [ ] Đã xóa các lệnh debug thừa: `dd()`, `var_dump()`, `console.log()`.
* [ ] Không commit file nhạy cảm: `.env`, `vendor/`, `node_modules/` (kiểm tra `.gitignore`).
* [ ] Commit message đúng chuẩn: `type(scope): mô tả`.
* [ ] Đã tự test tay tính năng (Happy path & Edge cases).
* [ ] Base branch là **`dev`** (KHÔNG phải `main`).
* [ ] Đã chỉ định người review (Reviewers).
