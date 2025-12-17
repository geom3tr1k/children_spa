<script setup lang="ts">
import Footer from '@/components/Footer.vue'
import Header from '@/components/Header.vue'
import router from '@/router'
import { ref, onMounted } from 'vue'
interface Order {
  id: number
  total_price: number
  status: string
  created_at: string
  items: {
    quantity: number
    price: number
    product: {
      title: string
    }
  }[]
}

const orders = ref<Order[]>([])

async function getOrders() {
  const response = await fetch('http://127.0.0.1:8000/my-orders', {
    headers: {
      Authorization: `Bearer ${localStorage.getItem('token')}`,
    },
  })

  if (response.ok) {
    orders.value = await response.json()
  }
}

interface User {
  id: number
  firstName: string
  lastName: string
  email: string
  avatar?: string
  created_at: string
  role: string
}

const user = ref<User | null>(null)
const showModal = ref(false)

const firstName = ref('')
const lastName = ref('')
const email = ref('')
const password = ref('')
const avatar = ref<File | null>(null)

async function getUser() {
  const response = await fetch('http://127.0.0.1:8000/user', {
    method: 'GET',
    headers: { Authorization: `Bearer ${localStorage.getItem('token')}` },
  })

  if (response.ok) {
    const data = await response.json()
    user.value = data
    firstName.value = data.firstName
    lastName.value = data.lastName
    email.value = data.email
  }
}

async function logOut() {
  const responce = await fetch('http://127.0.0.1:8000/logout', {
    method: 'POST',
    headers: { Authorization: `Bearer ${localStorage.getItem('token')}` },
  })
  if (responce.ok) {
    localStorage.removeItem('token')
    router.push('/')
  }
}

function openModal() {
  showModal.value = true
}

function closeModal() {
  showModal.value = false
}

function handleFileChange(event: Event) {
  const target = event.target as HTMLInputElement
  if (target.files && target.files[0]) {
    avatar.value = target.files[0]
  }
}

async function updateUser(id: number) {
  const formData = new FormData()

  if (firstName.value) formData.append('firstName', firstName.value)
  if (lastName.value) formData.append('lastName', lastName.value)
  if (email.value) formData.append('email', email.value)
  if (password.value) formData.append('password', password.value)
  if (avatar.value) formData.append('avatar', avatar.value)

  const response = await fetch(`http://127.0.0.1:8000/upload/${id}`, {
    method: 'POST',
    headers: {
      Authorization: `Bearer ${localStorage.getItem('token')}`,
    },
    body: formData,
  })

  if (response.ok) {
    closeModal()
    getUser()
  }
}

getUser()
getOrders()
</script>
<template>
  <div class="mx-auto font-mont">
    <Header />

    <main class="max-w-[1600px] mx-auto mt-10 grid grid-cols-3 gap-6">
      <section class="col-span-1 bg-white border rounded-2xl p-8">
        <h2 class="text-2xl font-bold text-[#333333] mb-6 text-center">Профиль</h2>

        <div class="flex flex-col items-center text-center">
          <img
            v-if="user?.avatar_url"
            :src="user.avatar_url"
            class="w-36 h-36 rounded-full object-cover"
          />
          <div
            v-else
            class="w-36 h-36 rounded-full bg-gray-200 flex items-center justify-center mb-4 text-xl text-gray-500"
          >
            Нет фото
          </div>

          <p class="text-xl font-semibold text-[#333333]">
            {{ user?.firstName }} {{ user?.lastName }}
          </p>
          <p class="text-lg text-gray-500 mb-4">
            {{ user?.email }}
          </p>

          <p v-if="user" class="text-sm text-gray-400 mb-6">
            Регистрация:
            {{ new Date(user.created_at).toLocaleDateString('ru-RU') }}
          </p>

          <button
            @click="openModal"
            class="w-full bg-white text-[#333333] text-lg py-3 rounded-xl border border-[#333333] hover:bg-[#333333] hover:text-white transition mb-3 cursor-pointer"
          >
            Редактировать
          </button>
          <router-link
            to="/admin"
            v-if="user?.role === 'admin' || user?.role === 'root'"
            class="w-full bg-white text-[#333333] text-lg py-3 rounded-xl border border-[#333333] hover:bg-[#333333] hover:text-white transition mb-3"
          >
            Панель администратора
          </router-link>
          <button
            @click="logOut"
            class="w-full bg-[#333333] text-white text-lg py-3 rounded-xl hover:bg-white hover:text-[#333333] border border-[#333333] transition mb-3 cursor-pointer"
          >
            Выйти
          </button>
        </div>
      </section>
      <section class="col-span-2 bg-white border rounded-2xl p-8">
        <h2 class="text-2xl font-bold text-[#333333] mb-6">Мои заказы</h2>
        <div v-if="!orders.length" class="text-gray-500 text-lg">Пока заказов нет</div>

        <div v-else class="space-y-6">
          <div v-for="order in orders" :key="order.id" class="border rounded-xl p-4">
            <div class="flex justify-between mb-2">
              <div class="font-semibold text-[#333333] text-xl">Заказ №{{ order.id }}</div>
              <div class="text-gray-500">
                {{ new Date(order.created_at).toLocaleDateString('ru-RU') }}
              </div>
            </div>
            <ul class="text-sm mb-3 text-gray-500">
              <li v-for="item in order.items" :key="item.product.title">
                {{ item.product.title }} × {{ item.quantity }} — {{ item.price * item.quantity }} ₽
              </li>
            </ul>

            <div class="font-bold text-right text-[#333333]">Итого: {{ order.total_price }} ₽</div>
          </div>
        </div>
      </section>
    </main>
    <div v-if="showModal" class="fixed inset-0 bg-black/40 flex items-center justify-center z-50">
      <div class="bg-white rounded-2xl w-full max-w-[500px] p-8 relative">
        <h2 class="text-2xl font-bold text-center mb-6 text-[#333333]">Редактирование профиля</h2>

        <form class="space-y-4 text-[#333333]" @submit.prevent="updateUser(user!.id)">
          <input
            v-model="firstName"
            type="text"
            placeholder="Имя"
            class="w-full px-4 py-3 border border-[#333333] rounded-xl text-lg focus:outline-none"
          />

          <input
            v-model="lastName"
            type="text"
            placeholder="Фамилия"
            class="w-full px-4 py-3 border border-[#333333] rounded-xl text-lg focus:outline-none"
          />

          <input
            v-model="email"
            type="email"
            placeholder="Почта"
            class="w-full px-4 py-3 border border-[#333333] rounded-xl text-lg focus:outline-none"
          />

          <input
            v-model="password"
            type="password"
            placeholder="Новый пароль"
            class="w-full px-4 py-3 border border-[#333333] rounded-xl text-lg focus:outline-none"
          />

          <input
            type="file"
            @change="handleFileChange"
            accept="image/*"
            class="w-full px-4 py-3 border border-[#333333] rounded-xl text-lg"
          />

          <div class="flex gap-4 mt-6">
            <button
              type="button"
              @click="closeModal"
              class="w-1/2 bg-white border border-[#333333] text-[#333333] py-3 rounded-xl hover:bg-[#333333] hover:text-white transition"
            >
              Отмена
            </button>

            <button
              type="submit"
              class="w-1/2 bg-[#333333] text-white py-3 rounded-xl hover:bg-white hover:text-[#333333] border border-[#333333] transition"
            >
              Сохранить
            </button>
          </div>
        </form>
      </div>
    </div>
    <Footer />
  </div>
</template>
