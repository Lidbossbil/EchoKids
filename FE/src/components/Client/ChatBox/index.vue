<template>
  <div class="position-fixed bottom-0 end-0 m-4" style="z-index: 9999;">

    <transition name="chat-window">
      <div v-if="isOpen" class="card shadow-lg border-0 mb-3"
        style="width: 380px; height: 520px; border-radius: 1.25rem; overflow: hidden; background-color: #fff; transform-origin: bottom right;">

        <div class="card-header d-flex justify-content-between align-items-center py-3 border-0 text-white"
          style="background: linear-gradient(135deg, #ff7b54, #fe5d37);">
          <h6 class="mb-0 fw-bold text-light">EchoKids</h6>
          <div class="d-flex align-items-center gap-2">
            <button @click="toggleChat"
              class="btn btn-sm btn-light rounded-circle d-flex align-items-center justify-content-center hover-scale"
              style="width: 30px; height: 30px;">
              ✕
            </button>
          </div>
        </div>

        <div class="card-body overflow-auto d-flex flex-column gap-3 p-3" ref="chatBody"
          style="background-color: #fffaf9; scroll-behavior: smooth;">

          <div v-for="(msg, index) in messages" :key="index" class="d-flex message-pop"
            :class="msg.role === 'user' ? 'justify-content-end' : 'justify-content-start'">

            <div v-if="msg.role === 'ai'" class="px-3 py-2 shadow-sm text-dark"
              style="max-width: 82%; font-size: 0.95rem; line-height: 1.4; border-radius: 18px 18px 18px 0; background-color: #ffffff; border: 1px solid #ffe0d9;">
              {{ msg.text }}

              <a v-if="msg.action_url" href="#" @click.prevent="navigateToAction(msg.action_url)"
                class="d-inline-block mt-2 px-2 py-1 bg-light text-primary rounded text-decoration-none fw-medium"
                style="font-size: 0.85rem; border: 1px solid #d4e4ff;">
                👉 {{ msg.action_label }}
              </a>
            </div>

            <div v-else class="px-3 py-2 shadow-sm text-white"
              style="max-width: 82%; font-size: 0.95rem; line-height: 1.4; border-radius: 18px 18px 0 18px; background: linear-gradient(135deg, #ff8c6b, #fe5d37);">
              {{ msg.text }}
            </div>

          </div>

          <div v-if="isTyping" class="d-flex justify-content-start typing-indicator">
            <div class="px-3 py-2 shadow-sm fst-italic text-muted small"
              style="border-radius: 18px 18px 18px 0; background-color: #ffffff; border: 1px solid #ffe0d9;">
              Cô Họa Mi đang gõ<span class="dots">...</span>
            </div>
          </div>
        </div>

        <div class="card-footer p-3 bg-white border-top">
          <div class="input-group align-items-center">

            <input type="text" v-model="userInput" @keyup.enter="sendMessage" :disabled="isTyping"
              class="form-control rounded-pill me-2 shadow-sm" placeholder="Bé hỏi cô đi..."
              style="border-color: #e0e0e0; padding: 10px 15px;" />

            <button @click="toggleRecording"
              class="btn btn-outline-secondary rounded-circle d-flex align-items-center justify-content-center shadow-sm hover-scale"
              :class="{ 'recording-pulse text-danger border-danger': isRecording }" style="width: 48px; height: 48px;">
              <i class="fa-solid fa-microphone fa-lg"></i>
            </button>

            <button @click="sendMessage" :disabled="!userInput.trim() || isTyping"
              class="btn rounded-circle d-flex align-items-center justify-content-center shadow-sm ms-2"
              style="width: 48px; height: 48px; background: #fe5d37; border: none; opacity: 1;">
              <i class="fa-solid fa-paper-plane text-white"></i>
            </button>
          </div>

          <transition name="fade">
            <small v-if="isRecording" class="text-danger d-block mt-2 text-center fw-medium">
              Con nói đi, cô đang nghe nè... (nói xong ấn mic lần nữa để gửi)
            </small>
          </transition>
        </div>
      </div>
    </transition>

    <div class="d-flex justify-content-end">
      <button @click="toggleChat"
        class="btn shadow-lg rounded-circle d-flex align-items-center justify-content-center fab-button hover-scale"
        style="width: 68px; height: 68px; background: #fe5d37; border: none;">

        <i v-if="isOpen" class="fa-solid fa-xmark text-white fs-3"></i>

        <svg v-else xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 24 24" fill="none"
          stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
          <path
            d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z">
          </path>
          <circle cx="8" cy="12" r="1.5" fill="white" stroke="none"></circle>
          <circle cx="12" cy="12" r="1.5" fill="white" stroke="none"></circle>
          <circle cx="16" cy="12" r="1.5" fill="white" stroke="none"></circle>
        </svg>

      </button>
    </div>

  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      isOpen: false, // Mặc định luôn đóng khi vào trang
      isRecording: false,
      isTyping: false,
      userInput: '',
      messages: [
        { role: 'ai', text: 'Chào con! Cô là Họa Mi, hôm nay con muốn tập phát âm gì nào? 🌸' }
      ]
    };
  },
  watch: {
    isOpen(val) {
      // Khi mở chat thì cuộn xuống dưới cùng
      if (val) {
        this.scrollToBottom();
      }
    }
  },
  methods: {
    toggleChat() {
      // Mở nếu đang đóng, đóng nếu đang mở
      this.isOpen = !this.isOpen;
    },
    toggleRecording() {
      this.isRecording = !this.isRecording;
    },
    scrollToBottom() {
      this.$nextTick(() => {
        const chatBody = this.$refs.chatBody;
        if (chatBody) {
          chatBody.scrollTop = chatBody.scrollHeight;
        }
      });
    },
    navigateToAction(url) {
      this.$router.push(url);
    },
    sendMessage() {
      const text = this.userInput.trim();
      if (!text || this.isTyping) return;

      this.messages.push({ role: 'user', text: text });
      this.userInput = '';
      this.isTyping = true;
      this.scrollToBottom();

      axios.post("http://127.0.0.1:8000/api/chat/system",
        { message: text },
        {
          headers: {
            Authorization: "Bearer " + localStorage.getItem("token_khach_hang")
          }
        }
      )
        .then((res) => {
          const data = res?.data || {};
          const actionUrl = data.action_url || null;
          const actionLabel = actionUrl ? (data.action_label || 'tại đây') : null;

          this.messages.push({
            role: 'ai',
            text: data.message || 'Con ơi, cô chưa nghe rõ câu hỏi. Con thử nhập lại nhé 🌸',
            action_url: actionUrl,
            action_label: actionLabel
          });
        })
        .catch((err) => {
          console.error("Lỗi khi gọi AI:", err);
          this.messages.push({
            role: 'ai',
            text: 'Ôi, mạng của cô Họa Mi đang bị chậm một chút. Con thử lại xíu nữa nhé! 😥'
          });
        })
        .finally(() => {
          this.isTyping = false;
          this.scrollToBottom();
        });
    }
  }
};
</script>

<style scoped>
/* Không thể dùng inline CSS cho :hover, @keyframes, và Vue <transition> classes. 
   Nên những thành phần chuyển động (animation/hover) bắt buộc phải để ở đây. */

.hover-scale {
  transition: transform 0.2s, box-shadow 0.2s;
}

.hover-scale:hover {
  transform: scale(1.1);
  box-shadow: 0 4px 15px rgba(254, 93, 55, 0.3);
}

.recording-pulse {
  animation: pulse-red 1.5s infinite;
}

@keyframes pulse-red {
  0% {
    box-shadow: 0 0 0 0 rgba(220, 53, 69, 0.7);
  }

  70% {
    box-shadow: 0 0 0 10px rgba(220, 53, 69, 0);
  }

  100% {
    box-shadow: 0 0 0 0 rgba(220, 53, 69, 0);
  }
}

.message-pop {
  animation: popIn 0.4s forwards;
}

@keyframes popIn {
  from {
    opacity: 0;
    transform: translateY(10px);
  }

  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.typing-indicator {
  animation: breathe 2s infinite;
}

@keyframes breathe {

  0%,
  100% {
    opacity: 0.6;
  }

  50% {
    opacity: 1;
  }
}

.fab-button {
  animation: bounceIn 0.5s;
}

@keyframes bounceIn {
  0% {
    transform: scale(0);
  }

  100% {
    transform: scale(1);
  }
}

.chat-window-enter-active {
  transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.chat-window-leave-active {
  transition: all 0.3s;
}

.chat-window-enter-from,
.chat-window-leave-to {
  opacity: 0;
  transform: scale(0.5) translateY(50px);
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>