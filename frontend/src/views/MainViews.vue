<script setup lang="ts">
import Header from '@/components/Header.vue'
import Footer from '@/components/Footer.vue'
</script>

<template>
  <div class="mx-auto font-mont">
    <Header />

    <main class="max-w-[1600px] mx-auto py-10 px-4 md:px-0 bg-white rounded-2xl">
      <section class="px-10 py-20 m-16 text-center border border-[#333333] rounded-2xl mt-0">
        <h1 class="text-5xl font-bold text-[#333333] mb-6">
          BabyLand — всё лучшее для детей и родителей
        </h1>
        <p class="text-xl text-[#333333] mb-10 max-w-4xl mx-auto">
          Интернет-магазин BabyLand предлагает широкий ассортимент товаров для детей: одежда,
          игрушки, мебель, питание и многое другое. Мы заботимся о качестве, безопасности и комфорте
          каждой семьи.
        </p>
        <div class="flex justify-center gap-6">
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
      <section class="px-10 mb-16">
        <h2 class="text-3xl font-bold text-[#333333] mb-6">О магазине BabyLand</h2>
        <p class="text-lg text-[#333333] mb-4 max-w-5xl">
          BabyLand — это современный интернет-магазин детских товаров, созданный с заботой о
          родителях и детях. Мы тщательно подбираем ассортимент, сотрудничая только с проверенными
          производителями и брендами.
        </p>
        <p class="text-lg text-[#333333] mb-4 max-w-5xl">
          Наш магазин подходит как для будущих родителей, так и для семей с детьми разных возрастов.
          Мы стремимся сделать процесс покупки простым, удобным и приятным.
        </p>
        <p class="text-lg text-[#333333] max-w-5xl">
          BabyLand — это не просто магазин, а надежный помощник в заботе о вашем ребёнке.
        </p>
      </section>
      <section class="px-10 mb-16">
        <h2 class="text-3xl font-bold text-[#333333] mb-10 text-center">Наши преимущества</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <div class="border border-[#333333] rounded-2xl p-6">
            <h3 class="text-2xl font-semibold text-[#333333] mb-3">Качество и безопасность</h3>
            <p class="text-lg text-[#333333]">
              Вся продукция сертифицирована и соответствует стандартам безопасности для детей.
            </p>
          </div>
          <div class="border border-[#333333] rounded-2xl p-6">
            <h3 class="text-2xl font-semibold text-[#333333] mb-3">Удобный сервис</h3>
            <p class="text-lg text-[#333333]">
              Простая навигация, быстрый заказ и поддержка клиентов на каждом этапе покупки.
            </p>
          </div>
          <div class="border border-[#333333] rounded-2xl p-6">
            <h3 class="text-2xl font-semibold text-[#333333] mb-3">Бонусы и акции</h3>
            <p class="text-lg text-[#333333]">
              Участвуйте в бонусной программе и получайте выгоду с каждой покупки.
            </p>
          </div>
        </div>
      </section>
      <section class="px-10 mb-16">
        <h2 class="text-3xl font-bold text-[#333333] mb-10 text-center">Категории товаров</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
          <div class="text-[#fff] bg-[#333333] rounded-xl p-6 text-center">Одежда для детей</div>
          <div class="text-[#fff] bg-[#333333] rounded-xl p-6 text-center">Игрушки и развитие</div>
          <div class="text-[#fff] bg-[#333333] rounded-xl p-6 text-center">Детская мебель</div>
          <div class="text-[#fff] bg-[#333333] rounded-xl p-6 text-center">Питание и уход</div>
        </div>
      </section>
      <section class="px-10 mb-16">
        <h2 class="text-3xl font-bold text-[#333333] mb-8">Почему нам доверяют родители</h2>
        <p class="text-lg text-[#333333] mb-4 max-w-5xl">
          Тысячи клиентов по всей стране выбирают BabyLand за честность, стабильность и высокий
          уровень сервиса. Мы постоянно развиваемся и учитываем отзывы наших покупателей.
        </p>
        <p class="text-lg text-[#333333] max-w-5xl">
          Наша команда делает всё возможное, чтобы каждая покупка приносила радость и уверенность в
          качестве товаров.
        </p>
      </section>
      <section class="px-10 py-16 text-center border border-[#333333] rounded-2xl m-16 mb-0">
        <h2 class="text-4xl font-bold text-[#333333] mb-6">Присоединяйтесь к BabyLand</h2>
        <p class="text-lg text-[#333333] mb-8">
          Зарегистрируйтесь, чтобы получать бонусы, акции и специальные предложения.
        </p>
        <router-link
          to="/register"
          class="bg-[#333333] text-white text-lg py-3 px-14 rounded-xl hover:bg-white hover:text-[#333333] border border-[#333333] transition"
        >
          Создать аккаунт
        </router-link>
      </section>
    </main>

    <Footer />
  </div>
</template>
