<script setup lang="ts">
import Header from '@/components/Header.vue'
import Footer from '@/components/Footer.vue'
import { ref } from 'vue'
import { onMounted } from 'vue'
import { computed } from 'vue'

const selectedCategory = ref<number | null>(null)
const priceSort = ref<'none' | 'cheap' | 'expensive'>('none')

const sortedProducts = computed(() => {
  let result = [...products.value]

  if (priceSort.value === 'cheap') {
    result.sort((a, b) => a.price - b.price)
  }

  if (priceSort.value === 'expensive') {
    result.sort((a, b) => b.price - a.price)
  }

  return result
})

interface Product {
  id: number
  title: string
  description: string
  price: number
  image: string
}
const products = ref<Product[]>([])

async function addToCart(productId: number) {
  const token = localStorage.getItem('token')

  if (!token) {
    alert('Нужно войти в аккаунт')
    return
  }

  const response = await fetch(`http://213.171.27.22/cart/add/${productId}`, {
    method: 'POST',
    headers: {
      Authorization: `Bearer ${token}`,
      Accept: 'application/json',
    },
  })

  if (response.ok) {
    alert('Товар добавлен в корзину')
  } else {
    const error = await response.json()
    alert(error.message || 'Ошибка')
  }
}

async function fetchProducts() {
  const response = await fetch('http://213.171.27.22/products', {
    method: 'GET',
    headers: {
      Authorization: `Bearer ${localStorage.getItem('token')}`,
    },
  })

  if (response.ok) {
    products.value = await response.json()
  }
}
async function fetchProductsCategory() {
  if (selectedCategory.value === null) {
    return
  }
  const categoryId = selectedCategory.value
  const response = await fetch(`http://213.171.27.22/products/${categoryId}`, {
    method: 'GET',
    headers: {
      Authorization: `Bearer ${localStorage.getItem('token')}`,
    },
  })

  if (response.ok) {
    products.value = await response.json()
  }
}

function resent() {
  selectedCategory.value = null
  priceSort.value = 'none'
  fetchProducts()
}

onMounted(fetchProducts)
</script>

<template>
  <div class="mx-auto font-mont px-4 sm:px-0">
    <Header />

    <main class="mx-auto py-6 sm:py-8 lg:py-10 px-4 md:px-0 rounded-2xl max-w-[1600px]">
      <section class="px-4 sm:px-6 lg:px-10 mb-6 sm:mb-10">
        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-white">Каталог товаров</h1>
      </section>

      <section class="flex flex-col lg:flex-row gap-6 lg:gap-10 px-4 sm:px-6 lg:px-10">
        <aside class="w-full lg:w-72 border border-[#333333] rounded-2xl p-4 sm:p-6 h-fit bg-white">
          <form @submit.prevent="fetchProductsCategory">
            <div class="mb-8">
              <h3 class="text-lg sm:text-xl font-semibold text-[#333333] mb-3 sm:mb-4">
                Категории
              </h3>
              <div class="space-y-3 text-[#333333]">
                <label class="flex items-center gap-2 cursor-pointer">
                  <input type="radio" name="category" value="1" v-model="selectedCategory" />
                  Одежда
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                  <input type="radio" name="category" value="2" v-model="selectedCategory" />
                  Игрушки
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                  <input type="radio" name="category" value="3" v-model="selectedCategory" />
                  Мебель
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                  <input type="radio" name="category" value="4" v-model="selectedCategory" />
                  Обувь
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                  <input type="radio" name="category" value="5" v-model="selectedCategory" />
                  Питание
                </label>
              </div>
            </div>

            <div>
              <h3 class="text-lg sm:text-xl font-semibold text-[#333333] mb-3 sm:mb-4">Цена</h3>

              <select
                v-model="priceSort"
                class="w-full border border-[#333333] text-[#333333] rounded-xl px-3 py-2 text-sm sm:text-base cursor-pointer"
              >
                <option value="none">Без сортировки</option>
                <option value="cheap">Сначала дешевле</option>
                <option value="expensive">Сначала дороже</option>
              </select>
            </div>
            <button
              class="mt-6 w-full py-2 border border-[#333333] text-[#333333] rounded-xl hover:bg-[#333333] hover:text-white transition cursor-pointer"
            >
              Применить
            </button>
            <button
              @click="resent()"
              type="button"
              class="mt-2 w-full py-2 border border-red-500 text-red-500 rounded-xl hover:bg-red-500 hover:text-white transition cursor-pointer"
            >
              Сбросить
            </button>
          </form>
        </aside>
        <div class="w-full grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
          <div
            v-for="product in sortedProducts"
            :key="product.id"
            class="border border-[#333333] rounded-2xl p-4 sm:p-5 flex flex-col bg-white"
          >
            <img
              :src="product.image_url"
              class="h-48 sm:h-44 w-full object-cover border border-[#333333] rounded-xl mb-3 sm:mb-4"
            />
            <h3 class="text-lg sm:text-xl font-semibold text-[#333333] mb-2">
              {{ product.title }}
            </h3>
            <p class="text-sm sm:text-base text-[#333333] mb-3 line-clamp-3">
              {{ product.description }}
            </p>
            <div class="text-base sm:text-lg font-semibold text-[#333333] mb-3 sm:mb-4">
              {{ product.price }} ₽
            </div>
            <button
              @click="addToCart(product.id)"
              class="mt-auto py-2 sm:py-3 border border-[#333333] text-[#333333] rounded-xl hover:bg-[#333333] hover:text-white transition cursor-pointer"
            >
              В корзину
            </button>
          </div>
        </div>
      </section>
    </main>

    <Footer />
  </div>
</template>
