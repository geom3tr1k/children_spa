<script setup lang="ts">
import { ref } from 'vue'

interface User {
  id: number
  firstName: string
  lastName: string
  email: string
  avatar?: string
}
const user = ref<User | null>(null)

async function getUser() {
  const token = localStorage.getItem('token')
  if (!token) return

  try {
    const response = await fetch('http://127.0.0.1:8000/user', {
      method: 'GET',
      headers: { Authorization: `Bearer ${token}` },
    })

    if (response.ok) {
      const data = await response.json()
      user.value = data
    }
  } catch (e) {
    console.error(e)
  }
}

getUser()
</script>

<template>
  <header class="bg-[#fff] font-mont rounded-b-3xl mb-6 md:mb-10 transition-all">
    <div class="w-full flex justify-between items-center p-4 md:p-8">
      <router-link to="/" class="flex items-center z-50">
        <span class="text-3xl md:text-5xl font-bold text-[#4ECDC4]">BabyLand</span>
      </router-link>

      <nav class="hidden lg:flex text-xl xl:text-2xl justify-around flex-1 px-4">
        <router-link to="/catalog" class="text-[#333333] hover:text-[#4ECDC4] transition"
          >Каталог</router-link
        >
        <router-link to="/about" class="text-[#333333] hover:text-[#4ECDC4] transition"
          >О компании</router-link
        >
        <router-link to="/contacts" class="text-[#333333] hover:text-[#4ECDC4] transition"
          >Контакты</router-link
        >
        <router-link to="/bonus" class="text-[#333333] hover:text-[#4ECDC4] transition"
          >Бонусная программа</router-link
        >
      </nav>

      <div class="flex items-center space-x-3 md:space-x-6">
        <div class="hidden sm:block">
          <router-link
            to="/login"
            v-if="!user"
            class="bg-[#4ECDC4] text-white px-6 md:px-10 py-2 rounded-xl hover:bg-[#333333] transition cursor-pointer whitespace-nowrap"
          >
            Войти
          </router-link>
          <router-link to="/account" v-else class="text-[#4ECDC4] font-bold text-lg md:text-xl">
            {{ user.firstName }}
          </router-link>
        </div>

        <router-link to="/cart" class="text-[#333333] cursor-pointer p-1">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-7 w-7 md:h-8 md:w-8"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.3 5.3a1 1 0 001 1.2h11.6a1 1 0 001-1.2L17 13M7 13h10M10 21a1 1 0 100-2 1 1 0 000 2zm8 0a1 1 0 100-2 1 1 0 000 2z"
            />
          </svg>
        </router-link>

        <details class="lg:hidden relative">
          <summary class="list-none cursor-pointer p-1 text-[#333333]">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M4 6h16M4 12h16m-7 6h7"
              />
            </svg>
          </summary>
          <div
            class="absolute right-0 top-12 bg-white shadow-2xl rounded-2xl p-6 w-64 flex flex-col space-y-4 z-[100] border border-gray-100"
          >
            <router-link to="/catalog" class="text-lg font-medium text-[#333333]"
              >Каталог</router-link
            >
            <router-link to="/about" class="text-lg font-medium text-[#333333]"
              >О компании</router-link
            >
            <router-link to="/contacts" class="text-lg font-medium text-[#333333]"
              >Контакты</router-link
            >
            <router-link to="/bonus" class="text-lg font-medium border-b pb-2 text-[#333333]"
              >Бонусы</router-link
            >

            <router-link v-if="!user" to="/login" class="text-[#4ECDC4] font-bold py-2"
              >Войти</router-link
            >
            <router-link v-else to="/account" class="text-[#4ECDC4] font-bold py-2"
              >Профиль: {{ user.firstName }}</router-link
            >
          </div>
        </details>
      </div>
    </div>
  </header>
</template>
