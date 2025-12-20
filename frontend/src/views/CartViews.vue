<script setup lang="ts">
import Header from '@/components/Header.vue'
import Footer from '@/components/Footer.vue'
import { ref, computed, onMounted } from 'vue'
import router from '@/router'

interface Product {
  id: number
  title: string
  price: number
  image_url: string
}

interface CartItem {
  id: number
  quantity: number
  product: Product
}

interface Cart {
  id: number
  items: CartItem[]
}

const cart = ref<Cart | null>(null)
const loading = ref(false)

const token = localStorage.getItem('token')

async function fetchCart() {
  const res = await fetch('http://213.171.27.22/cart', {
    headers: {
      Authorization: `Bearer ${token}`,
      Accept: 'application/json',
    },
  })

  if (res.ok) {
    cart.value = await res.json()
  }
}

async function add(productId: number) {
  await fetch(`http://213.171.27.22/cart/add/${productId}`, {
    method: 'POST',
    headers: { Authorization: `Bearer ${token}` },
  })
  fetchCart()
}

async function decrease(productId: number) {
  await fetch(`http://213.171.27.22/cart/decrease/${productId}`, {
    method: 'POST',
    headers: { Authorization: `Bearer ${token}` },
  })
  fetchCart()
}

async function remove(productId: number) {
  await fetch(`http://213.171.27.22/cart/remove/${productId}`, {
    method: 'DELETE',
    headers: { Authorization: `Bearer ${token}` },
  })
  fetchCart()
}

const totalPrice = computed(() => {
  if (!cart.value) return 0
  return cart.value.items.reduce((sum, item) => sum + item.product.price * item.quantity, 0)
})

async function checkout() {
  if (!cart.value || cart.value.items.length === 0) return

  loading.value = true

  const res = await fetch('http://213.171.27.22/checkout', {
    method: 'POST',
    headers: { Authorization: `Bearer ${token}` },
  })

  loading.value = false

  if (res.ok) {
    router.push('/account')
  }
}

onMounted(fetchCart)
</script>
<template>
  <div class="mx-auto font-mont px-4 sm:px-0">
    <Header />

    <main
      class="max-w-[1600px] mx-auto py-6 sm:py-8 lg:py-10 px-4 sm:px-6 lg:px-10 bg-white rounded-2xl"
    >
      <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-[#333333] mb-6 sm:mb-10">
        Корзина
      </h1>
      <div v-if="!cart || cart.items.length === 0" class="text-xl text-gray-500">Корзина пуста</div>
      <div v-else class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-10">
        <div class="col-span-1 lg:col-span-2 space-y-4 sm:space-y-6">
          <div
            v-for="item in cart.items"
            :key="item.id"
            class="flex flex-col sm:flex-row sm:items-center gap-4 sm:gap-6 border border-[#333333] rounded-2xl p-4 sm:p-5"
          >
            <img
              :src="item.product.image_url"
              class="w-full sm:w-28 h-48 sm:h-28 object-cover rounded-xl border"
            />
            <div class="flex-1">
              <h3 class="text-lg sm:text-xl font-semibold text-[#333333]">
                {{ item.product.title }}
              </h3>
              <p class="text-base sm:text-lg text-gray-500">{{ item.product.price }} ₽ / шт</p>
            </div>
            <div class="flex items-center gap-3 text-[#333333] justify-between sm:justify-start">
              <button
                @click="decrease(item.product.id)"
                class="px-3 py-1 border rounded-lg cursor-pointer"
              >
                −
              </button>
              <span class="text-lg font-semibold text-[#333333]">{{ item.quantity }}</span>
              <button
                @click="add(item.product.id)"
                class="px-3 py-1 border rounded-lg cursor-pointer"
              >
                +
              </button>
            </div>
            <div class="text-lg sm:text-xl font-bold sm:w-28 sm:text-right text-[#333333]">
              {{ item.product.price * item.quantity }} ₽
            </div>
            <button
              @click="remove(item.product.id)"
              class="text-red-500 cursor-pointer self-end sm:self-auto"
            >
              Удалить
            </button>
          </div>
        </div>
        <div class="border border-[#333333] rounded-2xl p-4 sm:p-6 h-fit sticky lg:top-10">
          <h2 class="text-2xl font-bold mb-6 text-[#333333]">Итого</h2>

          <div class="flex justify-between text-lg mb-4 text-gray-500">
            <span>Сумма:</span>
            <span class="font-semibold">{{ totalPrice }} ₽</span>
          </div>

          <button
            @click="checkout"
            :disabled="loading"
            class="w-full mt-4 sm:mt-6 py-3 bg-[#333333] text-white text-base sm:text-lg rounded-xl hover:bg-white hover:text-[#333333] border border-[#333333] transition cursor-pointer"
          >
            Оформить заказ
          </button>
        </div>
      </div>
    </main>

    <Footer />
  </div>
</template>
