<script setup lang="ts">
import Header from '@/components/Header.vue'
import Footer from '@/components/Footer.vue'
</script>

<template>
  <div class="mx-auto font-mont">
    <Header />
    <main class="max-w-[1600px] mx-auto py-10 px-4 md:px-0">
      <section class="mb-13 p-10 bg-white rounded-2xl w-full">
        <h1 class="text-4xl font-bold text-[#333333] mb-6">О компании BabyLand</h1>
        <p class="text-lg text-[#333333] mb-6">
          BabyLand — это современный интернет-магазин товаров для детей и родителей. Мы создаём
          комфорт, безопасность и радость для семей, предлагая качественные товары по честным ценам.
        </p>
        <p class="text-lg text-[#333333]">
          Наша цель — стать надежным помощником для родителей на каждом этапе роста ребёнка.
        </p>
      </section>
      <section class="p-10 mb-12 w-full bg-white rounded-2xl">
        <h2 class="text-3xl font-bold text-[#333333] mb-8">Почему выбирают нас</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <div class="bg-[#333333] rounded-2xl p-6 text-center">
            <h3 class="text-2xl font-semibold text-[#fff] mb-3">Качество и безопасность</h3>
            <p class="text-lg text-[#fff]">
              Мы сотрудничаем только с проверенными поставщиками и гарантируем безопасность всей
              продукции.
            </p>
          </div>

          <div class="bg-[#333333] rounded-2xl p-6 text-center">
            <h3 class="text-2xl font-semibold text-[#fff] mb-3">Забота о клиентах</h3>
            <p class="text-lg text-[#fff]">
              Индивидуальный подход, поддержка и честный сервис — основа нашей работы.
            </p>
          </div>

          <div class="bg-[#333333] rounded-2xl p-6 text-center">
            <h3 class="text-2xl font-semibold text-[#fff] mb-3">Быстрая доставка</h3>
            <p class="text-lg text-[#fff]">
              Мы делаем всё, чтобы заказы доставлялись быстро и в удобное для вас время.
            </p>
          </div>
        </div>
      </section>
      <section class="bg-[#333333] p-10 rounded-2xl p-8 mb-12">
        <h2 class="text-3xl text-white mb-6">Наша история</h2>
        <p class="text-lg text-white mb-4">
          BabyLand был основан с простой идеей — создать магазин, которому родители смогут доверять
          так же, как близким друзьям.
        </p>
        <p class="text-lg text-white">
          За годы работы мы расширили ассортимент, внедрили бонусную программу и собрали команду
          профессионалов, искренне любящих своё дело.
        </p>
      </section>
      <section class="p-10 rounded-2xl bg-white">
        <h2 class="text-3xl font-bold text-[#333333] mb-8">Наши ценности</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div class="bg-[#333333] rounded-xl p-6">
            <h3 class="text-xl font-semibold text-[#fff] mb-2">Ответственность</h3>
            <p class="text-lg text-[#fff]">
              Мы отвечаем за качество товаров и доверие наших клиентов.
            </p>
          </div>

          <div class="bg-[#333333] rounded-xl p-6">
            <h3 class="text-xl font-semibold text-[#fff] mb-2">Развитие</h3>
            <p class="text-lg text-[#fff]">
              Мы постоянно улучшаем сервис, расширяем ассортимент и внедряем новые решения.
            </p>
          </div>

          <div class="bg-[#333333] rounded-xl p-6">
            <h3 class="text-xl font-semibold text-[#fff] mb-2">Честность</h3>
            <p class="text-lg text-[#fff]">
              Прозрачные условия, честные цены и открытая коммуникация с клиентами.
            </p>
          </div>

          <div class="bg-[#333333] rounded-xl p-6">
            <h3 class="text-xl font-semibold text-[#fff] mb-2">Забота</h3>
            <p class="text-lg text-[#fff]">
              Мы заботимся о детях, родителях и качестве каждого заказа.
            </p>
          </div>
        </div>
      </section>
    </main>

    <Footer />
  </div>
</template>
