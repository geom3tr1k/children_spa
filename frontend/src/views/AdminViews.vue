<script setup lang="ts">
import Footer from '@/components/Footer.vue'
import Header from '@/components/Header.vue'
import { ref } from 'vue'
import { onMounted } from 'vue'

const activeTab = ref<'admins' | 'products'>('admins')
const image = ref<File | null>(null)
const showModal = ref(false)
const title = ref('')
const description = ref('')
const price = ref('')
const category_id = ref('')
const material = ref('')
const errors = ref()

interface Product {
  id: number
  title: string
  description: string
  price: number
  image: string
}

interface Users {
  id: number
  lastName: string
  firstName: string
}
interface Admins {
  id: number

  lastName: string
  firstName: string
}

const products = ref<Product[]>([])
const users = ref<Users[]>([])
const admins = ref<Admins[]>([])

async function fetchProducts() {
  const response = await fetch('http://127.0.0.1:8000/products', {
    method: 'GET',
    headers: {
      Authorization: `Bearer ${localStorage.getItem('token')}`,
    },
  })

  if (response.ok) {
    products.value = await response.json()
  }
}

async function Users() {
  const response = await fetch('http://127.0.0.1:8000/users', {
    method: 'GET',
    headers: {
      Authorization: `Bearer ${localStorage.getItem('token')}`,
    },
  })

  if (response.ok) {
    users.value = await response.json()
  }
}
async function Admins() {
  const response = await fetch('http://127.0.0.1:8000/admins', {
    method: 'GET',
    headers: {
      Authorization: `Bearer ${localStorage.getItem('token')}`,
    },
  })

  if (response.ok) {
    admins.value = await response.json()
  }
}

onMounted(fetchProducts)
onMounted(Users)
onMounted(Admins)

async function deleteAdmin(id: number) {
  const response = await fetch(`http://127.0.0.1:8000/delAdmin/${id}`, {
    method: 'DELETE',
    headers: {
      Authorization: `Bearer ${localStorage.getItem('token')}`,
    },
  })

  if (response.ok) {
    Admins()
    Users()
  }
}
async function setAdmin(id: number) {
  const response = await fetch(`http://127.0.0.1:8000/setAdmin/${id}`, {
    method: 'POST',
    headers: {
      Authorization: `Bearer ${localStorage.getItem('token')}`,
    },
  })

  if (response.ok) {
    Admins()
    Users()
  }
}

function openModal() {
  errors.value = null
  showModal.value = true
}

function closeModal() {
  showModal.value = false
  fetchProducts()
}

function handleFileChange(event: Event) {
  const target = event.target as HTMLInputElement
  if (target.files && target.files[0]) {
    image.value = target.files[0]
  }
}

async function addProduct() {
  const formData = new FormData()

  formData.append('title', title.value)
  formData.append('description', description.value)
  formData.append('price', price.value)
  formData.append('category_id', category_id.value)
  if (image.value) formData.append('image', image.value)
  formData.append('material', material.value)

  const response = await fetch(`http://127.0.0.1:8000/add`, {
    method: 'POST',
    headers: {
      Authorization: `Bearer ${localStorage.getItem('token')}`,
    },
    body: formData,
  })

  if (response.ok) {
    closeModal()
  } else {
    errors.value = 'Произошла ошибка, повторите еще раз'
  }
}
async function deleteProduct(id: number) {
  const response = await fetch(`http://127.0.0.1:8000/delete/${id}`, {
    method: 'DELETE',
    headers: {
      Authorization: `Bearer ${localStorage.getItem('token')}`,
    },
  })

  if (response.ok) {
    fetchProducts()
  }
}
</script>

<template>
  <div class="max-w-[1600px] mx-auto font-mont">
    <Header />

    <main class="mx-auto mt-10 grid grid-cols-4 gap-6">
      <aside class="col-span-1 bg-white border rounded-2xl p-6">
        <h2 class="text-2xl font-bold text-[#333333] mb-6 text-center">Панель администратора</h2>

        <nav class="space-y-4">
          <button
            @click="activeTab = 'admins'"
            :class="[
              'w-full text-lg py-3 rounded-xl border transition',
              activeTab === 'admins'
                ? 'bg-[#333333] text-white border-[#333333] cursor-pointer'
                : 'bg-white text-[#333333] border-[#333333] hover:bg-[#333333] hover:text-white cursor-pointer',
            ]"
          >
            Пользователи
          </button>

          <button
            @click="activeTab = 'products'"
            :class="[
              'w-full text-lg py-3 rounded-xl border transition',
              activeTab === 'products'
                ? 'bg-[#333333] text-white border-[#333333] cursor-pointer'
                : 'bg-white text-[#333333] border-[#333333] hover:bg-[#333333] hover:text-white cursor-pointer',
            ]"
          >
            Товары
          </button>
        </nav>
      </aside>

      <section class="col-span-3 bg-white border rounded-2xl p-8">
        <div v-if="activeTab === 'admins'">
          <h2 class="text-2xl font-bold text-[#333333] mb-6">Управление пользователями</h2>
          <h2 class="text-xl font-bold text-[#333333] mb-6">Администраторы</h2>
          <div class="mt-6 space-y-3">
            <div
              v-for="admin in admins"
              :key="admin.id"
              class="flex items-center gap-4 border border-[#333333] rounded-xl p-4 justify-between"
            >
              <h3 class="text-lg font-semibold text-[#333333]">
                {{ admin.firstName }}
                {{ admin.lastName }}
              </h3>
              <button
                @click="deleteAdmin(admin.id)"
                class="px-4 py-2 text-sm border border-[#FF6B6B] text-[#FF6B6B] rounded-lg hover:bg-[#FF6B6B] hover:text-white transition cursor-pointer"
              >
                Удалить
              </button>
            </div>
          </div>
          <h2 class="text-xl font-bold text-[#333333] mt-6 mb-6">Пользователи</h2>
          <div class="mt-6 space-y-3">
            <div
              v-for="user in users"
              :key="user.id"
              class="flex items-center gap-4 border border-[#333333] rounded-xl p-4 justify-between"
            >
              <h3 class="text-lg font-semibold text-[#333333]">
                {{ user.firstName }}
                {{ user.lastName }}
              </h3>
              <button
                @click="setAdmin(user.id)"
                class="px-4 py-2 text-sm border border-[#1E5945] text-[#1E5945] rounded-lg hover:bg-[#1E5945] hover:text-white transition cursor-pointer"
              >
                Назначить
              </button>
            </div>
          </div>
        </div>
        <div v-if="activeTab === 'products'">
          <h2 class="text-2xl font-bold text-[#333333] mb-6">Управление товарами</h2>
          <button
            @click="openModal"
            class="w-80 bg-[#333333] text-white text-lg py-3 rounded-xl hover:bg-white hover:text-[#333333] border border-[#333333] transition mb-3 cursor-pointer"
          >
            Добавить товар
          </button>
          <div class="grid grid-cols-4 gap-6 mt-6">
            <div
              v-for="product in products"
              :key="product.id"
              class="border border-[#333333] rounded-xl overflow-hidden flex flex-col"
            >
              <div class="h-40 w-full overflow-hidden">
                <img
                  v-if="product.image_url"
                  :src="product.image_url"
                  class="w-full h-full object-cover"
                />
                <div
                  v-else
                  class="w-full h-full flex items-center justify-center text-xs text-gray-400"
                >
                  нет фото
                </div>
              </div>
              <div class="p-4 flex flex-col flex-1">
                <h3 class="text-lg font-semibold text-[#333333] mb-2">
                  {{ product.title }}
                </h3>
                <p class="text-sm text-[#333333] mb-4">
                  {{ product.description }}
                </p>
                <button
                  @click="deleteProduct(product.id)"
                  class="px-4 py-2 text-sm border border-[#FF6B6B] text-[#FF6B6B] rounded-lg hover:bg-[#FF6B6B] hover:text-white transition cursor-pointer"
                >
                  Удалить
                </button>
              </div>
            </div>
          </div>

          <div
            v-if="showModal"
            class="fixed inset-0 bg-black/40 flex items-center justify-center z-50"
          >
            <div class="bg-white rounded-2xl w-full max-w-[500px] p-8 relative">
              <h2 class="text-2xl font-bold text-center mb-6 text-[#333333]">
                Добавить новый товар
              </h2>

              <form class="space-y-4 text-[#333333]" @submit.prevent="addProduct">
                <input
                  v-model="title"
                  type="text"
                  placeholder="Название"
                  class="w-full px-4 py-3 border border-[#333333] rounded-xl text-lg focus:outline-none"
                />

                <input
                  v-model="description"
                  type="text"
                  placeholder="Описание"
                  class="w-full px-4 py-3 border border-[#333333] rounded-xl text-lg focus:outline-none"
                />

                <input
                  v-model="price"
                  type="number"
                  placeholder="Цена"
                  class="w-full px-4 py-3 border border-[#333333] rounded-xl text-lg focus:outline-none"
                />

                <input
                  v-model="material"
                  type="text"
                  placeholder="Материал"
                  class="w-full px-4 py-3 border border-[#333333] rounded-xl text-lg focus:outline-none"
                />

                <input
                  type="file"
                  placeholder="Фото"
                  @change="handleFileChange"
                  accept="image/*"
                  class="w-full px-4 py-3 border border-[#333333] rounded-xl text-lg"
                />

                <select
                  v-model="category_id"
                  class="w-full px-4 py-3 border border-[#333333] rounded-xl text-lg focus:outline-none"
                >
                  <option disabled value="">Выберите категорию</option>
                  <option value="1">Одежда</option>
                  <option value="2">Игрушки</option>
                  <option value="3">Мебель</option>
                  <option value="4">Обувь</option>
                  <option value="5">Питание</option>
                </select>
                <div v-if="errors" class="text-[#FF6B6B]">{{ errors }}</div>

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
        </div>
      </section>
    </main>

    <Footer />
  </div>
</template>
