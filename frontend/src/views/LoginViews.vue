<script setup lang="ts">
import Footer from '@/components/Footer.vue'
import Header from '@/components/Header.vue'
import router from '@/router'
import { ref } from 'vue'

const email = ref('')
const password = ref('')
const serverErrors = ref()

async function login() {
  const responce = await fetch('http://213.171.27.22/login', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({
      email: email.value,
      password: password.value,
    }),
  })

  const result = await responce.json()

  if (responce.ok) {
    localStorage.setItem('token', result.token)
    localStorage.setItem('role', result.role)
    router.push('/account')
  } else {
    serverErrors.value = 'Неверный логин или пароль'
  }
}
</script>
<template>
  <div class="w-full mx-auto font-mont">
    <Header />
    <div class="max-w-[500px] p-10 rounded-2xl mx-auto border bg-[#fff]">
      <form @submit.prevent="login" class="space-y-6">
        <h1 class="text-3xl font-bold text-center mb-8 text-[#333333]">Войти в аккаунт</h1>
        <div class="space-y-2">
          <label for="email" class="block text-lg font-medium text-[#333333]">Почта</label>
          <input
            id="email"
            type="email"
            class="w-full px-4 py-3 border-1 border-[#333333] text-[#333333] rounded-xl text-lg focus:outline-none"
            v-model="email"
            required
          />
        </div>

        <div class="space-y-2">
          <label for="password" class="block text-lg font-medium text-[#333333]">Пароль</label>
          <input
            id="password"
            type="password"
            class="w-full px-4 py-3 border-1 border-[#333333] text-[#333333] rounded-xl text-lg focus:outline-none"
            v-model="password"
            required
          />
        </div>
        <div v-if="serverErrors" class="text-[#FF6B6B]">{{ serverErrors }}</div>
        <button
          type="submit"
          class="w-full bg-[#333333] text-white text-xl font-bold py-3 rounded-xl hover:bg-[#fff] border-1 border-[#333333] hover:text-[#333333] transition mt-2 cursor-pointer"
        >
          Войти
        </button>
        <p class="text-center pt-4 text-lg text-[#333333]">
          Еще нет аккаунта?
          <router-link to="/register" class="font-bold text-[#4ECDC4]">
            Зарегистрироваться
          </router-link>
        </p>
      </form>
    </div>
    <Footer />
  </div>
</template>
