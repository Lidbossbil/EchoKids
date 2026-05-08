<template>
     <div class="content-wrapper py-5">
      <!-- Bảng chữ cái + luyện đọc -->
      <div class="row g-4 mt-5">
        <!-- Cột trái -->
        <div ref="vocabularySection" class="col-lg-7">
          <div class="bg-white rounded-5 shadow-sm p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-4">
              <div>
                <h2 class="fw-bold mb-1" style="color: #0d3b66;">
                  {{ panelTitle }}
                </h2>
                <p class="text-muted mb-0">
                  {{ panelSubtitle }}
                </p>
              </div>

              <span class="badge bg-primary rounded-pill px-3 py-2">
                {{ panelCountLabel }}
              </span>
            </div>

            <div v-if="vocabLoading" class="text-center py-5 text-muted">
              Đang tải từ vựng…
            </div>

            <div v-else class="row g-3">
              <div
                class="col-lg-2 col-md-3 col-sm-4 col-4"
                v-for="item in practiceList"
                :key="item.key"
              >
                <div
                  class="alphabet-card rounded-4 text-center py-3 px-2 h-100"
                  :class="{ active: selectedLetter.key === item.key }"
                  @click="selectedLetter = item"
                >
                  <div
                    class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2 overflow-hidden"
                    style="
                      width: 55px;
                      height: 55px;
                      background: #fff3ef;
                    "
                  >
                    <img
                      v-if="item.image"
                      :src="item.image"
                      alt=""
                      class="w-100 h-100"
                      style="object-fit: cover;"
                    />
                    <h3
                      v-else
                      class="fw-bold mb-0 px-1"
                      style="color: #ff6b35; font-size: 1.15rem;"
                    >
                      {{ item.letter }}
                    </h3>
                  </div>

                  <p class="fw-bold mb-1 small" style="color: #0d3b66;">
                    {{ item.word }}
                  </p>

                  <small class="text-muted">{{ item.icon }}</small>
                </div>
              </div>
            </div>
          </div>
        </div>

<!-- Cột phải -->
<div class="col-lg-5">
  <div class="bg-white rounded-5 shadow-sm p-4 h-100 practice-panel">
    <div class="text-center mb-4 position-relative">
      <div
        class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-4 practice-letter-circle"
        style="
          width: 160px;
          height: 160px;
          background: linear-gradient(135deg, #fff1eb, #ffe4d6);
          border: 10px solid #fff3ef;
        "
      >
        <img
          v-if="selectedLetter.image"
          :src="selectedLetter.image"
          alt=""
          class="rounded-circle"
          style="width: 130px; height: 130px; object-fit: cover;"
        />
        <h1
          v-else
          class="fw-bold mb-0 practice-main-title"
          :class="{ 'practice-main-title--long': isLongMainTitle }"
          style="
            color: #ff6b35;
            font-family: 'Lobster Two', cursive;
          "
        >
          {{ selectedLetter.letter }}
        </h1>
      </div>

      <h2
        class="fw-bold mb-2 position-relative"
        style="color: #0d3b66; z-index: 2;"
      >
        {{ selectedLetter.word }}
      </h2>

      <p
        class="text-muted mb-4 position-relative"
        style="z-index: 2;"
      >
        Bé hãy nghe phát âm và đọc lại theo nhé
      </p>
    </div>

    <div class="bg-light rounded-4 p-3 mb-4 text-center practice-icon-box">
      <div style="font-size: 52px;" class="mb-2">
        <img
          v-if="selectedLetter.image"
          :src="selectedLetter.image"
          alt=""
          class="rounded-3"
          style="max-height: 120px; max-width: 100%; object-fit: contain;"
        />
        <span v-else>{{ selectedLetter.icon }}</span>
      </div>

      <h5 class="fw-bold mb-1">{{ selectedLetter.word }}</h5>

      <small class="text-muted">
        Chạm để nghe cách phát âm chuẩn
      </small>
    </div>

    <div class="d-grid gap-3 mb-4 position-relative" style="z-index: 2;">
      <button
        type="button"
        class="btn btn-warning rounded-pill py-3 fw-bold practice-btn"
        :disabled="ttsLoading"
        @click="playSampleTts"
      >
        <i class="fa fa-volume-up me-2"></i>
        Nghe mẫu
      </button>

      <button
        v-if="!isRecording && !isScoring"
        type="button"
        class="btn btn-danger rounded-pill py-3 fw-bold text-white practice-btn"
        :disabled="!selectedLetter.id || !phien_id"
        @click="startRecording"
      >
        <i class="fa fa-microphone me-2"></i>
        Ghi Âm Kiểm Tra
      </button>
      <button
        v-else-if="isRecording"
        type="button"
        class="btn btn-danger rounded-pill py-3 fw-bold text-white practice-btn recording-pulse"
        @click="stopRecording"
      >
        <i class="fa fa-stop-circle me-2"></i>
        Dừng Ghi Âm
      </button>
      <button
        v-else
        type="button"
        class="btn btn-secondary rounded-pill py-3 fw-bold text-white practice-btn"
        disabled
      >
        <span class="spinner-border spinner-border-sm me-2" role="status"></span>
        Đang chấm điểm...
      </button>
    </div>

    <div class="bg-light rounded-4 p-4 mb-4 position-relative" style="z-index: 2;">
      <!-- Chưa có kết quả -->
      <div v-if="!scoringResult && !isScoring" class="text-center text-muted py-2">
        <i class="fa fa-microphone-slash fa-2x mb-2 d-block" style="color: #ccc;"></i>
        <small>Nhấn "Ghi Âm Kiểm Tra" để AI chấm điểm phát âm của bé</small>
      </div>

      <!-- Đang chấm điểm -->
      <div v-else-if="isScoring" class="text-center py-2">
        <div class="spinner-border text-success mb-2" role="status"></div>
        <p class="text-muted mb-0 small">Đang chấm điểm...</p>
      </div>

      <!-- Có kết quả -->
      <template v-else-if="scoringResult">
        <div class="d-flex justify-content-between align-items-center mb-2">
          <span class="fw-bold">Điểm AI</span>
          <span class="fw-bold" :style="{ color: scoreColor }">{{ scoringResult.diem }} / 100</span>
        </div>

        <div class="progress rounded-pill mb-3 ai-progress" style="height: 10px;">
          <div
            class="progress-bar rounded-pill"
            role="progressbar"
            :style="{
              width: scoringResult.diem + '%',
              background: 'linear-gradient(135deg, ' + scoreColor + ', ' + scoreColor + 'aa)',
            }"
          ></div>
        </div>

        <!-- So sánh nhận diện -->
        <div class="rounded-3 px-3 py-2 mb-3 small" style="background:#f8f9fa; border:1px solid #e9ecef;">
          <div class="d-flex justify-content-between align-items-center mb-1">
            <span class="text-muted">Từ chuẩn:</span>
            <span class="fw-bold" style="color:#0d3b66;">{{ scoringResult.tu_chuan }}</span>
          </div>
          <div class="d-flex justify-content-between align-items-center">
            <span class="text-muted">AI nghe thấy:</span>
            <span
              class="fw-bold"
              :style="{ color: scoringResult.van_ban_nhan_dien === scoringResult.tu_chuan ? '#20c997' : '#dc3545' }"
            >
              {{ scoringResult.van_ban_nhan_dien || '(không nghe được)' }}
            </span>
          </div>
        </div>

        <!-- Nhãn lỗi -->
        <div
          v-if="scoringResult.loi_am_dau || scoringResult.loi_van || scoringResult.loi_thanh_dieu"
          class="d-flex flex-wrap gap-2 mb-3"
        >
          <span v-if="scoringResult.loi_am_dau" class="badge bg-danger">Sai âm đầu</span>
          <span v-if="scoringResult.loi_van" class="badge" style="background:#fd7e14;">Sai vần</span>
          <span v-if="scoringResult.loi_thanh_dieu" class="badge bg-warning text-dark">Sai thanh điệu</span>
        </div>
        <div v-else class="d-flex flex-wrap gap-2 mb-3">
          <span class="badge bg-success">Phát âm chuẩn</span>
        </div>

        <div
          class="rounded-4 p-3 ai-result-box"
          :style="{ background: scoringResult.diem >= 70 ? '#eefbf5' : '#fff3f3' }"
        >
          <div class="d-flex align-items-center gap-2 mb-2">
            <i
              :class="scoringResult.diem >= 70
                ? 'fa fa-check-circle text-success'
                : 'fa fa-times-circle text-danger'"
            ></i>
            <p
              :class="scoringResult.diem >= 70 ? 'text-success fw-bold mb-0' : 'text-danger fw-bold mb-0'"
            >
              {{ feedbackTitle }}
            </p>
          </div>
          <small class="text-muted">{{ feedbackText }}</small>
        </div>

        <!-- Nghe lại ghi âm -->
        <button
          v-if="recordingBlobUrl"
          type="button"
          class="btn btn-outline-secondary rounded-pill mt-3 w-100 fw-bold"
          @click="playRecording"
        >
          <i class="fa fa-play-circle me-2"></i>
          Nghe Lại Ghi Âm
        </button>

        <button
          type="button"
          class="btn btn-outline-danger rounded-pill mt-2 w-100 fw-bold"
          @click="retryRecording"
        >
          <i class="fa fa-redo me-2"></i>
          Thử Lại
        </button>
      </template>
    </div>

    <button class="btn btn-primary rounded-pill py-3 fw-bold w-100 test-btn">
      <i class="fa fa-file-alt me-2"></i>
      Làm Bài Kiểm Tra
    </button>
  </div>
</div>
      </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            ttsLoading: false,
            vocabLoading: false,
            lessonFetchDone: false,
            tuVungList: [],
            baiHocDetail: null,
            phien_id: null,

            selectedLetter: {},

            alphabetList: [],

            isRecording: false,
            isScoring: false,
            scoringResult: null,
            recordingBlobUrl: null,
        };
    },

    computed: {
        alphabetPracticeList() {
            return this.alphabetList.map((a) => ({
                key: `a-${a.letter}`,
                letter: a.letter,
                word: a.word,
                icon: a.icon,
                image: null,
            }));
        },
        practiceList() {
            if (!this.$route.params.id) {
                return this.alphabetPracticeList;
            }
            if (!this.lessonFetchDone) {
                return [];
            }
            if (this.tuVungList.length > 0) {
                return this.tuVungList.map((tv) => ({
                    key: `v-${tv.id}`,
                    id: tv.id,
                    letter: tv.tu_chuan,
                    word: tv.tu_chuan,
                    icon: "✨",
                    image: tv.hinh_anh_url || null,
                }));
            }
            return this.alphabetPracticeList;
        },
        panelTitle() {
            return this.tuVungList.length > 0 ? "Danh sách từ vựng" : "Danh Sách Chữ Cái";
        },
        panelSubtitle() {
            if (this.tuVungList.length > 0 && this.baiHocDetail?.tieu_de) {
                return this.baiHocDetail.tieu_de;
            }
            return "Chọn chữ cái để nghe phát âm và luyện đọc";
        },
        panelCountLabel() {
            if (this.vocabLoading || !this.lessonFetchDone) {
                return "…";
            }
            const n = this.practiceList.length;
            return this.tuVungList.length > 0 ? `${n} từ` : `${n} Chữ`;
        },
        isLongMainTitle() {
            return String(this.selectedLetter.letter || "").length > 10;
        },
        scoreColor() {
            if (!this.scoringResult) return '#20c997';
            const d = this.scoringResult.diem;
            if (d >= 80) return '#20c997';
            if (d >= 60) return '#fd7e14';
            return '#dc3545';
        },
        feedbackTitle() {
            if (!this.scoringResult) return '';
            const d = this.scoringResult.diem;
            if (d >= 90) return 'Tuyệt vời!';
            if (d >= 70) return 'Gần Đúng!';
            if (d >= 50) return 'Cố lên nào!';
            return 'Thử lại nhé!';
        },
        feedbackText() {
            if (!this.scoringResult) return '';
            const d = this.scoringResult.diem;
            if (d >= 90) return 'Bé phát âm rất chuẩn rồi! Tuyệt vời!';
            if (d >= 70) return 'Bé phát âm khá tốt, thử lại để đạt điểm cao hơn nhé!';
            if (d >= 50) return 'Bé đọc thêm vài lần sẽ tiến bộ hơn thôi!';
            return 'Bé hãy nghe mẫu trước rồi đọc theo thật chậm nhé!';
        },
    },

    mounted() {
        this.loadBaiHocTuVung();
    },

    watch: {
        "$route.params.id"() {
            try { this.endSession(); } catch (e) {}
            this.lessonFetchDone = false;
            this.tuVungList = [];
            this.baiHocDetail = null;
            this.loadBaiHocTuVung();
        },
        "$route.query.tu_vung_id"() {
            this.$nextTick(() => {
                this.applyTargetVocabulary();
            });
        },
        selectedLetter() {
            this.scoringResult = null;
            if (this.recordingBlobUrl) {
                URL.revokeObjectURL(this.recordingBlobUrl);
                this.recordingBlobUrl = null;
            }
            if (this.isRecording) {
                this.isRecording = false;
                if (this._mediaRecorder && this._mediaRecorder.state !== 'inactive') {
                    this._mediaRecorder.stop();
                }
                if (this._recordingTimer) {
                    clearTimeout(this._recordingTimer);
                    this._recordingTimer = null;
                }
            }
        },
    },

    beforeUnmount() {
        this.stopTtsSample();
        if (this._mediaRecorder && this._mediaRecorder.state !== 'inactive') {
            this._mediaRecorder.stop();
        }
        if (this._recordingTimer) {
            clearTimeout(this._recordingTimer);
        }
        if (this.recordingBlobUrl) {
            URL.revokeObjectURL(this.recordingBlobUrl);
        }
        localStorage.removeItem("active_lesson_chat_context");
        window.dispatchEvent(new CustomEvent("active-lesson-chat-updated"));
    },

    beforeRouteLeave(to, from, next) {
        localStorage.removeItem("active_lesson_chat_context");
        window.dispatchEvent(new CustomEvent("active-lesson-chat-updated"));
        next();
    },

    methods: {
        loadBaiHocTuVung() {
            const id = this.$route.params.id;
            if (!id) {
                this.lessonFetchDone = true;
                return;
            }
            this.vocabLoading = true;
            axios
                .get(`http://127.0.0.1:8000/api/bai-hoc/${id}`)
                .then((res) => {
                    const d = res.data?.data;
                    if (!d) {
                        this.tuVungList = [];
                        this.baiHocDetail = null;
                        localStorage.removeItem("active_lesson_chat_context");
                    } else {
                        this.baiHocDetail = {
                            id: d.id,
                            tieu_de: d.tieu_de,
                            mo_ta: d.mo_ta,
                            nguoi_tao_id: d.nguoi_tao_id || d.giao_vien?.id || null,
                            giao_vien: d.giao_vien || null,
                        };
                        this.tuVungList = Array.isArray(d.tu_vungs) ? d.tu_vungs : [];
                        localStorage.setItem(
                            "active_lesson_chat_context",
                            JSON.stringify({
                                lesson_id: d.id,
                                lesson_title: d.tieu_de || "",
                                teacher_id: d.nguoi_tao_id || d.giao_vien?.id || null,
                                teacher_name: d.giao_vien?.ho_ten || "Giáo viên",
                            })
                        );
                        window.dispatchEvent(new CustomEvent("active-lesson-chat-updated"));
                    }
                })
                .catch((e) => {
                    console.error(e);
                    this.tuVungList = [];
                    this.baiHocDetail = null;
                    localStorage.removeItem("active_lesson_chat_context");
                })
                .finally(() => {
                    this.lessonFetchDone = true;
                    this.vocabLoading = false;
                    this.$nextTick(() => {
                        const first = this.practiceList[0];
                        if (first) {
                            this.selectedLetter = { ...first };
                        }
                        this.applyTargetVocabulary();
                    });

                    // Tạo phiên luyện tập khi load bài xong
                    this.startSession();
                });
        },

        applyTargetVocabulary() {
            const tuVungId = Number(this.$route.query.tu_vung_id || 0);
            if (!tuVungId || this.practiceList.length === 0) {
                return;
            }

            const matchedItem = this.practiceList.find((item) => Number(item.id || 0) === tuVungId);
            if (!matchedItem) {
                return;
            }

            this.selectedLetter = { ...matchedItem };

            if (this.$route.query.section === "tu-vung" && this.$refs.vocabularySection) {
                this.$refs.vocabularySection.scrollIntoView({
                    behavior: "smooth",
                    block: "start",
                });
            }
        },

        stopTtsSample() {
            if (this._ttsAudio) {
                this._ttsAudio.pause();
                this._ttsAudio.src = "";
                this._ttsAudio = null;
            }
            if (this._ttsBlobUrl) {
                URL.revokeObjectURL(this._ttsBlobUrl);
                this._ttsBlobUrl = null;
            }
        },

        startSession() {
            const id = this.$route.params.id;
            if (!id) return;
            if (this.phien_id) return; // đã có phiên
            const token = localStorage.getItem("token_nguoi_dung");
            if (!token) return; // chưa đăng nhập

            axios.post('http://127.0.0.1:8000/api/phien-luyen-taps/start', { bai_hoc_id: id }, {
                headers: {
                    Authorization: 'Bearer ' + token
                }
            })
            .then((res) => {
                if (res.data.status) {
                    this.phien_id = res.data.data.phien_id;
                    localStorage.setItem('last_phien_id', String(this.phien_id));
                }
            })
            .catch((e) => {
                console.error('startSession error', e);
            });
        },

        endSession() {
            if (!this.phien_id) return;
            const token = localStorage.getItem("token_nguoi_dung");
            if (!token) { this.phien_id = null; return; }

            axios.post('http://127.0.0.1:8000/api/phien-luyen-taps/end', { phien_id: this.phien_id }, {
                headers: {
                    Authorization: 'Bearer ' + token
                }
            })
            .then(() => {
                this.phien_id = null;
            })
            .catch((e) => {
                console.error('endSession error', e);
                this.phien_id = null;
            });
        },

        async startRecording() {
            if (!this.selectedLetter.id) {
                alert('Vui lòng chọn một từ vựng để luyện tập!');
                return;
            }
            if (!this.phien_id) {
                alert('Chưa có phiên luyện tập. Vui lòng thử lại sau!');
                return;
            }
            try {
                const stream = await navigator.mediaDevices.getUserMedia({ audio: true });
                this._audioChunks = [];
                const mimeType = MediaRecorder.isTypeSupported('audio/webm') ? 'audio/webm' : '';
                this._mediaRecorder = new MediaRecorder(stream, mimeType ? { mimeType } : {});
                this._mediaRecorder.ondataavailable = (e) => {
                    if (e.data.size > 0) this._audioChunks.push(e.data);
                };
                this._mediaRecorder.onstop = () => {
                    stream.getTracks().forEach((t) => t.stop());
                    const blob = new Blob(this._audioChunks, {
                        type: this._mediaRecorder.mimeType || 'audio/webm',
                    });
                    this.submitAudio(blob);
                };
                this._mediaRecorder.start();
                this.isRecording = true;
                this.scoringResult = null;
                this._recordingTimer = setTimeout(() => {
                    if (this.isRecording) this.stopRecording();
                }, 10000);
            } catch (e) {
                console.error('startRecording error', e);
                alert('Không thể truy cập microphone. Vui lòng kiểm tra quyền truy cập!');
            }
        },

        stopRecording() {
            if (this._recordingTimer) {
                clearTimeout(this._recordingTimer);
                this._recordingTimer = null;
            }
            if (this._mediaRecorder && this._mediaRecorder.state !== 'inactive') {
                this._mediaRecorder.stop();
            }
            this.isRecording = false;
            this.isScoring = true;
        },

        async submitAudio(blob) {
            const token = localStorage.getItem('token_nguoi_dung');
            if (!token || !this.phien_id || !this.selectedLetter.id) {
                this.isScoring = false;
                return;
            }
            if (this.recordingBlobUrl) {
                URL.revokeObjectURL(this.recordingBlobUrl);
            }
            this.recordingBlobUrl = URL.createObjectURL(blob);
            const ext = blob.type.includes('ogg') ? 'ogg' : 'webm';
            const formData = new FormData();
            formData.append('audio', blob, `recording.${ext}`);
            formData.append('phien_id', this.phien_id);
            formData.append('tu_vung_id', this.selectedLetter.id);
            try {
                const res = await axios.post(
                    'http://127.0.0.1:8000/api/cham-diem-phat-am',
                    formData,
                    {
                        headers: {
                            Authorization: 'Bearer ' + token,
                            'Content-Type': 'multipart/form-data',
                        },
                    }
                );
                this.scoringResult = res.data;
            } catch (e) {
                console.error('submitAudio error', e);
                alert('Có lỗi xảy ra khi chấm điểm. Vui lòng thử lại!');
            } finally {
                this.isScoring = false;
            }
        },

        retryRecording() {
            this.scoringResult = null;
        },

        playRecording() {
            if (!this.recordingBlobUrl) return;
            if (this._recordingAudio) {
                this._recordingAudio.pause();
                this._recordingAudio.currentTime = 0;
            }
            this._recordingAudio = new Audio(this.recordingBlobUrl);
            this._recordingAudio.play();
        },

        playSampleTts() {
            const text = String(this.selectedLetter.word || "").trim();
            if (!text || this.ttsLoading) {
                return;
            }
            this.ttsLoading = true;
            this.stopTtsSample();

            axios
                .get(`http://127.0.0.1:8000/api/tts-vi`, {
                    params: { t: text },
                    responseType: "blob",
                })
                .then((res) => {
                    const blobUrl = URL.createObjectURL(res.data);
                    this._ttsBlobUrl = blobUrl;
                    const audio = new Audio(blobUrl);
                    this._ttsAudio = audio;
                    audio.onended = () => this.stopTtsSample();
                    audio.onerror = () => this.stopTtsSample();
                    audio.play();
                })
                .catch((e) => {
                    console.error(e);
                    this.stopTtsSample();
                })
                .finally(() => {
                    this.ttsLoading = false;
                });
        },
    },
};
</script>

<style scoped>
.start-btn {
  background: linear-gradient(135deg, #ff6b35, #ff8c42);
  transition: all 0.3s ease;
}

.start-btn:hover {
  transform: translateY(-3px);
  box-shadow: 0 12px 25px rgba(255, 107, 53, 0.25);
}

.alphabet-card {
  background: #fff;
  border: 2px solid #f5f5f5;
  cursor: pointer;
  transition: all 0.3s ease;
}

.alphabet-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 15px 30px rgba(0, 0, 0, 0.08);
}

.alphabet-card.active {
  border: 2px solid #ff6b35;
  background: #fff7f2;
  transform: translateY(-4px);
}

.start-btn {
  background: linear-gradient(135deg, #ff6b35, #ff8c42);
  transition: all 0.3s ease;
}

.start-btn:hover {
  transform: translateY(-3px);
  box-shadow: 0 12px 25px rgba(255, 107, 53, 0.25);
}

.alphabet-card {
  background: #fff;
  border: 2px solid #f5f5f5;
  cursor: pointer;
  transition: all 0.3s ease;
}

.alphabet-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 15px 30px rgba(0, 0, 0, 0.08);
}

.alphabet-card.active {
  border: 2px solid #ff6b35;
  background: #fff7f2;
  transform: translateY(-4px);
}

.practice-panel {
  position: sticky;
  top: 30px;
  overflow: hidden;
}

.practice-panel::before {
  content: "";
  position: absolute;
  width: 220px;
  height: 220px;
  background: rgba(255, 107, 53, 0.08);
  border-radius: 50%;
  top: -80px;
  right: -80px;
}

.practice-panel::after {
  content: "";
  position: absolute;
  width: 180px;
  height: 180px;
  background: rgba(77, 150, 255, 0.08);
  border-radius: 50%;
  bottom: -60px;
  left: -60px;
}

.practice-letter-circle {
  position: relative;
  z-index: 2;
  animation: floatCircle 3s ease-in-out infinite;
  box-shadow: 0 20px 40px rgba(255, 107, 53, 0.15);
}

/* .practice-main-title {
  font-size: 80px;
}

.practice-main-title--long {
  font-size: 1.65rem;
  line-height: 1.25;
  font-family: inherit !important;
  max-width: 100%;
  padding: 0 0.5rem;
} */

.practice-icon-box {
  transition: all 0.3s ease;
  border: 2px dashed #ffe1d6;
  position: relative;
  z-index: 2;
}

.practice-icon-box:hover {
  transform: translateY(-5px);
  background: #fff7f2 !important;
}

.practice-btn {
  transition: all 0.3s ease;
  position: relative;
  overflow: hidden;
}

.practice-btn:hover {
  transform: translateY(-3px);
}

.practice-btn::before {
  content: "";
  position: absolute;
  top: 0;
  left: -120%;
  width: 100%;
  height: 100%;
  background: rgba(255,255,255,0.2);
  transform: skewX(-20deg);
  transition: 0.5s;
}

.practice-btn:hover::before {
  left: 120%;
}

.ai-result-box {
  border: 2px dashed #d9f8ea;
  transition: all 0.3s ease;
  position: relative;
  z-index: 2;
}

.ai-result-box:hover {
  transform: translateY(-4px);
  box-shadow: 0 12px 24px rgba(32, 201, 151, 0.12);
}

.ai-progress {
  overflow: hidden;
}

.ai-progress .progress-bar {
  animation: progressMove 2s ease;
}

.test-btn {
  position: relative;
  z-index: 2;
  transition: all 0.3s ease;
}

.test-btn:hover {
  transform: translateY(-4px);
  box-shadow: 0 14px 28px rgba(13, 110, 253, 0.2);
}

@keyframes floatCircle {
  0% {
    transform: translateY(0px);
  }
  50% {
    transform: translateY(-8px);
  }
  100% {
    transform: translateY(0px);
  }
}

@keyframes progressMove {
  from {
    width: 0;
  }
}

@keyframes recordingPulse {
  0% { box-shadow: 0 0 0 0 rgba(220, 53, 69, 0.5); }
  70% { box-shadow: 0 0 0 12px rgba(220, 53, 69, 0); }
  100% { box-shadow: 0 0 0 0 rgba(220, 53, 69, 0); }
}

.recording-pulse {
  animation: recordingPulse 1.4s ease-in-out infinite;
}
</style>
