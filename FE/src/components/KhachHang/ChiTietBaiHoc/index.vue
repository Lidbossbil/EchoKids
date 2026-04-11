<template>
  <div class="content-wrapper py-5">
   <!-- Bảng chữ cái + luyện đọc -->
   <div class="row g-4 mt-5">
     <!-- Cột trái -->
     <div class="col-lg-7">
       <div class="bg-white rounded-5 shadow-sm p-4 h-100">
         <div class="d-flex justify-content-between align-items-center mb-4">
           <div>
             <h2 class="fw-bold mb-1" style="color: #0d3b66;">
               Danh Sách Chữ Cái
             </h2>
             <p class="text-muted mb-0">
               Chọn chữ cái để nghe phát âm và luyện đọc
             </p>
           </div>

           <span class="badge bg-primary rounded-pill px-3 py-2">
             {{ alphabetList.length }} Chữ
           </span>
         </div>

         <div class="row g-3">
           <div
             class="col-lg-2 col-md-3 col-sm-4 col-4"
             v-for="item in alphabetList"
             :key="itemKey(item)"
           >
             <div
               class="alphabet-card rounded-4 text-center py-3 px-2 h-100"
               :class="{ active: itemKey(selectedLetter) === itemKey(item) }"
               @click="selectedLetter = item"
             >
               <div
                 class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2"
                 style="
                   width: 55px;
                   height: 55px;
                   background: #fff3ef;
                 "
               >
                 <h3 class="fw-bold mb-0" style="color: #ff6b35;">
                   {{ item.letter }}
                 </h3>
               </div>

               <p class="fw-bold mb-1" style="color: #0d3b66;">
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
     <h1
       class="fw-bold mb-0"
       style="
         font-size: 80px;
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
     {{ selectedLetter.icon }}
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
     @click="ngheAmMau"
   >
     <i class="fa fa-volume-up me-2"></i>
     Nghe "{{ selectedLetter.letter }}"
   </button>

   <button class="btn btn-danger rounded-pill py-3 fw-bold text-white practice-btn">
     <i class="fa fa-microphone me-2"></i>
     Ghi Âm Kiểm Tra
   </button>
 </div>

 <div class="bg-light rounded-4 p-4 mb-4 position-relative" style="z-index: 2;">
   <div class="d-flex justify-content-between align-items-center mb-2">
     <span class="fw-bold">Điểm AI</span>
     <span class="fw-bold" style="color: #20c997;">8.5 / 10</span>
   </div>

   <div
     class="progress rounded-pill mb-3 ai-progress"
     style="height: 10px;"
   >
     <div
       class="progress-bar rounded-pill"
       role="progressbar"
       style="
         width: 85%;
         background: linear-gradient(135deg, #20c997, #4dd4ac);
       "
     ></div>
   </div>

   <div
     class="rounded-4 p-3 ai-result-box"
     style="background: #eefbf5;"
   >
     <div class="d-flex align-items-center gap-2 mb-2">
       <i class="fa fa-check-circle text-success"></i>
       <p class="text-success fw-bold mb-0">
         Gần Đúng
       </p>
     </div>

     <small class="text-muted">
       Bé phát âm khá tốt, hãy đọc to và rõ hơn ở cuối âm.
     </small>
   </div>
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
import axios from 'axios';

const ICON_PRESETS = [
"🍚", "🍜", "🎵", "🐄", "🐟", "🐐", "💡", "👧", "🐸", "🐔", "🌸", "🖨️",
"🍦", "🍃", "🐱", "🦌", "🐝", "☂️", "🌶️", "🍜", "🍎", "🧺", "📚", "🥤",
"⭐", "🐘", "🚗", "❤️", "📖", "🎯",
];

const STATIC_ALPHABET = [
{ letter: "A", word: "Na", icon: "🍚" },
{ letter: "Ă", word: "Ăn", icon: "🍜" },
{ letter: "Â", word: "Âm", icon: "🎵" },
{ letter: "B", word: "Bò", icon: "🐄" },
{ letter: "C", word: "Cá", icon: "🐟" },
{ letter: "D", word: "Dê", icon: "🐐" },
{ letter: "Đ", word: "Đèn", icon: "💡" },
{ letter: "E", word: "Em", icon: "👧" },
{ letter: "Ê", word: "Ếch", icon: "🐸" },
{ letter: "G", word: "Gà", icon: "🐔" },
{ letter: "H", word: "Hoa", icon: "🌸" },
{ letter: "I", word: "In", icon: "🖨️" },
{ letter: "K", word: "Kem", icon: "🍦" },
{ letter: "L", word: "Lá", icon: "🍃" },
{ letter: "M", word: "Mèo", icon: "🐱" },
{ letter: "N", word: "Nai", icon: "🦌" },
{ letter: "O", word: "Ong", icon: "🐝" },
{ letter: "Ô", word: "Ô", icon: "☂️" },
{ letter: "Ơ", word: "Ớt", icon: "🌶️" },
{ letter: "P", word: "Phở", icon: "🍜" },
{ letter: "Q", word: "Quả", icon: "🍎" },
{ letter: "R", word: "Rổ", icon: "🧺" },
{ letter: "S", word: "Sách", icon: "📚" },
{ letter: "T", word: "Táo", icon: "🍎" },
{ letter: "U", word: "Uống", icon: "🥤" },
{ letter: "Ư", word: "Ước", icon: "⭐" },
{ letter: "V", word: "Voi", icon: "🐘" },
{ letter: "X", word: "Xe", icon: "🚗" },
{ letter: "Y", word: "Yêu", icon: "❤️" },
];

function firstGrapheme(str) {
const s = String(str || "").trim();
if (!s) {
 return "?";
}
const arr = [...s];
return arr[0] || "?";
}

export default {
 name: 'AlphabetLessonPage',

 data() {
     return {
         selectedLetter: {
             ...STATIC_ALPHABET[0],
             id: null,
             amThanhUrl: null,
         },
         alphabetList: STATIC_ALPHABET.map((x) => ({
             ...x,
             id: null,
             amThanhUrl: null,
         })),
         currentAudio: null,
     };
 },

 mounted() {
     this.loadTuVungTuBaiHoc();
 },

 watch: {
     '$route.params.id'() {
         this.loadTuVungTuBaiHoc();
     },
 },

 beforeUnmount() {
     this.dungAmThanh();
     if (typeof window !== 'undefined' && window.speechSynthesis) {
         window.speechSynthesis.cancel();
     }
 },

 methods: {
     itemKey(item) {
         if (item.id != null) {
             return `id:${item.id}`;
         }
         return `s:${item.letter}|${item.word}`;
     },

     mapTuVungRow(row, index) {
         const word = row.tu_chuan || '';
         const readText = (row.phien_am || word).trim();
         return {
             id: row.id,
             letter: firstGrapheme(word),
             word,
             icon: ICON_PRESETS[index % ICON_PRESETS.length],
             amThanhUrl: row.am_thanh_mau_url || null,
             readText,
         };
     },

     dungAmThanh() {
         if (this.currentAudio) {
             this.currentAudio.pause();
             this.currentAudio = null;
         }
     },

     pickVietnameseVoiceFromSynth(synth) {
         const voices = synth.getVoices();
         const score = (v) => {
             const lang = String(v.lang || '')
                 .toLowerCase()
                 .replace(/_/g, '-');
             const name = String(v.name || '').toLowerCase();
             if (lang === 'vi-vn') {
                 return 100;
             }
             if (lang === 'vi') {
                 return 95;
             }
             if (lang.startsWith('vi-')) {
                 return 85;
             }
             if (
                 /vietnamese|tiếng việt|tieng viet|hoai|nam minh|microsoft.*vi\b/.test(
                     name,
                 )
             ) {
                 return 75;
             }
             return 0;
         };
         const rated = voices
             .map((v) => ({ v, s: score(v) }))
             .filter((x) => x.s > 0);
         if (!rated.length) {
             return null;
         }
         rated.sort((a, b) => b.s - a.s);
         return rated[0].v;
     },

     hasVietnameseVoice() {
         if (typeof window === 'undefined' || !window.speechSynthesis) {
             return false;
         }
         return (
             this.pickVietnameseVoiceFromSynth(window.speechSynthesis) !==
             null
         );
     },

     ensureSpeechVoicesReady() {
         return new Promise((resolve) => {
             if (typeof window === 'undefined' || !window.speechSynthesis) {
                 resolve();
                 return;
             }
             const synth = window.speechSynthesis;
             if (synth.getVoices().length > 0) {
                 resolve();
                 return;
             }
             let settled = false;
             const done = () => {
                 if (settled) {
                     return;
                 }
                 settled = true;
                 synth.removeEventListener('voiceschanged', onVc);
                 if (synth.onvoiceschanged === onVc) {
                     synth.onvoiceschanged = null;
                 }
                 resolve();
             };
             const onVc = () => done();
             synth.addEventListener('voiceschanged', onVc);
             synth.onvoiceschanged = onVc;
             synth.getVoices();
             setTimeout(done, 700);
         });
     },

     tryWebSpeech(text) {
         return new Promise((resolve) => {
             const synth = window.speechSynthesis;
             if (!synth) {
                 resolve(false);
                 return;
             }
             const t = String(text || '').trim();
             if (!t) {
                 resolve(false);
                 return;
             }
             synth.cancel();
             const u = new SpeechSynthesisUtterance(t);
             const vi = this.pickVietnameseVoiceFromSynth(synth);
             u.lang = vi ? vi.lang || 'vi-VN' : 'vi-VN';
             if (vi) {
                 u.voice = vi;
             }
             u.rate = 0.92;
             u.volume = 1;
             let finished = false;
             const timer = setTimeout(() => {
                 if (!finished) {
                     finished = true;
                     synth.cancel();
                     resolve(false);
                 }
             }, 15000);
             const end = (ok) => {
                 if (finished) {
                     return;
                 }
                 finished = true;
                 clearTimeout(timer);
                 resolve(ok);
             };
             u.onend = () => end(true);
             u.onerror = () => end(false);
             synth.speak(u);
             const ua =
                 typeof navigator !== 'undefined' ? navigator.userAgent : '';
             const isChromium =
                 typeof window !== 'undefined' &&
                 (window.chrome || /Chrome|Chromium|Edg\//.test(ua));
             if (isChromium) {
                 try {
                     synth.pause();
                     synth.resume();
                 } catch (e) {
                     /* bỏ qua */
                 }
             }
         });
     },

     tryServerTts(text) {
         const t = String(text || '').trim();
         if (!t) {
             return Promise.resolve();
         }
         this.dungAmThanh();
         const url = `http://127.0.0.1:8000/api/tts-vi?t=${encodeURIComponent(t)}`;
         const audio = new Audio(url);
         this.currentAudio = audio;
         return new Promise((resolve, reject) => {
             const cleanup = () => {
                 audio.removeEventListener('ended', onEnded);
                 audio.removeEventListener('error', onErr);
             };
             const onEnded = () => {
                 cleanup();
                 resolve();
             };
             const onErr = () => {
                 cleanup();
                 this.currentAudio = null;
                 reject(new Error('tts-audio'));
             };
             audio.addEventListener('ended', onEnded);
             audio.addEventListener('error', onErr);
             audio.play().catch((e) => {
                 cleanup();
                 this.currentAudio = null;
                 reject(e);
             });
         });
     },

     docTiengViet(text) {
         const t = String(text || '').trim();
         if (!t) {
             return;
         }
         this.ensureSpeechVoicesReady()
             .then(() => this.tryServerTts(t))
             .then(() => {})
             .catch((e) => {
                 console.warn(
                     'TTS qua server không dùng được, thử giọng trình duyệt:',
                     e,
                 );
                 const synth = window.speechSynthesis;
                 if (!synth) {
                     return;
                 }
                 this.tryWebSpeech(t).then((ok) => {
                     if (!ok) {
                         console.warn(
                             'Không phát được âm mẫu: chạy backend (php artisan serve), kiểm tra mạng, hoặc cài gói Tiếng Việt (Speech) trong Windows / dùng Edge.',
                         );
                     }
                 });
             });
     },

     ngheAmMau() {
         const item = this.selectedLetter;
         const text = (item.readText || item.word || '').trim();
         this.dungAmThanh();
         if (typeof window !== 'undefined' && window.speechSynthesis) {
             window.speechSynthesis.cancel();
         }

         const url = item.amThanhUrl;
         if (url) {
             const audio = new Audio(url);
             this.currentAudio = audio;
             audio
                 .play()
                 .then(() => {})
                 .catch(() => {
                     this.currentAudio = null;
                     this.docTiengViet(text);
                 });
             return;
         }

         this.docTiengViet(text);
     },

     loadTuVungTuBaiHoc() {
         const rawId = this.$route.params.id;
         if (
             rawId === undefined ||
             rawId === null ||
             String(rawId).trim() === ''
         ) {
             this.applyStaticAlphabet();
             return;
         }

         const id = Number(rawId);
         if (!Number.isFinite(id) || id <= 0) {
             this.applyStaticAlphabet();
             return;
         }

         axios
             .get(`http://127.0.0.1:8000/api/bai-hoc/${id}`)
             .then((res) => {
                 const row = res.data?.data;
                 const list = Array.isArray(row?.tu_vungs)
                     ? row.tu_vungs
                     : [];
                 if (list.length === 0) {
                     this.applyStaticAlphabet();
                     return;
                 }
                 const mapped = list.map((tv, i) =>
                     this.mapTuVungRow(tv, i),
                 );
                 this.alphabetList = mapped;
                 this.selectedLetter = mapped[0];
             })
             .catch((err) => {
                 console.error(err);
                 this.applyStaticAlphabet();
             });
     },

     applyStaticAlphabet() {
         this.alphabetList = STATIC_ALPHABET.map((x) => ({
             ...x,
             id: null,
             amThanhUrl: null,
             readText: x.word,
         }));
         this.selectedLetter = { ...this.alphabetList[0] };
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
</style>
