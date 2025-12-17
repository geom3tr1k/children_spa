<script setup lang="ts">
import Footer from '@/components/Footer.vue'
import Header from '@/components/Header.vue'
import router from '@/router'
import { ref } from 'vue'

const lastName = ref('')
const firstName = ref('')
const email = ref('')
const password = ref('')
const resentPassword = ref('')
const avatar = ref<File | null>(null)
const erorrs = ref<{
  password?: string
}>({})
const serverErrors = ref()

function validate() {
  erorrs.value = {}
  serverErrors.value = null

  if (password.value !== resentPassword.value) {
    erorrs.value.password = 'Пароли не совпадают'
  }

  return Object.keys(erorrs.value).length === 0
}

function fileChange(event: Event) {
  const target = event.target as HTMLInputElement
  if (target.files && target.files[0]) {
    avatar.value = target.files[0]
  }
}

async function register() {
  if (!validate()) return
  const formData = new FormData()
  formData.append('email', email.value)
  formData.append('password', password.value)
  formData.append('lastName', lastName.value)
  formData.append('firstName', firstName.value)
  if (avatar.value) {
    formData.append('avatar', avatar.value)
  }
  const responce = await fetch('http://127.0.0.1:8000/reg', {
    method: 'POST',
    body: formData,
  })

  const result = await responce.json()

  if (responce.ok) {
    localStorage.setItem('token', result.token)
    localStorage.setItem('role', result.role)
    router.push('/account')
  } else {
    serverErrors.value = 'Данная почта уже используются'
  }
}
</script>
<template>
  <div class="mx-auto font-mont">
    <Header />
    <div class="max-w-[500px] p-10 rounded-2xl mx-auto border bg-[#fff]">
      <form @submit.prevent="register" class="space-y-6">
        <h1 class="text-3xl font-bold text-center mb-8 text-[#333333]">Зарегистрироваться</h1>
        <div class="space-y-2">
          <label for="firstName" class="block text-lg font-medium text-[#333333]">Имя</label>
          <input
            id="firstName"
            type="text"
            class="w-full px-4 py-3 border-1 border-[#333333] text-[#333333] rounded-xl text-lg focus:outline-none"
            v-model="firstName"
            required
          />
        </div>
        <div class="space-y-2">
          <label for="lastName" class="block text-lg font-medium text-[#333333]">Фамилия</label>
          <input
            id="lastName"
            type="text"
            class="w-full px-4 py-3 border-1 border-[#333333] text-[#333333] rounded-xl text-lg focus:outline-none"
            v-model="lastName"
            required
          />
        </div>
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
          <label for="avatar" class="block text-lg font-medium text-[#333333]">Фото профиля</label>
          <input
            id="avatar"
            type="file"
            class="w-full px-4 py-3 border-1 border-[#333333] text-[#333333] rounded-xl text-lg focus:outline-none"
            @change="fileChange"
            accept="image/*"
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
        <div class="space-y-2">
          <label for="resentPassword" class="block text-lg font-medium text-[#333333]"
            >Повторите пароль</label
          >
          <input
            id="resentPassword"
            type="password"
            class="w-full px-4 py-3 border-1 border-[#333333] text-[#333333] rounded-xl text-lg focus:outline-none"
            v-model="resentPassword"
            required
          />
        </div>
        <div v-if="erorrs.password" class="text-[#FF6B6B]">{{ erorrs.password }}</div>
        <div v-if="serverErrors" class="text-[#FF6B6B]">{{ serverErrors }}</div>
        <button
          type="submit"
          class="w-full bg-[#333333] text-white text-xl py-3 rounded-xl hover:bg-[#fff] border-1 border-[#333333] hover:text-[#333333] transition mt-2 cursor-pointer"
        >
          Зарегистрироваться
        </button>
        <p class="text-center pt-4 text-lg text-[#333333]">
          Уже есть аккаунт?
          <router-link to="/login" class="font-bold text-[#4ECDC4]"> Войти </router-link>
        </p>
      </form>
    </div>
    <Footer />
  </div>
</template>
