<script setup lang="ts">
import Header from '@/components/Header.vue'
import Footer from '@/components/Footer.vue'
</script>

<template>
  <div class="mx-auto font-mont px-4 sm:px-0">
    <Header />

    <main class="max-w-[1600px] mx-auto py-6 sm:py-10 px-0 sm:px-4 md:px-0">
      <section class="p-4 sm:p-6 lg:p-10 mb-10 sm:mb-16 text-center rounded-2xl bg-white">
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-[#333333] mb-4 sm:mb-6">
          BabyLand — всё лучшее для детей и родителей
        </h1>
        <p class="text-base sm:text-lg lg:text-xl text-[#333333] mb-6 sm:mb-10 max-w-4xl mx-auto">
          Интернет-магазин BabyLand предлагает широкий ассортимент товаров для детей: одежда,
          игрушки, мебель, питание и многое другое. Мы заботимся о качестве, безопасности и комфорте
          каждой семьи.
        </p>
        <div class="flex flex-col sm:flex-row justify-center gap-4 sm:gap-6">
          <router-link
            to="/catalog"
            class="bg-[#333333] text-white text-lg py-3 px-12 rounded-xl hover:bg-white hover:text-[#333333] border border-[#333333] transition"
          >
            Перейти в каталог
          </router-link>
          <router-link
            to="/bonus"
            class="bg-white text-[#333333] text-lg py-3 px-12 rounded-xl border border-[#333333] hover:bg-[#333333] hover:text-white transition"
          >
            Бонусная программа
          </router-link>
        </div>
      </section>
      <section class="p-4 sm:p-6 lg:p-10 mb-10 sm:mb-16 bg-[#333333] rounded-2xl">
        <h2 class="text-2xl sm:text-3xl font-bold text-white mb-4 sm:mb-6">О магазине BabyLand</h2>
        <p class="text-base sm:text-lg text-white mb-4 max-w-5xl">
          BabyLand — это современный интернет-магазин детских товаров, созданный с заботой о
          родителях и детях. Мы тщательно подбираем ассортимент, сотрудничая только с проверенными
          производителями и брендами.
        </p>
        <p class="text-base sm:text-lg text-white mb-4 max-w-5xl">
          Наш магазин подходит как для будущих родителей, так и для семей с детьми разных возрастов.
          Мы стремимся сделать процесс покупки простым, удобным и приятным.
        </p>
        <p class="text-base sm:text-lg text-white mb-4 max-w-5xl">
          BabyLand — это не просто магазин, а надежный помощник в заботе о вашем ребёнке.
        </p>
      </section>
      <section class="p-4 sm:p-6 lg:p-10 mb-10 sm:mb-16 rounded-2xl bg-white">
        <h2 class="text-3xl font-bold text-[#333333] mb-10 text-center">Наши преимущества</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <div class="bg-[#333333] rounded-2xl p-6">
            <h3 class="text-2xl font-semibold text-[#fff] mb-3">Качество и безопасность</h3>
            <p class="text-lg text-[#fff]">
              Вся продукция сертифицирована и соответствует стандартам безопасности для детей.
            </p>
          </div>
          <div class="bg-[#333333] rounded-2xl p-6">
            <h3 class="text-2xl font-semibold text-[#fff] mb-3">Удобный сервис</h3>
            <p class="text-lg text-[#fff]">
              Простая навигация, быстрый заказ и поддержка клиентов на каждом этапе покупки.
            </p>
          </div>
          <div class="bg-[#333333] rounded-2xl p-6">
            <h3 class="text-2xl font-semibold text-[#fff] mb-3">Бонусы и акции</h3>
            <p class="text-lg text-[#fff]">
              Участвуйте в бонусной программе и получайте выгоду с каждой покупки.
            </p>
          </div>
        </div>
      </section>
      <section class="p-4 sm:p-6 lg:p-10 mb-10 sm:mb-16 bg-[#333] rounded-2xl">
        <h2 class="text-3xl font-bold text-[#fff] mb-10 text-center">Категории товаров</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
          <div class="text-sm sm:text-base text-[#333] bg-white rounded-xl p-4 sm:p-6 text-center">
            Одежда для детей
          </div>
          <div class="text-sm sm:text-base text-[#333] bg-white rounded-xl p-4 sm:p-6 text-center">
            Игрушки и развитие
          </div>
          <div class="text-sm sm:text-base text-[#333] bg-white rounded-xl p-4 sm:p-6 text-center">
            Детская мебель
          </div>
          <div class="text-sm sm:text-base text-[#333] bg-white rounded-xl p-4 sm:p-6 text-center">
            Питание и уход
          </div>
        </div>
      </section>
      <section class="p-4 sm:p-6 lg:p-10 mb-10 sm:mb-16 bg-white rounded-2xl">
        <h2 class="text-3xl font-bold text-[#333333] mb-8">Почему нам доверяют родители</h2>
        <p class="text-base sm:text-lg text-[#333333] mb-4 max-w-5xl">
          Тысячи клиентов по всей стране выбирают BabyLand за честность, стабильность и высокий
          уровень сервиса. Мы постоянно развиваемся и учитываем отзывы наших покупателей.
        </p>
        <p class="text-base sm:text-lg text-[#333333] mb-4 max-w-5xl">
          Наша команда делает всё возможное, чтобы каждая покупка приносила радость и уверенность в
          качестве товаров.
        </p>
      </section>
      <section class="p-4 sm:p-6 lg:p-10 text-center bg-[#333] rounded-2xl">
        <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-white mb-4 sm:mb-6">
          Присоединяйтесь к BabyLand
        </h2>
        <p class="text-lg text-[#fff] mb-8">
          Зарегистрируйтесь, чтобы получать бонусы, акции и специальные предложения.
        </p>
        <router-link to="/register" class="bg-[#fff] text-[#333] text-lg py-3 px-14 rounded-xl">
          Создать аккаунт
        </router-link>
      </section>
    </main>

    <Footer />
  </div>
</template>
