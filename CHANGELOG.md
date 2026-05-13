# Changelog - EchoKids AI Project

Tất cả các thay đổi quan trọng đối với dự án EchoKids AI sẽ được ghi nhận tại đây.

## [1.2.0] - 2026-05-13

### Added
- **AI Suggestions Enhancements**: Cập nhật danh sách gợi ý mặc định trong Chatbox AI với các câu hỏi tập trung vào lộ trình học tập, cách phát âm chuẩn (âm 'tr', 'ch') và cơ chế chấm điểm. Các gợi ý mới thân thiện với trẻ em và tối ưu hóa phản hồi từ RAG.
- **Contextual Chat Headers**: Hiển thị tiêu đề bài học bên cạnh tên học sinh trong danh sách chat và tiêu đề chat của Giáo viên để phân biệt các phiên hỗ trợ khác nhau cho cùng một học sinh.

### Fixed
- **Lesson Selection Logic**: Sửa lỗi logic trong `QuanHeGvHvController` khiến giáo viên không chọn được bài học để giao. Đã chuyển đổi lọc trạng thái bài học từ `1` (Chờ duyệt) sang `0` (Đã duyệt).
- **Time Localization**: Đồng bộ hóa toàn bộ ngày giờ hiển thị trong bảng điều khiển giáo viên sang múi giờ Việt Nam (`Asia/Ho_Chi_Minh`).
- **Duplicate Student Entries**: Xử lý vấn đề hiển thị trùng tên học sinh trong danh sách chat bằng cách đính kèm ngữ cảnh bài học vào thông tin phiên chat.

### Changed
- **AI Training Data**: Tích hợp dữ liệu từ `tai-lieu-training.pdf` vào hệ thống RAG, giúp AI có kiến thức chuyên sâu về các lỗi phát âm phụ âm đầu phổ biến (`th`, `x`, `l`, `t`, `s`, `f`, `k`) và các phương pháp can thiệp rối loạn âm lời nói.

---
*Ghi chú: Phiên bản này tập trung vào việc ổn định trải nghiệm người dùng cuối (Học sinh) và tối ưu hóa quy trình quản lý của Giáo viên.*
