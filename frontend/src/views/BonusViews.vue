<script setup lang="ts">
import Header from '@/components/Header.vue'
import Footer from '@/components/Footer.vue'
</script>

<template>
  <div class="mx-auto font-mont px-4 sm:px-0">
    <Header />
    <main class="max-w-[1600px] mx-auto py-6 sm:py-8 lg:py-10 px-4 md:px-0">
      <section class="mb-8 sm:mb-10 lg:mb-12 p-4 sm:p-6 lg:p-10 bg-white rounded-2xl">
        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-[#333333] mb-4 sm:mb-6">
          Бонусная программа BabyLand
        </h1>
        <p class="text-base sm:text-lg text-[#333333] mb-6 sm:mb-10">
          Мы ценим каждого клиента! Участвуйте в бонусной программе BabyLand и получайте бонусы за
          покупки, которые можно использовать для оплаты следующих заказов.
        </p>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 sm:gap-6">
          <div class="border border-[#333333] rounded-2xl p-4 sm:p-6 text-center">
            <h3 class="text-2xl font-bold text-[#333333] mb-3">1. Совершайте покупки</h3>
            <p class="text-base sm:text-lg text-[#333333]">
              За каждую покупку вы получаете бонусы — 5% от суммы заказа возвращается на ваш
              бонусный счет.
            </p>
          </div>

          <div class="border border-[#333333] rounded-2xl p-4 sm:p-6 text-center">
            <h3 class="text-2xl font-bold text-[#333333] mb-3">2. Копите бонусы</h3>
            <p class="text-base sm:text-lg text-[#333333]">
              Бонусы накапливаются автоматически и сохраняются в вашем личном кабинете.
            </p>
          </div>

          <div class="border border-[#333333] rounded-2xl p-4 sm:p-6 text-center">
            <h3 class="text-2xl font-bold text-[#333333] mb-3">3. Оплачивайте заказы</h3>
            <p class="text-base sm:text-lg text-[#333333]">
              Используйте бонусы для оплаты до 30% стоимости следующего заказа.
            </p>
          </div>
        </div>
      </section>

      <section class="bg-[#333333] px-4 sm:px-6 lg:px-10 rounded-2xl p-6 sm:p-8 mb-8 sm:mb-12">
        <h2 class="text-2xl sm:text-3xl text-white mb-4 sm:mb-6">Условия бонусной программы</h2>
        <ul class="list-disc list-inside space-y-2 sm:space-y-3 text-white text-base sm:text-lg">
          <li>Бонусы начисляются только зарегистрированным пользователям</li>
          <li>Начисление бонусов происходит после подтверждения заказа</li>
          <li>1 бонус = 1 рубль</li>
          <li>Бонусы действуют в течение 12 месяцев с момента начисления</li>
          <li>Бонусы не подлежат обмену на денежные средства</li>
        </ul>
      </section>

      <section class="p-4 sm:p-6 lg:p-10 bg-white rounded-2xl">
        <h2 class="text-2xl sm:text-3xl font-bold text-[#333333] mb-4 sm:mb-6">
          Часто задаваемые вопросы
        </h2>
        <div class="space-y-4">
          <div class="border border-[#333333] rounded-xl p-3 sm:p-4">
            <h3 class="text-lg sm:text-xl font-semibold text-[#333333] mb-2">
              Когда начисляются бонусы?
            </h3>
            <p class="text-base sm:text-lg text-[#333333]">
              Бонусы начисляются после того, как заказ был успешно доставлен.
            </p>
          </div>

          <div class="border border-[#333333] rounded-xl p-3 sm:p-4">
            <h3 class="text-lg sm:text-xl font-semibold text-[#333333] mb-2">
              Где посмотреть баланс бонусов?
            </h3>
            <p class="text-base sm:text-lg text-[#333333]">
              Баланс бонусов отображается в вашем личном кабинете в разделе профиля.
            </p>
          </div>

          <div class="border border-[#333333] rounded-xl p-3 sm:p-4">
            <h3 class="text-lg sm:text-xl font-semibold text-[#333333] mb-2">
              Можно ли оплатить заказ полностью бонусами?
            </h3>
            <p class="text-base sm:text-lg text-[#333333]">
              Нет, бонусами можно оплатить не более 30% стоимости заказа.
            </p>
          </div>
          <div class="border border-[#333333] rounded-xl p-3 sm:p-4">
            <h3 class="text-lg sm:text-xl font-semibold text-[#333333] mb-2">
              Когда начинает действовать бонусная программа?
            </h3>
            <p class="text-base sm:text-lg text-[#333333]">
              Бонусная программа начинает свою работу с 01.02.2026 года.
            </p>
          </div>
        </div>
      </section>
    </main>
    <Footer />
  </div>
</template>
