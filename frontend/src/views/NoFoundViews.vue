<script setup lang="ts">
import Footer from '@/components/Footer.vue'
import Header from '@/components/Header.vue'
</script>

<template>
  <div class="mx-auto font-mont">
    <Header />
    <main class="py-20 flex flex-col items-center justify-center min-h-[60vh]">
      <div class="max-w-2xl p-12 rounded-3xl bg-white text-center border-2 border-[#4ECDC4]">
        <h1 class="text-9xl text-[#FF6B6B] mb-4">404</h1>
        <h2 class="text-4xl text-[#333333] mb-6">Упс! Страница потерялась.</h2>
        <p class="text-xl text-gray-600 mb-8">
          Кажется, эта ссылка ведет в страну потерянных игрушек. Не волнуйтесь, мы поможем вам
          вернуться!
        </p>
        <router-link
          to="/"
          class="bg-[#4ECDC4] text-white text-2xl px-12 py-4 rounded-xl hover:bg-[#333333] transition"
        >
          На главную
        </router-link>
      </div>
    </main>

    <Footer />
  </div>
</template>
